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
      <form  method="post" action="{{url('/')}}//admin/edit/company/{{$result[0]->pk_id}}" class="login-form" enctype="multipart/form-data">
     
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
              <input type="text" class="form-control" id="usr" name="fname" value="{{$result[0]->fname}}">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Company Name</label>
              <input type="text" class="form-control" name="company_name" value="{{$result[0]->company_name}}">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Phone</label>
              <input type="tel" class="form-control" name="phone" value="{{$result[0]->phone}}">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label for="pwd">Bussiness Address</label>
              <input type="text" class="form-control" id="pwd" name="address" value="{{$result[0]->address}}">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Bussiness Type</label>
              <input type="text" class="form-control" name="b_type" value="{{$result[0]->bussiness_type}}">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label>Industry</label>
              <input type="text" class="form-control" name="industry" value="{{$result[0]->industry}}">
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