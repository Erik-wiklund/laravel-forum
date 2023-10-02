<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    public function sendMessage(Request $request)
    {
        // Validate the form data (message content)
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Assuming chat room ID is 1
        $chatRoomId = 1;

        // Create a new message
        $message = new Message();
        $message->content = $request->input('content');
        $message->chat_room_id = $chatRoomId; // Associate with the chat room
        $message->user_id = auth()->user()->id; // Associate with the user who sent the message
        $message->save();

        return redirect()->route('forum.index')->with('success', 'Message sent successfully.');
    }
}
