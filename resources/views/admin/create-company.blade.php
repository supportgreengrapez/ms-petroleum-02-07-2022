@extends('admin.layout.appadmin')
@section('content')
    
    
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="viewadminhead">
            <h2>Create Company</h2>
          </div>
        </div>
      </div>
      <form  method="post" action="{{url('/')}}/admin/home/add/company" class="login-form" enctype="multipart/form-data">
     
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
              <label for="usr">Owner Name</label>
              <input type="text" class="form-control" id="usr" name="fname">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Company Name</label>
              <input type="text" class="form-control" name="company_name">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Phone</label>
              <input type="tel" class="form-control" name="phone">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label for="pwd">Bussiness Address</label>
              <input type="text" class="form-control" id="pwd" name="address">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Bussiness Type</label>
              <input type="text" class="form-control" name="b_type">
            </div>
          </div>
        </div>
        <!--<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">-->
        <!--  <div class="createadmininputs">-->
        <!--    <div class="form-group">-->
        <!--      <label>Industry</label>-->
        <!--      <input type="text" class="form-control" name="industry">-->
        <!--    </div>-->
        <!--  </div>-->
        <!--</div>-->
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