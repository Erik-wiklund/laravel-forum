<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Http\Request;

class ReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Thread $thread, int $threadId)
    {

        $thread = Thread::find($threadId);
        $replies = $thread->replies;

        if (!$thread) {
            // Handle the case where the thread with the given ID is not found (e.g., show an error page)
            abort(404); // You can customize the error handling as needed
        }


        return view('forum.threads.thread-content.show', compact('replies', 'thread'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, string $threadId)
    {
        // Validate the form data (message content)
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Create a new reply
        $reply = new Reply();
        $reply->content = $request->input('content');
        $reply->thread_id = $threadId; // Associate with the thread
        $reply->user_id = auth()->user()->id; // Associate with the user who sent the reply
        $reply->save();

        return redirect()->route('thread-content.index', ['id' => $threadId])->with('success', 'Reply sent successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
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
        // Find the specific thread by ID
        $thread = Thread::find($id);

        if (!$thread) {
            // Handle the case where the thread with the given ID is not found (e.g., show an error page)
            abort(404); // You can customize the error handling as needed
        }

        // Assuming you have a reply model
        $newReply = new Reply();
        $newReply->content = 'Reply content';
        $newReply->thread_id = $thread->id; // Set the thread ID
        $newReply->user_id = auth()->user()->id; // Set the user ID of the reply author
        $newReply->save();

        // Update the last_poster_id in the thread to the user who made the reply
        $thread->last_poster_id = auth()->user()->id;
        $thread->save();

        // Unset the $thread variable if you no longer need it
        unset($thread);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
