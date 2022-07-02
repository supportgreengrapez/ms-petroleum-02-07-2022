<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta, title, CSS, favicons, etc. -->
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="-1">
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Ms Petroleum">
<meta name="keywords" content="HTML,CSS,XML,JavaScript">
<meta name="author" content="Ms Petroleum">
<link rel="shortcut icon" href="{{url('/')}}/images/mslogo.png"/>
<title>Ms Petroleum</title>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<style>
#invoice{
    padding: 30px;
}

.invoice {
    position: relative;
    background-color: #FFF;
    min-height: 680px;
    padding: 15px
}

.invoice header {
    padding: 10px 0;
    margin-bottom: 20px;
    border-bottom: 1px solid #3989c6
}

.invoice .company-details {
    text-align: right
}

.invoice .company-details .name {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .contacts {
    margin-bottom: 20px
}

.invoice .invoice-to {
    text-align: left
}

.invoice .invoice-to .to {
    margin-top: 0;
    margin-bottom: 0
}

.invoice .invoice-details {
    text-align: right
}

.invoice .invoice-details .invoice-id {
    margin-top: 0;
    color: #3989c6
}

.invoice main {
    padding-bottom: 50px
}

.invoice main .thanks {
    margin-top: -100px;
    font-size: 2em;
    margin-bottom: 50px
}

.invoice main .notices {
    padding-left: 6px;
    border-left: 6px solid #3989c6
}

.invoice main .notices .notice {
    font-size: 1.2em
}

.invoice table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px
}

.invoice table td,.invoice table th {
    padding: 15px;
    background: #eee;
    border-bottom: 1px solid #fff
}

.invoice table th {
    white-space: nowrap;
    font-weight: 400;
    font-size: 16px
}

.invoice table td h3 {
    margin: 0;
    font-weight: 400;
    color: #3989c6;
    font-size: 1.2em
}

.invoice table .qty,.invoice table .total,.invoice table .unit {
    text-align: right;
    font-size: 1.2em
}

.invoice table .no {
    color: #fff;
    font-size: 1.6em;
    background: #3989c6
}

.invoice table .unit {
    background: #ddd
}

.invoice table .total {
    background: #3989c6;
    color: #fff
}

.invoice table tbody tr:last-child td {
    border: none
}

.invoice table tfoot td {
    background: 0 0;
    border-bottom: none;
    white-space: nowrap;
    text-align: right;
    padding: 10px 20px;
    font-size: 1.2em;
    border-top: 1px solid #aaa
}

.invoice table tfoot tr:first-child td {
    border-top: none
}

.invoice table tfoot tr:last-child td {
    color: #3989c6;
    font-size: 1.4em;
    border-top: 1px solid #3989c6
}

.invoice table tfoot tr td:first-child {
    border: none
}

.invoice footer {
    width: 100%;
    text-align: center;
    color: #777;
    border-top: 1px solid #aaa;
    padding: 8px 0
}

@media print {
    .invoice {
        font-size: 11px!important;
        overflow: hidden!important
    }

    .invoice footer {
        position: absolute;
        bottom: 10px;
        page-break-after: always
    }

    .invoice>div:last-child {
        page-break-before: always
    }
}
</style>
</head>
<body>

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
            
        <strong>{{$results->supplier_name}}</strong>
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

</body>

</html>