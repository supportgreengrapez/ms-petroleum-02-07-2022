@extends('admin.layout.appadmin')
@section('content') 
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2> 
            <a href="{{url('/')}}/admin/home/view/sale/by/customer" class="amountbtn btn">Back</a> View Sale / By Customer</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Customer Name : <span>{{$result1[0]->customer_name}}</span></h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Balance : <span>PKR {{number_format($result1[0]->current_balance)}}</span></h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Total Sale : <span>PKR {{number_format($total_amount[0]->{'SUM(total_amount)'})}}</span></h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Billing Address : <span>{{$result1[0]->billing_address}}</span></h4>
      </div>
    </div>
    
    
    
  </div>
  @if($errors->any())
  <div class="alert alert-success"> <strong></strong> {{$errors->first()}} </div>
  @endif
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <table id="myTable" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
            <thead class="headbgcolor">
              <tr>
                <th>Sale Invoice</th>
                <th>Sale Type</th>
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
            
            $total_q1 = DB::select("select SUM(quantity) from detail_sale where sale_id = '$results->pk_id'");
            $total_q2 = DB::select("select SUM(quantity) from detail_tax_sale where sale_id = '$results->pk_id'");
             $rate = DB::select("select* from detail_sale where sale_id = '$results->pk_id'  ");
            $q = DB::table('sale_return')->where('sale_id',$results->pk_id)->sum('quantity');
            $sale = DB::select("select* from sale_return where sale_id = '$results->pk_id'  ");
            $due_date = DB::select("select * from sale_invoice where sale_id = '$results->pk_id'");
            
            $return_q = DB::table('sale_return')->where('sale_id',$results->pk_id)->sum('amount');
            @endphp
            <tr>
              <td>{{$results->pk_id}}</td>
               @if($results->sale == "tax")
              <td>Tax</td>
              @else
              <td>{{$results->sale_type}}</td>
              @endif
              @if($results->sale == "tax")
              <td>{{number_format($total_q2[0]->{'SUM(quantity)'})}}</td>
              @else
              <td>{{number_format($total_q1[0]->{'SUM(quantity)'})}}</td>
              @endif
                <td>PKR {{number_format($rate[0]->rate)}}</td>
           
              <?php $account_type= DB::table('account')->where('pk_id',$results->account_type)->first();
                        if(empty($account_type)){ ?>
              <?php }else{ ?>
              <td>{{$account_type->account_name}}</td>
              <?php } ?>
             
              @php
              $balance= ($results->total_amount)  -$results->paid_amount
              @endphp
             
              <td>PKR {{number_format($results->total_amount)}}</td>
             
              <td>PKR {{number_format(($results->total_amount)- ($balance))}}</td>
              <td>PKR {{number_format($results->balance)}} </td>
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
              <td> Partial ,
                
                
                @if( now()  > $results->due_date )
                
                Overdue
                
                @endif </td>
              @elseif($results->paid_amount   != $results->total_amount )
              <td> Open ,
                
                
                @if( now()  > $results->due_date )
                
                Overdue
                
                @endif </td>
              @endif
              <td>{{$results->created_at}}</td>
             
              <td><a href="{{url('/')}}/admin/home/view/sale/detail/{{$results->pk_id}}/{{$results->sale}}" class="bordersets">view</a> <a href="{{url('/')}}/admin/home/create/sale/payment/{{$results->pk_id}}/{{$results->sale}}" class="bordersets">Recieve Payment</a> @if( $results->total_amount   != $return_q ) <a href="{{url('/')}}/admin/home/do/sale/return/{{$results->pk_id}}" class="bordersets">Return</a> @endif <a href="{{url('/')}}/admin/home/view/sale/payment/history/{{$results->pk_id}}/{{$result1[0]->customer_name}}" class="bordersets"> Payment History</a>
           
              @if(session('Sales_Management_delete')==1)
            <a href="{{url('/')}}/admin/home/delete/sale/list/{{$results->pk_id}}" class="bordersets">Delete</a></td>
            @else
              Delete
           
              @endif
           
           
            </tr>
            @endforeach
            @endif
              </tbody>
            
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content --> 

@endsection