<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Models\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resources = Resources::all();
        return view('resources.index', compact('resources'));
    }

    public function chose_category()
    {
        return view('resources.chose_category');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:zip,rar,7z,tar,txt,mp3,wav,ogg,avi,mpg,mpeg,mkv,iso,pdf,png,jpg,jpeg,jpe,gif,psd,tif,bsp,dem,vtf,vmt,cfg,ini,sp,py',
        ]);
        // dd($request->all());
        // Validate the request data
        // $request->validate([
        //     'category' => 'required',
        //     'title' => 'required',
        //     'description' => 'required',
        //     'version' => 'required',
        //     'format' => 'required',
        // ]);

        $title = $request->input('title');
        $description = $request->input('description');
        $category = $request->input('category');
        $version = $request->input('version');
        $tag_line = $request->input('tag_line');
        $url = $request->input('url');

        // Create a new resource instance
        $resource = new Resources();
        $resource->created_by = auth()->user()->id;
        $resource->category = empty($category) ? null : $category;
        $resource->title = empty($title) ? null : $title;
        $resource->description = empty($description) ? null : $description;
        $resource->version = empty($version) ? null : $version;
        $resource->tag_line = empty($tag_line) ? null : $tag_line;
        $resource->format = empty($format) ? null : $format;
        $resource->url = empty($url) ? null : $url;
        if ($request->hasFile('format')) {
            // An image was uploaded
            // Generate a unique filename for the uploaded image
            $resourceFileName = time() . '.' . $request->format->extension();

            $request->format->move(public_path('public_resources/resources'), $resourceFileName);

            $resource->format = $resourceFileName;
        }
        if ($request->hasFile('image')) {
            // An image was uploaded
            // Generate a unique filename for the uploaded image
            $imageFileName = time() . '.' . $request->image->extension();

            // Move the uploaded image to the public/images folder with the generated filename
            $imagePath = public_path('public_resources/images' . $imageFileName);
            $request->image->move(public_path('public_resources/images'), $imageFileName);

            // Open the uploaded image using Intervention Image and resize it to fit within a 300x300 pixel box
            Image::make($imagePath)->fit(300, 300)->save($imagePath);

            $resource->image = $imageFileName;
        }


        // Save the resource
        $resource->save();

        // Redirect to a success page or perform any other actions
        return redirect()->back()->with('success', 'Resource added successfully.');
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
