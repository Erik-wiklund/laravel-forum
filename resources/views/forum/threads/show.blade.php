@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="row">
            <!-- Thread -->
            <div class="col-lg-12">
                <!-- Thread section  -->
                <div class="text-white bg-info mb-0 p-4 rounded-top flex justify-between items-center">
                    <h4>
                        {{ $category->title }} / {{ $subcategory->title }} / {{ $thread->title }}
                    </h4>                    
                    @guest
                        <a href="{{ route('register') }}"
                            class="ml-auto bg-red-600 text-white text-center py-2 px-4 hover:bg-red-700"
                            style="border-radius: 4px">
                            Sign up
                        </a>
                    @endguest
                </div>
                <div>{{ $replies->links() }}</div>
                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <!-- Table headers here -->
                    </thead>
                    <tbody>
                        <ol style="list-style: none; padding: 0; margin: 0;">
                            
                            @foreach ($replies as $reply)
                            <li style="border-bottom: 1px solid #383838;">
                                <div class="flex flex-row items-center" style="padding: 32px;">
                                    <div class="posterAvatar">
                                        @if (!empty($reply->createdBy->image))
                                            <img src="{{ asset('images/' . $reply->createdBy->image) }}" alt="User Image"
                                                style="max-width: 100px;">
                                        @else
                                            <div class="bg-white text-black flex justify-center items-center"
                                                style="width: 100px; height: 100px;">No Image</div>
                                        @endif
                                    </div>
                                    <div class="ml-3">
                                        <div>{{ $thread->content }}</div>
                                        <div>
                                            <div style="font-size: 14px; color: grey; display: flex">
                                                <a href="#">{{ $thread->createdBy->name }}</a>
                                                <div style="color: #383838; margin-left: 2px;">
                                                    {{ $thread->created_at->format('M d, Y') }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </li>
                                <li style="border-bottom: 1px solid #383838;">
                                    <div class="flex flex-row items-center" style="padding: 32px;">
                                        <div class="posterAvatar">
                                            @if (!empty($reply->createdBy->image))
                                                <img src="{{ asset('images/' . $reply->createdBy->image) }}"
                                                    alt="User Image" style="max-width: 100px;">
                                            @else
                                                No Image
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <div>{{ $reply->content }}</div>
                                            <div>
                                                <div style="font-size: 14px; color: grey; display: flex">
                                                    <a href="#">{{ $reply->createdBy->name }}</a>
                                                    <div style="color: #383838; margin-left: 2px;">
                                                        {{ $reply->created_at->format('M d, Y') }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ol>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if (Auth::check())
        <form method="post"
            action="{{ route('reply.create', ['subcategory' => $subcategory->id, 'thread' => $thread->id]) }}"
            style=" width:100%; padding:10px;">
            @csrf
            <textarea class="w-full" name="content" id="" cols="30" rows="10"></textarea>

            <button class="float-right" type="submit"
                style="background: red; padding:10px; border-radius: 7px">Reply</button>
        </form>
    @else
        <div class="text-center"><a href="{{ route('login') }}">You must register or login to reply here</a></div>
    @endif
@endsection
