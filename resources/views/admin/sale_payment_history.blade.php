@extends('admin.layout.appadmin')
@section('content') 
<!-- page content -->
<div class="right_col" role="main">
 
<div class="row">
    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
      <div class="viewadminhead">
        <h2>View Sale Payment History</h2>
      </div>
    </div>
  </div>
  <div class="row">
      
      
       <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Customer Name :</h4>
        <p>{{($c_name)}}</p>
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
        
        <p>PKR {{number_format($org_amount)}}</p>
        
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
                <th>Payment ID</th>
                
                
               
               
               
               
                <th>Sale Invoice ID</th>
              <th> Description</th>
                <th> Partial</th>
                <th>Remain</th>
                 <th>Date</th>
                 <th>Action</th>
                
              </tr>
            </thead>
            <tbody>
            
            @if(count($result)>0)
            @foreach($result as $results)
            
            <tr>
              <td>{{$results->pk_id}}</td>
             
              
            
              <td>{{$results->sale_id}}</td>
             
              <td>{{$results->description}}</td>
              <td>
                  {{number_format($results->partial)}}
                  </td>
              <td>{{number_format($results->remain)}}</td>
 <td>{{$results->date}}</td>
              <td> <a href="{{URL('/')}}/admin/home/edit/invoice/payment/{{$results->sale_id}}/{{$results->pk_id}}" class="bordersets">Edit</a></td>
         </tr>
       
            @endforeach
            @endif
            
            
             <tr>
                <th>Sale ID</th>
                
                
              
               
                <th>Date</th>
               
                <th>Sale Type</th>
              
                <th> Returned Amount</th>
                <th>Total Amount</th>
                
              </tr>
            </thead>
            <tbody>
            
            @if(count($result2)>0)
            @foreach($result2 as $results)
            
            <tr>
              <td>{{$results->pk_id}}</td>
             
              
            
            
              <td>{{$results->created_at}}</td>
              <td>{{$results->sale_type}}</td>
              <td>{{$results->return_amount}}</td>
              <td>{{$results->total_amount}}</td>

             
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