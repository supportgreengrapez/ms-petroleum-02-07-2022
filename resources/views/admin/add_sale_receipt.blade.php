@extends('admin.layout.appadmin')
@section('content')
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>Sale Receipt</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="invoicestopright">
        <h4>Sale Receipt #</h4>
        <p>00{{$sale_id}}</p>
      </div>
    </div>
  </div>
  <form method="post" action ="{{url('/')}}/admin/home/add/sale/reciept" class="login-form" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    @if($errors->any())
    <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
    @endif
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Customer Name</label>
            <a class="bordersets" data-toggle="modal" data-target="#modal_fullscreen"> Add  </a>


<select class="js-example-basic-single" name="customer_name" required>
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
            <label for="usr">Sale Receipt Date</label>
            <input type="text" class="form-control" id="mydate" name="date">
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
          <label for="usr">Sale Type</label>
                  <input type="text" class="form-control" value="sale"   name="sale_type" readonly>
             
          </div>
        </div>
      </div>

    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Account Type</label>
             
       
        <input type="text" class="form-control" value="cash"  name="account_type" readonly>
       
      
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Payment Account</label>
           
              <select class="js-example-basic-single" name="ref_no" required>
              <option value=""> Select Account</option>
              
      @if(($account_type)>0)
                    @foreach($account_type as $results)
        
              <option value="{{$results->account_name}}">{{$results->account_name}}</option>
              
          @endforeach
                  @endif
      
            </select>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid">
    <div class="field_wrapper">
      <div class="borderrow">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                <label for="usr">SKU</label>
                 <select class="js-example-basic-single" id="sku" name="sku[]" required>
              <option value=""> Select SKU</option>
              
      @if($inventory>0)
                    @foreach($inventory as $results)
        
              <option value="{{$results->sku}}">{{$results->sku}}</option>
              
          @endforeach
                  @endif
      
            </select>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                 
                <label for="item_name">Item Name</label> <a href="{{URL('/')}}/admin/home/add/inventory/list" > ADD New</a>
                    <select class="js-example-basic-single" id="name" name="item_name[]" required>
              <option value=""> Select Item Name</option>
              
      @if($inventory>0)
                    @foreach($inventory as $results)
        
              <option value="{{$results->name}}">{{$results->name}}</option>
              
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
                <input type="text" class="form-control"  name="" >
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                <label>Rate</label>
                <input type="text" class="form-control" id="rate" name="rate[]" required>
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                <label>QTY</label><span id="qty"></span>
                <input type="text" class="form-control" id="quantity" name="quantity[]" required >
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                <label for="usr">Amount</label>
                <input type="text" class="form-control" id="amount"  name="amount[]" disabled>
              </div>
            </div>
          </div>

          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
              <div class="plusbutton">
                <button type="button" class="add_buttonsale plusbtn" title="Add field"><span class="glyphicon glyphicon-plus"></span></button>
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
          <button type="submit" class="amountbtn btn">Save</button>
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

<div class="alert alert-danger">
  <strong></strong> {{$errors->first()}}
</div>
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