@extends('layouts.app')

@section('content')
    @include('modals.report_conversation_modal')
    @include('modals.report_reply_pm_modal')
    <div class="col-lg-12">
        <div class="row">
            <!-- Thread -->
            <div class="col-lg-12">
                <!-- Thread section -->
                <div class="text-white bg-info mb-0 p-4 rounded-top" style="min-height: 100px;">
                    <div class="threadNavs">
                        <h4>
                            Private Message
                        </h4>
                    </div>
                    <div class="threadTitle">
                        <div class=" mt-2">Discussion in '{{ $conversation->subject }}'</div>
                    </div>
                </div>

                <div>{{ $replies->links() }}</div>
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <!-- Table headers here -->
                    </thead>
                    <tbody>
                        <ol style="list-style: none; padding: 0; margin: 0;">
                            @php
                                $startCount = ($replies->currentPage() - 1) * $replies->perPage() + 1;
                            @endphp


                            @if ($replies->currentPage() === 1)
                                <li style="border-bottom: 1px solid #383838; padding: 10px;">

                                    <div class="posterAvatar" style="width: 150px; float: left;">
                                        @if (!empty($conversation->createdBy->image))
                                            <img src="{{ asset('images/' . $conversation->createdBy->image) }}"
                                                alt="User Image" style="max-width: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </div>
                                    <div class="messagePrimaryContent" style="margin-left: 150px;">
                                        <div style="padding: 10px; min-height: 100px; overflow: hidden;"
                                            class="messageContent">{{ $conversation->message }}</div>
                                        <a class="postcount"
                                            style="font-size: 12px; float: right; line-height: 2; margin-top: 0; margin-left: 6px;"
                                            href="#">#{{ $startCount }}</a>
                                        <div style="font-size: 12px; line-height: 2;" class="messageDetails">
                                            <span class="item-muted">
                                                <span href="#">{{ $conversation->createdBy->name }}</span>
                                                ,
                                                <a style="color: #383838; margin-left: 2px;">
                                                    {{ $conversation->created_at->format('M d, Y') }}
                                                </a>
                                            </span>
                                        </div>
                                        @if (Auth::check())
                                            <div class="messageTriggers"
                                                style="font-size: 12px; padding-top: 5px; padding-bottom: 5px; overflow: hidden; zoom: 1;">
                                                @if (Auth::check())
                                                    <div class="reportPrivateMessageButton">
                                                        <button class="replyButton float-left" href=""
                                                            data-toggle="modal" data-target="#reportConversationModal"
                                                            data-conversation="{{ $conversation->id }}">Report</button>

                                                    </div>
                                                @endif
                                                <div style="float: right" class="publishControls">
                                                    <a style="" href="#" class="quote-button replyButton"
                                                        data-quote="{{ $conversation->message }}"
                                                        data-username="{{ $conversation->createdBy->name }}">Reply</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endif


                            @foreach ($replies as $key => $reply)
                                <li style="border-bottom: 1px solid #383838; padding: 10px;">
                                    <div class="posterAvatar" style="width: 150px; float: left;">
                                        @if (!empty($reply->createdBy->image))
                                            <img src="{{ asset('images/' . $reply->createdBy->image) }}" alt="User Image"
                                                style="max-width: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </div>
                                    <div class="messagePrimaryContent" style="margin-left: 150px;">
                                        <div class="messageContent"
                                            style="padding: 10px; min-height: 100px; overflow: hidden;">
                                            <div class="quoted-block">
                                                <div class="quoted-message" style="display: none"></div>
                                            </div>
                                            @if (!in_array($user->id, $reply->has_read))
                                                <span data-reply-id="{{ $reply->id }}" class="new-indicator float-right"
                                                    style="color: red">New</span>
                                            @endif
                                            <div>{!! $reply->message !!}</div>

                                        </div>

                                        <a class="postcount"
                                            style="font-size: 12px; float: right; line-height: 2; margin-top: 0; margin-left: 6px;"
                                            href="#">#{{ $startCount + $key + 1 }}</a>
                                        <div style="font-size: 12px; line-height: 2;" class="messageDetails">
                                            <span class="item-muted">
                                                <span href="#">{{ $reply->createdBy->name }}</span>
                                                ,
                                                <a style="color: #383838; margin-left: 2px;">
                                                    {{ $reply->created_at->format('M d, Y') }}
                                                </a>
                                            </span>
                                        </div>
                                        @if (Auth::check())
                                            <div class="messageTriggers"
                                                style="font-size: 12px; padding-top: 5px; padding-bottom: 5px; overflow: hidden; zoom: 1;">
                                                @if (Auth::check())
                                                    <div class="reportpmReplyButton">
                                                        <button class="replyButton float-left" href=""
                                                            data-toggle="modal" data-target="#reportpmReplyModal"
                                                            data-replypm="{{ $reply->id }}"
                                                            data-conversation="{{ $conversation->id }}">Report</button>
                                                    </div>
                                                @endif
                                                <div style="float: right" class="publishControls">
                                                    <a style="" href="#" class="quote-button replyButton"
                                                        data-quote="{{ $reply->message }}"
                                                        data-username="{{ $reply->createdBy->name }}">Reply</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if (Auth::check())
        <div class="quickReplyForm" style="border: gray 1px solid">
            <div class="quickReplyContainer" style="display: flex; align-items: center;">
                <div class="quickReplyerAvatar" style="margin-right: 10px; margin-left: 10px;">
                    <img src="{{ asset('images/' . $user->image) }}" alt="User Image" style="max-width: 140px;">
                </div>
                <form method="post"
                    action="{{ route('pm.reply', ['conversation' => $conversation->id, 'userId' => $userId]) }}"
                    style="width: 100%; padding: 10px;">
                    @csrf
                    <!-- Add a textarea for the user's reply -->
                    <textarea class="w-full" name="message" id="reply-textarea" cols="30" rows="10"></textarea>
                    <div style="text-align: right; margin-top: 8px;">
                        <button type="submit"
                            style="background: red; padding: 10px; border-radius: 7px; text-align: right">
                            Post Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif



    <script type="text/javascript" src="{{ URL::asset('js/show_thread.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/reply_pm_report.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/conversation_pm_report.js') }}"></script>
    <script>
        const conversationId = {{ $conversation->id }};
    </script>


@endsection
