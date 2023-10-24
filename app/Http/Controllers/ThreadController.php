<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PageView;
use App\Models\SubCategory;
use App\Models\Thread;
use App\Models\ThreadView;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategory $subcategory)
    {
        // Retrieve all threads related to the provided subcategory

        $threads = Thread::where('sub_category_id', $subcategory->id)->get();

        return view('forum.threads.index', compact('threads', 'subcategory'));
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Assuming you retrieve the subcategory here, adjust this based on your actual logic
        $subcategory = SubCategory::find(1); // Replace 1 with the actual subcategory ID or your logic to fetch it

        return view('forum.threads.create', compact('subcategory'));
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, SubCategory $subcategory)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new thread and associate it with the subcategory
        $thread = new Thread();
        $thread->title = $request->input('title');
        $thread->content = $request->input('content');
        $thread->sub_category_id = $subcategory->id; // Associate with the current subcategory
        $thread->created_by = auth()->user()->id; // Set the user ID of the creator
        $thread->last_poster_id = auth()->user()->id; // Set the initial last poster
        $thread->save();

        // Redirect to the newly created thread or another appropriate page
        return redirect()->route('subcategories.threads.index', ['subcategory' => $subcategory, 'thread' => $thread]);
    }

    public function updateCheckboxValue(Request $request, Thread $thread)
    {
        $value = $request->input('value');

        // Update the 'lockedOrNot' value in the database
        $thread->lockedOrNot = $value;
        $thread->save();

        return response()->json(['message' => 'Checkbox value updated successfully']);
    }


    /**
     * Display the specified resource.
     */


    public function show(SubCategory $subcategory, Thread $thread, Request $request, Category $category)
    {
        // Retrieve the thread by its ID
        $thread = Thread::findOrFail($thread->id);
        $category = Category::findOrFail($subcategory->id);

        // Check if the user is logged in and has not exceeded the rate limit
        if (Auth::check() && !RateLimiter::tooManyAttempts('view-thread:' . $request->user()->id, 1)) {
            // Increment the view count for this thread
            $thread->incrementViewCount();

            // Define the rate limit key and duration in minutes (e.g., 60 minutes)
            $rateLimitKey = 'view-thread:' . $request->user()->id;
            $rateLimitDuration = 60;

            // Apply rate limiting
            RateLimiter::hit($rateLimitKey, $rateLimitDuration);
        }

        $replies = $thread->replies()->paginate(20);

        $loggedInUserId = Auth::id();
        $user = User::find($loggedInUserId); // Replace with your user model
    

        return view('forum.threads.show', compact('request', 'thread', 'subcategory', 'replies', 'category','user'));
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
