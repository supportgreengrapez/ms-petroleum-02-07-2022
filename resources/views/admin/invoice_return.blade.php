@extends('admin.layout.appadmin')
@section('content')
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2> Invoice Return</h2>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
      <div class="invoicestopright">
        <h4>Sale Invoice #</h4>
        <p>00{{$id}}</p>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          
        </div>
  </div>
  <form method="post" action ="{{url('/')}}/admin/home/add/sale/invioce/return/{{$id}}" class="login-form" enctype="multipart/form-data">
    {{ csrf_field() }}
    
    @if($errors->any())
    <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
    @endif
    <div class="row">
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Customer Name</label>
          
           @php
$cus_name= $result[0]->customer_name;
                    $customer_name = DB::select("select* from customer where pk_id = '$cus_name'");
                 
           @endphp


            <input  class=" form-control"  id="customer_name" name="customer_name"  value= "{{$customer_name[0]->customer_name}}" readonly>


          </div>
        </div>
      </div>
    </div>
    <div class="row">
  
          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Sale Type</label>
            <input  class=" form-control"  id="sale_type" name="sale_type" value="{{$result[0]->sale_type}}" readonly>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Invoice Date</label>
             <input type="text" class="form-control"  name="date" value="{{$result[0]->bill_date}} " readonly>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Due Date</label>
            <input type="text" class="form-control"  name="date2" value="{{$result[0]->due_date}}" readonly>
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


                <input  class=" form-control"  id="sku" name="sku"  value="{{$result1[0]->sku}}" readonly>
 

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
               
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                <label for="item_name">Product/Service</label>


                <input  class=" form-control"   id="name"  name="item_name" value="{{$result1[0]->item_name}}" readonly>


               
            
              </div>
            </div>
          </div>
          <!-- <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                <label>Description</label>
                <input type="text" class="form-control"  name="description" value="{{$result[0]->description}}" readonly >
              </div>
            </div>
          </div> -->
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                <label>QTY</label>Availble:{{$quantity_available}}
                <input type="text" class="form-control" id="quantityr" name="quantity" value="0" >
              </div>
            </div>
          </div>
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                <label>Rate</label>
                <input type="text" class="form-control" id="rater" name="rate" value="{{$result1[0]->rate}}" readonly >
              </div>
            </div>
          </div>
          
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
            <div class="createadmininputs">
              <div class="form-group">
                <label for="usr">Amount</label>
                <input type="text" class="form-control" id="amountr"  name="amount" value="{{$result1[0]->amount}}"  readonly>
              </div>
            </div>
          </div>


          
          <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
              <div class="plusbutton">
                <button type="button" class="add_buttonsaler plusbtn" title="Add field"><span class="glyphicon glyphicon-plus"></span></button>
              </div>
            </div>

            </div>
        </div>
      </div>
    </div>
    <div class="row">


   
    <!-- <div  class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-6">
    <div class="totalamounth">
              
                <label for="usr">to Amount</label>
                <input type="text" class="form-control" id="totalr"  name="totalr"  readonly>
             
            </div>
          </div> -->



      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-6">
        <div class="totalamounth">
          <h3>Total Amount</h3>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="totalamountp">
          <p id="totalr">0</p>
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
@endsection
