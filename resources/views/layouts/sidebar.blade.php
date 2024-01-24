<div class="w-full mt-8">
    <aside>
        <div class="card">
            <div class="card-footer">
                <div class="register-login-thread-button mb-4 text-center">
                    @guest
                        <a href="{{ route('register') }}"
                            class="ml-auto bg-red-600 text-white text-center py-2 px-4 hover:bg-red-700"
                            style="border-radius: 4px">
                            Sign up
                        </a>
                    @endguest
                    @auth()
                        @if (Route::is('subcategories.threads.index'))
                            <label for=""
                                style="text-align: center; line-height: 40px; display: block; cursor: pointer; height: 40px;">
                                <a href="{{ route('threads.create', ['subcategory' => $subcategory]) }}"
                                    class="bg-red-600 block px-4 py-2 rounded-lg">Create new thread</a>
                            </label>
                        
                        @elseif(Route::is('pm.index'))
                            <label for=""
                                style="text-align: center;  display: block; cursor: pointer;">
                                <a href="{{ route('pm.create',['userId' => $user->id]) }}"
                                    class="bg-red-600 block px-4 py-2 rounded-lg">Create new PM</a>
                            </label>
                        @endif
                    @endauth
                </div>

                @auth
                    <div class="shoutbox-container" id="chat-messages"
                        style="height: 300px;  overflow:hidden; overflow-y: scroll;">
                        <!-- Display chat messages -->
                        <div id="chat-messages" padding: 10px;">
                            @foreach ($sidebarData['messages']->reverse() as $message)
                                <div class="message" style="border-bottom: solid lightgrey 1px;">
                                    <div class="flex justify-between items-center" style="font-size: 14px;">
                                        {{ $message->user->name }} - {{ $message->content }}
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
                        <form class="mt-2" method="post" action="{{ route('chat.send') }}"
                            style="display: flex; width: 100%;">
                            @csrf
                            <input type="text" name="content" placeholder="Type your message"
                                style="flex: 1; width: 100%; margin-right: 10px; font-size: 10px;" />
                            <button type="submit"
                                style="font-size: 14px; background: red; padding: 10px; border-radius: 7px;">Send</button>
                        </form>
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
                <dl>
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
                    <dt class="col-8 mb-0 text-sm">Total Forums:</dt>
                    <dd class="col-4 mb-0">15</dd>
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
            <div class="card-footer">
                <div>Newest Member</div>
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