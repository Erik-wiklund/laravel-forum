@extends('layouts.dashboard')

@section('content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-edit"></i>View User role</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                        <li><i class="fa fa-question"></i>User Role</li>
                        <li><i class="fa fa-plus"></i>View</li>
                    </ol>
                </div>
            </div>
            <!-- edit-profile -->
            <div id="view-role" class="tab-pane">
                <section class="panel">
                    <div class="panel-body bio-graph-info">
                        <form class="form-horizontal" action="#" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Role</label>
                                <div class="col-lg-10">
                                    <input style="width: 200px;" readonly name="roleName" class="form-control" value="{{ $userrole->name }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">Role Color</label>
                                <div class="col-lg-10">
                                    <input style="width: 100px;" type="color" disabled  readonly value="{{ $userrole->color }}" class="form-control">
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <a href="{{ route('role.edit', ['userroleId' => $userrole->id]) }}">Edit Role</a>
                                    <a href="{{ route('user_roles') }}" class="btn btn-danger">Back</a>
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
