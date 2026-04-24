<?php

namespace App\Http\Controllers;

use App\Models\Request;
use App\Models\Student;
use Illuminate\Http\Request as HttpRequest;
use Carbon\Carbon;

class FORequestsController extends Controller
{
    /**
     * Display a listing of the requests with pagination
     */
    public function index(HttpRequest $request)
    {
        $perPage = 5;
        $student = auth('student')->user();
        $query = Request::where('student_id', $student->id);

        // Search by reference or type
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where('reference', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by type
        if ($request->filled('type')) {
            $query->where('type', $request->input('type'));
        }

        $requests = $query->with('student')
            ->orderBy('submitted_at', 'desc')
            ->paginate($perPage);

        return view('fo_requests.index', [
            'requests' => $requests,
            'currentPage' => $requests->currentPage(),
            'totalPages' => $requests->lastPage(),
            'total' => $requests->total(),
            'perPage' => $perPage,
        ]);
    }

    /**
     * Show the form for creating a new request
     */
    public function create(HttpRequest $request)
    {
        $type = $request->query('type');
        // If type is provided, validate it against allowed types

        if (!$this->reclamationsEnabled()) {
            return redirect()->route('requests.index')
                ->with('error', __('admin.reclamations_closed'))
                ->with('step', 1);
            ;
        }

        return view('fo_requests.create', [
            'types' => Request::TYPES,
            'selectedType' => $type,
        ]);
    }

    /**
     * Store a newly created request in storage
     */
    public function store(HttpRequest $request)
    {
        if (!$this->reclamationsEnabled()) {
            return redirect()->route('requests.index')
                ->with('error', __('admin.reclamations_closed_submission'));
        }

        $type = $request->input('type');

        // Validate base fields
        $validated = $request->validate([
            'type' => 'required|in:' . implode(',', array_keys(Request::TYPES)),
            'comment' => 'nullable|string|max:1000',
        ]);

        // Validate type-specific fields
        $typeRules = Request::typeRules($type);
        $typeValidated = $request->validate($typeRules);

        // Only keep fields defined in typeRules
        $typeData = array_intersect_key($typeValidated, array_flip(array_keys($typeRules)));

        // Generate next reference
        $reference = $this->nextReference();

        // Get authenticated student
        $student = auth('student')->user();

        switch ($type) {
            case 'transcript': {
                $type_times = Request::where('student_id', $student->id)->where('type', $type)->count();
                if ($type_times > Request::CONSTRAINTS[$type]['max_requests']) {
                    return redirect()->route('requests.index')
                        ->with('error', __('portal.max_requests_limit_reached', ['request' => __('admin.request_types.transcript')]));
                }
            }
                break;
            case 'enrollment_certificate': {
                $type_times = Request::where('student_id', $student->id)->where('type', $type)->count();
                if ($type_times > Request::CONSTRAINTS[$type]['max_requests']) {
                    return redirect()->route('requests.index')
                        ->with('error', __('portal.max_requests_limit_reached', ['request' => __('admin.request_types.enrollment_certificate')]));
                }
            }
                break;
        }

        // Create the request
        Request::create([
            'reference' => $reference,
            'student_id' => $student->id,
            'type' => $type,
            'status' => 'pending',
            'comment' => $validated['comment'] ?? null,
            'details' => $typeData,
            'submitted_at' => Carbon::now()->toDateString(),
        ]);

        return redirect()->route('requests.index')
            ->with('success', __('admin.request_submitted', ['reference' => $reference]));
    }

    /**
     * Display the specified request.
     */
    public function show(Request $request)
    {
        return view('fo_requests.show', compact('request'));
    }

    /**
     * Generate next unique request reference
     */
    private function nextReference(): string
    {
        $year = now()->year;
        $lastRequest = Request::where('reference', 'like', "REQ-{$year}-%")
            ->orderBy('id', 'desc')
            ->first();

        if (!$lastRequest) {
            $nextNumber = 1;
        } else {
            // Extract number from reference like REQ-2026-0001
            preg_match('/REQ-\d+-(\d+)/', $lastRequest->reference, $matches);
            $nextNumber = isset($matches[1]) ? intval($matches[1]) + 1 : 1;
        }

        return 'REQ-' . $year . '-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Show the form for editing the specified request.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified request in storage.
     */
    public function update(HttpRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified request from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
