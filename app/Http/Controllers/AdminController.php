<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

        $requests = \App\Models\Request::with('student')
            ->when($request->type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($request->search, function ($query, $search) {
                $query->whereHas('student', function ($studentQuery) use ($search) {
                    $studentQuery->where('apogee_number', 'like', "%{$search}%")
                        ->orWhere('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('Admin.All_Request', compact('requests', 'requestTypes', 'statuses'));
    }

    public function show(\App\Models\Request $request)
    {
        $request->load('student');
        return view('Admin.Request_Detail', compact('request'));
    }
}
