@extends('layouts.app_no_chat')

@section('content')
    @include('modals.chose_resource_category_modal')
    <div class="container">
        <div class="h-11 mt-4 bg-slate-600 rounded-md">
            <div class="flex flex-row justify-center items-center h-full">
                <div class="w-[80%]">
                    <a href="/">Home</a>
                    >
                    <a href="/resources">resources</a>
                </div>
                <div class="resourceCategoryModalButton">
                    <a href="{{ route('resources.create') }}"
                        class="upload_resource_btn float-right mr-3 bg-red-600 rounded-md h-8 text-xs w-28 text-white p-2 sm:h-9 sm:w-28 sm:text-xs lg:h-9">Upload
                        resource</a>
                </div>

            </div>
        </div>
        <div class="resource-title">
            <h1 class="text-xl font-bold">Resources</h1>
        </div>
        <div class="main-container flex flex-row">

            <div class="resource-left-container w-56 float-left bg-slate-400">
                <div>
                    <span class="font-bold">Categories</span>
                    <div class="text-white">files</div>
                </div>
                <div>
                    <span class="font-bold">Top resources</span>
                    <div class="text-white">names</div>
                </div>
                <div>
                    <span class="font-bold">Most active authors</span>
                    <div class="text-white">name</div>
                </div>
            </div>
            <div class="resource-main-container w-full">
                <div class="resources-content">
                    @foreach ($resources as $resource)
                        <div class="resource border border-red-500 rounded-md p-4 mb-4">
                            <div class="uploader-avatar float-left">
                                <img class=" w-36" src="{{ asset('images/' . $resource->user->image) }}"
                                    alt="Uploader Avatar">
                            </div>
                            <div class="uploader-info ml-40 mt-2">
                                <p class="font-semibold">{{ $resource->user->name }}</p>
                                <p class="text-gray-500">{{ $resource->created_at->diffForHumans() }}</p>

                                <div class="resource-details mt-2">
                                    <p class="font-semibold">{{ $resource->title }}</p>
                                    <p>{{ $resource->description }}</p>
                                </div>
                                <div class="file-download mt-2">
                                    <a href="{{ asset('public_resources/resources/' . $resource->format) }}"
                                        class="text-blue-500 hover:underline">Download</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/choseCategoryResource.js') }}"></script>
@endsection
