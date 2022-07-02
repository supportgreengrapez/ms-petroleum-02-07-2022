@extends('admin.layout.appadmin')
    @section('content') 
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>Account Payable</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <!-- <form method="post" action = "" class="login-form" enctype="multipart/form-data">
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
    </form> -->
  </div>
  <div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
      <div class="Adminprofilebox">
        <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="accountpayablehead">
                
              <h4>Company Name</h4>
              <h4>Account Payable Report</h4>
              <p>January 1-Faburary 10</p>
            </div>
          </div>
        </div>
        <table id="example" class="table" cellspacing="0" width="100%">
            
            <a href="{{ url('/admin/home/view/account/payable/print') }}" class="amountbtn btt btn">Print Preview</a>
          <a href="{{ url('/admin/home/view/account/payable/pdf/download/hd/kj')}}" class="amountbtn btn btn">PDFF</a>
         
          <thead class="headbgcolor2">
          <tr>
              <th></th>
             
              <th>1-30</th>
              <th>31-60</th>
              <th>61-90</th>
              <th>91 and over</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
          @if($supplier>0)
          @foreach($supplier as $results)
          @php

$supplier_name=$results->pk_id;

$result = DB::select("select SUM(total_amount) from purchase where supplier_name = '$supplier_name' ");
@endphp 

<tr>
            <td>
            
            <a  href="{{url('/')}}/admin/home/view/purchase/by/supplier/name/deatiled/{{$results->pk_id}}"><strong>{{$results->supplier_name}}</strong></a>
          
           </td>
            <!-- 1--30 -->
            @if(  number_format($result[0]->{'SUM(total_amount)'}) <= '30000' )
            <td>PKR {{number_format($result[0]->{'SUM(total_amount)'})}}</td>
            @else
            <td>00</td>
            @endif
            <!-- 31---60 -->
            @if(($result[0]->{'SUM(total_amount)'}) >='30000' && ($result[0]->{'SUM(total_amount)'})  <= "60000" )
            <td>PKR {{number_format($result[0]->{'SUM(total_amount)'})}}</td>
            @else
            <td>00</td>
            @endif


            @if( $result[0]->{'SUM(total_amount)'} >="60000" && $result[0]->{'SUM(total_amount)'} <= "90000" )
             <!-- 61--90 -->
             <td>PKR {{number_format($result[0]->{'SUM(total_amount)'})}}</td>
            @else
            <td>00</td>
            @endif
            <!-- 91----over -->
            @if($result[0]->{'SUM(total_amount)'} >="90000"  )
            <td>PKR {{number_format($result[0]->{'SUM(total_amount)'})}}</td>
            @else
            <td>00</td>
            @endif
             <!-- total -->
             <td>PKR {{number_format($result[0]->{'SUM(total_amount)'})}}</td>
            
          </tr>
          @endforeach
                  @endif
          <tr>
            <td><strong>Total</strong></td>
          @if(count($result3)>0)
           <td>  PKR {{number_format($result3[0]->{'SUM(total_amount)'})}}   </td>
@else
<td>00</td>
@endif

@if(count($result4)>0)
           <td>  PKR {{number_format($result4[0]->{'SUM(total_amount)'})}}   </td>
@else
<td>00</td>
@endif
            
@if(count($result5)>0)
           <td>  PKR {{number_format($result5[0]->{'SUM(total_amount)'})}}   </td>
@else
<td>00</td>
@endif 

@if(count($result6)>0)
           <td>  PKR {{number_format($result6[0]->{'SUM(total_amount)'})}}   </td>
@else
<td>00</td>
@endif 

@if($total>0)
         
           
          <td>PKR {{number_format($total[0]->{'SUM(total_amount)'})}} </td>
           
                  @endif
          </tr>
            </tbody>
          
        </table>
      </div>
    </div>
  </div>
</div>
@endsection