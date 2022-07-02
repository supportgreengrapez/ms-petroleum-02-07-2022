@extends('admin.layout.appadmin')
@section('content') 
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>
            <a href="{{url('/')}}/admin/home/view/purchase/by/supplier" class="amountbtn btn">Back</a>
            View Purchases / By Supplier</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Billing Address : <span>{{$result1[0]->billing_address}}</span></h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Supplier Name : <span>{{$result1[0]->supplier_name}}</span></h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Balance : <span>PKR {{number_format($result1[0]->current_balance)}}</span></h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Total Purchases : <span>PKR {{number_format($total_amount[0]->{'SUM(total_amount)'})}}</span></h4>
      </div>
    </div>
  </div>
  @if($errors->any())
  <div class="alert alert-success"> <strong></strong> {{$errors->first()}} </div>
  @endif
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <table id="myTable" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
        <thead class="headbgcolor">
          <tr>
            <th>PI #</th>
            <th>Purchase Type</th>
            <th>Qty</th>
            <th>Rate</th>
            <th>Invoice Amount</th>
            <th>Paid</th>
            <th> Balance</th>
            <th>Returned Qty</th>
            <th>Returned Amount</th>
            <th> Status </th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        
        @if(count($result)>0)
        @foreach($result as $results)
        @php
        
        $total_q1 = DB::select("select SUM(quantity) from detail_purchase where purchase_id = '$results->pk_id'");
        $total_q2 = DB::select("select SUM(quantity) from detail_tax_purchase where purchase_id = '$results->pk_id'");
        $sale = DB::select("select* from purchase_return where purchase_id = '$results->pk_id'  ");
         $rate = DB::select("select* from detail_purchase where purchase_id = '$results->pk_id'  ");
        $q = DB::table('purchase_return')->where('purchase_id',$results->pk_id)->sum('quantity');
        $return_q = DB::table('purchase_return')->where('purchase_id',$results->pk_id)->sum('amount');
        @endphp
        <tr>
          <td>{{$results->pk_id}}</td>
          @if($results->purchase == "tax")
          <td>Tax</td>
          @else
          <td>Purchase</td>
          @endif
          
          @if($results->purchase == "tax")
          <td>{{($total_q2[0]->{'SUM(quantity)'})}}</td>
          @else
          <td>{{($total_q1[0]->{'SUM(quantity)'})}}</td>
          @endif
           <td>PKR {{number_format($rate[0]->rate)}}</td>
        
          <td>PKR {{number_format($results->total_amount)}}</td>
          @php
          $balance= ($results->total_amount)  -$results->paid_amount
          @endphp
          <td>PKR {{number_format(($results->total_amount)- ($balance))}}</td>
          <td>PKR {{number_format($results->balance)}}</td>
            @if(count($sale)>0)
          <td>{{$q}}</td>
          @else
          <td></td>
          @endif
          @if(count($sale)>0)
          <td>PKR {{number_format ($sale[0]->amount)  }}</td>
          @else
          <td></td>
          @endif
          
          
          @if( $results->paid_amount   == $results->total_amount )
          <td> Paid </td>
          @elseif($results->paid_amount >0 &&  $results->paid_amount < $results->total_amount )
          <td> Partial </td>
          @elseif($results->paid_amount   != $results->total_amount )
          <td> Open </td>
          @endif
          <td>{{$results->created_at}}</td>
          <td><a href="{{url('/')}}/admin/home/view/purchase/detail/{{$results->pk_id}}/{{$results->purchase}}" class="bordersets">view</a> <a href="{{url('/')}}/admin/home/create/purchase/payment/{{$results->pk_id}}" class="bordersets" >Create Payment</a> @if( $results->total_amount   != $return_q ) <a href="{{url('/')}}/admin/home/do/purchase/return/{{$results->pk_id}}" class="bordersets" >Return</a> @endif <a href="{{url('/')}}/admin/home/view/purchase/payment/history/{{$results->pk_id}}/{{$result1[0]->supplier_name}}" class="bordersets"> Payment History</a>
      
          @if(session('Purchase_Management_delete')==1)
       <a href="{{url('/')}}/admin/home/delete/purchase/list/{{$results->pk_id}}" class="bordersets">Delete</a>
       @else
              Delete
           
              @endif
       </td>
        </tr>
        @endforeach
        @endif
          </tbody>
        
      </table>
    </div>
  </div>
</div>
<!-- /page content --> 

@endsection