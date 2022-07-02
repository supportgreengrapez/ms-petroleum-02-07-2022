@extends('admin.layout.appadmin')
@section('content')
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="viewadminhead">
          <h2>Create Expense</h2>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="plusbutton"> <a href="{{url('/')}}/admin/home/add/account" class="btn pumpplusbtn" title="Add field"><span class="glyphicon glyphicon-plus"></span></a> </div>
      </div>
    </div>
    <form method="post" action = "{{url('/')}}/admin/home/add/expense" class="login-form">
  {{ csrf_field() }}
  @if($errors->any())
  <div class="alert alert-success"> <strong></strong> {{$errors->first()}} </div>
  @endif
  <div class="field_wrapper">
    <div class="row">
    <div class="borderrow">
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Payee</label>
            <select  class="js-example-basic-single" name="payee">
              <option value="">Select </option>
              
            @if($customer>0)
            @foreach($customer as $results)
    
              <option value="{{$results->customer_name}}" >{{$results->customer_name}} (Customer)</option>
              
            @endforeach
            @endif
            
            @if($supplier>0)
            @foreach($supplier as $results)

              <option value="{{$results->supplier_name}}" >{{$results->supplier_name}} (Supplier)</option>
              
            @endforeach
            @endif
            
            @if($employe>0)
            @foreach($employe as $results)

              <option value="{{$results->employe_name}}" >{{$results->employe_name}} (Employe)</option>
            
            @endforeach
            @endif
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label>Account Name</label>
            <a href="{{URL('/')}}/admin/home/add/account" > ADD</a>
            <select  class="js-example-basic-single" name="account_name" required>
              <option value="">Select Account</option>
              
            @if($result>0)
            @foreach($result as $results)

              <option value="{{$results->pk_id}}" >{{$results->account_name}}{{$results->sub_account}}</option>
              
            @endforeach
            @endif
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="sel1">Payment Account</label>
            <a href="{{URL('/')}}/admin/home/add/account" > ADD </a>
            <select  class="js-example-basic-single" name="payment_account" required>
              <option value="">Select Account</option>
              
            @if($bank>0)
            @foreach($bank as $results)
    
              <option value="{{$results->account_name}}" >{{$results->account_name}}</option>
              
            @endforeach
            @endif
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label>Description</label>
            <input type="text" class="form-control" name="description">
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label>Amount</label>
            <input type="text" class="form-control" name="amount" required>
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="mydate"> Date</label>
            <input type="text" class="form-control" id="mydate" name="date">
          </div>
        </div>
      </div>
    </div>
  </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 pull-right">
        <div class="totalamountp">
          <button type="submit" class="amountbtn btn pull-right">Save</button>
        </div>
      </div>
    </div>
    
</form>
  </div>
  <!-- /page content -->
@endsection