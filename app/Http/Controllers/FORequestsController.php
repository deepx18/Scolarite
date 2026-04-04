<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class FORequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = 5;
        $requests = \App\Models\Request::paginate($perPage);
        // $requests = Student::find(7)->requests;
        return view('fo_requests.index', [
            'requests' => $requests,
            'currentPage' => $requests->currentPage(),
            'totalPages' => $requests->lastPage(),
            'total' => $requests->total(),
            'perPage' => $perPage,
        ]);
    }
        
    /**
     * Show the form for creating a new resource.
    */
    public function create()
    {
        return view('fo_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \App\Models\Request::create([
            'student_id' => 7,
            'type' => $request->input('type'),
            'comment' => $request->input('comment'),
            'status' => 'PENDING',
        ]);

        return redirect()->route('requests.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
