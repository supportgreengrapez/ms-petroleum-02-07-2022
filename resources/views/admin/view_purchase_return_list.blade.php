@extends('admin.layout.appadmin')
@section('content')
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
          <div class="viewadminhead">
            <h2>View Purchases Return / By Supplier</h2>
          </div>
        </div>
         <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="machinename">
         <h4>{{$result1[0]->billing_address}}</h4>
         </div>
        </div>
      </div>
      <div class="row">
       <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <div class="Totalpurchasehead">
         <h4>Supplier Name :</h4>
          <p>{{$result1[0]->supplier_name}}</p>
         </div>       
      </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <div class="Totalpurchasehead">
         <h4>Balance :</h4>
          <p>PKR {{number_format($result1[0]->current_balance)}}</p>
         </div>       
      </div>
     
        
  
      
       <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
         <div class="Totalpurchasehead">
         <h4>Total Purchases :</h4>
          <p>PKR {{number_format($total_amount[0]->{'SUM(total_amount)'})}}</p>
         </div>       
      </div>
      
      </div>
      
      
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
            <div class="x_content">
              <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead class="headbgcolor">
                  <tr>
                    <th>Purchase-Invoice</th>
                    <th>Amount</th>
                    <th>Supplier Paid</th>
                    <th>Returned Amount</th>
                    <th>Company Paid</th>
                    <th>Balance</th>
                            <th>Date</th>
                             <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                @if(count($result)>0)
                @foreach($result as $results)
                   <tr>
                   <td>{{$results->pk_id}}</td>
                   <td>PKR {{number_format($results->total_amount)}}</td>
                   @php


$sale = DB::select("select* from purchase_return where purchase_id = '$results->pk_id'  ");
$payment = DB::select("select* from purchase_returned_payment where purchase_id = '$results->pk_id'  ");
$remain = DB::table('purchase_invoice')->where('purchase_id',$results->pk_id)->sum('partial');
@endphp
               @if(($remain)>0)
<td>PKR {{number_format($remain)  }}</td>
@else
<td> </td>
@endif
@if(count($sale)>0)
                     <td>PKR {{number_format ($sale[0]->amount)  }}</td>
                     @else
<td> </td>
@endif
@if(count($payment)>0)
                     <td>PKR {{number_format ($payment[0]->payment)  }}</td>
                     @else
<td> </td>
@endif
<td>{{$results->balance}}</td>
                      <td>{{$results->created_at}}</td>
                        <td><a href="{{url('/')}}/admin/home/view/purchase/return/detail/{{$results->pk_id}}" class="bordersets">view</a>  
                        
                        @if(empty($payment))
                        <a href="{{url('/')}}/admin/home/create/purchase/return/payment/{{$results->pk_id}}" class="bordersets">Create Payment</a>
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
      </div>
    </div>
  </div>
  <!-- /page content --> 
  
 
 @endsection