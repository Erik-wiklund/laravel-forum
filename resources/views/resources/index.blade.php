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
                    @foreach ($categoryCounts as $categoryCount)
                        <div class="text-white">{{ $categoryCount->category }}
                            <span>{{ $categoryCount->count }}</span>
                        </div>
                    @endforeach
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

                                <div class="resource-details mt-2">
                                    <a href="{{ route('resources.show', ['resourceId' => $resource->id]) }}"
                                        class="font-semibold">{{ $resource->title }}
                                        {{ number_format($resource->version, 1) }}</a>
                                    <p>{{ $resource->description }}</p>
                                </div>
                                <div class="flex flex-row">
                                    <p class="font-semibold">{{ $resource->user->name }},</p>
                                    <p class="text-gray-500 ml-1">{{ $resource->created_at->format('F d, Y') }},</p>
                                    <p class="text-gray-500 ml-1">{{ $resource->category }}</p>
                                </div>
                                <p class="text-gray-500">{{ $resource->tag_line }}</p>
                                <p class="text-gray-500">{{ $resource->url }}</p>
                                {{-- <div class="file-download mt-2">
                                    <a href="{{ asset('public_resources/resources/' . $resource->format) }}"
                                        class="text-blue-500 hover:underline">Download</a>
                                </div> --}}
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/choseCategoryResource.js') }}"></script>
@endsection
