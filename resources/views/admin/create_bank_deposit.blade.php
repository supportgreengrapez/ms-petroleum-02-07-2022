@extends('admin.layout.appadmin')
@section('content') 

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>Create Capital Investment</h2>
      </div>
    </div>
    
  </div>
  <form method="post" action = "{{url('/')}}/admin/home/add/bank/deposit" class="login-form">
    {{ csrf_field() }}
    
    
    @if($errors->any())
    <div class="alert alert-success"> <strong></strong> {{$errors->first()}} </div>
    @endif
    <div class="row">
      <!--<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">-->
      <!--  <div class="createadmininputs">-->
      <!--    <div class="form-group">-->
      <!--      <label for="usr">Account Type</label>-->
      <!--      <a href="{{URL('/')}}/admin/home/add/account" > ADD New</a>-->
      <!--      <select class="js-example-basic-single" name="payment_acc" id="account_type" required>-->
      <!--        <option value="" disable="true" selected="true">---Select Account ---</option>-->
                  
      <!--          <option value="Owners Equity">Owners Equity</option>-->
              
      <!--      </select>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</div>-->
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Payment Account</label>
            <a href="{{URL('/')}}/admin/home/add/account" > ADD New</a>
            <select class="js-example-basic-single" name="account_name" required>
              <option value="" disable="true" selected="true">---Select Account ---</option>
              
                @if($result2>0)
                @foreach($result2 as $results)
                  
                <option value="{{$results->account_name}}">{{$results->account_name}}</option>
              
                @endforeach
                @endif
       
      
            </select>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-1">
        <div class="createadmininputs">
          <div class="form-group">
            <label for="usr">Date</label>
            <input type="text" class="form-control" id="mydate" name="date">
          </div>
        </div>
      </div>
    </div>
        <div class="alert alert-success"> <strong></strong>Please Select Account Name or Sub Account Name</div>
    <div class="row">
      <div class="borderrow">
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label> Account Name</label>
              <a href="{{URL('/')}}/admin/home/add/account" > ADD New</a>
              <select  class="js-example-basic-single" name="account_name2" id="mainaccount">
                    <option value="" disable="true" selected="true">---Select Account ---</option>
                    @if($result>0)
                @foreach($result as $results)
                <option value="{{$results->account_name}}">{{$results->account_name}}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label> Sub Account Name</label>
              <select  class="js-example-basic-single" name="sub_account" id="subaccount">
                    <option value="" disable="true" selected="true">---Select Sub Account ---</option>
                @if($subcategories>0)
                @foreach($subcategories as $results)
                <optgroup label="{{$results->account_name}}">
                <option value="{{$results->sub_account}}">{{$results->sub_account}}</option>
                </optgroup>
                @endforeach
                @endif
              </select>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label for="usr">Description</label>
              <input class="form-control" name="description" >
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
          <div class="createadmininputs">
            <div class="form-group">
              <label for="usr">Amount</label>
              <input type="number" name = "amount" class="form-control" required>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 col-lg-offset-9">
        <div class="totalamountp">
          <button type="submit"  class="amountbtn btn">Save</button>
        </div>
      </div>
    </div>
  </form>
</div>
<!-- /page content --> 

@endsection