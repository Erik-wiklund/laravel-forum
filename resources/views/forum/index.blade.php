@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                @foreach ($categories as $category)
                    <!-- Category -->
                    <div class="col-lg-12">
                        <!-- Category section  -->
                        <h4 class="text-white bg-info mb-0 p-4 rounded-top">
                            {{ $category->title }}
                        </h4>

                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <!-- Table headers here -->
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h3 class="h5">

                                            @foreach ($category->subcategories as $subcategory)
                                                <a href="{{ route('subcategories.threads.index', ['subcategory' => $subcategory]) }}"
                                                    class="text-uppercase">
                                                    <li class="mt-2 mb-2" style="list-style: none;">
                                                        {{ $subcategory->title }}
                                                        <div class="mt-2" style="border-bottom: 2px solid lightgrey;">
                                                        </div>
                                                    </li>
                                                </a>
                                            @endforeach

                                            </a>
                                        </h3>

                                    </td>
                                    <td>
                                        @foreach ($category->subcategories as $subcategory)
                                        <!-- Output subcategory details -->
                                    
                                        @if ($subcategory->threads->isNotEmpty())
                                            @php
                                                $lastThread = $subcategory->threads->sortByDesc('updated_at')->first();
                                            @endphp
                                    
                                            <h4 class="h6 font-weight-bold mb-0">
                                                <a href="#">{{ $lastThread->title }}</a>
                                            </h4>
                                            <div><a href="#">{{ $lastThread->lastPoster->name }}</a></div>
                                            <div>{{ $lastThread->updated_at->format('d/m/Y H:i') }}</div>
                                        @endif
                                    @endforeach
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-lg-4">
            <aside>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Members Online</h4>
                        <ul class="list-unstyled mb-0">
                            <li><a href="#">Member name</a></li>
                            <li><a href="#">Member name</a></li>
                            <li><a href="#">Member name</a></li>
                            <li><a href="#">Member name</a></li>
                            <li><a href="#">Member name</a></li>
                        </ul>
                    </div>
                    <div class="card-footer">
                        <dl class="row">
                            <dt class="col-8 mb-0">Total:</dt>
                            <dd class="col-4 mb-0">10</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-8 mb-0">Members:</dt>
                            <dd class="col-4 mb-0">10</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-8 mb-0">Guests:</dt>
                            <dd class="col-4 mb-0">3</dd>
                        </dl>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Members Statistics</h4>
                        <dl class="row">
                            <dt class="col-8 mb-0">Total Forums:</dt>
                            <dd class="col-4 mb-0">15</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-8 mb-0">Total Topics:</dt>
                            <dd class="col-4 mb-0">500</dd>
                        </dl>
                        <dl class="row">
                            <dt class="col-8 mb-0">Total members:</dt>
                            <dd class="col-4 mb-0">200</dd>
                        </dl>
                    </div>
                    <div class="card-footer">
                        <div>Newest Member</div>
                        <div><a href="#">Member Name</a></div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection


{{-- @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif --}}
