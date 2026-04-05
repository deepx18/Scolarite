<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginStudentsController extends Controller
{
    public function showLoginForm()
    {
        return view('loginStudents.index');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'apogee' => 'required|string',
            'dob' => 'required|date',
        ], [
            'apogee.required' => 'Apogee number is required',
            'dob.required' => 'The date of birth is required',
            'dob.date' => 'The date of birth must be a valid date',
        ]);

        $student = Student::where('apogee_number', trim($validated['apogee']))
            ->where('date_of_birth', trim($validated['dob']))
            ->first();

        if ($student) {
            Auth::guard('student')->login($student);
            return redirect()->route('requests.index');
        }

        return back()
            ->withErrors(['apogee' => 'Invalid credentials'])
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login.student.show');
    }
}
