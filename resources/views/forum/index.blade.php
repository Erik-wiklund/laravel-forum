@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-10">
            <div class="row">
                @auth
                    <!-- Display chat messages -->
                    <div id="chat-messages" style="height: 300px; width:100%; overflow-y: scroll; padding: 20px;">
                        @foreach ($messages->reverse() as $message)
                            <div class="message" style="border-bottom: solid lightgrey 1px;">
                                <div class="flex justify-between items-center">{{ $message->user->name }} -
                                    {{ $message->content }}
                                    @if (auth()->user()->isAdmin())
                                        <div class="dropdown">
                                            <button style="background-color: #6c757d !important"
                                                class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Actions
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <form class="text-center dropdown-item" method="POST"
                                                    action="{{ route('chat.destroy', ['message' => $message]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Delete Message</button>
                                                </form>
                                                <form class="text-center dropdown-item" method="POST"
                                                    action="{{ route('chat.purge', ['id' => $message->user->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit">Purge user</button>
                                                </form>
                                                <form class="text-center dropdown-item" method="POST"
                                                    action="{{ route('chat.ban', ['id' => $message->user->id, 'userId' => $message->user->id]) }}">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit">Shoutbox ban user</button>
                                                </form>




                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    @if (in_array(Auth::user()->id, $bannedUserIds))
                        <div class="alert alert-danger">
                            You are banned from sending messages in the shoutbox, please contact an administrator for help!
                        </div>
                    @else
                        <!-- Input form for sending messages -->
                        <form method="post" action="{{ route('chat.send') }}"
                            style="display: flex; flex-direction: row; width:100%; padding:10px;">
                            @csrf
                            <input type="text" name="content" placeholder="Type your message"
                                style="flex: 1; margin-right: 10px; margin-left:10px;" />
                            <button type="submit" style="background: red; padding:10px; border-radius: 7px">Send</button>
                        </form>
                    @endif
                @endauth


                @foreach ($categories as $category)
                    <!-- Category -->
                    <div class="col-lg-12">
                        <!-- Category section  -->
                        <h4 class="text-white bg-info mb-0 p-4 rounded-top">
                            {{ $category->title }}
                        </h4>

                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <!-- Table headers here -->
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h3 class="h5">

                                            @foreach ($category->subcategories as $subcategory)
                                                <a href="{{ route('subcategories.threads.index', ['subcategory' => $subcategory]) }}"
                                                    class="text-uppercase">
                                                    <li class="mt-2 mb-2" style="list-style: none;">
                                                        {{ $subcategory->title }}
                                                        <div class="mt-2" style="border-bottom: 2px solid lightgrey;">
                                                        </div>
                                                    </li>
                                                </a>
                                            @endforeach

                                            </a>
                                        </h3>

                                    </td>
                                    <td style="width: 350px">
                                        @foreach ($category->subcategories as $subcategory)
                                            <!-- Output subcategory details -->

                                            @if ($subcategory->threads->isNotEmpty())
                                                @php
                                                    $lastThread = $subcategory->threads->sortByDesc('updated_at')->first();
                                                @endphp
                                                <div>
                                                    <h4 class="h6 font-weight-bold mb-0">
                                                        Latest: <a href="#">{{ $lastThread->title }}</a>
                                                    </h4>
                                                    <div class="flex items-center"><a
                                                            href="#">{{ $lastThread->lastPoster->name }}</a>,
                                                        <div style="color:grey; 14px; margin-left:2px">
                                                            {{ $lastThread->updated_at->format('M d, Y') }}</div>
                                                    </div>
                                                </div>
                                                <div class="mt-2" style="border-bottom: 2px solid lightgrey;"></div>
                                            @endif
                                        @endforeach
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-2">
            <aside>
                <div class="card">

                    <div class="card-footer">
                        <div class="card-body">
                            <h4 class="card-title"
                                style="border-radius: 5px; background: dodgerblue; padding: 6px; text-align: center">Members
                                In chat</h4>
                            <ul class="list-unstyled mb-0 flex">
                                @foreach ($onlineUsers as $user)
                                    <li><a style="color: #aaa;"
                                            href="{{ route('profile.show', ['user' => $user->id]) }}">{{ $user->name }},</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <dl>
                            <h3 style="border-radius: 5px;background: dodgerblue; padding: 6px; text-align: center">Members
                                Online Now</h3>
                            <ul class="list-unstyled mb-0 flex">
                                @foreach ($onlineUsers as $user)
                                    <li><a style="color: #aaa;"
                                            href="{{ route('profile.show', ['user' => $user->id]) }}">{{ $user->name }},</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div>
                                Total: {{ $totalOnline }},
                                members: {{ $membersOnline }},
                                guests: {{ $visitors }},
                            </div>
                        </dl>
                    </div>

                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Members Statistics</h4>
                        <dl class="row">
                            <dt class="col-8 mb-0">Total Forums:</dt>
                            <dd class="col-4 mb-0">15</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-8 mb-0">Total Topics:</dt>
                            <dd class="col-4 mb-0">500</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-8 mb-0">Total members:</dt>
                            <dd class="col-4 mb-0">{{ $totalUsers }}</dd>
                        </dl>
                    </div>
                    <div class="card-footer">
                        <div>Newest Member</div>
                        <div><a href="{{ route('profile.show', ['user' => $user->id]) }}">{{ $latestuser->name }}</a></div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection


{{-- @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}
