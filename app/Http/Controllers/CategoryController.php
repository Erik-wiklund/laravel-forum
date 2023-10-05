<?php

namespace App\Http\Controllers;

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
        $request->image->move(public_path('images'), $imageFileName);

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
        $image='';
        $imageFileName = '';
        $new_imageFileName = '';

        if ($request->image) {
            $image = $request->image;
            $imageFileName = $image->getClientOriginalName();
            $new_imageFileName = time() . $imageFileName;
            $request->image->move(public_path('images'), $new_imageFileName);
        }

        $category = Category::find($categoryId);
        if ($request->title) {
            $category->title = $request->title;
        }
        if ($request->desc) {
            $category->desc = $request->desc;
        }
        if ($request->order) {
            $category->order = $request->order;
        }

        if ($request->image) {
            $category->image = $new_imageFileName;
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
