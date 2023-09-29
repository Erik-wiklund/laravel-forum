@extends('layouts.app')

@section('content')
<div class="col-lg-8">
    <div class="row">
        
            <!-- Category -->
            <div class="col-lg-12">
                <!-- Category section  -->
                <h4 class="text-white bg-info mb-0 p-4 rounded-top">
                    {{ $subcategory->title }}
                </h4>

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
                                                <a href="{{ route('thread-content.show', $thread) }}">{{ $thread->title }}</a>
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