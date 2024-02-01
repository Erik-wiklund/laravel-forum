<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ChatRoom;
use App\Models\Message;
use App\Models\Thread;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer('layouts.sidebar', function ($view) {
            $onlineUsers = [];
            $totalUsers = User::count();
            $totalUserCount = $totalUsers;
            $visitors = 0;
            $membersOnline = 0;
            $totalOnline = 0;
            $activitiesCount = 0;
            $user = null;
            $userImage = null;

            $latestuser = User::latest()->first();

            if (Auth::check()) {
                // User is logged in, fetch online users excluding the current user
                $onlineUsers = User::where('last_seen', '>=', now()->subMinutes(5))->get();
                $membersOnline = User::where('last_seen', '>=', now()->subMinutes(5))->get()->count();
                $userImage = Auth::user()->image;
                $user = Auth::user();
                $currentUser = Auth::user();
                $repliesCount = $currentUser->repliesMade()->count();
                $threadsCount = $currentUser->threadsStarted()->count();
                $activitiesCount = $repliesCount + $threadsCount;


                $sidebarData['user'] = $currentUser;
                $sidebarData['activitiesCount'] = $activitiesCount;
                $totalCategories = Category::count();
                $categories = Category::all();
                $totalSubCategories = $categories->sum(function ($category) {
                    return $category->subcategories()->count();
                });
                $totalTopics = Thread::count();
                $messages = Message::all()->reverse();
                $chatRoom = ChatRoom::find(1);
                $bannedUserIds = json_decode($chatRoom->banned_users) ?? [];
                $totalOnline = $membersOnline + $visitors;
                $ip = request()->ip();
                $visitor = Visitor::firstOrCreate(['ip_address' => $ip]);
                $visitor->visits = 0; // Set visitor count to 1 for guests
                $visitor->save();
            } else {
                $totalCategories = Category::count();
                $categories = Category::all();
                $totalSubCategories = $categories->sum(function ($category) {
                    return $category->subcategories()->count();
                });
                $totalTopics = Thread::count();
                $messages = Message::all()->reverse();
                $chatRoom = ChatRoom::find(1);
                $bannedUserIds = json_decode($chatRoom->banned_users) ?? [];
                // User is not logged in
                $ip = request()->ip();
                $visitor = Visitor::firstOrCreate(['ip_address' => $ip]);
                $visitor->visits = 1; // Set visitor count to 1 for guests
                $visitor->save();

                $visitors = Visitor::count();
                $totalUserCount = $totalUsers + $visitors;
                $totalOnline = $membersOnline + $visitors;
            }

            $sidebarData = [
                'activitiesCount' => $activitiesCount,
                'user' => $user,
                'userImage' => $userImage,
                'onlineUsers' => $onlineUsers,
                'totalUsers' => $totalUsers,
                'totalOnline' => $totalOnline,
                'membersOnline' => $membersOnline,
                'visitors' => $visitors,
                'totalUserCount' => $totalUserCount,
                'latestUser' => $latestuser,
                'totalTopics' => $totalTopics,
                'totalCategories' => $totalCategories,
                'totalSubCategories' => $totalSubCategories,
                'messages' => $messages,
                'bannedUserIds' => $bannedUserIds,
            ];

            // dd($sidebarData);

            $view->with('sidebarData', $sidebarData);
        });
    }
}
