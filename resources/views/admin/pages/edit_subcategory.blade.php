<?php
use Illuminate\Support\Facades\Session;
?>
@extends('layouts.dashboard')

@section('content')
    <!--main content start-->


    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-edit"></i>Edit Sub-Category</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                        <li><i class="fa fa-question"></i>Sub-Category</li>
                        <li><i class="fa fa-plus"></i>Edit</li>
                    </ol>
                </div>
            </div>


            <!-- edit-profile -->
            <div id="edit-profile" class="tab-pane">
                <section class="panel">
                    <div class="panel-body bio-graph-info">
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
                        <form class="form-horizontal" method="POST" action="{{ route('subcategory.update', ['subcategoryId' => $subcategory->id]) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Sub-Category Title</label>
                                <div class="col-lg-10">
                                    <input name="title" class="form-control" value="{{ $subcategory->title }}" />
                                </div>
                            </div>
                            @error('title')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Sub-Category Order</label>
                                <div class="col-lg-10">
                                    <input type="number" name="order" class="form-control"
                                        value="{{ $subcategory->order }}" />
                                </div>
                            </div>
                            @error('order')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Add to category</label>
                                <div class="col-lg-10">
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->id == $subcategory->category_id ? 'selected' : '' }}>
                                                {{ $category->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('order')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Sub-Category Description</label>
                                <div class="col-lg-10">
                                    <textarea name="desc" id="editor1" class="form-control" cols="30" rows="5">{{ $subcategory->desc }}</textarea>
                                </div>
                            </div>
                            @error('desc')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror



                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Add</button>
                                    <a href="{{ route('subcategories') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
            </div>


        </section>
    </section>
    <!--main content end-->

@endsection
