@extends('admin.layout.appadmin')
@section('content') 

<!-- page content -->
<div class="right_col" role="main">
  <div class="row">
  
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div class="Totalpurchasehead">
        <h4>Total Purchase : <span>PKR {{number_format($total)}}</span></h4>
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
                   <th>Purchase ID </th>
              
                  <th>Item Name</th>
                <th>Amount</th>
               
              </tr>
            </thead>
            <tbody>
            
            @if(count($result1)>0)
            @foreach($result1 as $results)
            @php
           
 
           $item = DB::select("select* from detail_purchase where purchase_id = '$results->pk_id'   ");
        
         
             @endphp
            
         
            <tr>
                 <td>{{$results->purchase_id}}</td>
              
             
              <td>
                 
              {{$results->item_name}}
              
              
              </td>
             <td> {{$results->amount}}</td>
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