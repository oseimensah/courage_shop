<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function users()
    {
        $users = User::with('profile')->latest()->get();
        return view('admin.user.home', compact('users'));
    }

    public function customers()
    {
        $users = User::with('profile')->whereHas("roles", function ($q) {
            $q->where("name", "customer");
        })->latest()->get();
        return view('admin.user.customer', compact('users'));
    }

    public function delete($id)
    {
        $profile = Profile::firstWhere('user_id', $id);
        $profile->delete();

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->back();
    }
}
