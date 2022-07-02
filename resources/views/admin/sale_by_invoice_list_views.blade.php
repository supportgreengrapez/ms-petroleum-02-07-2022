@extends('admin.layout.appadmin')
    @section('content') 
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>Sale Report</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <form method="post" action = "{{url('/')}}/admin/home/search/invoice/by/date" class="login-form" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="dateinputcircles">
          <div class="form-group">
            <input type="date" name="date_from">
          </div>
        </div>
      </div>
      <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
        <div class="Tohead">
          <h4>To</h4>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="dateinputcircles">
          <div class="form-group">
            <input type="date" name="date_to">
          </div>
        </div>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <div class="Applybtn">
          <button href="#" class="btnapply btn">Apply</button>
        </div>
      </div>
    </form>
  </div>
  <div class="row">
    <form method="post" action = "{{url('/')}}/admin/home/search/sale/by/invoice" class="login-form" enctype="multipart/form-data">
      {{ csrf_field() }}
      <div class="col-lg-4">
        <div class="form-group">
          <label>Customer Name</label>
          <select class="js-example-basic-single" name="customer_name" >
            <option value=""></option>
            
           @foreach($result1 as $results )
        
            <option value="{{$results->pk_id}}">{{$results->customer_name}}</option>
           
           @endforeach
      
          
          </select>
        </div>
      </div>
      <div class="col-lg-2">
        <div class="totalamountp">
          <button type="submit" class="amountbtn btn">Apply</button>
        </div>
      </div>
    </form>
  </div>
  <div class="row">
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 col-lg-offset-2">
      <div class="Adminprofilebox">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="accountpayablehead">
                
              <h4>Company Name</h4>
              <h4>Sale Report by Customer</h4>
              <p>January 1-Faburary 10</p>
            </div>
          </div>
        </div>
        <table id="example" class="table" cellspacing="0" width="100%">
            
            <a href="{{ url('/admin/home/print/sale/by/customer') }}" class="amountbtn btt btn">Print Preview</a>
            <a href="{{ url('/admin/home/view/sale/by/invoice/pdf') }}" class="amountbtn btn btn">PDF</a>
       
          <thead class="headbgcolor2">
            <tr>
              <th></th>
              <th style="text-align:right;">Credit Rs</th>
            </tr>
          </thead>
          <tbody>
          
          @if(count($result)>0)
          @foreach($result as $results)
          @php
          $customer = DB::select("select* from customer  where pk_id = '$results->customer_name'");
          @endphp
          <tr>
            <td><a href="{{url('/')}}/admin/home/view/sale/by/customer/name/deatiled/{{$results->customer_name}}"><strong>{{$customer[0]->customer_name}}</strong></a></td>
            <td style="text-align:right;"><a href="{{url('/')}}/admin/home/view/sale/by/customer/deatiled/{{$results->pk_id}}">{{$results->total_amount}}</a></td>
          </tr>
          @endforeach
          @endif
          
          <tr>
            <td>
            <div class="totalpayabletable">
              <h4>Total Sale</h4>
            </div>
          </td>
          <td style="text-align:right;">
            <div class="totalpayabletable">
              <p>PKR {{number_format($total_amount[0]->{'SUM(total_amount)'})}}</p>
            </div>
              </td>
          </tr>
            </tbody>
          
        </table>
      </div>
    </div>
  </div>
</div>
@endsection