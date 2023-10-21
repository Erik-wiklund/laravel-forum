<?php
use Illuminate\Support\Facades\Session;
?>

@extends('layouts.app');

@section('content')
    


@if (session()->has('errors'))
    @foreach ($errors as $error)
        {{ $error }}
    @endforeach
@endif
@if (\Session::has('message'))
    <p class="alert
      {{ Session::get('alert-class', 'alert-success') }}">
        {{ Session::get('message') }}</p>
@endif
<form class="form-horizontal" method="POST" action="{{ route('contact.store') }}">
    @csrf
        <h1 style="text-align: center">Contact Form</h1>
    <div class="form-group">
        <label>Name: </label>
        <input type="text" class="form-control" id="name" placeholder="Name" name="name" required>
    </div>
    @error('name')
        <p class="alert alert-danger">{{ $name }}</p>
    @enderror
    <div class="form-group">
        <label>Email: </label>
        <input type="text" class="form-control" id="email" placeholder="Email" name="email" required>
    </div>
    @error('name')
        <p class="alert alert-danger">{{ $email }}</p>
    @enderror
    <div class="form-group">
        <label>Subject: </label>
        <input type="text" class="form-control" id="subject" placeholder="Subject" name="subject" required>
    </div>
    @error('name')
        <p class="alert alert-danger">{{ $subject }}</p>
    @enderror
    <div class="form-group">
        <label for="message">Message: </label>
        <textarea type="text" class="form-control" id="message" placeholder="Enter your message here" name="message"
            required> </textarea>
    </div>
    @error('name')
        <p class="alert alert-danger">{{ $message }}</p>
    @enderror
    <div class="form-group">
        <button type="submit" class="btn btn-primary" value="Send">Send</button>
    </div>

</form>
@endsection