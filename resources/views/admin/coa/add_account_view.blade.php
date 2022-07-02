@extends('admin.layout.appadmin')
@section('content') 
<style>
    
    .cls{
        display:none;
    }
</style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>Create Chart of Account</h2>
      </div>
    </div>
  </div>
  <form method="post" action = "{{url('/')}}/admin/home/add/account" class="login-form">
    {{ csrf_field() }}
    
    @if($errors->any())
    <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
    @endif
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"> 
        <div class="createadmininputs">
          <div class="form-group">
            <label for="sel1">Nature of Account</label> 
            <!--<a href="{{url('/')}}/admin/add/nature/of/account">Add New</a>-->
            
           <select class="js-example-basic-single" id="mainCategory" name="noa">
             <option >Select</option> 
             @if($account_nature>0)
          @foreach($account_nature as $results)
        
                    
                  <option value="{{$results->nature_of_account}}" >{{$results->nature_of_account}}</option> 
                  
                    
           @endforeach
                  @endif
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="sel1">Account Type</label> 
            <a href="{{url('/')}}/admin/add/account/type">Add New</a>
             <select class="js-example-basic-single" id="SubCategory"  name="account_type" >
               
             <option >Select</option> 
            </select>
            
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Account Name</label>
            <input list="account_name" name="account_name"  class="form-control" id="ProductType" autocomplete="off">
            <datalist id="account_name">
                <option >Select</option> 
            </datalist>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Description</label>
            <input type="text" name="description" class="form-control">
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Balance</label>
            <input type="text" name="balance" class="form-control">
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Date</label>
            <input type="text" class="form-control" id="mydate" name="date">
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <label for="myCheck">Is Sub-Account?</label> 
            <input type="checkbox" id="myCheck" onclick="myFunction()">

            <div id="text" style="display:none">
            <div class="createadmininputs">
          <div class="form-group">
            <label for="sel1">Parent Account</label>
           <select class="js-example-basic-single" name="sub_account" id="p_account">
             <option value=""></option> 
             @if($account_name>0)
          @foreach($account_name as $results)
        
                    
                  <option value="{{$results->account_name}}" >{{$results->account_name}}</option> 
                  
                    
           @endforeach
                  @endif
            </select>
          </div>
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
  </form>
</div>
<!-- /page content --> 

@endsection 