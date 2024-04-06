<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
//    public function store(Request $request)
//    {
//        $message = $request->input('message');
//        MessageSent::dispatch($message);
//        return response()->json(['success' => true,
//            'message' => 'Message sent!']);
//
//    }

public function index(Request $request)
{
    $messages = Message::with('user')
        ->latest()
        ->take(50)
        ->get()
        ->reverse();
    return view('chat.index', compact('messages'));
}

public function sendMessage(Request $request)
{
    $request->validate([
        'message' => 'required|string',
    ]);

    $message = new Message();
    $message->user_id = auth()->user()->id;
    $message->content = $request->input('message');
    $message->save();

    MessageSent::broadcast($message->content,$message->user_id,auth()->user()->name);
    return response()->json([
        'message' => $message->load('user'),
    ]);

}
}
