@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <div class="row">

            <!-- Category -->
            <div class="col-lg-12">
                <!-- Category section  -->
                <div class="text-white bg-info mb-0 p-4 rounded-top flex justify-between">
                    <h4>
                        {{ $subcategory->title }}
                    </h4>
                    @guest
                        <a href="{{ route('login') }}"
                            class="ml-auto bg-red-600 text-white text-center py-4 px-6 rounded-full hover:bg-red-700">
                            Login
                        </a>
                    @endguest
                    @auth()
                    <label for=""
                    style="text-align: center; line-height: 40px; display: block; cursor: pointer; height: 40px;">
                    <a href="{{ route('threads.create', ['subcategory' => $subcategory]) }}" class="bg-red-600 block px-4 py-2 rounded-lg">Create new thread</a>
                </label>
                
                    @endauth
                </div>




                <table class="table table-striped table-bordered">
                    <thead class="thead-light">
                        <!-- Table headers here -->
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <h3 class="h5">

                                    @foreach ($threads as $thread)
                                        <a href="{{ route('subcategories.threads.index', ['subcategory' => $subcategory]) }}"
                                            class="text-uppercase">
                                            <li class="mt-2 mb-2" style="list-style: none;">
                                                <a
                                                    href="{{ route('thread-content.show', $thread) }}">{{ $thread->title }}</a>
                                                <div class="mt-2" style="border-bottom: 2px solid lightgrey;">
                                                </div>
                                            </li>
                                        </a>
                                    @endforeach

                                    </a>
                                </h3>
                                <p class="mb-0">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    Soluta, laboriosam.
                                </p>
                            </td>
                            <td>
                                <h4 class="h6 font-weight-bold mb-0">
                                    <a href="#">Post name</a>
                                </h4>
                                <div><a href="#">Author name</a></div>
                                <div>06/07/ 2021 20:04</div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
