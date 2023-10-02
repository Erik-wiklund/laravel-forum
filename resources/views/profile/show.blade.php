@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>User Profile: {{ $user->name }}</h1>
        <!-- Display user information and other details here -->
    </div>
    
@endsection