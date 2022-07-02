@extends('admin.layout.appadmin')
@section('content')

  <!-- page content -->
  <div class="right_col" role="main">
    <div class="row">
      <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
        <div class="viewadminhead">
          <h2><a href="{{url('/')}}/admin/home/view/purchase/by/supplier" class="amountbtn btn">Back</a> Create Purchase / Normal Entrys</h2>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="invoicestopright">
          <h4>Purchase Invoice #</h4>
          <p>00{{$sale_id}}</p>
        </div>
      </div>
    </div>
    
    <form method="post" action = "{{url('/')}}/admin/home/add/purchase" class="login-form" enctype="multipart/form-data">
  {{ csrf_field() }}
  
  @if($errors->any())
  <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
  @endif 
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs invoicestopright">
          <h4>Date</h4>
          <input type="text" class="form-control" id="mydate" name="date" autocomplete="off" data-date-format="dd-mm-yyyy">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="supplier_name">Supplier Name</label>
            <a href="#" class="bordersets" data-toggle="modal" data-target="#modal_fullscreen"> Add </a>
            <select class="js-example-basic-single" name="supplier_name" required>
            
                  <option value="">Select Supplier</option>
                  @if($result>0)
          @foreach($result as $results)
                  <option value="{{$results->pk_id}}">{{$results->supplier_name}}</option>
                  @endforeach
                  @endif
              </select> 
            
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="account_type">Account Type</label>
            <input type="text" class="form-control" id="account_type" value="Credit" placeholder="Credit" name="account_type" readonly>
          </div>
        </div>
      </div>
      <!--<div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">-->
      <!--  <div class="createadmininputs">-->
      <!--    <div class="form-group">-->
      <!--      <label for="purchase_type">Purchase Type</label>-->
      <!--      <select class="form-control" id="purchase_type" name="purchase_type" required>-->
      <!--        <option value="">Select Purachse Type</option>-->
      <!--        <option value="purchase">Purchase</option>-->
      <!--        <option value="return">Purchase Return</option>-->
      <!--      </select>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="company_name">Company Name</label>
            <input type="text" class="form-control" id="company_name" name="company_name" value="" autocomplete="off">
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="vehicle">Vehicle No</label>
            <input type="text" class="form-control" autocomplete="off" id="vehicle" name="vehicle_no" value="">
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
                  <label for="sku">SKU</label>
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
                  <label for="name">Item Name</label><a href="{{URL('/')}}/admin/home/add/inventory" > ADD New</a>
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
                  <label for="quantity">Description</label> 
                  <input type="text" class="form-control"  name="description[]"  >
                </div>
              </div>
            </div>
            
           
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
              <div class="createadmininputs">
                <div class="form-group">
                  <label for="rate">Rate</label>
                  <input type="text" class="form-control" id="rate" name="rate[]" value="" required>
                </div>
              </div>
            </div>
            
             <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 ">
              <div class="createadmininputs">
                <div class="form-group">
                  <label for="quantity">Quantity</label> (<span id="qty"></span>)
                  <input type="text" class="form-control" id="quantity" name="quantity[]" value="" required>
                </div>
              </div>
            </div>
            
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
              <div class="createadmininputs">
                <div class="form-group">
                  <label for="amount">Amount</label>
                  <input type="text" class="form-control" id="amount" name="amount[]" value="" disabled>
                </div>
              </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12 pull-right">
              <div class="plusbutton">
                <button type="button" class="add_buttonsale plusbtn" title="Add field" style="float:right;"><span class="glyphicon glyphicon-plus"></span></button>
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
          <span id="total">0</span> <span>PKR</span>
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
  </div>
<!-- /page content -->


<div class="modal fade modal-fullscreen" id="modal_fullscreen" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Supplier</h4>
      </div>
      <div class="modal-body">
        <form method="post" action = "{{url('/')}}/admin/home/add/supplier" class="login-form" enctype="multipart/form-data" autocomplete="off">
          {{ csrf_field() }}
          @if($errors->any())
          <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
          @endif
          <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
              <div class="createadmininputs">
                <div class="form-group">
                  <label for="usr">Supplier Name</label>
                  <input type="text" name="supplier_name" class="form-control" id="usr" required>
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
                  <input type="text" name="phone" class="form-control" id="">
                </div>
              </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
              <div class="createadmininputs">
                <div class="form-group">
                  <label for="usr">Billing Address</label>
                  <input type="text" name="billing_address" class="form-control" id="">
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
@endsection