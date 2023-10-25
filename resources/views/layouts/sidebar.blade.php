<div class="w-full">
    <aside>
        <div class="card">

            <div class="card-footer">
                <div class="card-body">
                    <h4 class="card-title"
                        style="border-radius: 5px; background: dodgerblue; padding: 6px; text-align: center">Members
                        In chat</h4>
                    <ul class="list-unstyled mb-0 flex">
                        @foreach ($sidebarData['onlineUsers'] as $user)
                            <li><a style="color: #aaa;"
                                href="#" class="openProfileModal" data-user-id="{{ $user->id }}">{{ $user->name }},</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <dl>
                    <h3 style="border-radius: 5px;background: dodgerblue; padding: 6px; text-align: center">Members
                        Online Now</h3>
                    <ul class="list-unstyled mb-0 flex">
                        @foreach ($sidebarData['onlineUsers'] as $user)
                            <li><a style="color: #aaa;"
                                href="#" class="openProfileModal" data-user-id="{{ $user->id }}">{{ $user->name }},</a>
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
                    <dd class="col-4 mb-0 ">500</dd>
                </dl>
                <dl class="row">
                    <dt class="col-8 mb-0 text-sm">Total members:</dt>
                    <dd class="col-4 mb-0">{{ $sidebarData['totalUsers'] }}</dd>
                </dl>
            </div>
            <div class="card-footer">
                <div>Newest Member</div>
                <div>
                    <a href="#" class="openProfileModal" data-user-id="{{ $sidebarData['latestUser']['id'] }}">{{ $sidebarData['latestUser']['name'] }}</a>
                </div>
                
                <!-- Modal -->
                <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel" aria-hidden="true">
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
                
                <script>
                    $(document).ready(function () {
                        $('.openProfileModal').on('click', function (e) {
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
                                success: function (data) {
                                    // Populate the modal body with the loaded content
                                    $('#profileModalBody').html(data);
                
                                    // Show the modal manually
                                    $('#profileModal').modal('show');
                                },
                                error: function (xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    });
                </script>
                
                


        </div>
    </aside>
</div>
