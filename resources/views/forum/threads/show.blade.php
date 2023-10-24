@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="row">
            <!-- Thread -->
            <div class="col-lg-12">
                <!-- Thread section -->
                <div class="text-white bg-info mb-0 p-4 rounded-top" style="min-height: 100px;">
                    <div class="threadNavs">
                        <h4>
                            {{ $category->title }} / {{ $subcategory->title }} / {{ $thread->title }}
                        </h4>
                    </div>
                    <div class="threadTitle">
                        <div class=" mt-2">Discussion in '{{ $subcategory->title }}' started by
                            {{ $thread->createdBy->name }}, {{ $thread->created_at->format('M d, Y') }}.</div>
                    </div>
                    @if (Auth::check() && $thread->lockedOrNot == 1)
                        <div class="threadAlert p-1 mx-0 my-2"
                            style="border: 1px solid #494949;border-radius: 2px;background-image: none;background-color: #3a3a3a;">
                            <span>Thread status:
                                <span class="text-gray-500">Not open for further replies.</span>
                            </span>
                        </div>
                    @endif
                    @if (auth()->check() &&
                            auth()->user()->isAdminOrMod())
                        <div class="threadTools mt-4">
                            <div class="float-right">
                                <div class="popup">
                                    <a href="#" class="menu">Thread Tools
                                        <span class="arrowIcon"></span>
                                    </a>
                                    <div class="admin-menu">
                                        <div class="admin-menu-title">Thread Tools</div>
                                        <ul>
                                            <li><a href="#">Edit Thread</a></li>
                                            <li><a href="#">Add Poll</a></li>
                                            <li><a href="#">Move Thread</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="#">Moderator Actions</a></li>
                                            <li>
                                                <input type="checkbox" id="LockedOrNot" value="{{ $thread->lockedOrNot }}"
                                                    onchange="updateCheckboxValue(this)"
                                                    {{ $thread->lockedOrNot == 1 ? 'checked' : '' }}> Open
                                            </li>
                                            <li><input type="checkbox"> Select for Thread Moderation</li>
                                        </ul>
                                    </div>
                                </div>
                                <a href="">test</a>
                                <a href="">test</a>
                            </div>
                        </div>
                    @endif
                    @guest
                        <a href="{{ route('register') }}"
                            class="ml-auto bg-red-600 text-white text-center py-2 px-4 hover-bg-red-700 float-right"
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
                                                @if (auth()->check() &&
                                                        (auth()->user()->isAdmin() ||
                                                            auth()->user()->isMod()))
                                                    <input type="checkbox" name="lockedOrNot" id="">
                                                @endif
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
                                                @if (auth()->check() &&
                                                        (auth()->user()->isAdmin() ||
                                                            auth()->user()->isMod()))
                                                    <input type="checkbox" name="lockedOrNot" id="">
                                                @endif
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

    @if (Auth::check() && (Auth::user()->isAdminOrMod() || $thread->lockedOrNot == 0))
        <div class="quickReplyForm" style="border: gray 1px solid">
            <div class="quickReplyContainer" style="display: flex; align-items: center;">
                <div class="quickReplyerAvatar" style="margin-right: 10px; margin-left: 10px;">
                    <img src="{{ asset('images/' . $user->image) }}" alt="User Image" style="max-width: 140px;">
                </div>
                <form method="post"
                    action="{{ route('reply.create', ['subcategory' => $subcategory->id, 'thread' => $thread->id]) }}"
                    style="width: 100%; padding: 10px;">
                    @csrf
                    <!-- Add a textarea for the user's reply -->
                    <textarea class="w-full" name="content" id="reply-textarea" cols="30" rows="10"></textarea>
                    <div style="text-align: right; margin-top: 8px;">
                        <button type="submit"
                            style="background: red; padding: 10px; border-radius: 7px; text-align: right">
                            Post Reply
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @elseif (Auth::check() && $thread->lockedOrNot == 1)
        <div class="text-center"><a href="{{ route('login') }}">Thread has been locked</a></div>
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

        .popup {
            position: relative;
            display: inline-block;
        }

        .admin-menu {
            width: 300px;
            display: none;
            position: absolute;
            top: 100%;
            left: -112px;
            background-color: #17a2b8;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            padding: 10px;
            z-index: 1;
        }

        .popup:hover .admin-menu {
            display: block;
            /* Show the admin menu on hover */
        }

        .menu {
            position: relative;
            padding-right: 20px;
            /* Reserve space for the arrow icon */
            text-decoration: none;
        }

        .arrowIcon:before {
            content: '▼';
            /* Down arrow */
            position: absolute;
            right: 0;
            transition: transform 0.3s;
            /* Add a smooth transition effect */
        }

        .menu:hover .arrowIcon:before {
            transform: rotate(180deg);
            /* Rotate the arrow to point up on hover */
        }

        .admin-menu-title {
            font-weight: bold;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin: 5px 0;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }
    </style>

    <script>
        function updateCheckboxValue(checkbox) {
            const threadId = {{ $thread->id }}; // Replace with the actual thread ID
            const value = checkbox.checked ? '1' : '0';

            // Send an AJAX request to update the checkbox value in the database
            axios.post(`/update-thread-checkbox/${threadId}`, {
                    value
                })
                .then(response => {
                    // Handle a successful response here, if needed
                    // Reload the window after a successful response
                    location.reload();
                })
                .catch(error => {
                    // Handle errors if the request fails
                    console.error('Error:', error);
                });
        }


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
