<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="w-full mx-auto px-4 sm:px-6 lg:px-8" style="background-color: #17a2b8 !important;">
        <div class="flex justify-between h-18">
            <div class="flex items-center">
                <!-- Logo -->
                {{-- <a href="/forum" class="flex-shrink-0">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </a> --}}

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 items-center sm:flex">
                    <a href="{{ route('forum.index') }}" class="items-center flex navButtons h-16 p-2" type="submit">
                        {{ __('Home') }}</a>
                    <a href="{{ route('resources.index') }}" class="flex items-center navButtons h-16 p-2"
                        type="submit">{{ __('Resources') }}</a>
                </div>
            </div>
            <!-- Settings Dropdown -->
            @guest
                <div class="flex justify-center items-center">
                    <!-- Responsive Settings Options -->
                    <div>
                        <div class="px-4">
                            <a class="navButtons" href="{{ route('login') }}">Login</a>
                            {{-- <a class="text-gray-500" href="{{ route('register') }}">Register</a> --}}
                        </div>
                    </div>
                </div>
            @endguest
            @auth
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <li class="nav-item dropdown list-none">
                        <a id="navbarDropdown" class="nav-link " href="#" role="button" data-bs-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa fa-bell"></i>
                            <span
                                class="badge badge-light bg-success badge-xs">{{ auth()->user()->unreadNotifications->count() }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            @if (auth()->user()->unreadNotifications->count() > 0)
                                <li class="d-flex justify-content-end mx-1 my-2">
                                    <a href="{{ route('mark-as-read') }}" class="btn btn-success btn-sm">Mark All as
                                        Read</a>
                                </li>
                                <li class="d-flex justify-content-end mx-1 my-2">
                                    <form action="{{ route('clear-all-notifications') }}" method="POST"
                                        class="btn btn-success btn-sm">
                                        @csrf
                                        @method('DELETE') <!-- This tells Laravel to treat the form as a DELETE request -->
                                        <button type="submit" class="">Clear all
                                            notifications</button>
                                    </form>
                                </li>
                            @else
                                <p class="text-xs p-2">No notification to display</p>
                            @endif

                            @foreach (auth()->user()->unreadNotifications as $notification)
                                <a href="#" class="text-success">
                                    <li class="p-1 text-success"> {{ $notification->data['data'] }}</li>
                                </a>
                            @endforeach
                            @foreach (auth()->user()->readNotifications as $notification)
                                <a href="#" class="text-secondary">
                                    <li class="p-1 text-secondary"> {{ $notification->data['data'] }}</li>
                                </a>
                            @endforeach
                        </ul>
                    </li>
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center p-1 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div class="userImg">
                                    <img src="{{ asset('images/' . $user->image) }}" alt="User Image"
                                        style="max-width: 30px; max-height: 30px;">
                                </div>
                                @auth
                                    <div>{{ Auth::user()->username }}</div>
                                @endauth
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.index', ['userId' => $user->id])">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            <div class="flex justify-center  flex-col">
                                <x-dropdown-link style="margin: 0 !important;" :href="route('pm.index', ['userId' => $user->id])">
                                    {{ __('Private message') }}
                                </x-dropdown-link>
                                @if (Auth::check())
                                    @if (Auth::user()->hasUnreadMessages())
                                        <span style="margin-top: -15px;"
                                            class="new-indicator px-4 py-2 text-sm text-red-600">New Messages</span>
                                    @else
                                        <span class="text-xs px-4">No unread messages</span>
                                    @endif
                                @else
                                    <span>User not authenticated</span>
                                @endif
                            </div>

                            @if (auth()->user()->isAdmin())
                                <x-dropdown-link :href="route('admin.home')">
                                    {{ __('Admin') }}
                                </x-dropdown-link>
                            @endif
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endauth

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
</nav>
