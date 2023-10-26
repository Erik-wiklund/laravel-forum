@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="row">
            <!-- Category -->
            <div class="col-lg-12">
                <!-- Category section -->
                <div class="text-white bg-info mb-0 p-4 rounded-top flex justify-between">
                    <h4>
                        {{ $subcategory->title }}
                    </h4>
                </div>

                <table class="table table-striped ">
                    <thead class="thead-light">
                        <tr>
                            <th class="posterAvatar"></th>
                            <th class="main">
                                <a href="#"><span>Title</span></a>
                                <a class="float-right" href="#"><span>Start Date</span></a>
                            </th>
                            <th class="stats">
                                <a href="#"><span>Replies</span></a>
                                <a href="#"><span>Views</span></a>
                            </th>
                            <th class="lastposter"><a href="#"><span>Last Poster</span></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($threads as $thread)
                            <tr>
                                <td class="posterAvatar">
                                    <!-- Avatar content here -->
                                </td>
                                <td class="mainblock">
                                    <h3 style="font-size: 20px;">
                                        <div>
                                            <a href="{{ route('subcategories.threads.index', ['subcategory' => $subcategory]) }}"
                                                class="text-uppercase">
                                                @if (auth()->check() &&
                                                        (auth()->user()->isAdmin() ||
                                                            auth()->user()->isMod()))
                                                    <input type="checkbox" name="lockedOrNot" id="">
                                                @endif
                                                <a
                                                    href="{{ route('threads.show', ['subcategory' => $subcategory->id, 'thread' => $thread->id]) }}">{{ $thread->title }}</a>
                                            </a>
                                            @php
                                                $createdBy = $subcategory->threads('created_by')->first();
                                            @endphp
                                            <div style="font-size: 14px; color: grey;">
                                                <a href="#">{{ $createdBy->createdBy->name }},</a>
                                                <div style="color: #383838">
                                                    {{ $createdBy->updated_at->format('M d, Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </h3>
                                    @php
                                        $lastThread = $subcategory->threads('last_poster_id')->first();
                                    @endphp
                                </td>
                                <td class="statsblock flex">
                                    <div class="mx-3">{{ $thread->replies->count() }}</div>
                                    <div class="mx-3">{{ $thread->views_count }}</div>
                                </td>
                                <td class="lastpost">
                                    <!-- Last post content here -->
                                    <div style="color: grey; font-size: 14px;">
                                        <div class="flex items-center">
                                            <a href="#">{{ $lastThread->lastPoster->name }}</a>
                                        </div>
                                        {{ $lastThread->updated_at->format('M d, Y') }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
