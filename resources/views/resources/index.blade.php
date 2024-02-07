@extends('layouts.app_no_chat')

@section('content')
    @include('modals.chose_resource_category_modal')
    <div>
        <div class="h-11 mt-4 bg-slate-600 rounded-md">
            <div class="flex flex-row justify-center items-center h-full">
                <div class="w-[80%]">
                    <a href="/">Home</a>
                    >
                    <a href="/resources">resources</a>
                </div>
                <div class="resourceCategoryModalButton">
                    <button type="categoryButton" data-toggle="modal" data-target="#resourceCategoryModal"
                        class="upload_resource_btn float-right mr-3 bg-red-600 rounded-md text-white text-sm p-2">Upload
                        resource</button>
                </div>

            </div>
        </div>
        <div class="resource-title">
            <h1 class="text-xl font-bold">Resources</h1>
        </div>
        <div class="resource-container">
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
            <div class="resource-main-container">
                <div></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ URL::asset('js/choseCategoryResource.js') }}"></script>
@endsection
