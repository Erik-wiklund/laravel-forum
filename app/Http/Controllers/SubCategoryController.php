<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = SubCategory::latest()->paginate(20);

        return view('admin.pages.subcategories', compact(['subcategories']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.new_subcategory');
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
        ]);

        $subcategory = new SubCategory();
        $subcategory->title = $request->title;
        $subcategory->desc = $request->desc;
        $subcategory->order = $request->order;
        $subcategory->user_id = auth()->id();
        $subcategory->save();

        Session::flash('message', 'Sub-Category created successfully');
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
    public function edit(string $subcategoryId)
    {
        $subcategory = SubCategory::find($subcategoryId);
        return view('admin.pages.edit_subcategory', compact(['subcategory']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $subcategoryId)
    {

        $subcategory = SubCategory::find($subcategoryId);
        if ($request->title) {
            $subcategory->title = $request->title;
        }
        if ($request->desc) {
            $subcategory->desc = $request->desc;
        }
        if ($request->order) {
            $subcategory->order = $request->order;
        }
        

        $subcategory->save();
        Session::flash('message', 'Sub-Category updated successfully');
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
