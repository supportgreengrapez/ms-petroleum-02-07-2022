@extends('admin.layout.appadmin')
    @section('content') 

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>Trial Balance</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 col-lg-offset-2">
      <div class="Adminprofilebox">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="accountpayablehead">
              <h4>Trial Balance</h4>
              <!-- <p>January 1-Faburary 10</p> --> 
            </div>
          </div>
        </div>
        <table id="example" class="table table-striped table-bordered display nowrap" width="100%">
          <a href="{{ url('/admin/home/view/trial/balance/print') }}" class="amountbtn btt btn">Print Preview</a>
          <a href="{{ url('/admin/home/view/trial/balance/pdf') }}" class="amountbtn btn btn">PDF</a>
        
         
          <thead class="headbgcolor2">
            <tr>
              <th></th>
              <th>Debit</th>
              <th>Credit </th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td >Sale </td>
              <td>{{number_format($sale_decrease)}}</td>
              <td>{{number_format($sale_inc)}}</td>
            </tr>
            <tr>
              <td>Cash in Hand</td>
              <td>{{number_format($coh_inc)}}</td>
              @if(($coh_dec)>0)
              <td>{{number_format($coh_dec)}}</td>
              @else
              <td>0</td>
              @endif </tr>
               @if($bank>0)
          @foreach($bank as $results)
          <tr>
            <td>{{$results->account_name}}</td>
            <td>{{number_format($results->increase)}} </td>
            <td>{{number_format($results->decrease)}}</td>
          </tr>
          @endforeach
          @endif
              
              @if($customer>0)
          @foreach($customer as $results)
            <tr>
              <td>{{($results->customer_name)}}</td>
              @if(($results->current_balance)>0)
              <td>{{($results->current_balance)}}</td>
              <td>0</td>
              @else
              <td>0</td>
               <td>{{(-$results->current_balance)}}</td>
              @endif
               @endforeach
          @endif
            </tr>
          <!--@if($detail_purchase>0)-->
          <!--<tr>-->
          <!--  <td>Account payable</td>-->
          <!--  <td>{{number_format($detail_purchase_sum_return)}}</td>-->
          <!--  <td>{{number_format($detail_purchase_sum)}}</td>-->
          <!--</tr>-->
          <!--@endif-->
          
          
            @if($detail_purchase>0)
          
          @foreach($detail_purchase as $results)
          <tr>
            <td>  <a href="{{ url('/admin/home/view/trial/balance/detail') }}" >{{$results->account_name}}</a></td>
            <td> <a href="{{ url('/admin/home/view/trial/balance/detail') }}" >{{number_format($purchase_inc)}}</a></td>
            <td>0</td>
          </tr>
          @endforeach
          @endif
          
          <!--@if($expense>0)-->
          
          <!--@foreach($expense as $results)-->
          <!--<tr>-->
          <!--  <td>{{$results->account_name}}</td>-->
            
          <!--  <td>{{number_format($results->increase)}} </td>-->
          <!--  <td>{{number_format($results->decrease)}}</td>-->
          <!--</tr>-->
          <!--@endforeach-->
          <!--@endif-->
          
          
        @if($expense>0)
          @foreach($expense as $results)
          <tr>
              @if(!empty($results->account_name))
                <td><strong>{{$results->account_name}}</strong></td>
                @endif
              @if(!empty($results->sub_account))
              <td><div style="margin-left:10px;">{{$results->sub_account}}</div></td>
              @endif
            <td>{{number_format($results->decrease)}}</td>
            <td>{{number_format($results->increase)}} </td>
    
          </tr>
          @endforeach
          @endif

          
          
          <!--@if($Capital>0)-->
          <!--@foreach($Capital as $results)-->
          <!--<tr>-->
          <!--  <td>{{$results->account_name}}</td>-->
          <!--  <td>000</td>-->
          <!--</tr>-->
          <!--@endforeach-->
          <!--@endif-->
          
          @if($Capital>0)
          @foreach($Capital as $results)
          <tr>
              @if(!empty($results->account_name))
                <td><strong>{{$results->account_name}}</strong></td>
                @endif
              @if(!empty($results->sub_account))
              <td><div style="margin-left:10px;">{{$results->sub_account}}</div></td>
              @endif
            
            <td>{{number_format($results->decrease)}}</td>
            <td>{{number_format($results->increase)}} </td>
          </tr>
          @endforeach
          @endif
          
          
          <!--@if($Capital_sub>0)-->
          <!--@foreach($Capital_sub as $results)-->
          <!--<tr>-->
          <!--  <td>{{$results->sub_account}}</td>-->
          <!--  <td>000</td>-->
          <!--  <td>{{number_format($Capital_sub_inc)}}</td>-->
          <!--</tr>-->
          <!--@endforeach-->
          <!--@endif-->
          
          <!--@if($Capital_sub_decrease>0)-->
          <!--@foreach($Capital_sub_decrease as $results)-->
          <!--<tr>-->
          <!--  <td>{{$results->sub_account}}</td>-->
          <!--  <td>{{number_format($Capital_sub_dec)}}</td>-->
          <!--  <td>000</td>-->
          <!--</tr>-->
          <!--@endforeach-->
          <!--@endif-->
          
      
          
          
              
          
           @if($supplier>0)
          @foreach($supplier as $results)
            <tr>
              <td>{{($results->supplier_name)}}</td>
              @if(($results->current_balance)>0)
               <td>0</td>
              <td>{{($results->current_balance)}}</td>
             
              @else
              
               <td>{{(-$results->current_balance)}}</td>
               <td>0</td>
              @endif
               @endforeach
          @endif
          
          
          
          @if($detail_purchase_tax>0)
          @foreach($detail_purchase_tax as $results)
          <tr>
            <td>{{$results->item_name}}</td>
            <td>{{number_format($results->amount)}} </td>
            <td>000</td>
          </tr>
          @endforeach
          @endif
          
          
          @if($detail_purchase_return>0)
          @foreach($detail_purchase_return as $results)
          <tr>
            <td>{{$results->item_name}}</td>
            <td>000</td>
            <td>{{number_format($results->amount)}}</td>
          </tr>
          @endforeach
          @endif
          
          
          
          
          @if($detail_purchase_return_tax>0)
          @foreach($detail_purchase_return_tax as $results)
          <tr>
            <td>{{$results->item_name}}</td>
            <td>000</td>
            <td>{{number_format($results->amount)}}</td>
          </tr>
          @endforeach
          @endif
          <tr>
              
              <td><h3>Total</h3></td>
              <td><h5>PKR {{number_format(($total_amount2)+($expense_inc) +($sale_decrease)+($increase)+($exp_decrease)
                
                +($detail_purchase_sum_return)+($Capital_sub_dec)+($purchase_inc)+($current_balance1)+ (-$current_balance2_purchase)
                
               
                
                )}}
               
                </h5></td>
                
              <td><h5>PKR {{number_format(($decrease)+($total_amount)+($detail_purchase_sum_return)+
              ($exp_increase)+($capital_increase)+($total_amount3)+(-$current_balance2)+ ($current_balance1_purchase)
              
              
               
              
              )}}</h5></td>
          </tr>
            </tbody>
          
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /page content --> 

@endsection