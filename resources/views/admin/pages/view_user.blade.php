@extends('layouts.dashboard')

@section('content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-edit"></i>View User</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                        <li><i class="fa fa-question"></i>User</li>
                        <li><i class="fa fa-plus"></i>View</li>
                    </ol>
                </div>
            </div>
            <!-- edit-profile -->
            <div id="edit-profile" class="tab-pane">
                <section class="panel">
                    <div class="panel-body bio-graph-info">
                        <form class="form-horizontal" action="#" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Name</label>
                                <div class="col-lg-10">
                                    <input readonly name="name" class="form-control" value="{{ $users->name }}" />
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Main Role</label>
                                <div class="col-lg-10">
                                    <input type="text" readonly
                                        value="{{ $users->role ? $users->role->name : 'No role assigned' }}"
                                        class="form-control">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-2 control-label">Banned User Status</label>
                                <div class="col-lg-10">
                                    <div style="margin-bottom: 10px;">
                                        @if ($users->banned_until >= 1 || $users->is_permbanned === 1)
                                            <span
                                                style="background: red; padding: 5px 10px; color: white; border-radius: 5px;">User
                                                Forumbanned</span>
                                        @else
                                            <span
                                                style="background: green; padding: 5px 10px; color: white; border-radius: 5px;">User
                                                not forumbanned</span>
                                        @endif
                                    </div>
                                    <div style="margin-top: 10px;">
                                        @if (in_array($users->id, $bannedUserIds))
                                            <span
                                                style="background: red; padding: 5px 10px; color: white; border-radius: 5px;">User
                                                Shoutbox Banned</span>
                                        @else
                                            <span
                                                style="background: green; padding: 5px 10px; color: white; border-radius: 5px;">User
                                                Not Shoutbox Banned</span>
                                        @endif
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="col-lg-2 control-label">User Email</label>
                                <div class="col-lg-10">
                                    <input readonly name="email" class="form-control" value="{{ $users->email }}" />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-10">
                                    <div style="margin-top: 5px;">Current User image: @if (!empty($users->image))
                                            <img src="{{ asset('images/' . $users->image) }}" alt="User Image"
                                                style="max-width: 150px;">
                                        @else
                                            No Image
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-offset-2 col-lg-10">
                                    <a href="{{ route('user.edit', ['userId' => $users->id]) }}"
                                        class="btn btn-success">Edit
                                        User</a>
                                    <a href="{{ route('users') }}" class="btn btn-danger">Back</a>
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
