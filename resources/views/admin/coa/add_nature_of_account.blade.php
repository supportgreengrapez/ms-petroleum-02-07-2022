  @extends('admin.layout.appadmin')
@section('content') 

<div class="right_col" role="main">
      <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>Create Chart of Account</h2>
      </div>
    </div>
  </div>
  
 <form method="post" action = "{{url('/')}}/admin/add/nature/of/account/list" class="login-form">
    {{ csrf_field() }}
    
    @if($errors->any())
    <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
    @endif
     <div class="row">
  
      
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Nature of Account</label>
            <input type="text" name="coa" class="form-control" id="">
          </div>
        </div>
      </div>
       </div>
      
      
          <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="totalamountp">
          <button type="submit" class="amountbtn btn">Save</button>
        </div>
      </div>
    </div>
      </div>
  </form>
      
      @endsection 