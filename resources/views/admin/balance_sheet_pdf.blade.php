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
        <h2>Balance Sheet</h2>
      </div>
    </div>
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
         
          <thead class="headbgcolor2">
            <tr>
              <th></th>
              <th style="text-align:right;">Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><strong>Assests</strong>
                <table cellspacing="0" width="100%" style="margin-bottom :0px;">
                  <tbody>
                    <tr>
                      <td width="100%" style="padding : 7px 10px 0px;">Current Assests
                        <table cellspacing="0" width="100%" style="margin-bottom : 0px;">
                          <tbody>
                            <tr>
                              <td width="100%" style="padding : 7px 10px 0px;">Accounts Receiveable
                                <table cellspacing="0" width="100%" style="margin-bottom : 0px;">
                                  <tbody>
                                    <tr>
                                      <td width="100%" style="padding : 7px 10px 5px;">Accounts Receiveable(A/R)</td>
                                    </tr>
                                    <tr class="headbgcolor2">
                                      <td><strong>Total Accounts receivable</strong></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                            <tr>
                              <td style="padding:0px 10px;">Cash and cash equivalents</td>
                            </tr>
                            <!-- <tr>
                              <td>HBL</td>
                            </tr>
                            <tr>
                              <td>Undeposited Funds</td>
                            </tr> -->
                            <tr  class="headbgcolor2">
                              <td><strong>Total Current Assets</strong></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
              <td style="text-align:right;"><table cellspacing="0" width="100%" style="margin-bottom = 0px;">
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td style="text-align:right;">PKR {{number_format($AR)}}</td>
                    </tr>
                    <tr  class="headbgcolor2">
                      <td><strong></strong></td>
                      <td style="text-align:right;"><strong>PKR {{number_format($AR)}} </strong></td>
                    </tr>
                    <tr>
                      <td><strong></strong></td>
                      <td style="text-align:right;padding :0px 10px 5px;">PKR {{number_format($asset)}}</td>
                    </tr>
                    <!-- <tr>
                      <td><strong></strong></td>
                      <td style="text-align:right;padding :07px 10px 5px;">PKR 4545</td>
                    </tr>
                    <tr>
                      <td><strong></strong></td>
                      <td style="text-align:right;padding :10px 10px 5px;">PKR 4545</td>
                    </tr> -->
                    <tr class="headbgcolor2">
                      <td><strong></strong></td>
                      <td style="text-align:right;"><strong>PKR {{number_format($asset + $AR)}}</strong></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td><strong>Total Assets</strong></td>
              <td style="text-align:right;"><strong>PKR {{number_format($asset + $AR)}}</strong></td>
            </tr>
            
            <tr>
              <td><strong>Liabilities </strong>
                <table cellspacing="0" width="100%" style="margin-bottom :0px;">
                  <tbody>
                    <tr>
                      <td width="100%" style="padding : 7px 10px 0px;">Current Assests
                        <table cellspacing="0" width="100%" style="margin-bottom : 0px;">
                          <tbody>
                            <tr>
                              <td width="100%" style="padding : 7px 10px 0px;">Accounts Payable
                                <table cellspacing="0" width="100%" style="margin-bottom : 0px;">
                                  <tbody>
                                    <tr>
                                      <td width="100%" style="padding : 7px 10px 5px;">Accounts Payable(A/P)</td>
                                    </tr>
                                    <tr class="headbgcolor2">
                                      <td><strong>Total Accounts Payable</strong></td>
                                    </tr>
                                  </tbody>
                                </table></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
              <td style="text-align:right;"><table cellspacing="0" width="100%" style="margin-bottom = 0px;">
                  <tbody>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td style="text-align:right;">PKR {{number_format($AP)}}</td>
                    </tr>
                    <tr  class="headbgcolor2">
                      <td><strong></strong></td>
                      <td style="text-align:right;"><strong>PKR {{number_format($AP)}} </strong></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td><strong>Total Liabilities and Assets</strong></td>
              <td style="text-align:right;"><strong>PKR {{number_format(($asset + $AR)- $AP)}}</strong></td>
            </tr>
            
            <tr>
              <td><strong>Shareholder's equity</strong>
                <table cellspacing="0" width="100%" style="margin-bottom :0px;">
                  <tbody>
                    <tr>
                      <td width="100%" style="padding : 7px 10px 0px;">Shareholders' equity:
                        <table cellspacing="0" width="100%" style="margin-bottom : 0px;">
                          <tbody>
                            <tr>
                              <td width="100%" style="padding : 7px 10px 0px;">Net Income</td>
                            </tr>
                            <!-- <tr>
                              <td width="100%" style="padding : 7px 10px 0px;">Opening Balance Equity</td>
                            </tr> -->
                          </tbody>
                        </table></td>
                    </tr>
                    <tr>
                      <td width="100%" style="padding : 7px 10px 0px;">Owners Equity:
                        <table cellspacing="0" width="100%" style="margin-bottom : 0px;">
                          <tbody>
                            <tr>
                              <td width="100%" style="padding : 7px 10px 0px;">Owner's Drawing</td>
                            </tr>
                            <tr>
                              <td width="100%" style="padding : 7px 10px 0px;">Owner's Investment</td>
                            </tr>
                            <tr class="headbgcolor2">
                              <td width="100%" style="padding : 7px 10px 0px;"><strong>Total Owners Equity</strong></td>
                            <!-- </tr>
                            <tr class="headbgcolor2">
                              <td width="100%" style="padding : 7px 10px 0px;">Retained Earnings</td>
                            </tr> -->
                            <tr class="headbgcolor2">
                              <td width="100%" style="padding : 7px 10px 0px;"><strong>Total shareholders' equity</strong></td>
                            </tr>
                          </tbody>
                        </table></td>
                    </tr>
                  </tbody>
                </table></td>
              <td style="text-align:right;">
                  <table cellspacing="0" width="100%" style="margin-bottom = 0px;">
                  <tbody>
                       <tr>
                      <td></td>
                      <td style="text-align:right;"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td style="text-align:right;"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td style="text-align:right; padding : 23px 10px 0px;">PKR {{number_format($net_income)}}</td>
                    </tr>
                    <!-- <tr>
                      <td></td>
                      <td style="text-align:right;padding : 5px 10px 0px;">0</td>
                    </tr> -->
                    <tr>
                      <td></td>
                      <td style="text-align:right;padding : 5px 10px 0px;"></td>
                    </tr>
                    <tr>
                      <td></td>
                      <td style="text-align:right;padding : 15px 10px 0px;">0</td>
                    </tr>
                    <tr>
                      <td></td>
                      <td style="text-align:right;padding : 5px 10px 0px;">0</td>
                    </tr>
                    
                    <tr  class="headbgcolor2">
                      <td></td>
                      <td style="text-align:right;padding : 5px 10px 0px;"><strong>PKR {{number_format($net_income)}}</strong></td>
                    </tr>
                     
                     <!-- <tr  class="headbgcolor2">
                      <td></td>
                      <td style="text-align:right;padding : 5px 10px 0px;">PKR 5000</td>
                    </tr> -->
                      <tr  class="headbgcolor2">
                      <td></td>
                      <td style="text-align:right;padding : 5px 10px 0px;"><strong>PKR {{number_format($net_income)}}</strong></td>
                    </tr>
                  </tbody>
                </table></td>
            </tr>
            <tr>
              <td><strong>Total Equity</strong></td>
              <td style="text-align:right;"><strong>PKR {{number_format($net_income)}}</strong></td>
            </tr>
          </tbody>
          
        </table>
      </div>
    </div>
  </div>
</div>

</body>

</html>