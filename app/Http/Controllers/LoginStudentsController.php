<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class LoginStudentsController extends Controller
{
    // Display login form
    public function loginForm()
    {
        return view('layouts.login-students'); // login Blade
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'apogee_number' => 'required|string',
            'date_of_birth' => 'required|date',
        ]);

        // Check student credentials
        $student = Student::where('apogee_number', $request->apogee_number)
                          ->where('date_of_birth', $request->date_of_birth)
                          ->first();

        if ($student) {
            // Save student id in session
            session(['student_id' => $student->id]);
            
            // Redirect to student dashboard or requests page
            return redirect()->route('requests.index'); 
        }

        // If invalid credentials
        return back()->withErrors([
            'apogee_number' => 'Invalid Apogee number or date of birth.',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $request->session()->forget('student_id'); // remove student from session
        return redirect()->route('students.login'); // redirect to login page
    }
}