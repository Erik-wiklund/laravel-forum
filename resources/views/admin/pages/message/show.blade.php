@extends('layouts.dashboard')

@section('content')
    <!-- main content start -->
    <section id="main-content">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="page-header"><i class="fa fa-edit"></i> View message</h3>
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="/dashboard/home">Home</a></li>
                        <li><i class="fa fa-question"></i> Messages</li>
                        <li><i class="fa fa-plus"></i> View</li>
                    </ol>
                </div>
            </div>

            <div id="view-message" class="tab-pane">
                <section class="panel">
                    <div class="panel-body bio-graph-info">
                        <div class="form-group">
                            <label class="col-lg-2 control-label">From</label>
                            <div class="col-lg-10">
                                <span class="form-control-static">{{ $contactMessage->email }}</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label">Subject</label>
                            <div class="col-lg-10">
                                <span class="form-control-static">{{ $contactMessage->subject }}</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-2 control-label">Message</label>
                            <div class="col-lg-10">
                                <span class="form-control-static">{{ $contactMessage->message }}</span>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </section>
    </section>
    <!-- main content end -->
@endsection
<link rel="stylesheet" href="{{URL::asset('css/custom.css')}}">

