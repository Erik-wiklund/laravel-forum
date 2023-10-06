@extends('layouts.app_no_navigation')

@section('content')
    <div class="container">
        <h1>User Profile: {{ $user->name }}</h1>
        <!-- Display user information and other details here -->
    </div>
    
@endsection