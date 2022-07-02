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
        <table id="example1" class="table table-striped table-bordered display nowrap" width="100%">
         
         
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
              <td>000</td>
              @endif </tr>
               @if($bank>0)
          @foreach($bank as $results)
          <tr>
            <td>{{$results->account_name}}</td>
            <td>{{number_format($results->increase)}} </td>
            <td>000</td>
          </tr>
          @endforeach
          @endif
              
            <tr>
              <td>Account Reciveable</td>
              <td>{{number_format($lib_inc)}}</td>
              <td>{{number_format($lib_decrease)}}</td>
            </tr>
          @if($detail_purchase>0)
          <tr>
            <td>Account payable</td>
            <td>{{number_format($detail_purchase_sum_return)}}</td>
            <td>{{number_format($detail_purchase_sum)}}</td>
          </tr>
          @endif
          
          
          @if($expense>0)
          
          @foreach($expense as $results)
          <tr>
            <td>{{$results->account_name}}</td>
            <td>{{number_format($expense_inc)}}</td>
            <td>000</td>
          </tr>
          @endforeach
          @endif
          
          <!--@if($Capital>0)-->
          <!--@foreach($Capital as $results)-->
          <!--<tr>-->
          <!--  <td>{{$results->account_name}}</td>-->
          <!--  <td>000</td>-->
          <!--  <td>{{number_format($Capital_inc)}}</td>-->
          <!--</tr>-->
          <!--@endforeach-->
          <!--@endif-->
          
          
          <!--@if($Capital_sub>0)-->
          <!--@foreach($Capital_sub as $results)-->
          <!--<tr>-->
          <!--  <td>{{$results->sub_account}}</td>-->
          <!--  <td>000</td>-->
          <!--  <td>{{number_format($Capital_sub_inc)}}</td>-->
          <!--</tr>-->
          <!--@endforeach-->
          <!--@endif-->
          
          @if($Capital_sub_decrease>0)
          @foreach($Capital_sub_decrease as $results)
          <tr>
            <td>{{$results->sub_account}}</td>
            <td>{{number_format($Capital_sub_dec)}}</td>
            <td>000</td>
          </tr>
          @endforeach
          @endif
          
          @if($detail_purchase>0)
          @foreach($detail_purchase as $results)
          <tr>
            <td>{{$results->item_name}}</td>
            <td>{{number_format($results->amount)}} </td>
            <td>000</td>
          </tr>
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
              <td><h5>PKR {{number_format(($total_amount2)+($expense_inc) +($sale_decrease)+($bankk)
                
                +($detail_purchase_sum)+($detail_purchase_sum_return)+($lib_inc)+($Capital_sub_dec))}}</h5></td>
              <td><h5>PKR {{number_format(($total_amount)+($lib_decrease)+($detail_purchase_sum_return)+($pur_inc)+($detail_purchase_sum)+($Capital_inc)+($total_amount3)+($Capital_sub_inc))}}</h5></td>
          </tr>
            </tbody>
          
        </table>
      </div>
    </div>
  </div>
</div>
</body>

</html>