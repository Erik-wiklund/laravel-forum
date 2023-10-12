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
                    <h3 class="page-header"><i class="fa fa-edit"></i>Add new User</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                        <li><i class="fa fa-question"></i>User</li>
                        <li><i class="fa fa-plus"></i>Add</li>
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
                        <form class="form-horizontal" method="POST" action="{{ route('user.store') }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Name</label>
                                <div class="col-lg-10">
                                    <input name="name" class="form-control" value="" />
                                </div>
                            </div>
                            @error('name')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Role</label>
                                <div class="col-lg-10">
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="">Select a Role</option>
                                        @foreach ($user_roles as $user_role)
                                            <option value="{{ $user_role->id }}">{{ $user_role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @error('role_id')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Email</label>
                                <div class="col-lg-10">
                                    <input name="email" class="form-control" value="" />
                                </div>
                            </div>
                            @error('email')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Image</label>
                                <div class="col-lg-10">
                                    <input type="file" name="image" class="form-control" value="" />
                                </div>
                            </div>
                            @error('image')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Password</label>
                                <div class="col-lg-10">
                                    <input type="password" name="password" class="form-control" value="" />
                                </div>
                            </div>
                            @error('password')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Confirm Password</label>
                                <div class="col-lg-10">
                                    <input type="password" name="password_confirmation" class="form-control" value="" />
                                </div>
                            </div>
                            @error('password_confirmation')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror



                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Add</button>
                                    <a href="/dashboard/home" class="btn btn-danger">Cancel</a>
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
