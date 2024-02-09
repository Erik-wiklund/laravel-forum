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
                        <li><i class="fa fa-users"></i>Admin Log</li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-flag-o red"></i><strong>Admin Actions</strong></h2>
                            <div class="panel-actions">
                                <a href="/dashboard/home" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="/dashboard/home" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                <a href="/dashboard/home" class="btn-close"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ $adminLogs->links() }}
                            <table class="table bootstrap-datatable countries">
                                <thead>
                                    <tr>
                                        <th>Admin</th>
                                        <th>Main role</th>
                                        <th>Target</th>
                                        <th>Action</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($adminLogs as $log)
                                        <tr>
                                            <td>{{ $log->admin->name }}</td>
                                            <!-- Access the user's name via the relationship -->
                                            <td>{{ $log->admin->role->name }}</td>
                                            <td>
                                                @if ($log->resource_type === 'thread')
                                                    <a
                                                        href="{{ route('threads.show', ['subcategory' => $log->thread->sub_category_id, 'thread' => $log->thread->id]) }}">
                                                        {!! $log->thread->title !!} ({{ $log->thread->id }})
                                                    </a>
                                                @elseif ($log->resource_type === 'thread' && !$log->threadName)
                                                    {{ 'Unknown Thread' }}
                                                @else
                                                    <a
                                                        href="{{ route('user.show', ['userId' => $log->targetUser->id]) }}">{!! $log->targetUser->username !!}</a>
                                                @endif
                                            </td>
                                            <td>{{ $log->action }}</td>
                                            <td>{{ $log->created_at }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </section>
    <!--main content end-->
@endsection
