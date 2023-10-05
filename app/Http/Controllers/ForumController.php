<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\Thread;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all threads with their associated users
        $threads = Thread::with('user')->get();

        $latestuser = User::latest()->first();

        $chatRoom = ChatRoom::find(1);
        $bannedUserIds = json_decode($chatRoom->banned_users) ?? [];

        // Fetch all categories with their subcategories
        $categories = Category::with('subcategories')->get();

        // Fetch chat messages (you may want to limit the number of messages displayed)
        $messages = Message::latest()->take(50)->get();

        // Check if the user is logged in
        $onlineUsers = [];
        $totalUsers = User::count();
        $totalUserCount = $totalUsers;
        $visitors = 0;
        $membersOnline = 0;
        $totalOnline = 0;

        if (Auth::check()) {
            // User is logged in, fetch online users excluding the current user
            $onlineUsers = User::where('last_seen', '>=', now()->subMinutes(5))->get();
            $membersOnline = User::where('last_seen', '>=', now()->subMinutes(5))->get()->count();
            $totalOnline = $membersOnline + $visitors;
            $ip = $request->ip();
            $visitor = Visitor::firstOrCreate(['ip_address' => $ip]);
            $visitor->visits = 0; // Set visitor count to 1 for guests
            $visitor->save();
        } else {
            // User is not logged in
            $ip = $request->ip();
            $visitor = Visitor::firstOrCreate(['ip_address' => $ip]);
            $visitor->visits = 1; // Set visitor count to 1 for guests
            $visitor->save();

            $visitors = Visitor::count();
            $totalUserCount = $totalUsers + $visitors;
            $totalOnline = $membersOnline + $visitors;
        }

        return view('forum.index', compact('latestuser','bannedUserIds','totalOnline', 'membersOnline', 'categories', 'threads', 'messages', 'onlineUsers', 'totalUsers', 'visitors', 'totalUserCount'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
