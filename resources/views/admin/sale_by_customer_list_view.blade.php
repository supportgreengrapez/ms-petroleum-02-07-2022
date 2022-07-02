@extends('admin.layout.appadmin') @section('content')

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
            <div class="viewadminhead">
                <h2>View Sale</h2>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="machinename"> </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="dropbtnstyle">
                        <div class="dropdown">
                            <div class="btn pumpplusbtn dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span> </div>
                            <ul class="dropdown-menu">
                                <!-- <li><a href="{{URL('/')}}/admin/home/add/sale">Add Normal Entry</a></li> -->

                                <li><a href="{{URL('/')}}/admin/home/add/sale/invioce/view">Add Invoice</a></li>
                                <li><a href="{{URL('/')}}/admin/home/add/sale/tax">Add Tax Applicable</a></li>
                                <li><a href="{{URL('/')}}/admin/home/add/sale/reciept/view">Sale Reciept</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="dropbtnstyle">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"> Select Field <span class="caret"></span> </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{URL('/')}}/admin/home/view/sale/by/customer">View sale</a></li>
                                <li><a href="{{URL('/')}}/admin/home/view/all/sales">View all sales </a></li>
                                <li><a href="{{URL('/')}}/admin/home/view/sale/return/by/customer">View sale Return</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <form method="post" action="{{url('/')}}/admin/home/search/sale" class="login-form" enctype="multipart/form-data">
            {{ csrf_field() }}
            <label>
        <input type="hidden" name="date" value="1">
      </label>
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
        <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
            <div class="Totalpurchasehead">
                <h4>Total Sale : <span>PKR {{number_format($total_amount[0]->{'SUM(total_amount)'})}}</span></h4>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <table id="myTable" class="table table-striped table-bordered display nowrap" cellspacing="0" width="100%">
                        <thead class="headbgcolor">
                            <tr>
                                <th>Customer Name</th>
                                <th>Total Amount</th>
                                <th>Remaining Amount</th>
                                <th>Current Balance</th>
                                <th>Sale Invoices </th>
                            </tr>
                        </thead>
                        <tbody>

                            @if($result>0) @foreach($result as $results) 
                            @php
                            $invoice = DB::select("select* from sale where customer_name = '$results->pk_id' and (sale = 'invoice' or sale = 'tax')  and status ='active'");
                            $Receipt = DB::select("select* from sale where customer_name = '$results->pk_id' and sale = 'Receipt'  ");
                            
                            $total_q1 = DB::select("select SUM(quantity) from detail_sale,sale where detail_sale.sale_id = sale.pk_id and sale.customer_name = '$results->pk_id'");
                            $total_q2 = DB::select("select SUM(quantity) from detail_tax_sale,sale where detail_tax_sale.sale_id = sale.pk_id and sale.customer_name = '$results->pk_id' ");
                            
                            $total_sale = $total_q1[0]->{'SUM(quantity)'} + $total_q2[0]->{'SUM(quantity)'};
                            
                            $total_sale = DB::select("select SUM(total_amount)  from sale where customer_name = '$results->pk_id' ");
                            
                            $current_balance = DB::select("select SUM(balance)  from sale where customer_name = '$results->pk_id' and status ='active' ");
                            $invoice_inactive = DB::select("select* from sale where customer_name = '$results->pk_id' and (sale = 'invoice' or sale = 'tax')  and status ='inactive'");
                            $invoice_paid = DB::select("select* from sale where customer_name = '$results->pk_id' and (sale = 'invoice' or sale = 'tax')  and status ='active' and balance='0'");
                            
                            $invoice_open = DB::select("select* from sale where customer_name = '$results->pk_id' and (sale = 'invoice' or sale = 'tax')  and status ='active' and paid_amount='0'");
                            
                            $invoice_partial = DB::select("select* from sale where customer_name = '$results->pk_id' and (sale = 'invoice' or sale = 'tax')  and status ='active' and paid_amount>0 ");
                            
                            
                            
                            
                            
                            if(count($invoice_partial)>0)
                            
                            $neww= $invoice_partial[0]->paid_amount >0 && $invoice_partial[0]->paid_amount < $invoice_partial[0]->total_amount;
                            
                            
                            else
                            
                            $neww="0";
                            
                            @endphp
                            

                            <tr>
                                <!--<td>{{$results->main_customer}}::{{$results->customer_name}}</td>-->
                                <td>{{$results->customer_name}}</td>
                                <td>PKR {{number_format($total_sale[0]->{'SUM(total_amount)'})}}</td>
                                <td>PKR {{number_format($current_balance[0]->{'SUM(balance)'})}}</td>
                                <td>PKR {{number_format($results->current_balance)}}</td>
                                <td> @if(count($invoice)>0)
                                    <!--<a href="{{url('/')}}/admin/home/view/sale/{{$results->pk_id}}">{{count($invoice)}} Active</a> -->
                                    <!--/-->
                                    <a href="{{url('/')}}/admin/home/view/open/sale/{{$results->pk_id}}">{{count($invoice_open)}} Open </a> |
                                    <a href="{{url('/')}}/admin/home/view/partial/sale/{{$results->pk_id}}">{{($neww)}} Partial</a> |
                                    <a href="{{url('/')}}/admin/home/view/paid/sale/{{$results->pk_id}}">{{count($invoice_paid)}} Paid </a> |
                                    <a href="{{url('/')}}/admin/home/view/inactive/sale/{{$results->pk_id}}">{{count($invoice_inactive)}} InActive </a> @endif <br> @if(count($Receipt)>0) <a href="{{url('/')}}/admin/home/view/sale/receipt/list/{{$results->pk_id}}"> {{count($Receipt)}} Receipt</a>                                        @endif </td>
                                
                            </tr>
                            @endforeach @endif
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->
@endsection