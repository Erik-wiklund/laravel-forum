@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="row">
            <!-- Conversations -->
            <div class="col-lg-12">
                <!-- Conversations section -->
                <div class="text-white bg-info mb-0 p-4 rounded-top flex justify-between">
                    <h4>
                        <span>Private Conversations</span>
                    </h4>
                </div>

                <table class="table table-striped ">
                    <thead class="thead-light">
                        <tr>
                            <th class="posterAvatar"></th>
                            <th class="main">
                                <a href="#"><span>Subject Title</span></a>
                            </th>
                            <th class="stats">
                                <a href="#"><span>Replies</span></a>
                                <a href="#"><span>Participants</span></a>
                            </th>
                            <th class="lastposter"><a href="#"><span>Last Poster</span></a></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($conversationsWithNames))
                            @foreach ($conversationsWithNames as $conversation)
                                <tr>
                                    <td class="posterAvatar">
                                        <!-- Avatar content here -->
                                    </td>
                                    <div class="avatar">
                                        <!-- Display the creator's avatar here -->
                                        <img src="" alt="">
                                    </div>
                                    <td class="conversation-details">
                                        <h3 class="conversation-title">
                                            <a
                                                href="{{ route('pm.show', ['conversation' => $conversation->id, 'userId' => $user->id]) }}">{{ $conversation->subject }}</a>
                                        </h3>
                                        <p class="participants-info">
                                            Participants: {{ $conversation->participantNames->implode(', ') }}
                                        </p>
                                        <p class="created-info">
                                            Created by {{ $conversation->createdby->name }} on
                                            {{ $conversation->created_at->format('M d, Y') }}
                                        </p>
                                        </td>
                                        @php
                                            $lastReply = $conversation;
                                        @endphp
                                        <td>
                                            <p class="replies-info flex flex-col">
                                                <span>Replies: {{ $lastReply->privateMessageReplies->count() }}</span>
                                                <span>Participants: {{ count($conversation->participantNames) }}</span>
                                            </p>
                                        </td>

                                        <td>
                                            <div class="last-reply-details" style="color: grey; font-size: 14px;">
                                                <div class="flex items-center">
                                                    <a href="#">{{ $lastReply->lastPoster->name }}</a>
                                                </div>
                                                <p class="last-reply-date">
                                                    {{ $conversation->updated_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                        </td>
                                </tr>
                            @endforeach

                    </tbody>
                @else
                    <tr>
                        <td colspan="4">No conversations available.</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
