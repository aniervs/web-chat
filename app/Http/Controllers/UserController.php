<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);

        return view('users.users', ['users' => $users]);
    }

    public function show(int $id)
    {
        $user = User::findOrFail($id);

        return view('users.profile', ['user' => $user]);
    }

    public function edit($id)
    {
        try {
            $user = User::findOrfail($id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'User not found.']);
        }
        if (!Gate::allows('edit-user', $user)) {
            return redirect()->back()->withErrors(['msg' => 'You are not allowed to edit this user.']);
        }

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'User not found.'])->withInput();
        }

        $fields = $request->toArray();
        $validator = Validator::make($fields, [
            'name'     => ['string', 'nullable'],
            'avatar'   => ['image'],
            'is_admin' => ['boolean', 'nullable'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->has('name')) {
            $user->name = $request->name;
        }
        if ($request->has('is_admin')) {
            $user->is_admin = $request->is_admin;
        }
        if ($request->hasFile('avatar')) {
            $user->clearMediaCollection('avatars');
            $user->addMediaFromRequest('avatar')->toMediaCollection('avatars');
        }

        try {
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Problem when saving.']);
        }

        return redirect('/users/'.$user->id);
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'User not found.']);
        }

        if (!Gate::allows('delete-user', $user)) {
            return redirect()->back()->withErrors(['msg' => 'You are not allowed to delete this user.']);
        }

        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Problem when deleting.']);
        }

        return redirect()->back();
    }
}
