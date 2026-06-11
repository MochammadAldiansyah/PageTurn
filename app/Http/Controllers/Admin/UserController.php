<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('dashboard.role.admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->hasRole('admin')) {
            return back()->with('error', 'Tidak dapat menghapus akun admin!');
        }

        $user->delete();
        return back()->with('success', 'User berhasil dihapus.');
    }
}
