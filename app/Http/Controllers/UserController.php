<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('users', ['users' => $users]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(int $id)
    {
        $user = User::findOrFail($id);

        return view('user_detail', ['user' => $user]);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'User not found.']);
        }

        $fields = $request->toArray();
        if (isset($fields['_token'])) {
            unset($fields['_token']);
        }
        foreach ($fields as $key => $val) {
            $user->$key = $val;
        }
        $user->save();

        return redirect()->back();
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'User not found.']);
        }
        $user->delete();

        return redirect()->back();
    }
}
