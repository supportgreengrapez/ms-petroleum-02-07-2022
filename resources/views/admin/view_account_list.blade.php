@extends('admin.layout.appadmin')
@section('content') 

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>View Accounts</h2>
      </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <!--<div class="plusbutton"> <a href="{{URL('/')}}/admin/home/add/account" class="btn pumpplusbtn" title="Add field"><span class="glyphicon glyphicon-plus"></span></a> </div>-->
    
    <div class="dropbtnstyle">
            <div class="dropdown">
              <div class="btn pumpplusbtn dropdown-toggle" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-plus"></span> </div>
              <ul class="dropdown-menu">
                <!-- <li><a href="{{URL('/')}}/admin/home/add/sale">Add Normal Entry</a></li> -->
                
                <li><a href="{{URL('/')}}/admin/home/add/account">Add Account</a></li>
                <!--<li><a href="{{URL('/')}}/admin/home/add/test">Add</a></li>-->
              </ul>
            </div>
          </div>
    </div>
  </div>
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <form method="post" action = "{{url('/')}}/admin/home/search/account" class="login-form" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="row">
          <div class="col-lg-2">
            <div class="form-group">
              <label>
                <input type="checkbox" name="date" value="1">
                Date</label>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="form-group">
              <label>From</label>
              <input type="datetime-local" name="date_from" class="form-control">
            </div>
          </div>
          <div class="col-lg-5">
            <div class="form-group">
              <label>To:</label>
              <input type="datetime-local" name="date_to" class="form-control">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-2">
            <div class="totalamountp">
              <button type="submit" class="amountbtn btn">Filter</button>
            </div>
          </div>
        </div>
      </form>
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
                    <th>Nature of Account</th>
                <th>Account Type</th>
                <th>Account Name</th>
                <!-- <th>Sub Account</th> -->
                <th>Description</th>
                <th>Balance</th>
                <th>Date</th>
                <th>View</th>
              </tr>
            </thead>
            <tbody>
            
            @if(count($result)>0)
         
            @foreach($result as $results)
            <tr>
                 <td>{{$results->nature_of_account}}</td>
              <td>{{$results->account_type}}</td>
              <td> {{$results->account_name}}
                <li style="margin-left:2rem;list-style:none;"> {{$results->sub_account}} </li></td>
              <td>{{$results->description}}</td>
              <td>{{number_format($results->balance)}}</td>
              <td>{{$results->date}}</td>
              <td><a  href="{{url('/')}}/admin/home/view/account/detail/{{$results->pk_id}}/{{$results->sub_account}}" > view</a></td>
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