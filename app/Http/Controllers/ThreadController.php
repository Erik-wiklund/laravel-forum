<?php

namespace App\Http\Controllers;

use App\Models\AdminLog;
use App\Models\Category;
use App\Models\PageView;
use App\Models\SubCategory;
use App\Models\Thread;
use App\Models\ThreadView;
use App\Models\User;
use App\Models\User_role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategory $subcategory)
    {
        // Retrieve all threads related to the provided subcategory

        $threads = Thread::where('sub_category_id', $subcategory->id)->get();
        $user_roles = User_role::all();

        return view('forum.threads.index', compact('threads', 'subcategory', 'user_roles'));
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

    public function updateCheckboxValue(Request $request, $thread)
    {
        $value = $request->input('value');
        $context = $request->input('context');

        // Update the 'lockedOrNot' value based on the checkbox value
        $thread = Thread::find($thread);
        $thread->lockedOrNot = $value; // Set the value based on the checkbox
        $thread->save();

        // Create an admin log entry
        $adminLog = new AdminLog();
        $adminLog->user_id = auth()->check() ? auth()->user()->id : null;
        $adminLog->action = $context === 'lockThread' ? 'Lock Thread' : 'Unlock Thread';
        $adminLog->resource_type = 'thread';
        $adminLog->resource_id = $thread->id; // Set the resource_id to the thread_id
        $adminLog->thread_id = $thread ? $thread->id : null;
        $adminLog->save();

        return response()->json(['message' => 'Checkbox value and action updated successfully']);
    }

    public function show(SubCategory $subcategory, Thread $thread, Request $request, Category $category)
    {
        // Retrieve the thread by its ID
        $thread = Thread::findOrFail($thread->id);
        $category = Category::findOrFail($subcategory->id);
        $adminLogs = $thread->adminLogs; // Get the admin logs associated with the thread

        // Initialize the admin name variable
        $adminName = null;
        $lockedDate = null;
        if ($thread->lockedOrNot) {
            $lockLog = $thread->adminLogs()->where('action', 'Lock Thread')->first();
            if ($lockLog) {
                $adminName = $lockLog->admin->name; // Assuming the admin's name is in the 'name' field
                $lockedDate = $lockLog->created_at; // You may need to adjust the field name depending on your schema
            }
        }

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


        return view('forum.threads.show', compact('lockedDate', 'adminName', 'request', 'thread', 'subcategory', 'replies', 'category', 'user'));
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

    public function editThread($thread, Request $request)
    {
        $thread = Thread::find($thread);
        $title = $request->input('threadTitle');
        $thread->title = $title;
        $thread->save();

        Session::flash('message', 'Thread successfully updated');
        Session::flash('alert-class', 'alert-success');

        return back();
    }
}
