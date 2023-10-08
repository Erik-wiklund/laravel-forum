@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="row">
            <!-- Category -->
            <div class="col-lg-12">
                <!-- Category section  -->
                <div class="text-white bg-info mb-0 p-4 rounded-top flex justify-between">
                    <h4>
                        {{ $subcategory->title }}
                    </h4>
                    @guest
                        <a href="{{ route('register') }}"
                            class="ml-auto bg-red-600 text-white text-center py-2 px-4 hover:bg-red-700"
                            style="border-radius: 4px">
                            Sign up
                        </a>
                    @endguest
                    @auth()
                        <label for=""
                            style="text-align: center; line-height: 40px; display: block; cursor: pointer; height: 40px;">
                            <a href="{{ route('threads.create', ['subcategory' => $subcategory]) }}"
                                class="bg-red-600 block px-4 py-2 rounded-lg">Create new thread</a>
                        </label>
                    @endauth
                </div>

                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <!-- Table headers here -->
                    </thead>
                    <tbody>
                        <dl class="sectionHeaders"
                            style="background: lightgray; display: flex; table-layout: fixed; width: 100%; word-wrap: normal;">
                            <dd class="posterAvatar" style="width: 46px"><a
                                    style="display: block; color: #878787; outline: none;" href=""><span></span></a>
                            </dd>
                            <dd class="main" style="width: 40%;">
                                <a style="float: left; width: 50%; white-space: nowrap;"
                                    href="#"><span>Title</span></a>
                                <a style="float: left; width: 50%; white-space: nowrap;" href="#"><span>Start
                                        Date</span></a>
                            </dd>
                            <dd class="stats" style="width: 30%;">
                                <a style="float: left; width: 25%; white-space: nowrap;"
                                    href="#"><span>Replies</span></a>
                                <a style="float: left; width: 25%; white-space: nowrap;"
                                    href="#"><span>Views</span></a>
                            </dd>
                            <dd class="lastposter" style="width: 20%;"><a
                                    style="float: left; width: 100%; white-space: nowrap;" href=""><span>Last
                                        Poster</span></a></dd>
                        </dl>
                        <ol style="list-style: none; padding: 0; margin: 0;">
                            @foreach ($threads as $thread)
                                <li style="border-bottom: 1px solid #383838; display: flex; align-items: center;">
                                    <div class="posterAvatar">
                                        <!-- Avatar content here -->
                                    </div>
                                    <div class="mainblock" style="flex: 2;">
                                        <h3 style="font-size: 20px;">
                                            <div>
                                                <a href="{{ route('subcategories.threads.index', ['subcategory' => $subcategory]) }}"
                                                    class="text-uppercase">
                                                    <a
                                                        href="{{ route('thread-content.show', $thread) }}">{{ $thread->title }}</a>
                                                </a>
                                                @php
                                                    $createdBy = $subcategory->threads('created_by')->first();
                                                @endphp
                                                <div style="font-size: 14px; color: grey; display: flex"><a
                                                        href="#">{{ $createdBy->createdBy->name }},</a>
                                                    <div style="color: #383838"> {{ $createdBy->updated_at->format('M d, Y') }}</div>
                                                </div>
                                            </div>
                                        </h3>

                                        @php
                                            $lastThread = $subcategory->threads('last_poster_id')->first();
                                        @endphp

                                    </div>
                                    <div class="statsblock" style="flex: 1;">
                                        <!-- Stats content here -->
                                    </div>
                                    <div class="lastpost" style="flex: 1;">
                                        <!-- Last post content here -->

                                        <div style="color: grey; font-size: 14px; margin-left: 2px;">
                                            <div class="flex items-center">
                                                <a href="#">{{ $lastThread->lastPoster->name }}</a>
                                            </div>
                                            {{ $lastThread->updated_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
