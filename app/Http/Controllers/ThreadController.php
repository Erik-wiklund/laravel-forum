<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Thread;
use Illuminate\Http\Request;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SubCategory $subcategory)
    {
        // Retrieve all threads related to the provided subcategory
        $threads = Thread::where('sub_category_id', $subcategory->id)->get();

        // Pass the subcategory and threads to the view
        return view('forum.threads.show', compact('threads', 'subcategory'));
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


    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        // // Retrieve the thread using the provided integer ID
        // $thread = Thread::find($id);

        // if (!$thread) {
        //     // Handle the case where the thread with the given ID is not found (e.g., show an error page)
        //     abort(404); // You can customize the error handling as needed
        // }

        // return view('forum.threads.thread-content.show', compact('thread'));
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
