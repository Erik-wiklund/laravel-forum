<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Message;
use App\Models\Thread;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Fetch all threads with their associated users
        $threads = Thread::with('user')->get(); // Changed $thread to $threads

        // Fetch all categories with their subcategories
        $categories = Category::with('subcategories')->get();

        // Fetch chat messages (you may want to limit the number of messages displayed)
        $messages = Message::latest()->take(50)->get();

        $onlineUsers = User::where('last_seen', '>=', now()->subMinutes(5))->get();
        $totalUsers = User::count();

        $ip = $request->ip();
    $visitor = Visitor::firstOrCreate(['ip_address' => $ip]);
    $visitor->increment('visits');
    $visitor->save();

    $visitors = Visitor::count();

    $totalUserCount = $totalUsers + $visitors;

        return view('forum.index', compact('categories', 'threads', 'messages', 'onlineUsers','totalUsers','visitors','totalUserCount'));
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
