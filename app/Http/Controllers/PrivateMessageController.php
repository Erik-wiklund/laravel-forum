<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\private_message;
use App\Models\PrivateMessage;
use App\Models\PrivateMessageUserStatus;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrivateMessageController extends Controller
{

    public function index($userId)
    {
        $user = User::find($userId);
        $authenticatedUserId = auth()->user()->id;

        // Get all private message conversations
        $conversations = PrivateMessage::all();

        $loggedInUserId = Auth::id();
        $user = User::find($loggedInUserId);

        $conversations = $conversations->filter(function ($conversation) use ($user) {
            $participants = is_array($conversation->participants) ? $conversation->participants : json_decode($conversation->participants, true);
            return in_array($user->id, $participants);
        });

        // Get the names of participants in each conversation
        $conversationsWithNames = $conversations->map(function ($conversation) use ($user) {
            // Parse the JSON string to an array
            $participants = is_array($conversation->participants) ? $conversation->participants : json_decode($conversation->participants, true);
            $participantNames = User::whereIn('id', $participants)->pluck('name');
            $conversation->participantNames = $participantNames;
            return $conversation;
        });

        // dd($conversationsWithNames);

        return view('private_message.index', compact('user', 'conversationsWithNames'));
    }



    public function create($userId)
    {
        $users = User::all();
        $user = User::find($userId);
        return view('private_message.new_private_message', compact('users', 'user'));
    }
    // Send a private message
    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'recipients' => 'required|array',
        ]);

        // Get the authenticated user (sender)
        $senderId = Auth::user()->id;

        // Include the sender ID in the recipients array
        $recipients = $request->input('recipients');
        $recipients[] = $senderId; // Add the sender to the recipients

        // Convert the recipients array to a JSON string
        $participants = json_encode($recipients);

        $message = $request->input('message');

        // Create a new private message conversation
        $privateMessage = new PrivateMessage();
        $privateMessage->subject = $request->input('subject');
        $privateMessage->created_by = auth()->user()->id;
        $privateMessage->last_poster_id = auth()->user()->id;
        $privateMessage->participants = $participants; // Store participants as JSON
        $privateMessage->message = $message;
        $privateMessage->save();

        // Redirect to the conversation or success page
        return back();
    }

    public function reply(Request $request, $conversationId)
    {
        // Find the conversation by its ID
        $conversation = PrivateMessage::find($conversationId);

        // Check if the conversation exists
        if (!$conversation) {
            abort(404); // Handle the case where the conversation is not found
        }

        // Get the current user
        $user = auth()->user();

        // Create a new reply record
        $reply = new PrivateMessage();
        $reply->participants = $conversation->participants;
        $reply->subject = 'Re: ' . $conversation->subject; // You can customize the subject as needed
        $reply->message = $request->input('message');
        $reply->created_by = auth()->user()->id;
        $reply->last_poster_id = auth()->user()->id;
        $reply->created_at = now(); // Use the current timestamp

        // Save the reply
        $reply->save();

        // Optionally, you can update the `last_poster_id` of the original conversation to the user who replied.

        return redirect()->back()->with('success', 'Reply sent successfully');
    }







    // Show messages in a conversation
    public function show(PrivateMessage $conversation, $userId)
    {
        $loggedInUserId = auth()->user()->id;

        $loggedInUserId = Auth::id();
        $user = User::find($loggedInUserId);

        // Retrieve the conversation's replies
        $replies = $conversation->privateMessageReplies()->paginate(20);

        // Mark unread messages as read and filter unread replies
        $unreadReplies = [];
        foreach ($replies as $reply) {
            $hasRead = $reply->has_read ?? [];
            if (!in_array($loggedInUserId, $hasRead)) {
                $hasRead[] = $loggedInUserId;
                $reply->has_read = $hasRead;
                $reply->save();
                $unreadReplies[] = $reply;
            }
        }

        // Retrieve the conversation's participants
        $participants = is_array($conversation->participants)
            ? $conversation->participants
            : json_decode($conversation->participants, true);

        // Get the names of participants in the conversation
        $participantNames = User::whereIn('id', $participants)->pluck('name');

        // Render the view, passing the unread messages and participant names
        return view('private_message.show', compact('user','unreadReplies', 'conversation','replies', 'participantNames', 'userId'));
    }
}
