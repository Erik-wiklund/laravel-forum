@extends('layouts.app')

@section('content')
    <div class="container">
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
        <h1>User Profile</h1>
        <form enctype="multipart/form-data" action="{{ route('profile.update', ['userId' => $user->id]) }}" method="post"
            class="form-horizontal">
            @csrf
            @method('POST')
            <!-- User Image -->
            <div class="form-group">
                <label for="image" class="col-lg-2 control-label">User Image:</label>
                <div class="col-lg-10">
                    <input type="file" name="image" id="image" class="form-control">
                    <small class="text-muted">Upload a new profile image (max file size: 5MB)</small>
                    @if (!empty($user->image))
                        <div class="mt-2">
                            <strong>Current Image:</strong>
                            <img src="{{ asset('images/' . $user->image) }}" alt="User Image"
                                style="max-width: 100px; max-height: 100px;">
                        </div>
                    @else
                        <div class="mt-2 text-muted">No Image</div>
                    @endif
                </div>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="name" class="col-lg-2 control-label">Username:</label>
                <div class="col-lg-10">
                    <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}"
                        readonly>
                </div>
            </div>

            <!-- Username -->
            <div class="form-group">
                <label for="role_id" class="col-lg-2 control-label">Role:</label>
                <div class="col-lg-10">
                    <input type="text" name="name" id="name" class="form-control" value="{{ optional($user->role)->name }}"
                        readonly>
                </div>
            </div>

            <!-- User Email -->
            <div class="form-group">
                <label for="email" class="col-lg-2 control-label">User Email:</label>
                <div class="col-lg-10">
                    <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-group">
                <div class="col-lg-offset-2 col-lg-10">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </form>
    </div>
@endsection
