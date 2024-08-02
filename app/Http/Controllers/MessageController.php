<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use App\Events\MessageSent;
use Auth;

class MessageController extends Controller
{
    public function sendMessage(Request $request)
{
    $message = Message::create([
        'from_user_id' => Auth::id(),
        'to_user_id' => $request->to_user_id,
        'message' => $request->message,
        'date' => date("Y-m-d"),
    ]);

    broadcast(new MessageSent($message))->toOthers();

    return response()->json(['status' => 'Message sent successfully']);
}

}
