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
                    <h3 class="page-header"><i class="fa fa-edit"></i>Edit User Role</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                        <li><i class="fa fa-question"></i>User Role</li>
                        <li><i class="fa fa-plus"></i>Edit</li>
                    </ol>
                </div>
            </div>


            <!-- edit-profile -->
            <div id="edit-user-role" class="tab-pane">
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
                        <form class="form-horizontal" method="POST"
                            action="{{ route('role.update', ['userroleId' => $userrole->id]) }}"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Role</label>
                                <div class="col-lg-10">
                                    <input name="roleName" class="form-control" value="{{ $userrole->name }}" />
                                </div>
                            </div>
                            @error('roleName')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Role</label>
                                <div class="col-lg-10">
                                    <input type="color" name="userColor" id="userColor" value="{{ $userrole->color }}">
                                </div>
                            </div>
                            @error('userColor')
                                <p class="alert alert-danger">{{ $message }}</p>
                            @enderror
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <button type="submit" class="btn btn-success">Add</button>
                                    <a href="admin/dashboard" class="btn btn-danger">Cancel</a>
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
