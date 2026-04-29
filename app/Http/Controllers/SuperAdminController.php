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
        $adminsAddedToday = Admin::whereDate('created_at', now()->toDateString())->count();
        $adminsAddedThisWeek = Admin::where('created_at', '>=', now()->subWeek())->count();

        return view('Admin.manage-admins', compact('admins', 'totalAdmins', 'adminsAddedToday', 'adminsAddedThisWeek', 'search'));
    }

    public function store(Request $request)
    {
        $messages = [
            'password.not_regex' => 'Le mot de passe ne peut pas être composé uniquement de chiffres.',
        ];

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email',
            'department' => 'required|string|max:255',
            'password' => ['required', 'string', 'min:8', 'not_regex:/^\\d+$/'],
        ], $messages);

        $data['role'] = 'admin';
        Admin::create($data);

        return redirect()->route('admin.manage.index')->with('success', __('admin.administrator_created'));
    }

    public function show(Admin $admin)
    {
        return view('Admin.show-admin', compact('admin'));
    }

    public function edit(Admin $admin)
    {
        return view('Admin.edit-admin', compact('admin'));
    }

    public function update(Request $request, Admin $admin)
    {
        $messages = [
            'password.not_regex' => 'Le mot de passe ne peut pas être composé uniquement de chiffres.',
        ];

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('admins')->ignore($admin->id)],
            'department' => 'required|string|max:255',
            'password' => ['nullable', 'string', 'min:8', 'not_regex:/^\\d+$/'],
        ], $messages);

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $admin->update($data);

        return redirect()->route('admin.manage.index')->with('success', __('admin.administrator_updated'));
    }

    public function destroy(Admin $admin)
    {
        if ($admin->role === 'super_admin') {
            return redirect()->route('admin.manage.index')->with('error', __('admin.cannot_delete_super_admin'));
        }

        $admin->delete();

        return redirect()->route('admin.manage.index')->with('success', __('admin.administrator_deleted'));
    }
}
