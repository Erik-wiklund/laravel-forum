@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
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
                                    <td style="width: 350px">
                                        @foreach ($category->subcategories as $subcategory)
                                            <!-- Output subcategory details -->

                                            @if ($subcategory->threads->isNotEmpty())
                                                @php
                                                    $lastThread = $subcategory->threads->sortByDesc('updated_at')->first();
                                                @endphp
                                                <div>
                                                    <h4 class="h6 font-weight-bold mb-0">
                                                        Latest: <a href="#">{{ $lastThread->title }}</a>
                                                    </h4>
                                                    <div class="flex items-center"><a
                                                            href="#">{{ $lastThread->lastPoster->name }}</a>,
                                                        <div style="color:grey; 14px; margin-left:2px">
                                                            {{ $lastThread->updated_at->format('M d, Y') }}</div>
                                                    </div>
                                                </div>
                                                <div class="mt-2" style="border-bottom: 2px solid lightgrey;"></div>
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
    </div>
@endsection
