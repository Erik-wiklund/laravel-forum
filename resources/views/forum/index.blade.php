@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                @foreach ($categories as $category)
                    <!-- Category -->
                    <div class="col-lg-12">
                        <!-- Category section  -->
                        <h4 class="text-white bg-info mb-0 mt-8 p-4 rounded-top">
                            {{ $category->title }}
                        </h4>

                        <table class="table table-striped table-bordered">
                            <thead class="thead-light">
                                <!-- Table headers here -->
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($category->subcategories as $subcategory)
                                        <td class="relative border-b border border-yellow-300 flex flex-col">
                                            <div class="h5">
                                                <a href="{{ route('subcategories.threads.index', ['subcategory' => $subcategory]) }}"
                                                    class="text-uppercase">
                                                    <li class="mt-2 mb-2" style="list-style: none;">
                                                        {{ $subcategory->title }}
                                                    </li>
                                                </a>
                                            </div>
                                            <div class="absolute top-0 right-0 p-2 m-2" style="width: 250px;">

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
                                                                href="#">{{ $lastThread->lastPoster->username }}</a>,
                                                            <div style="color:grey; font-size:14px; margin-left:2px">
                                                                {{ $lastThread->updated_at->format('M d, Y') }}</div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
