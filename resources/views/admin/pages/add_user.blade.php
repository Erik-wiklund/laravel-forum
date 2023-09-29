  
  @extends('layouts.dashboard')

  @section('content')
            <!--main content start-->
         
            
      <section id="main-content">
          <section class="wrapper">
            <div class="row">
              <div class="col-lg-12">
                <h3 class="page-header"><i class="fa fa-user-md"></i> Profile</h3>
                <ol class="breadcrumb">
                  <li><i class="fa fa-home"></i><a href="index.html">Home</a></li>
                  <li><i class="fa fa-users"></i>Users</li>
                <li><i class="fa fa-user-md"></i></li>
                </ol>
              </div>
            </div>


            <!-- edit-profile -->
  <div id="edit-profile" class="tab-pane">
    <section class="panel">
      <div class="panel-body bio-graph-info">
        <h1> Profile Info</h1>
        <form class="form-horizontal">
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
            <div class="col-lg-6">
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


          </section>
        </section>
        <!--main content end-->
        
  @endsection
  
  
  
  
  
  
  
  
  
  
  
  
  