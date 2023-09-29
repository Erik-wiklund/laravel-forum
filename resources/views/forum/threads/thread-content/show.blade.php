@extends('layouts.app')

@section('content')
    <h1>{{ $thread->title }}</h1>
    <p>{{ $thread->content }}</p>
    <!-- You can customize the layout as needed -->
@endsection