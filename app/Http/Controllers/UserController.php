<?php

namespace App\Http\Controllers;

use App\Models\ChatRoom;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chatRoom = ChatRoom::find(1);
        $bannedUserIds = json_decode($chatRoom->banned_users) ?? [];
        $users = User::latest()->paginate(20);

        return view('admin.pages.users', compact(['users', 'bannedUserIds']));
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

    public function del_shoutbox_ban($userId)
    {
        $chatRoom = ChatRoom::find(1); // Assuming chat room ID is 1
        $bannedUserIds = json_decode($chatRoom->banned_users) ?? [];

        // Check if the user ID exists in the banned user IDs array
        $key = array_search($userId, $bannedUserIds);

        if ($key !== false) {
            // Remove the user ID from the banned user IDs array
            unset($bannedUserIds[$key]);

            // Update the banned users list in the chat room
            $chatRoom->banned_users = json_encode(array_values($bannedUserIds));
            $chatRoom->save();
        }

        return redirect()->route('users'); // Redirect back to the user list page
    }

    public function add_shoutbox_ban($userId)
{
    // Find the chat room by ID (assuming it's ID 1)
    $chatRoom = ChatRoom::find(1);

    // Get the current banned users as an array
    $bannedUsers = json_decode($chatRoom->banned_users) ?? [];

    // Add the user to the banned users array
    if (!in_array($userId, $bannedUsers)) {
        $bannedUsers[] = $userId;
    }

    // Update the chat room's banned_users attribute with the new array
    $chatRoom->banned_users = $bannedUsers;

    // Save the chat room
    $chatRoom->save();

    // Redirect back to the user list page
    return redirect()->route('users')->with('success', 'Shoutbox ban added successfully');
}
}
