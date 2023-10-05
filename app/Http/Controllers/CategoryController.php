<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Models\Category;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(20);

        return view('admin.pages.categories', compact(['categories']));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.new_category');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'desc' => 'required',
        'order' => 'required',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $category = new Category;
    $category->title = $request->title;
    $category->desc = $request->desc;
    $category->order = $request->order;
    $category->user_id = auth()->id();

    // Generate a unique filename for the uploaded image
    $imageFileName = time() . '.' . $request->image->extension();

    // Move the uploaded image to the public/images folder with the generated filename
    $imagePath = public_path('images/' . $imageFileName);
    $request->image->move(public_path('images'), $imageFileName);

    // Open the uploaded image using Intervention Image and resize it to fit within a 300x300 pixel box
    Image::make($imagePath)->fit(300, 300)->save($imagePath);

    $category->image = $imageFileName;
    $category->save();

    Session::flash('message', 'Category created successfully');
    Session::flash('alert-class', 'alert-success');
    return back();
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
    public function edit(string $categoryId)
    {
        $category = Category::find($categoryId);
        return view('admin.pages.edit_category', compact(['category']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $categoryId)
{
    $image = '';
    $imageFileName = '';
    $newImageFileName = '';

    if ($request->image) {
        $image = $request->image;
        $imageFileName = $image->getClientOriginalName();
        $newImageFileName = time() . $imageFileName;

        // Move the uploaded image to the public/images folder with the new filename
        $imagePath = public_path('images/' . $newImageFileName);
        $request->image->move(public_path('images'), $newImageFileName);

        // Open the uploaded image using Intervention Image and resize it to fit within a 300x300 pixel box
        Image::make($imagePath)->fit(300, 300)->save($imagePath);
    }

    $category = Category::find($categoryId);

    if ($request->filled('title')) {
        $category->title = $request->title;
    }
    if ($request->filled('desc')) {
        $category->desc = $request->desc;
    }
    if ($request->filled('order')) {
        $category->order = $request->order;
    }

    if ($request->image) {
        $category->image = $newImageFileName;
    }

    $category->save();

    Session::flash('message', 'Category updated successfully');
    Session::flash('alert-class', 'alert-success');

    return back();
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
