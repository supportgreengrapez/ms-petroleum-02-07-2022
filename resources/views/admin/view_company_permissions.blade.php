@extends('admin.layout.appadmin')
@section('content')
    
    <!-- page content -->
    <div class="right_col" role="main">
       <div class="row">
       <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="viewadminhead">
            <h2>View Company</h2>
          </div>
        </div>
          <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="plusbutton">
            <a href="create-admin.html" class="btn pumpplusbtn" title="Add field"><span class="glyphicon glyphicon-plus"></span></a>
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
                      <th>ID</th>
                      <th>Username</th>
                      <th> Companies</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($result)>0)
            @foreach($result as $results)
                    <tr>
                      <td>{{$results->pk_id}}</td>
                      <td>{{$results->username}}</td>
                      <td>{{$results->company}}</td>
                      <td><a href="" class="bordersets">View</a> </td>
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