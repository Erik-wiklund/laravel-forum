@extends('layouts.app_no_navigation')

@section('content')
    <div class="container">
        <div>
            <img src="" alt="" style="max-width: 15px;">
            <h1>User Profile: {{ $user->name }}</h1>
            <span>Last seen:
                @if ($user->last_seen)
                    @php
                        $lastSeenDate = Carbon\Carbon::parse($user->last_seen);
                        $today = Carbon\Carbon::now();
                    @endphp
            
                    @if ($lastSeenDate->isSameDay($today))
                        today at {{ $lastSeenDate->format('H:i') }}
                    @else
                        {{ $lastSeenDate->format('l \a\t H:i') }}
                    @endif
                @else
                    Never seen
                @endif</span>
        </div>
        <!-- Display user information and other details here -->
    </div>
@endsection
