<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(int $user_id)
    {
        User::findOrFail($user_id);

        $logged_user = User::find(Auth::id());

        $messages = Message::where(
            function ($query) use($logged_user, $user_id){
                $query->where('receiver_id', '=', $logged_user->id)->where('sender_id', '=', $user_id);
            })->orWhere(
                function ($query) use($logged_user, $user_id){
                    $query->where('sender_id', '=', $logged_user->id)->where('receiver_id', '=', $user_id);
                })->get(['id', 'created_at', 'body'])->sortByDesc('created_at');

        return view('chat', ['messages' => $messages, 'user_id' => $user_id]);
    }

    public function create()
    {

    }

    public function store(int $user_id, Request $request)
    {
        User::findOrFail($user_id);
        $logged_user = User::find(Auth::id());
        $message = $request->input('text','');

        Message::create([
            'sender_id' => $logged_user->id,
            'receiver_id' => $user_id,
            'body' => $message
        ]);

        return redirect()->action([MessageController::class, 'index'], ['user_id' => $user_id]);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(int $id)
    {
        $logged_user = User::find(Auth::id());

        try{
            $message = Message::findOrFail($id);
        }catch (\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Message not found.'])->withInput();
        }

        if($message->sender_id != $logged_user->id and $message->receiver_id != $logged_user->id)
            abort(403);

        try{
            $message->delete();
        } catch (\Exception $e){
            return redirect()->back()->withErrors(['msg' => 'Problem with deleting the message.'])->withInput();
        }

        return redirect()->back()->withInput();
    }
}
