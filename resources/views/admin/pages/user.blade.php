@extends('layouts.dashboard')

@section('content')
          <!--main content start-->
          
          @if ($user = $data['user'])          
          
    <section id="main-content">
        <section class="wrapper">
          <div class="row">
            <div class="col-lg-12">
              <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
              <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                <li><i class="fa fa-users"></i>Users</li>
              <li><i class="fa fa-user-md"></i>{{$user->name}}</li>
              </ol>
            </div>
          </div>

          
          <div class="row">
            <!-- profile-widget -->
            <div class="col-lg-12">
              <div class="profile-widget profile-widget-info">
                <div class="panel-body">
                  <div class="col-lg-2 col-sm-2">
                  <h4>{{$user->name}}</h4>
                    <div class="follow-ava">
                    <img src="{{asset('admin/img/profile-widget-avatar.jpg')}}" alt="">
                    </div>
                    <h6>{{$user->rank}}</h6>
                  </div>
                  <div class="col-lg-4 col-sm-4 follow-info">
                    <p>You have no bio yet</p>
                  <p>{{$user->email}}</p>
                  <p><i class="fa fa-twitter">{{$user->username}}</i></p>
                    <h6>
                    <span><i class="icon_clock_alt"></i>You joined {{$user->created_at->diffforhumans()}}</span>
                                     
                                  </h6>
                  </div>
                  <div class="col-lg-2 col-sm-6 follow-info weather-category">
                    <ul>
                      <li class="active">
  
                        <i class="fa fa-comments fa-2x"> </i><br>You have no messages yet
                      </li>
  
                    </ul>
                  </div>
                  <div class="col-lg-2 col-sm-6 follow-info weather-category">
                    <ul>
                      <li class="active">
  
                        <i class="fa fa-bell fa-2x"> </i><br> You have no notifications yet
                      </li>
  
                    </ul>
                  </div>
                  <div class="col-lg-2 col-sm-6 follow-info weather-category">
                    <ul>
                      <li class="active">
  
                        <i class="fa fa-tachometer fa-2x"> </i><br> No measurement on your activities yet
                      </li>
  
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- page start-->
          <div class="row">
            <div class="col-lg-12">
              <section class="panel">
                <header class="panel-heading tab-bg-info">
                  <ul class="nav nav-tabs">
                    <li class="active">
                      <a data-toggle="tab" href="#recent-activity">
                                            <i class="icon-home"></i>
                                            Daily Activity
                                        </a>
                    </li>
                    <li>
                      <a data-toggle="tab" href="#profile">
                                            <i class="icon-user"></i>
                                            Profile
                                        </a>
                    </li>
                    <li class="">
                      <a data-toggle="tab" href="#edit-profile">
                                            <i class="icon-envelope"></i>
                                            Edit Profile
                                        </a>
                    </li>
                  </ul>
                </header>
                <div class="panel-body">
                  <div class="tab-content">
                    <div id="recent-activity" class="tab-pane active">
                      <div class="profile-activity">

                      @if ($data['activities'])
                      @foreach ($data['activities'] as $activity)
                      <div class="act-time">
                        <div class="activity-body act-in">
                          <span class="arrow"></span>
                          <div class="text">
                            <p class="attribution"><a href="#"></a>{{$activity->created_at->diffForHumans()}}</p>
                          <p>{{$activity->activity}}</p>
                          </div>
                        </div>
                      </div>
                      @endforeach
                         
                      @else
                      <p>No activities for this user yet!</p> 
                      @endif

                       
                        
                        
  
                      </div>
                    </div>
                    <!-- profile -->
                    <div id="profile" class="tab-pane">
                      <section class="panel">
                        <div class="bio-graph-heading">
                         User's Bio Not added
                        </div>
                        <div class="panel-body bio-graph-info">
                          <h1>User Information</h1>
                          <div class="row">
                            <div class="bio-row">
                              <p><span>Name </span>: {{$user->name}} </p>
                            </div>
                            <div class="bio-row">
                              <p><span>Rank </span>: {{$user->rank}}</p>
                            </div>
                            <div class="bio-row">
                            <p><span>Added:</span>: {{$user->created_at->diffforhumans()}}</p>
                            </div>
                            <div class="bio-row">
                            <p><span>mail: </span>: {{$user->email}}</p>
                            </div>
                          </div>
                        </div>
                      </section>
                      <section>
                        <div class="row">
                        </div>
                      </section>
                    </div>
                    <!-- edit-profile -->
                    <div id="edit-profile" class="tab-pane">
                      <section class="panel">
                        <div class="panel-body bio-graph-info">
                          <h1> Profile Info</h1>
                          <form class="form-horizontal" role="form">
                            <div class="form-group">
                              <label class="col-lg-2 control-label">First Name</label>
                              <div class="col-lg-6">
                                <input type="text" class="form-control" id="f-name" placeholder=" ">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Last Name</label>
                              <div class="col-lg-6">
                                <input type="text" class="form-control" id="l-name" placeholder=" ">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">About Me</label>
                              <div class="col-lg-10">
                                <textarea name="" id="" class="form-control" cols="30" rows="5"></textarea>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Country</label>
                              <div class="col-lg-6">
                                <input type="text" class="form-control" id="c-name" placeholder=" ">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Birthday</label>
                              <div class="col-lg-6">
                                <input type="text" class="form-control" id="b-day" placeholder=" ">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Occupation</label>
                              <div class="col-lg-6">
                                <input type="text" class="form-control" id="occupation" placeholder=" ">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Email</label>
                              <div class="col-lg-6">
                                <input type="text" class="form-control" id="email" placeholder=" ">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Mobile</label>
                              <div class="col-lg-6">
                                <input type="text" class="form-control" id="mobile" placeholder=" ">
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-lg-2 control-label">Website URL</label>
                              <div class="col-lg-6">
                                <input type="text" class="form-control" id="url" placeholder="http://www.demowebsite.com ">
                              </div>
                            </div>
  
                            <div class="form-group">
                              <div class="col-lg-offset-2 col-lg-10">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-danger">Cancel</button>
                              </div>
                            </div>
                          </form>
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
              </section>
            </div>
          </div>
  
          <!-- page end-->
        </section>
      </section>
      <!--main content end-->
      @endif
@endsection