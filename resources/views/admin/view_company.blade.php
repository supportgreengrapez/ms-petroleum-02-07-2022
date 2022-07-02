
    @extends('admin.layout.appadmin')
@section('content')
    
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="viewadminhead">
            <h2>View Company</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 col-lg-offset-2">
          <div class="Adminprofilebox">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="viewexpenselines">
                  <h4>Company Name</h4>
                  <p>{{$result[0]->company_name}}</p>
                </div>
              </div>

              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="viewexpenselines">
                  <h4>Employee Name</h4>
                  <p>{{$result[0]->fname}}</p>
                </div>
              </div>

              
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="viewexpenselines">
                  <h4>Industry</h4>
                  <p>{{$result[0]->industry}}</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="viewexpenselines">
                  <h4>Phone</h4>
                  <p>{{$result[0]->phone}}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="viewexpenselines">
                  <h4>Bussiness Address</h4>
                  <p>{{$result[0]->address}}</p>
                </div>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="viewexpenselines">
                  <h4>Bussiness Type</h4>
                  <p>{{$result[0]->bussiness_type}}</p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-lg-offset-8">
                <div class="viewadminbtn">
                  <a href="{{URL('/')}}/admin/edit/company/view/{{$result[0]->pk_id}}" class="btnedit">Edit</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    @endsection