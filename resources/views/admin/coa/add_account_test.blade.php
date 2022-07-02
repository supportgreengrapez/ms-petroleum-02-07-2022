@extends('admin.layout.appadmin')
@section('content')
<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="viewadminhead">
                <h2>Create Customer Creditor/Debitor</h2>
            </div>
        </div>
    </div>
    <form method="post" action="{{url('/')}}/admin/add/payment/test" class="login-form">
        {{ csrf_field() }}

        @if($errors->any())
        <div class="alert alert-danger"> <strong></strong> {{$errors->first()}} </div>
        @endif
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                    <div class="form-group">
                        <label>Select Customer Name</label>

                        <select class="js-example-basic-single" id="testname" name="name">

                            <option value="" disable="true" selected="true">---Select Name---</option>
                            @if($result>0)
                            @foreach($result as $results)


                            <option value="{{$results->pk_id}}">{{$results->customer_name}} |
                            
                            @if($results->payment_type == 'Payment')
                            Debitor
                            
                            
                            @elseif($results->payment_type == 'Received')
                            
                            Creditor
                            @else
                            ...
                            @endif
                            </option>


                            @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                      <div class="form-group">
                        <label >Payment Method</label>
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
        <div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                
                <div class="createadmininputs">
                    <div class="form-group">
                        <label for="usr">Payment Type</label>
                    </div>
                </div>
                <div class="radio">
                    <label><input type="radio" name="payment_type" value="Payment" checked>Payment</label>
                </div>
                <div class="radio">
                    <label><input type="radio" name="payment_type" value="Received">Received</label>
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
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                    <div class="form-group">
                        <label for="usr">Date</label>
                        <input type="text" class="form-control" id="mydate" name="date">
                    </div>
                </div>
            </div>

            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                    <div class="form-group">
                        <label for="usr">Balance</label>
                        <div id="test_blance"></div>
                        <div id="supplier_blance"></div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="createadmininputs">
                    <div class="form-group">
                        <label for="usr">Amount</label>
                        <input type="number" class="form-control" name="test_amount">
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