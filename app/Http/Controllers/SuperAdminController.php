<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class SuperAdminController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $admins = Admin::when($search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('department', 'like', "%{$search}%");
        })
        ->orderByDesc('created_at')
        ->paginate(10)
        ->withQueryString();

        $totalAdmins = Admin::count();
        $activeSessions = 12;
        $securityAlerts = 0;

        return view('admin.manage-admins', compact('admins', 'totalAdmins', 'activeSessions', 'securityAlerts', 'search'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'department' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        $data['role'] = 'admin';
        Admin::create($data);

        return redirect()->route('admin.manage.index')->with('success', 'Administrator created successfully.');
    }

    public function show(Admin $admin)
    {
        return view('admin.show-admin', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('admin.edit-admin', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'department' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $admin->update($data);

        return redirect()->route('admin.manage.index')->with('success', 'Administrator updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        if ($admin->role === 'super_admin') {
            return redirect()->route('admin.manage.index')->with('error', 'A super administrator cannot be deleted.');
        }

        $admin->delete();

        return redirect()->route('admin.manage.index')->with('success', 'Administrator deleted successfully.');
    }
}
