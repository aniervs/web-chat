<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Notifications\MessageReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function index($user_id = null)
    {
        if ($user_id === null) {
            $user_id = Auth::id();
        }

        $other_user = User::findOrFail($user_id);

        $logged_user = Auth::user();

        $messages = Message::where(
            function ($query) use ($logged_user, $user_id) {
                $query->where('receiver_id', '=', $logged_user->id)->where('sender_id', '=', $user_id);
            }
        )->orWhere(
            function ($query) use ($logged_user, $user_id) {
                $query->where('sender_id', '=', $logged_user->id)->where('receiver_id', '=', $user_id);
            }
        )->get()->sortBy('created_at');

        $users = User::all();

        return view('chat', ['messages' => $messages, 'users' => $users, 'other_user' => $other_user]);
    }

    public function store(int $user_id, Request $request)
    {
        $fields = $request->toArray();
        $validator = Validator::make($fields, [
            'text' => 'string|nullable',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $other_user = User::findOrFail($user_id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'User not found.']);
        }

        $logged_user = Auth::user();
        $message = $request->input('text', '');

        $message = Message::create([
            'sender_id'   => $logged_user->id,
            'receiver_id' => $user_id,
            'body'        => $message,
        ]);

        $other_user->notify(new MessageReceived($message));

        return redirect()->action([MessageController::class, 'index'], ['user_id' => $user_id]);
    }

    public function destroy(int $id)
    {
        $logged_user = Auth::user();

        try {
            $message = Message::findOrFail($id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Message not found.']);
        }

        if (!Gate::allows('delete-message', $logged_user)) {
            return redirect()->back()->withErrors(['msg' => 'You are not allowed to delete this message.']);
        }

        try {
            $message->delete();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['msg' => 'Problem with deleting the message.'])->withInput();
        }

        return redirect()->back()->withInput();
    }
}
