<?php

namespace App\Http\Controllers;

use Intervention\Image\Facades\Image;
use App\Models\Resources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    public function index()
    {

        $uniqueCategories = Resources::all()->pluck('category')->unique();
        $categoryCounts = Resources::groupBy('category')
            ->selectRaw('category, count(*) as count')
            ->get();

        $resources = Resources::all();
        $count = $resources->count();

        return view('resources.index', compact('resources', 'uniqueCategories', 'count', 'categoryCounts'));
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
            'category' => 'required|not_in:default',
            'version' => ['required', 'regex:/^\d+(\.\d+)?$/'],
            'title' => 'required|string',
            'description' => 'required|string',
            'format' => 'required|file|mimes:zip,rar,7z,tar,txt,mp3,wav,ogg,avi,mpg,mpeg,mkv,iso,pdf,png,jpg,jpeg,jpe,gif,psd,tif,bsp,dem,vtf,vmt,cfg,ini,sp,py',
        ]);
        // dd($request->all());

        $title = $request->input('title');
        $description = $request->input('description');
        $category = $request->input('category');
        $version = $request->input('version');
        $tag_line = $request->input('tag_line');
        $url = $request->input('url');

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
            $originalFileName = $request->format->getClientOriginalName();
            $request->format->move(public_path('public_resources/resources'), $originalFileName);
            $resource->format = $originalFileName;
        }
        if ($request->hasFile('image')) {
            $imageFileName = time() . '.' . $request->image->getClientOriginalName();
            $request->image->move(public_path('public_resources/images'), $imageFileName);
            $resource->image = $imageFileName;
        }

        $resource->save();

        return redirect()->back()->with('success', 'Resource added successfully.');
    }



    /**
     * Display the specified resource.
     */
    public function show($resourceId)
    {
        $resource = Resources::find($resourceId);

        // Check if resource is found
        if (!$resource) {
            abort(404); // Or handle the case where the resource is not found
        }

        $loggedInUser = Auth::user();
        $isCreator = $loggedInUser && $resource->created_by === $loggedInUser->id;

        return view('resources.show', compact('resource', 'isCreator'));
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
