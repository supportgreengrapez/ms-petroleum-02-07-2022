@extends('admin.layout.appadmin')
@section('content')
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>
            
            Create Creditor</h2>
      </div>
    </div>
    <
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"> </div>
  </div>
  <form method="post" action ="{{url('/')}}/admin/home/add/bal/invioce" class="login-form" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    @if($errors->any())
    <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
    @endif
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="">Customer Name</label>
            <a  href="#"class="bordersets" data-toggle="modal" data-target="#modal_fullscreen"> Add </a>
            <select class="js-example-basic-single" name="customer_name" required="required">
              <option value=""> Select Cutomer Name</option>
              
      @if($result>0)
          @foreach($result as $results)
        
              <option value="{{$results->pk_id}}">{{$results->customer_name}}</option>
              
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
                  <input type="text" class="form-control" id="amount"  name="amount" >
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
    <!-- <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-6">
        <div class="totalamounth">
          <h3>Balance Due</h3>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="totalamountp">
          <p>0</p>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-9">
        <div class="totalamountp">
          <button type="submit" class="amountbtn btn pull-right">Save</button>
        </div>
      </div>
    </div>
  </form>
  <div class="modal fade modal-fullscreen" id="modal_fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Add Customer</h4>
        </div>
        <div class="modal-body">
          <form method="post" action = "{{url('/')}}/admin/home/add/customer" class="login-form" enctype="multipart/form-data">
            {{ csrf_field() }}
            @if($errors->any())
            <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
            @endif
            <div class="row">
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                  <div class="form-group">
                    <label for="usr">Customer Name</label>
                    <input type="text" name="customer_name" class="form-control" id="usr" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                  <div class="form-group">
                    <label for="usr">CNIC No</label>
                    <input type="text" name="cnic" class="form-control" id="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                  <div class="form-group">
                    <label for="usr">Phone No</label>
                    <input type="text" name="phone" class="form-control" id="" required>
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                  <div class="form-group">
                    <label for="usr">Billing Address</label>
                    <input type="text" name="billing_address" class="form-control" id="" required>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                  <div class="form-group">
                    <label for="usr">National Tax Number</label>
                    <input type="text" name="ntn" class="form-control" id="">
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                  <div class="form-group">
                    <label for="usr">Sales Tax Registration Number</label>
                    <input type="text" name="strn" class="form-control" id="">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                  <div class="form-group">
                    <label for="usr">Opening Balance(PKR)</label>
                    <input type="text" name="opening_balance" value="0" class="form-control" id="">
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                  <div class="form-group">
                    <label for="usr">Current Balance(PKR)</label>
                    <input type="text" name="current_balance" value="0" class="form-control" id="">
                  </div>
                </div>
              </div>
              <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="viewadminbtn">
                  <button type="submit" class="btnedit btn" style="float:left !important;">Save</button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection