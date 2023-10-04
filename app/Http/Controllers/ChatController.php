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

    public function destroy($id)
    {
        $message = Message::find($id);
        $message->delete();

        return redirect('/');
    }

    public function purge($id)
    {
        // Find all chat messages by user ID
        $messages = Message::where('user_id', $id)->get();

        // Delete all found messages
        $messages->each->delete();

        return redirect('/');
    }

    public function ban($id, $userId)
    {
        // Find all chat messages by user ID and delete them
        Message::where('user_id', $id)->delete();

        // Find the chat room by ID (assuming it's ID 1)
        $chatRoom = ChatRoom::find(1);

        // Get the current banned users as an array
        $bannedUsers = $chatRoom->banned_users ?? [];

        // Add the user to the banned users array
        if (!in_array($userId, $bannedUsers)) {
            $bannedUsers[] = $userId;
        }

        // Update the chat room's banned_users attribute with the new array
        $chatRoom->banned_users = $bannedUsers;

        // Save the chat room
        $chatRoom->save();

        return view('forum.index', [ 'userId' => $id]);
    }
}
