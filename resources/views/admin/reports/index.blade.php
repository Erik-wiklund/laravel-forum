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
                        <li><i class="fa fa-users"></i>Admin Reports</li>
                    </ol>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-flag-o red"></i><strong>Reports</strong></h2>
                            <div class="panel-actions">
                                <a href="/dashboard/home" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
                                <a href="/dashboard/home" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
                                <a href="/dashboard/home" class="btn-close"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="panel-body">
                            {{ $reports->links() }}
                            <table class="table bootstrap-datatable countries">
                                <thead>
                                    <tr>
                                        <th>Reporting User</th>
                                        <th>Reported Thread</th>
                                        <th>Reported Reply</th>
                                        <th>Reported Private Conversation</th>
                                        <th>Reported Private Conversation Messages</th>
                                        <th>Reason</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reports as $report)
                                        <tr>
                                            <td>{{ $report->user->name }}</td>
                                            <td>
                                                @if ($report->thread && $report->thread->sub_category_id !== null)
                                                    <a
                                                        href="{{ route('threads.show', ['subcategory' => $report->thread->sub_category_id, 'thread' => $report->thread->id]) }}">
                                                        {!! $report->thread->title !!} ({{ $report->thread->id}})
                                                    </a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($report->reply && $report->thread->sub_category_id !== null)
                                                    <a
                                                        href="{{ route('threads.show', ['subcategory' => $report->thread->sub_category_id, 'thread' => $report->thread->id, 'scrollToReply' => $report->reply->id]) }}">
                                                        {!! $report->reply->content !!}({{ $report->reply->id}})
                                                    </a>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($report->conversation !== null)
                                                    <span>{!! $report->conversation->message !!} ({{ $report->conversation->id}})</span>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                @if ($report->conversationMessages !== null)
                                                    <span>{!! $report->conversationMessages->message !!} ({{ $report->conversationMessages->id}})</span>
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>{{ $report->reason }}</td>
                                            <td>{{ $report->created_at }}</td>
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
    <script type="text/javascript" src="{{ URL::asset('js/scrollToReply.js') }}"></script>
@endsection
