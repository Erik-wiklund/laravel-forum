@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="row">
            <!-- Thread -->
            <div class="col-lg-12">
                <!-- Thread section -->
                <div class="text-white bg-info mb-0 p-4 rounded-top flex justify-between items-center">
                    <h4>
                        {{ $category->title }} / {{ $subcategory->title }} / {{ $thread->title }}
                    </h4>
                    @guest
                        <a href="{{ route('register') }}"
                            class="ml-auto bg-red-600 text-white text-center py-2 px-4 hover-bg-red-700"
                            style="border-radius: 4px">
                            Sign up
                        </a>
                    @endguest
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
                                        @if (!empty($thread->createdBy->image))
                                            <img src="{{ asset('images/' . $thread->createdBy->image) }}" alt="User Image"
                                                style="max-width: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </div>
                                    <div class="messagePrimaryContent" style="margin-left: 150px;">
                                        <div style="padding: 10px; min-height: 100px; overflow: hidden;"
                                            class="messageContent">{{ $thread->content }}</div>
                                        <a class="postcount"
                                            style="font-size: 12px; float: right; line-height: 2; margin-top: 0; margin-left: 6px;"
                                            href="#">#{{ $startCount }}</a>
                                        <div style="font-size: 12px; line-height: 2;" class="messageDetails">
                                            <span class="item-muted">
                                                <span href="#">{{ $thread->createdBy->name }}</span>
                                                ,
                                                <a style="color: #383838; margin-left: 2px;">
                                                    {{ $thread->created_at->format('M d, Y') }}
                                                </a>
                                            </span>
                                        </div>
                                        @if (Auth::check())
                                            <div class="messageTriggers"
                                                style="font-size: 12px; padding-top: 5px; padding-bottom: 5px; overflow: hidden; zoom: 1;">
                                                <div style="float: right" class="publishControls">
                                                    <a style="color: #fff;
                        background-color:#17a2b8;
                        padding-right: 8px;
                        padding-left: 8px;
                        margin: 0 1px 4px 0;
                        border: 0 solid #383838;
                        border-top-width: 1px;
                        border-bottom-width: 2px;
                        -webkit-border-radius: 2px;
                        -moz-border-radius: 2px;
                        -khtml-border-radius: 2px;
                        border-radius: 2px;
                        line-height: 24px;
                        float: none;
                        display: inline-block;
                        vertical-align: middle;"
                                                        href="#">Reply</a>
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
                                            <div>{!! $reply->content !!}</div>

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
                                                <div style="float: right" class="publishControls">
                                                    <a style="color: #fff;
                                                        background-color:#17a2b8;
                                                        padding-right: 8px;
                                                        padding-left: 8px;
                                                        margin: 0 1px 4px 0;
                                                        border: 0 solid #383838;
                                                        border-top-width: 1px;
                                                        border-bottom-width: 2px;
                                                        -webkit-border-radius: 2px;
                                                        -moz-border-radius: 2px;
                                                        -khtml-border-radius: 2px;
                                                        border-radius: 2px;
                                                        line-height: 24px;
                                                        float: none;
                                                        display: inline-block;
                                                        vertical-align: middle;"
                                                        href="#" class="quote-button"
                                                        data-quote="{{ $reply->content }}"
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
                <img src="{{ asset('images/' . $reply->createdBy->image) }}" alt="User Image" style="max-width: 140px;">
            </div>
            <form method="post"
                action="{{ route('reply.create', ['subcategory' => $subcategory->id, 'thread' => $thread->id]) }}"
                style="width: 100%; padding: 10px;">
                @csrf
                <!-- Add a textarea for user's reply -->
                <textarea class="w-full" name="content" id="reply-textarea" cols="30" rows="10"></textarea>
                <div style="text-align: right; margin-top: 8px;">
                    <button type="submit" style="background: red; padding: 10px; border-radius: 7px; text-align: right">
                        Post Reply
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    @else
        <div class="text-center"><a href="{{ route('login') }}">You must register or login to reply here</a></div>
    @endif
    </div>
    <style>
        .quoted-message {
            background-color: #f0f0f0;
            border-left: 4px solid #17a2b8;
            padding: 10px;
            /* margin: 10px 0; */
            font-style: italic;
            color: #333;
        }
    </style>

    <script>
        const quoteButtons = document.querySelectorAll('.quote-button');

        quoteButtons.forEach(button => {
            button.addEventListener('click', () => {
                const quotedMessage = button.getAttribute('data-quote');
                const username = button.getAttribute('data-username');

                if (quotedMessage) {
                    // Use the captured 'quotedMessage' and 'username' here
                    const contentToInsert = `
    <div class="quoted-message" style="background-color: grey; padding: 10px;">
        User ${username} said:
    </div>
    <div class="quoted-message" style="background-color: lightgrey; padding: 10px;">
        ${quotedMessage}
    </div><br>
`;


                    // Assuming you have initialized TinyMCE and have a reference to the editor instance
                    const editor = tinymce.get('reply-textarea');

                    if (editor) {
                        editor.insertContent(contentToInsert);
                    }
                }
            });
        });
    </script>
















@endsection
