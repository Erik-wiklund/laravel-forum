@extends('layouts.app')

@section('content')
    <h1>Create a new message</h1>
    <form action="{{ route('pm.store', ['userId' => $user->id]) }}" method="post">
        {{ csrf_field() }}
        <div class="col-md-6">
            <!-- Subject Form Input -->
            <div class="form-group">
                <label class="control-label">Subject</label>
                <input type="text" class="form-control" name="subject" placeholder="Subject" value="{{ old('subject') }}">
            </div>

            <!-- Message Form Input -->
            <div class="form-group">
                <label class="control-label">Message</label>
                <textarea name="message" class="form-control">{{ old('message') }}</textarea>
            </div>

            @if ($users->count() > 0)
                <div class="form-group">
                    <label for="recipients">Recipients:</label>
                    @foreach ($users as $user)
                        <div class="form-check">
                            <input type="checkbox" name="recipients[]" value="{{ $user->id }}" class="form-check-input">
                            <label class="form-check-label" for="recipient{{ $user->id }}">{{ $user->name }}</label>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Submit Form Input -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </div>
    </form>
@stop
