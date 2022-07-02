@extends('admin.layout.appadmin')
@section('content')
    
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="viewadminhead">
            <h2>Create Admin</h2>
          </div>
        </div>
      </div>
      <form  method="post" action="{{url('/')}}/admin/add/admin" class="login-form" enctype="multipart/form-data">
     
      {{ csrf_field() }}


                   @if($errors->any())
             
             <div class="alert alert-success">
             <strong></strong> {{$errors->first()}}
             </div>
             @endif 
     
      <div class="row">
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label for="usr">First Name</label>
              <input type="text" class="form-control" name="fname" id="usr">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Last Name</label>
              <input type="text" class="form-control" name="lname" >
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" > 
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label for="pwd">Password</label>
              <input type="password" class="form-control" id="pwd" name="pass"  >
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Confirm Password</label>
              <input type="password" class="form-control" name="c_pass" >
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-right">
          <div class="viewadminbtn pull-right">
            <button type="submit" class="btnedit">Save</button>
          </div>
        </div>
      </div>
      </form>
    </div>
    <!-- /page content --> 
    
    @endsection