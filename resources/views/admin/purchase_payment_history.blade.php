@extends('admin.layout.appadmin')
@section('content') 
<!-- page content -->
<div class="right_col" role="main">
 
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>View Purchase Payment History</h2>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Supplier Name :</h4>
        <p> {{($s_name)}}</p>
      </div>
    </div>
    
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Total Paid :</h4>
        <p>PKR {{number_format($summ)}}</p>
      </div>
    </div>
   
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Original Amount :</h4>
        <p>PKR {{number_format($result[0]->org_amount)}}</p>
      </div>
    </div>
   

  </div>



  @if($errors->any())
    <div class="alert alert-success"> <strong></strong> {{$errors->first()}} </div>
    @endif
    
  <div class="clearfix"></div>
  <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
        <div class="x_content">
          <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead class="headbgcolor">
              <tr>
                <th>Payment Id </th>
                
                
              
               
               
               
                <th>Purchase Invoice ID</th>
               <th> Description</th>
                <th> Partial</th>
                <th>Remain</th>
                 <th>Date</th>
              </tr>
            </thead>
            <tbody>
            
            @if(count($result)>0)
            @foreach($result as $results)
            
            <tr>
              <td>{{$results->pk_id}}</td>
             
              
            
            
             
              <td>{{$results->purchase_id}}</td>
             <td>{{$results->description}}</td>
              <td> PKR {{number_format($results->partial)}}</td>
              <td> PKR {{number_format($results->remain)}}</td>
 <td>{{$results->date}}</td>
             
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