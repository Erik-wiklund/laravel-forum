@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Thread</h1>

        <form method="POST" action="{{ route('threads.store', ['subcategory' => $subcategory]) }}">
            @csrf
        
            <!-- Thread Title Field -->
            <label for="title">Thread Title</label>
            <input type="text" name="title" id="title" required>
        
            <!-- Thread Content Field -->
            <label for="content">Thread Content</label>
            <textarea name="content" id="content" rows="4" required></textarea>
        
            <!-- Submit Button -->
            <button type="submit">Create Thread</button>
        </form>
    </div>
@endsection
