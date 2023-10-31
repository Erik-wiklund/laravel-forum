<?php

namespace App\Http\Controllers;

use App\Models\PrivateMessage;
use App\Models\PrivateMessageReply;
use Illuminate\Http\Request;

class PrivateMessageRepliyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PrivateMessage $conversation, int $privateMessageId)
    {

        // $privateMessage = PrivateMessage::find($privateMessageId);
        // $replies = $privateMessage->privateMessageReplies;




        // if (!$privateMessage) {
        //     // Handle the case where the thread with the given ID is not found (e.g., show an error page)
        //     abort(404); // You can customize the error handling as needed
        // }


        // // Controller code
        // return view('private_message.show', compact('privateMessage', 'replies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $conversationId, string $userId)
    {

        $conversation = PrivateMessage::find($conversationId);
        // Validate the form data (message content)
        $request->validate([
            'message' => 'required|string|max:255',
        ]);

        // Create a new reply
        $reply = new PrivateMessageReply();
        $reply->message = $request->input('message');
        $reply->private_message_id = $conversationId; 
        $reply->user_id = auth()->user()->id; 
        $reply->save();

        $conversation->unread = true;
        $conversation->last_poster_id = auth()->user()->id;
        $conversation->save();

      
        unset($conversation);

        return redirect()->route('pm.show', ['conversation' => $conversationId, 'userId' => $userId])->with('success', 'Reply sent successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
