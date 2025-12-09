<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::withCount('shortLinks')->latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function toggleAdmin(User $user)
    {
        $user->is_admin = ! $user->is_admin;
        $user->save();

        return back()->with('success', 'Role admin diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User dihapus.');
    }
}
