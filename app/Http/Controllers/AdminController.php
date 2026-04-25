<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use App\Models\Student;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


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

        $statuses = \App\Models\Request::STATUSES;

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

                // Header: include useful student/request fields
                fputcsv($handle, [
                    'ID',
                    'Étudiant',
                    'Email',
                    'Numéro Apogee',
                    'CNE',
                    'Département',
                    'Type',
                    'Statut',
                    'Commentaire (admin)',
                    'Commentaire (étudiant)',
                    'Date de soumission',
                    'Date de mise à jour',
                ]);

                foreach ($query->get() as $reqItem) {
                    $student = $reqItem->student;

                    fputcsv($handle, [
                        $reqItem->id,
                        trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')),
                        $student->email ?? '',
                        $student->apogee_number ?? '',
                        $student->cne ?? '',
                        $student->department ?? '',
                        $reqItem->type,
                        $reqItem->status,
                        $reqItem->admin_comment ?? '',
                        $reqItem->student_comment ?? '',
                        $reqItem->created_at->format('Y-m-d H:i:s'),
                        $reqItem->updated_at->format('Y-m-d H:i:s'),
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

    public function studentsIndex(Request $request)
    {
        $departments = Student::query()
            ->select('department')
            ->distinct()
            ->orderBy('department')
            ->pluck('department');

        $statuses = Student::query()
            ->select('status')
            ->distinct()
            ->orderBy('status')
            ->pluck('status');

        $query = Student::query()
            ->when($request->department, function ($query, $department) {
                $query->where('department', $department);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->search, function ($query, $search) {
                $terms = preg_split('/\s+/', trim($search));

                foreach ($terms as $term) {
                    $query->where(function ($studentQuery) use ($term) {
                        $studentQuery->where('apogee_number', 'like', "%{$term}%")
                            ->orWhere('cne', 'like', "%{$term}%")
                            ->orWhere('first_name', 'like', "%{$term}%")
                            ->orWhere('last_name', 'like', "%{$term}%")
                            ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$term}%"]);
                    });
                }
            })
            ->latest();

        $students = $query->paginate(10)->withQueryString();

        return view('Admin.students.index', compact('students', 'departments', 'statuses'));
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
        $requiredColumns = [
            'first_name',
            'last_name',
            'email',
            'apogee_number',
            'cne',
            'date_of_birth',
            'department',
            'status',
            'cin',
            'birth_city',
            'nationality',
            'gender',
            'study_level',
            'specialization',
            'bac_year',
            'province',
            'academic_track',
        ];

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

            $missingRequired = false;
            foreach ($requiredColumns as $column) {
                if (!isset($data[$column]) || trim((string) $data[$column]) === '') {
                    $missingRequired = true;
                    break;
                }
            }

            if ($missingRequired) {
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

        return redirect()->route('admin.students.bulkUpload')
            ->with('success', __('admin.import_complete', ['created' => $created, 'skipped' => $skipped]))
            ->with('errors_list', $errors);
    }

    public function show(\App\Models\Request $request)
    {
        $request->load('student');
        if ($request->status === "pending") {
            $request->status = "in_review";
            $request->save();
        }

        return view('Admin.Request_Detail', compact('request'));
    }

    public function update(Request $httpRequest, \App\Models\Request $request)
    {
        $validated = $httpRequest->validate([
            'status' => ['required', Rule::in(array_keys(\App\Models\Request::STATUSES))],
            'admin_comment' => 'nullable|string|max:1000',
        ]);

        $request->update($validated);

        return back()->with('success', __('admin.request_updated'));
    }

    public function destroy(\App\Models\Request $request)
    {
        $request->delete();
        return redirect()->route('admin.requests.index')->with('success', __('admin.request_deleted'));
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
            ->get()
            ->map(function ($item) use ($totalRequests) {
                return [
                    'type' => $item->type,
                    'count' => $item->total,
                    'percent' => $totalRequests ? round(($item->total / $totalRequests) * 100) : 0,
                ];
            });

        // New data for pending actions
        $pendingActions = \App\Models\Request::with('student')
            ->where('status', 'pending')
            ->orderBy('created_at', 'asc')
            ->take(3)
            ->get();

        // New data for status distribution
        $statusDistribution = \App\Models\Request::query()
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->map(function ($item) use ($totalRequests) {
                return [
                    'status' => $item->status,
                    'count' => $item->count,
                    'percent' => $totalRequests ? round(($item->count / $totalRequests) * 100) : 0,
                ];
            });

        // Check reclamations status from Redis cache
        $reclamationsEnabled = Cache::store(config('cache.default'))->get('reclamations_enabled', true) ?? true;
        // Build translated maps for types and statuses so UI respects current locale
        $typeNames = [];
        foreach (\App\Models\Request::TYPES as $key => $label) {
            $translated = __('admin.request_types.' . $key);
            $typeNames[$key] = $translated === 'admin.request_types.' . $key ? $label : $translated;
        }

        $statusNames = [];
        foreach (\App\Models\Request::STATUSES as $key => $label) {
            $translated = __('admin.statuses.' . $key);
            $statusNames[$key] = $translated === 'admin.statuses.' . $key ? $label : $translated;
        }

        return view('Admin.dashboard', compact(
            'totalRequests',
            'pending',
            'approved',
            'rejected',
            'recentRequests',
            'typeVolumes',
            'typeNames',
            'pendingActions',
            'statusDistribution',
            'statusNames',
            'reclamationsEnabled' // Pass the reclamations status to the view
        ));
    }

    public function profile()
    {
        $admin = auth('admin')->user();
        return view('Admin.profile', compact('admin'));
    }

    public function recentRequesters()
    {
        $recent = \App\Models\Request::with('student')
            ->latest()
            ->take(12)
            ->get()
            ->pluck('student')
            ->filter()
            ->unique('id')
            ->values()
            ->take(8)
            ->map(function ($student) {
                return [
                    'id' => $student->id,
                    'name' => trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? '')),
                    'avatar' => $student->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode(trim(($student->first_name ?? '') . ' ' . ($student->last_name ?? ''))) . '&background=002045&color=ffffff&size=128',
                    'profile_url' => route('admin.students.show', $student->id),
                ];
            });

        return response()->json(['data' => $recent]);
    }

    // Toggle reclamations open/close status
    public function toggleReclamations(Request $request)
    {
        $request->validate([
            'status' => 'required|in:on,off',
        ]);

        $enabled = $request->input('status') === 'on';
        Cache::store(config('cache.default'))->forever('reclamations_enabled', $enabled);

        return redirect()->route('admin.dashboard')
            ->with('success', $enabled ? __('admin.reclamations_enabled') : __('admin.reclamations_disabled'));
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

        return redirect()->route('admin.students.create')->with('success', __('admin.student_added'));
    }

    public function showStudent(Student $student)
    {
        return view('Admin.students.show', compact('student'));
    }

    public function editStudent(Student $student)
    {
        return view('Admin.students.edit', compact('student'));
    }

    public function updateStudent(Request $request, Student $student)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => ['required', 'email', \Illuminate\Validation\Rule::unique('students')->ignore($student->id)],
            'apogee_number' => ['required', 'string', 'max:255', \Illuminate\Validation\Rule::unique('students')->ignore($student->id)],
            'cne' => ['nullable', 'string', 'max:255', \Illuminate\Validation\Rule::unique('students')->ignore($student->id)],
            'cin' => ['nullable', 'string', 'max:255', \Illuminate\Validation\Rule::unique('students')->ignore($student->id)],
            'date_of_birth' => 'required|date',
            'birth_city' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'gender' => 'nullable|in:M,F',
            'department' => 'required|string|max:255',
            'study_level' => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'bac_year' => 'nullable|string|max:4',
            'province' => 'nullable|string|max:255',
            'academic_track' => 'nullable|string|max:255',
            'status' => 'required|in:active,inactive',
        ]);

        $student->update($validated);

        return redirect()->route('admin.students.index')->with('success', __('admin.student_updated'));
    }

    public function destroyStudent(Student $student)
    {
        $student->delete();
        return redirect()->route('admin.students.index')->with('success', __('admin.student_deleted'));
    }

    public function exportStudents(Request $request)
    {
        $format = $request->get('format', 'xlsx');
        $studyLevel = $request->get('study_level', 'all');
        $status = $request->get('status', 'all');
        $department = $request->get('department', 'all');

        // Prepare filters
        $filters = [
            'study_level' => $studyLevel,
            'status' => $status,
            'department' => $department,
        ];

        $filename = 'students-' . now()->format('Ymd-His');

        if ($format === 'xlsx') {
            return Excel::download(
                new StudentExport($filters),
                $filename . '.xlsx'
            );
        } else {
            // CSV export
            return Excel::download(
                new StudentExport($filters),
                $filename . '.csv'
            );
        }
    }
}
