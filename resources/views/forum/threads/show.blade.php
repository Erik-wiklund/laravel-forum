@extends('layouts.app')

@section('content')
    @include('modals.edit_thread_modal')
    @include('modals.report_thread_modal')
    @include('modals.report_reply_modal')
    <div class="col-lg-12">
        <div class="row">
            <!-- Thread -->
            <div class="col-lg-12">
                <!-- Thread section -->
                <div class="text-white mt-8 bg-info mb-0 p-4 rounded-top" style="min-height: 100px;">
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
                            <span class="text-white">Thread status:
                                <span class="text-gray-500">Not open for further replies.</span>
                            </span>
                        </div>
                    @endif
                    @if (auth()->check() && auth()->user()->isAdminOrMod())
                        @if (session()->has('errors'))
                            @foreach ($errors as $error)
                                {{ $error }}
                            @endforeach
                        @endif
                        @if (\Session::has('message'))
                            <p class="alert
      {{ Session::get('alert-class', 'alert-success') }}">
                                {{ Session::get('message') }}</p>
                        @endif
                        <div class="threadTools mt-4">
                            <div class="float-right">
                                <div class="popup">
                                    <a href="#" class="menu">Thread Tools
                                        <span class="arrowIcon"></span>
                                    </a>
                                    <div class="admin-menu">
                                        <div class="admin-menu-title">Thread Tools</div>
                                        <ul>
                                            <button data-toggle="modal" data-target="#editThreadModal" href="#">Edit
                                                Thread</button>
                                            <li><a href="#">Add Poll</a></li>
                                            <li><a href="#">Move Thread</a></li>
                                        </ul>
                                        <ul>
                                            <li><a href="#" class="openmodModal" data-user-id="">Moderator Actions</a>
                                            </li>
                                            <li>
                                                <input type="hidden" name="context" value="thread">
                                                <form method="POST"
                                                    action="{{ route('update-thread-checkbox', ['thread' => $thread->id]) }}">
                                                    @csrf
                                                    <input type="hidden" name="context" value="lockThread">
                                                    <input type="checkbox" id="LockedOrNot"
                                                        value="{{ $thread->lockedOrNot }}"
                                                        onchange="updateCheckboxValue(this)"
                                                        {{ $thread->lockedOrNot == 1 ? 'checked' : '' }}> Open /
                                                    <label for="LockedOrNot">Lock Thread</label>
                                                    <button hidden type="submit" style="background: green">Update</button>
                                                </form>
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
                                        <div>
                                            @if (!empty($thread->createdBy->image))
                                                <img src="{{ asset('images/' . $thread->createdBy->image) }}"
                                                    alt="User Image" style="max-width: 100px;">
                                            @else
                                                No Image
                                            @endif
                                        </div>
                                        <div class="user-container mt-1 text-center"
                                            style="width:100px;background-color: {{ $thread->createdBy->role->color }};padding: 5px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            {{ $thread->createdBy->role->name }}</div>
                                    </div>
                                    <div class="messagePrimaryContent" style="margin-left: 150px;">
                                        <div style="padding: 10px; min-height: 100px; overflow: hidden;"
                                            class="messageContent">{{ $thread->content }}</div>
                                        <a class="postcount"
                                            style="font-size: 12px; float: right; line-height: 2; margin-top: 0; margin-left: 6px;"
                                            href="#">#{{ $startCount }}</a>
                                        <div style="font-size: 12px; line-height: 2;" class="messageDetails">
                                            <span class="item-muted">
                                                @if (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isMod()))
                                                    <input type="hidden" name="context" value="lockThread">
                                                    <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                                                    <input type="checkbox" name="lockedOrNot" id="">
                                                @endif
                                                <span href="#">{{ $thread->createdBy->username }}</span>
                                                ,
                                                <a style="color: #383838; margin-left: 2px;">
                                                    {{ $thread->created_at->format('M d, Y') }}
                                                </a>
                                            </span>
                                        </div>
                                        @if (Auth::check())
                                            <div class="messageTriggers"
                                                style="font-size: 12px; padding-top: 5px; padding-bottom: 5px; overflow: hidden; zoom: 1;">
                                                <div class="reportThreadMessageButton">
                                                    <button class="replyButton float-left" href="#"
                                                        data-toggle="modal" data-target="#threadReportModal"
                                                        data-thread="{{ $thread->id }}">Report</button>

                                                </div>
                                                <div style="float: right" class="publishControls">
                                                    <a style="" href="#" class="quote-button replyButton"
                                                        data-quote="{{ $thread->content }}"
                                                        data-username="{{ $thread->createdBy->username }}">Reply</a>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </li>
                            @endif
                            @foreach ($replies as $key => $reply)
                                <li id="reply_{{ $reply->id }}"
                                    style="border-bottom: 1px solid #383838; padding: 10px;">
                                    <div class="posterAvatar" style="width: 150px; float: left;">
                                        <div>
                                            @if (!empty($reply->createdBy->image))
                                                <img src="{{ asset('images/' . $reply->createdBy->image) }}"
                                                    alt="User Image" style="max-width: 100px;">
                                            @else
                                                No Image
                                            @endif
                                        </div>
                                        <div class="user-container mt-1 text-center text-sm"
                                            style="width:100px;background-color: {{ $reply->user->role->color }};padding: 5px; border-radius: 5px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                                            {{ $reply->user->role->name }}</div>
                                    </div>
                                    <div class="messagePrimaryContent" style="margin-left: 150px;">
                                        <div class="messageContent"
                                            style="padding: 10px; min-height: 100px; overflow: hidden;">
                                            <div class="quoted-block">
                                                <div class="quoted-message" style="display: none"></div>
                                            </div>
                                            <div>{!! processMessageContent($reply->content, $reply->user) !!}</div>
                                        </div>
                                        <a class="postcount"
                                            style="font-size: 12px; float: right; line-height: 2; margin-top: 0; margin-left: 6px;"
                                            href="#">#{{ $startCount + $key + 1 }}</a>
                                        <div style="font-size: 12px; line-height: 2;" class="messageDetails">
                                            <span class="item-muted">
                                                @if (auth()->check() && (auth()->user()->isAdmin() || auth()->user()->isMod()))
                                                    <input type="hidden" name="context" value="lockThread">
                                                    <input type="hidden" name="thread_id" value="{{ $thread->id }}">
                                                    <input type="checkbox" name="lockedOrNot" id="">
                                                @endif
                                                <span href="#">{{ $reply->createdBy->username }}</span>
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
                                                    <div class="reportReplyMessageButton">
                                                        <button class="replyButton float-left" href=""
                                                            data-toggle="modal" data-target="#reportReplyModal"
                                                            data-report="{{ $reply->id }}"
                                                            data-thread="{{ $thread->id }}">Report</button>

                                                    </div>
                                                @endif
                                                <div style="float: right" class="publishControls">
                                                    <a style="" href="#" class="quote-button replyButton"
                                                        data-quote="{{ $reply->content }}"
                                                        data-username="{{ $reply->createdBy->username }}">Reply</a>
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
                    @include('components.forms.custom-editor')
                    <div style="text-align: right; margin-top: 8px;">
                        <button type="submit"
                            style="background: red; padding: 10px; border-radius: 7px; text-align: right">
                            Post Reply
                        </button>
                    </div>
                </form>
                <!-- Hidden form for mentioning user -->
                <form id="mentionForm" method="post" action="{{ route('mention') }}" style="display: none;">
                    @csrf
                    <input type="hidden" name="mentioned_user" id="mentionedUserId">
                </form>

                <div class="mentionDropdownatReplies"
                    style="position: absolute; display: none; background-color: #f9f9f9; min-width: 100px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                    <!-- Dropdown content will be added dynamically -->
                </div>
            </div>
        </div>
    @elseif (Auth::check() && $thread->lockedOrNot == 1)
        <div class="text-center"><a href="{{ route('login') }}">Thread has been locked</a></div>
    @else
        <div class="text-center"><a href="{{ route('login') }}">You must register or login to reply here</a></div>
    @endif

    @if (Auth::check() && $thread->lockedOrNot == 1)
        <div class="threadAlert p-1 mx-0 my-2"
            style="border: 1px solid #494949;border-radius: 2px;background-image: none;background-color: #3a3a3a;">
            <span class="text-white">Thread status:
                <span class="text-gray-500">Not open for further replies.</span>
            </span>
        </div>
    @endif

    <!-- Modal -->
    <div class="modal fade" id="ModeratorActionsModal" tabindex="-1" role="dialog" aria-labelledby="modModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modModalLabel">Moderation Actions</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modModalBody">
                    @if ($thread->lockedOrNot)
                        <p>Thread is locked by: {{ $adminName }}</p>
                        <p>Locked on: {{ $lockedDate }}</p>
                    @else
                        <p>Thread is not locked.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <style>
        .quoted-container {
            margin-bottom: 10px;
            /* Adjust margin as needed */
        }

        .quoted-header {
            background-color: grey;
            padding: 10px;
        }

        .quoted-content {
            background-color: lightgrey;
            padding: 10px;
        }
    </style>
    <script type="text/javascript" src="{{ URL::asset('js/show_thread.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/reply_report.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/thread_report.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/scrollToReplyElement.js') }}"></script>
    <script>
        const threadId = {{ $thread->id }};
    </script>
    <script>
        var mentionedUserId = null;

        function mentionUser(userId) {
            // Set the mentioned user ID
            mentionedUserId = userId;
            console.log("Mentioned User ID:", mentionedUserId);
        }

        $(document).ready(function() {
            // Event listener for clicking on a user in the mention dropdown
            $('.mentionDropdown').on('click', '.mentionUser', function() {
                var userId = $(this).data('user-id');
                mentionUser(userId);
            });

            // Event listener for form submission
            $('#sendMessageForm').submit(function(event) {
                // Prevent the default form submission
                event.preventDefault();

                // Submit the message form
                $('#sendMessageForm').unbind('submit').submit();

                // Check if a mention exists
                if (mentionedUserId) {
                    // Set the CSRF token
                    var csrfToken = $('meta[name="csrf-token"]').attr('content');

                    // Make an AJAX request to update the mention
                    $.ajax({
                        url: '/mention',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        data: {
                            mentioned_user: mentionedUserId // Include the mentioned user ID in the request
                        },
                        success: function(response) {
                            console.log("Mention updated successfully");
                            // Optionally, you can perform any actions after updating the mention
                        },
                        error: function(xhr, status, error) {
                            console.error("Failed to update mention:", error);
                        }
                    });
                }
            });
        });






        function searchUsersAtReplies(query) {
            // Check if query starts with @ and has more than one character
            if (!query.startsWith('@') || query.length <= 1) {
                // If not, hide the dropdown and return
                $('.mentionDropdownatReplies').hide();
                return;
            }

            // Remove @ from the beginning of the query
            const searchText = query.substring(1);

            // AJAX request to fetch users matching the searchText
            $.ajax({
                url: '/users/search',
                type: 'GET',
                data: {
                    query: searchText
                },
                success: function(response) {
                    const users = response.users;
                    const dropdown = $('.mentionDropdownatReplies');
                    dropdown.empty();
                    if (users.length > 0) {
                        dropdown.show();
                        users.forEach(user => {
                            const userElement = $('<div></div>').text(user.username);
                            userElement.data('user-id', user.id); // Set data-user-id attribute
                            console.log("User ID set for", user.username, ":", user.id); // Log user ID
                            userElement.addClass('mentionUser'); // Add class for event handling
                            userElement.on('click', function() {
                                // Replace the last word after @ with the selected user
                                const messageContent = $('.messageContentInThread');
                                const newQuery = '@' + user.username + ' ';
                                messageContent.val(newQuery);
                                dropdown.hide();
                            });
                            dropdown.append(userElement);
                        });
                    } else {
                        dropdown.hide();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>


    <script>
        $(document).ready(function() {
            $('.openProfileModal').on('click', function(e) {
                e.preventDefault();

                // Get the user ID from the data attribute
                var userId = $(this).data('user-id');

                // Create the URL using the named route
                var url = "{{ route('profile.show_modal', ['user' => ':userId']) }}";
                url = url.replace(':userId', userId);

                // Make an AJAX request to load the profile content
                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(data) {
                        // Populate the modal body with the loaded content
                        $('#profileModalBody').html(data);

                        // Show the modal manually
                        $('#profileModal').modal('show');
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
