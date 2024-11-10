<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\Mention;
use App\Models\User;
use App\Notifications\DepositSuccessful;
use App\Notifications\MentionSuccessful;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function mention(Request $request)
    {
        // Validate the request data
        $request->validate([
            'mentioned_user' => 'nullable|exists:users,id', // Mentioned user is optional and should exist in the users table
        ]);

        // Check if a user was mentioned
        if ($request->has('mentioned_user')) {
            // Find the mentioned user
            $mentionedUser = User::find($request->mentioned_user);

            // If the mentioned user exists, create the mention
            if ($mentionedUser) {
                $mention = Mention::create([
                    'mentioning_user_id' => Auth::user()->id,
                    'mentioned_user_id'  => $mentionedUser->id,
                ]);

                // Notify the mentioned user
                $mentionedUser->notify(new MentionSuccessful(Auth::user()->id));

                return redirect()->back()->with('status', 'User has been mentioned');
            } else {
                return redirect()->back()->with('error', 'The mentioned user does not exist.');
            }
        } else {
            // If no user was mentioned, simply redirect back
            return redirect()->back()->with('status', 'No user mentioned');
        }
    }

    public function markAsRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }

    public function clearAllNotifications()
    {
        auth()->user()->notifications()->delete();

        return redirect()->back()->with('success', 'All notifications cleared.');
    }
}
