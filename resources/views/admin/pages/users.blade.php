@extends('layouts.dashboard')

@section('content')
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <!--overview start-->
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-laptop"></i> Dashboard</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                        <li><i class="fa fa-users"></i>Users</li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-flag-o red"></i><strong>Registered Users</strong></h2>
                            <div class="panel-actions">
                                <a href="/dashboard/home" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="/dashboard/home" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                <a href="/dashboard/home" class="btn-close"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table bootstrap-datatable countries">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Main role</th>
                                        <th>Ban Actions</th>
                                        <th>View</th>
                                        <th>Edit</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($users) > 0)
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ optional($user->role)->name }}</td>
                                                <td>
                                                    <div>
                                                        <div style="margin-bottom: 4px;">
                                                            @if ($user->isforumbanned == 1)
                                                                <form method="POST"
                                                                    action="{{ route('forum.unban', ['userId' => $user->id]) }}">
                                                                    @csrf
                                                                    @method('GET')
                                                                    <input type="hidden" name="context" value="unbanForum">
                                                                    <button style="background: red" type="submit">Remove
                                                                        Forum
                                                                        Ban</button>
                                                                </form>
                                                            @else
                                                                <form method="POST"
                                                                    action="{{ route('forum.ban', ['userId' => $user->id]) }}">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <input type="hidden" name="context" value="forum">
                                                                    <button style="background: green" type="submit">Forum
                                                                        Ban
                                                                        User</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                        <div style="margin-top: 4px;">
                                                            @if (in_array($user->id, $bannedUserIds))
                                                                <form method="POST"
                                                                    action="{{ route('chat.unban', ['userId' => $user->id]) }}">
                                                                    @csrf
                                                                    @method('GET')
                                                                    <input type="hidden" name="context" value="unbanShoutbox">
                                                                    <button style="background: red" type="submit">Remove
                                                                        Shoutbox Ban</button>
                                                                </form>
                                                            @else
                                                                <form method="POST"
                                                                    action="{{ route('chat.banUser', ['userId' => $user->id]) }}">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <input type="hidden" name="context" value="shoutbox">
                                                                    <button style="background: green"
                                                                        type="submit">shoutbox
                                                                        Ban User</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </td>
                                                <td><a href="{{ route('user.show',['userId' => $user->id]) }}"><i
                                                            class="fa fa-eye text-success"></i></a></td>
                                                <td><a href="{{ route('user.edit', ['userId' => $user->id]) }}"><i
                                                            class="fa fa-edit text-info"></i></a></td>
                                                <td><a href="#" class="text-danger"><i
                                                            class="fa fa-trash"></i>Delete</a></td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>

                            {{ $users->links() }}
                        </div>

                    </div>

                </div>

            </div>
            <!--/col-->

            </div>



        </section>


    </section>
    <!--main content end-->
@endsection
