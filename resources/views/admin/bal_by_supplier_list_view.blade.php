@extends('admin.layout.appadmin')
@section('content') 

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>View Creditor/Debitor</h2>
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
              <a class="btn pumpplusbtn dropdown-toggle" href="{{URL('/')}}/admin/home/add/balance/supplier"><span class="glyphicon glyphicon-plus"></span> </a>
            </div>
          </div>
        </div>
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
                <th>Supplier Name</th>
                <th>Current Balance</th>
                <!-- <th>Action</th> -->
              </tr>
            </thead>
            <tbody>
             @if($result>0)
              @foreach($result as $results)
              <tr> 
                <td>{{$results->supplier_name}}</td>
                <td>PKR {{number_format($results->current_balance)}}</td>
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