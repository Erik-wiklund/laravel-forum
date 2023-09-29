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
    public function show(int $id)
    {
        // Retrieve the thread using the provided integer ID
        $thread = Thread::find($id);

        if (!$thread) {
            // Handle the case where the thread with the given ID is not found (e.g., show an error page)
            abort(404); // You can customize the error handling as needed
        }

        return view('forum.threads.thread-content.show', compact('thread'));
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
