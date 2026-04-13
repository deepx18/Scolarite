<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Notifications\AdminAnnouncementNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $requestTypes = \App\Models\Request::query()
            ->select('type')
            ->distinct()
            ->orderBy('type')
            ->pluck('type');
        // dd($requestTypes);

        $statuses = \App\Models\Request::query()
            ->select('status')
            ->distinct()
            ->orderBy('status')
            ->pluck('status');

        $query = \App\Models\Request::with('student')
            ->when($request->type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->search, function ($query, $search) {
                $terms = preg_split('/\s+/', trim($search));

                $query->whereHas('student', function ($studentQuery) use ($terms) {
                    foreach ($terms as $term) {
                        $studentQuery->where(function ($studentSubQuery) use ($term) {
                            $studentSubQuery->where('apogee_number', 'like', "%{$term}%")
                                ->orWhere('cne', 'like', "%{$term}%")
                                ->orWhere('first_name', 'like', "%{$term}%")
                                ->orWhere('last_name', 'like', "%{$term}%")
                                ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$term}%"]);
                        });
                    }
                });
            })
            ->latest();

        if ($request->filled('export')) {
            $filename = 'demandes-' . now()->format('Ymd-His') . '.csv';

            $callback = function () use ($query) {
                $handle = fopen('php://output', 'w');
                fwrite($handle, "\xEF\xBB\xBF");
                fputcsv($handle, ['ID', 'Étudiant', 'Numéro Apogee', 'Type', 'Statut', 'Date de soumission', 'Date de mise à jour']);

                foreach ($query->get() as $request) {
                    fputcsv($handle, [
                        $request->id,
                        trim(($request->student->first_name ?? '') . ' ' . ($request->student->last_name ?? '')),
                        $request->student->apogee_number ?? '',
                        $request->type,
                        $request->status,
                        $request->created_at->format('Y-m-d H:i:s'),
                        $request->updated_at->format('Y-m-d H:i:s'),
                    ]);
                }

                fclose($handle);
            };

            return response()->streamDownload($callback, $filename, [
                'Content-Type' => 'text/csv; charset=UTF-8',
                'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            ]);
        }

        $requests = $query->paginate(10)->withQueryString();

        return view('Admin.All_Request', compact('requests', 'requestTypes', 'statuses'));
    }

    public function bulkUploadForm()
    {
        return view('Admin.students.bulk-upload');
    }

    public function bulkUploadStore(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $handle = fopen($path, 'r');

        if ($handle === false) {
            return back()->withErrors(['file' => 'Unable to read the uploaded file.']);
        }

        $header = fgetcsv($handle);
        $requiredColumns = ['first_name', 'last_name', 'email', 'apogee_number', 'cne', 'date_of_birth', 'department', 'status'];

        $normalizedHeader = array_map(function ($column) {
            return Str::of($column)->trim()->lower()->replace(' ', '_')->__toString();
        }, $header ?: []);

        foreach ($requiredColumns as $column) {
            if (!in_array($column, $normalizedHeader, true)) {
                fclose($handle);
                return back()->withErrors(['file' => "Le fichier doit contenir la colonne : {$column}."]);
            }
        }

        $created = 0;
        $skipped = 0;
        $errors = [];

        while (($row = fgetcsv($handle)) !== false) {
            if (count(array_filter($row)) === 0) {
                continue;
            }

            $data = array_combine($normalizedHeader, $row);
            $data = array_intersect_key($data, array_flip($requiredColumns));

            if (empty($data['email']) || empty($data['apogee_number']) || empty($data['first_name']) || empty($data['last_name'])) {
                $skipped++;
                continue;
            }

            if (Student::where('email', $data['email'])->exists() || Student::where('apogee_number', $data['apogee_number'])->exists() || Student::where('cne', $data['cne'])->exists()) {
                $skipped++;
                continue;
            }

            try {
                Student::create($data);
                $created++;
            } catch (\Throwable $e) {
                $errors[] = "Ligne {\count($errors) + 1} : {$e->getMessage()}";
                $skipped++;
            }
        }

        fclose($handle);

        return redirect()->route('admin.students.bulkUpload')->with('success', "Import terminé : {$created} étudiants ajoutés, {$skipped} ignorés.")->with('errors_list', $errors);
    }

    public function show(\App\Models\Request $request)
    {
        $request->load('student');
        return view('Admin.Request_Detail', compact('request'));
    }

    public function announcementForm()
    {
        return view('Admin.notify-all');
    }

    public function sendAnnouncement(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $students = Student::whereNotNull('email')->where('email', '!=', '')->get();

        if ($students->isEmpty()) {
            return back()->with('error', 'Aucun étudiant trouvé avec une adresse email valide.');
        }

        Notification::send($students, new AdminAnnouncementNotification($validated));

        return redirect()->route('admin.dashboard')->with('success', 'Annonce envoyée à tous les étudiants.');
    }

    public function notificationsHistory()
    {
        $notifications = \Illuminate\Notifications\DatabaseNotification::where('type', AdminAnnouncementNotification::class)
            ->latest()
            ->paginate(20);

        return view('Admin.notifications-history', compact('notifications'));
    }

    public function dashboard()
    {
        $totalRequests = \App\Models\Request::count();
        $pending = \App\Models\Request::where('status', 'pending')->count();
        $approved = \App\Models\Request::where('status', 'approved')->count();
        $rejected = \App\Models\Request::where('status', 'rejected')->count();
        $recentRequests = \App\Models\Request::with('student')->latest()->take(5)->get();

        $typeVolumes = \App\Models\Request::query()
            ->selectRaw('type, COUNT(*) as total')
            ->groupBy('type')
            ->orderByDesc('total')
            ->take(4)
            ->get()
            ->map(function ($item) use ($totalRequests) {
                return [
                    'type' => $item->type,
                    'count' => $item->total,
                    'percent' => $totalRequests ? round(($item->total / $totalRequests) * 100) : 0,
                ];
            });

        return view('Admin.dashboard', compact(
            'totalRequests',
            'pending',
            'approved',
            'rejected',
            'recentRequests',
            'typeVolumes'
        ));
    }

    public function createStudent()
    {
        return view('Admin.students.create');
    }

    public function storeStudent(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'apogee_number' => 'required|string|max:255|unique:students,apogee_number',
            'cne' => 'required|string|max:255|unique:students,cne',
            'date_of_birth' => 'required|date',
            'department' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        Student::create($validated);

        return redirect()->route('admin.students.create')->with('success', 'Student added successfully.');
    }
}
