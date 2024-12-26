<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC');

        if (request()->has('search')) {
            $users = $users->where('email', 'like', '%' . request()->get('search', '') . '%');
        }

        return view('admin.users.index', [
            'users' => $users->paginate(8)
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()->with('success', 'user deleted successfully');
    }
}
