@extends('admin.layout.appadmin')
@section('content')
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>
            
            Create Creditor Payment</h2>
      </div>
    </div>
    <
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"> </div>
  </div>
  <form method="post" action ="{{url('/')}}/admin/home/create/bal/payment" class="login-form" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    @if($errors->any())
    <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
    @endif
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="">Customer Name</label>
            <input type="text" class="form-control" name="customer_name" value="{{$customer}}" readonly>
            
          </div>
        </div>
      </div>
    </div>
   
    <div class="row">
         <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label >Account Name</label>
            <select class="js-example-basic-single" name="account_name" required="required">
              <option value=""> Select Account Name</option>
              
      @if(count($account_type)>0)
          @foreach($account_type as $results)
        
              <option value="{{$results->account_name}}">{{$results->account_name}}</option>
              
          @endforeach
                  @endif
      
            </select>
          </div>
        </div>
      </div>
        </div>
    
      <div class="field_wrapper">
        <div class="borderrow">
          <div class="row">
     
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
              <div class="createadmininputs">
                <div class="form-group">
                  <label for="usr">Balance</label>
                  <input type="text" class="form-control"   name="amount" value="{{$total}}" readonly>
                </div>
              </div>
            </div>
            
             
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
              <div class="createadmininputs">
                <div class="form-group">
                  <label for="usr">Partial</label>
                  <input type="text" class="form-control" id="amount"  name="partial" >
                </div>
              </div>
            </div>
           
          </div>
        </div>
      </div>

    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-6">
        <div class="totalamounth">
          <h3>Total Amount</h3>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="totalamountp">
          <p id="total">0</p>
        </div>
      </div>
      
      
    </div>

    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-9">
        <div class="totalamountp">
          <button type="submit" class="amountbtn btn pull-right">Save</button>
        </div>
      </div>
    </div>
  </form>

</div>
@endsection