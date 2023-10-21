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
                        <li><i class="fa fa-users"></i>Contact Messages</li>
                    </ol>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2><i class="fa fa-flag-o red"></i><strong>Contact Form Messages</strong></h2>
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
                                        <th>Subject</th>
                                        <th>From</th>
                                        <th>Email</th>
                                        <th>View</th>
                                        {{-- <th>Edit</th> --}}
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($contactMessages) > 0)
                                        
                                    @foreach($contactMessages as $contactMessage)
                                    <tr>
                                        <td>
                                            
                                               {{ $contactMessage->subject}}
                                           
                                        </td>
                                        <td>
                                            {{ $contactMessage->name}}
                                        </td>
                                        <td>
                                            {{ $contactMessage->email}}
                                        </td>
                                        <td><a href="{{ route('contact.show',['messageId' => $contactMessage->id]) }}"><i
                                                    class="fa fa-eye text-success"></i></a></td>
                                        {{-- <td><a href=""><i
                                                    class="fa fa-edit text-info"></i></a></td> --}}
                                        <td><a href="#" class="text-danger"><i class="fa fa-trash"></i>Delete</a></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>

                            {{-- {{ $users->links() }} --}}
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
