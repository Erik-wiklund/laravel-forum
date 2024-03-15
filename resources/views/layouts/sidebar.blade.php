<div class="w-full my-8">
    <aside>
        <div class="card">
            <div>
                <div class="register-login-thread-button mb-4 text-center mt-4">
                    @guest
                        <a href="{{ route('register') }}"
                            class="ml-auto bg-red-600 text-white text-center py-2 px-4 hover:bg-red-700"
                            style="border-radius: 4px">
                            Sign up
                        </a>
                    @endguest
                    @auth()
                        @if (Route::is('subcategories.threads.index'))
                            <label for="" class="md:h-0"
                                style="text-align: center; line-height: 40px; display: block; cursor: pointer; height: 40px;">
                                <a href="{{ route('threads.create', ['subcategory' => $subcategory]) }}"
                                    class="bg-red-600 block px-4 py-2 rounded-lg md:h-8 md:text-xs md:leading-none md:m-1">Create
                                    new
                                    thread</a>
                            </label>
                        @elseif(Route::is('pm.index'))
                            <label for="" style="text-align: center;  display: block; cursor: pointer;">
                                <a href="{{ route('pm.create', ['userId' => $user->id]) }}"
                                    class="bg-red-600 block text-sm px-4 py-2 rounded-lg md:m-2">Create new PM</a>
                            </label>
                        @endif
                    @endauth
                </div>

                @auth
                    <div class="userInfo flex">
                        <div>
                            <img class="mx-3 mb-3 max-w-[100px] md:max-h-24 md:w-11"
                                src="{{ asset('images/' . $sidebarData['userImage']) }}" alt="User Image">
                        </div>
                        <div class="flex flex-col items-center">
                            <p class="">{{ $sidebarData['user']->username }}</p>
                            <span class="messages_count text-xs">Messages: {{ $sidebarData['activitiesCount'] }}</span>
                        </div>
                    </div>
                    <div class="shoutbox-container" id="chat-messages"
                        style="height: 300px;  overflow:hidden; overflow-y: scroll;">
                        <!-- Display chat messages -->
                        <div id="chat-messages" class="padding: 2px;">
                            @foreach ($sidebarData['messages']->reverse() as $message)
                                <div class="message p-1" style="border-bottom: solid lightgrey 1px;">
                                    <div class="flex justify-between items-center" style="font-size: 14px;">
                                        <div class="message_userContent">
                                            {{ $message->user->name }} - {!! processMessageContent($message->content, $sidebarData['user']) !!}
                                        </div>
                                        @if (auth()->user()->isAdmin())
                                            <div class="dropdown">
                                                <button
                                                    style="margin: 2px; font-size: 12px; background-color: #6c757d !important"
                                                    class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Actions
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <form class="text-center dropdown-item" method="POST"
                                                        action="{{ route('chat.destroy', ['message' => $message]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="font-size: 12px;">Delete
                                                            Message</button>
                                                    </form>
                                                    <form class="text-center dropdown-item" method="POST"
                                                        action="{{ route('chat.purge', ['id' => $message->user->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" style="font-size: 12px;">Purge user</button>
                                                    </form>
                                                    <form class="text-center dropdown-item" method="POST"
                                                        action="{{ route('chat.ban', ['id' => $message->user->id, 'userId' => $message->user->id]) }}">
                                                        @csrf
                                                        @method('POST')
                                                        <button type="submit" style="font-size: 12px;">Shoutbox ban
                                                            user</button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    @if (in_array(Auth::user()->id, $sidebarData['bannedUserIds']))
                        <div class="alert alert-danger" style="font-size: 14px;">
                            You are banned from sending messages in the shoutbox, please contact an administrator for help!
                        </div>
                    @else
                        <!-- Input form for sending messages -->
                        <form class="mt-2 mx-2" id="sendMessageForm" method="post" action="{{ route('chat.send') }}"
                            style="display: flex; width: 100%;">
                            @csrf
                            <input oninput="searchUsers(this.value)" type="text" name="content" class="messageContent"
                                placeholder="Type your message"
                                style="flex: 1; width: 100%; margin-right: 10px; font-size: 10px;" />
                            <button type="submit" class="mr-4"
                                style="font-size: 14px; background: red; padding: 10px; border-radius: 7px;">Send</button>
                        </form>

                        <!-- Hidden form for mentioning user -->
                        <form id="mentionForm" method="post" action="{{ route('mention') }}" style="display: none;">
                            @csrf
                            <input type="hidden" name="mentioned_user" id="mentionedUserId">
                        </form>

                        <div class="mentionDropdown"
                            style="position: absolute; display: none; background-color: #f9f9f9; min-width: 100px; box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2); z-index: 1;">
                            <!-- Dropdown content will be added dynamically -->
                        </div>
                    @endif
                @endauth


                <div class="card-body">
                    <h4 class="card-title"
                        style="border-radius: 5px; background: dodgerblue; padding: 6px; text-align: center">Members
                        In chat</h4>
                    <ul class="list-unstyled mb-0 flex">
                        @foreach ($sidebarData['onlineUsers'] as $user)
                            <li><a style="color: #aaa;" href="#" class="openProfileModal"
                                    data-user-id="{{ $user->id }}">{{ $user->name }},</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <dl class="m-2">
                    <h3 style="border-radius: 5px;background: dodgerblue; padding: 6px; text-align: center">Members
                        Online Now</h3>
                    <ul class="list-unstyled mb-0 flex">
                        @foreach ($sidebarData['onlineUsers'] as $user)
                            <li><a style="color: #aaa;" href="#" class="openProfileModal"
                                    data-user-id="{{ $user->id }}">{{ $user->name }},</a>
                            </li>
                        @endforeach
                    </ul>
                    <div>
                        Total: {{ $sidebarData['totalOnline'] }},
                        members: {{ $sidebarData['membersOnline'] }},
                        guests: {{ $sidebarData['visitors'] }},
                    </div>
                </dl>
            </div>

        </div>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Members Statistics</h4>
                <dl class="row">
                    <dt class="col-8 mb-0 text-sm">Total Categories:</dt>
                    <dd class="col-4 mb-0">{{ $sidebarData['totalCategories'] }}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-8 mb-0 text-sm">Total SubCategories:</dt>
                    <dd class="col-4 mb-0">{{ $sidebarData['totalSubCategories'] }}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-8 mb-0 text-sm">Total Topics:</dt>
                    <dd class="col-4 mb-0 ">{{ $sidebarData['totalTopics'] }}</dd>
                </dl>
                <dl class="row">
                    <dt class="col-8 mb-0 text-sm">Total members:</dt>
                    <dd class="col-4 mb-0">{{ $sidebarData['totalUsers'] }}</dd>
                </dl>
            </div>
            <div class="card-footer m-2">
                <div>Newest Member:</div>
                <div>
                    <a href="#" class="openProfileModal"
                        data-user-id="{{ $sidebarData['latestUser']['id'] }}">{{ $sidebarData['latestUser']['name'] }}</a>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="profileModal" tabindex="-1" role="dialog"
                    aria-labelledby="profileModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="profileModalLabel">User Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="profileModalBody">
                                <!-- Content will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>

                <link href="{{ asset('css/custom.css') }}" rel="stylesheet">


            </div>
    </aside>
</div>

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






    function searchUsers(query) {
        // Check if query starts with @ and has more than one character
        if (!query.startsWith('@') || query.length <= 1) {
            // If not, hide the dropdown and return
            $('.mentionDropdown').hide();
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
                const dropdown = $('.mentionDropdown');
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
                            const messageContent = $('.messageContent');
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
