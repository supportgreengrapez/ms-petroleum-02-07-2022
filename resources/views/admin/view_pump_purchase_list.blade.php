@extends('admin.layout.appadmin')
@section('content') 
<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>View Purchases / By Supplier</h2>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="machinename">
        <h4>{{$pump[0]->pump_name}}</h4>
        <h4>{{$pump[0]->pump_address}}</h4>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Supplier Name : <span>{{$result1[0]->supplier_name}}</span></h4>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Balance : <span>PKR {{number_format($result1[0]->opening_balance)}}</span></h4>
        <p></p>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Total Purchases : <span>{{number_format($total_amount[0]->{'SUM(total_amount)'})}}</span></h4>
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
                <th>P-Invoice</th>
                <th>STI#</th>
                <th>Purchase Type</th>
                <th>Company Name</th>
                <th>Vehicle No</th>
                <th>Bills #</th>
                <th>Account Type</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
            
            @if(count($result)>0)
            @foreach($result as $results)
            <tr>
              <td>{{$results->pk_id}}</td>
              <td>{{$results->sti}}</td>
              @if($results->pump_purchase == "tax")
              <td>Tax</td>
              @else
              <td>Normal</td>
              @endif
              <td>{{$results->company_name}}</td>
              <td>{{$results->vehicle_no}}</td>
              <td>001</td>
              <td>{{$results->account_type}}</td>
              <td>PKR {{number_format($results->total_amount)}}</td>
              <td>{{$results->created_at}}</td>
              <td><a href="{{url('/')}}/admin/home/view/pump/purchases/detail/{{$results->pk_id}}/{{$results->pump_purchase}}" class="bordersets">view</a> &nbsp;&nbsp;&nbsp;<a href="#"><i class="fa fa-print sizecol"></i></a></td>
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