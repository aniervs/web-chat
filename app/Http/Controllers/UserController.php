<?php

namespace App\Http\Controllers;

use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users', ['users' => $users]);
    }

//    public function show(int $id)
//    {
//        $user = User::findOrFail($id);
//
//        return view('user', ['user' => $user]);
//    }
}
