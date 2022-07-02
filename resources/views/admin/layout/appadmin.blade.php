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

<!-- Bootstrap -->
<link href="{{url('/')}}/css/bootstrap.min.css" rel="stylesheet">
<!-- iCheck -->
<link href="{{url('/')}}/css/green.css" rel="stylesheet">
<!-- Custom Theme Style -->
<link href="{{url('/')}}/css/custom.min.css" rel="stylesheet">
<!--Custom Styling-->
<link href="{{url('/')}}/css/style.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Datatables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.8/css/fixedHeader.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<!-- Font Awesome -->
<link href="{{url('/')}}/css/font-awesome.min.css" rel="stylesheet">
</head>
@php    
$inventory = DB::select("select* from inventory");
$pump_id = session()->get('pump_id');
$tank = DB::select("select* from tank where pump_id = '$pump_id'");

$expense = DB::select("select* from account where account_type='Expense'"); 
        $bank = DB::select("select* from account where account_type='Bank Account'"); 
@endphp
<body class="nav-md">
<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;"> <a href="{{url('/')}}/admin/home/" class="site_title"><i><img src="{{url('/')}}/images/mslogo.png" alt="logo"></i> </a> </div>
        <div class="clearfix"></div>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <ul class="nav side-menu">
              <li><a href="{{url('/')}}/admin/home/"><i class="fa fa-tachometer"></i>Dashboard</a> </li>
              <li><a><i class="fa fa-th-list"></i>Master Modules<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                @if(session('username')=="abdullahfarooqi26@gmail.com")
                  <li><a href="{{url('/')}}/admin/view/admin/list"><i class="fa fa-list-alt"></i>Admin Management</a></li>
                  @endif
                  @if(session('Admin_Management')==1)
                  <li><a href="{{url('/')}}/admin/home/company/list"><i class="fa fa-list-alt"></i>Companies</a></li>
                  <li><a href="{{url('/')}}/admin/create/permissions/view"><i class="fa fa-list-alt"></i>Create Permissions</a></li>
                  <li><a href="{{url('/')}}/admin/view/permissions/list"><i class="fa fa-list-alt"></i>View Permissions</a></li>
                 
                  @endif
                  @if(session('bank_deposit')==1)
                  <li><a href="{{url('/')}}/admin/home/add/bank/deposit/view"><i class="fa fa-list-alt"></i>Capital Investment</a></li>
                  @endif
                  @if(session('Item_Management')==1)
                  <!-- <li><a href="{{URL('/')}}/admin/home/view/product/type"><i class="fa fa-list-alt"></i>Item Management</a></li> -->
                  @endif
                  @if(session('Customer_Management')==1)
                  <li><a href="{{url('/')}}/admin/home/customer/list/view"><i class="fa fa-list-alt"></i>Customer Management</a></li>
                 
                  <!--<li><a href="{{url('/')}}/admin/home/view/employe/list"><i class="fa fa-list-alt"></i>Employe Management</a></li>-->
                  @endif
                   <li><a href="{{url('/')}}/admin/home/view/pump"><i class="fa fa-list-alt"></i>Pump Management</a></li> 
                  @if(session('Supplier_Management')==1)
                  <li><a href="{{url('/')}}/admin/home/supplier/list/view"><i class="fa fa-list-alt"></i>Supplier Management</a></li>
                  @endif
                  @if(session('Accounts_Management')==1)
                  <li><a href="{{url('/')}}/admin/home/view/account"><i class="fa fa-list-alt"></i>Charts of Account</a></li>
                  @endif
                </ul>
              </li>
              <li><a><i class="fa fa-th-list"></i>Transactions<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                @if(session('Pump_Management')==1)
                  <!-- <li><a href="view-pump-sale-table.html"><i class="fa fa-list-alt"></i>Pump Sale</a></li> -->
                  <!-- <li><a href="{{url('/')}}/admin/home/view/pump/for/purchase"><i class="fa fa-list-alt"></i>Pump Purchase</a></li> -->
                  @endif
                  @if(session('Sales_Management')==1)
                  <li><a href="{{url('/')}}/admin/home/view/sale/by/customer"><i class="fa fa-list-alt"></i>Sale Management</a></li>
                  
                  @endif
                  <li><a href="{{URL('/')}}/admin/home/view/bal/by/customer"><i class="fa fa-list-alt"></i>Customer Creditor/Debitor</a></li>
                  <li><a href="{{URL('/')}}/admin/home/view/bal/by/supplier"><i class="fa fa-list-alt"></i>Supplier Creditor/Debitor</a></li>
                  
                  <!--<li><a href="{{url('/')}}/admin/home/view/bal/by/customer"><i class="fa fa-list-alt"></i>Creditor</a></li>-->
                  
                  @if(session('Purchase_Management')==1)
                  <li><a href="{{url('/')}}/admin/home/view/purchase/by/supplier"><i class="fa fa-list-alt"></i>Purchase Management</a></li>
                  @endif
                  <!-- <li><a href="{{url('/')}}/admin/home/add/account/payable/view"><i class="fa fa-list-alt"></i>Account Payable (A/P)</a></li> -->
                 
                  <!-- <li><a href="{{url('/')}}/admin/home/add/account/receivable/view"><i class="fa fa-list-alt"></i>Account Receivable (A/R)</a></li> -->
                  @if(session('Expense_Management')==1)
                  <li><a href="{{url('/')}}/admin/home/view/expense"><i class="fa fa-list-alt"></i>Expense Management</a></li>
               
                  @endif
                  @if(session('transfer_money')==1)
                  <li><a href="{{url('/')}}/admin/home/view/transfer_of_money"><i class="fa fa-list-alt"></i>Transfer Of Money</a></li>
                  @endif
                </ul>
              </li>
              @if(session('Item_Management')==1)
              <li><a href="{{url('/')}}/admin/home/view/inventory"><i class="fa fa-th-list"></i>Inventory Management</a> </li>
              @endif
              <!-- <li><a href="view-zakat-table .html"><i class="fa fa-th-list"></i>Zakat Module</a></li> -->
              @if(session('Kachi_Parchi')==1)
              <!-- <li><a><i class="fa fa-th-list"></i>Kachi Parchi Module</a> </li> -->
              @endif
              <!-- <li><a><i class="fa fa-th-list"></i>Other Income</a> </li> -->
              <!-- <li><a><i class="fa fa-th-list"></i>Tanker</a> </li> -->
              <!-- <li><a><i class="fa fa-th-list"></i>Shortage Excess</a> </li> -->
              <!-- <li><a href="view-material-table.html"><i class="fa fa-th-list"></i>Purchase Module</a></li> -->
              @if(session('Report')==1)
              <li><a><i class="fa fa-th-list"></i>Reports<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="{{url('/')}}/admin/home/view/report"><i class="fa fa-list-alt"></i>Report</a></li>
                  
                  <li><a href="{{url('/')}}/admin/home/view/sale/reports/fg/fg/fg/fg"><i class="fa fa-list-alt"></i>Sale Reports</a></li>
                  <li><a href="{{url('/')}}/admin/home/view/purchase/by/item"><i class="fa fa-list-alt"></i>Purchase Report</a></li>
                </ul>
              </li>
              @endif
            </ul>
          </div>
        </div>
        <!-- /sidebar menu --> 
      </div>
    </div>
    
    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <nav>
          <div class="nav toggle"> <a id="menu_toggle"><i class="fa fa-bars"></i></a> </div>
          <ul class="nav navbar-nav navbar-right">
            <li class=""> <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false"> <img src="{{url('/')}}/images/mslogo.png" alt=""> {{session()->get('name')}}, {{session()->get('company')}} <span class=" fa fa-angle-down"></span> </a>
              <ul class="dropdown-menu dropdown-usermenu pull-right">
                <li><a href="javascript:;"> Profile</a></li>
                <li><a href="{{url('/')}}/admin/logout"><i class="fa fa-sign-out pull-right"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation --> 

@yield('content') 
  
  <!-- footer content -->
  <footer>
      <div class="footersets">
        <p>Copyright © 2018-2019 MS Petroleum. All rights reserved. </p>
        <br>
        <span>Powered By<a href="http://greengrapez.com/"> <img src="{{url('/')}}/images/icon.png" style="width:50px;" alt="po"></a></span> </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content --> 
  </div>
</div>

<!-- jQuery --> 
<script src="{{url('/')}}/js/jquery.min.js"></script> 
<!-- Bootstrap --> 
<script src="{{url('/')}}/js/bootstrap.min.js"></script> 
<!-- DateJS --> 
<script src="{{url('/')}}/js/build/date.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- bootstrap-progressbar --> 
<script src="{{url('/')}}/js/bootstrap-progressbar.min.js"></script> 
<!-- iCheck --> 
<script src="{{url('/')}}/js/icheck.min.js"></script> 

<script src="{{url('/')}}/js/datepicker.js"></script>

<!-- Custom Theme Scripts --> 
<script src="{{url('/')}}/js/custom.min.js"></script>

<!-- Datatables --> 
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script> 
<script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>'
<script src="{{url('/')}}/js/jquery.printPage.js"></script>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
        
        "paging":   false,
        "ordering": false,
        "info":     false,
        "bFilter": false,
        dom: 'Bfrtip',
        buttons: [
{ extend: 'excel', className: 'amountbtn' }
]
    } );
} );

$(document).ready( function () {
   $('#myTable').DataTable( {
    responsive: true
} );
} );
</script>
<script >
$(document).ready(function(){
$('.btb').printPage();
});
</script>
<script >
$(document).ready(function(){
$('.btt').printPage();
});
</script>

<script >
$(document).ready(function(){
$('.btz').printPage();
});
</script>



<script>


$(function() {
  $('#noa').change(function(){
    $('.cls').hide();
    $('#' + $(this).val()).show();
  });
});


$("#from").on('change',function(e){
        console.log(e);
        var cat_id =  e.target.value;
       
        $.get('{{URL('/')}}/ajax?cat_id='+ cat_id,function(data){
          console.log(data);
          $('#Subbb').empty();
          $('#Subbb').append('<span>PKR :</span>');
          $.each(data,function(create,subcatObj){
            $('#Subbb').append('<span>'+subcatObj.balance+'</span>');
        });
        });
    });
</script>


<script>
$("#to").on('change',function(e){
        console.log(e);
        var cat_id =  e.target.value;
        $.get('{{URL('/')}}/ajax?cat_id='+ cat_id,function(data){
          console.log(data);
          $('#subbb').empty();
          $('#subbb').append('<span>PKR :</span>');
          $.each(data,function(create,subcatObj){
            $('#subbb').append('<span>'+subcatObj.balance+'</span>');
        });
        });
    });
</script>



<script>

$("#expense").change(function () {
   var selected_option = $('#expense').val();
   if (selected_option == 'Expense') {
       $("#fnivel2").removeAttr('pk').hide();
   }
   else{
    $("#fnivel2").removeAttr('pk').show();
   }
})
</script>
<script>


$(document).ready(function(){
  var total = 0;var total2 = 0;var total3 = 0;var total4 = 0;var total5 = 0;var total6 = 0;var total7 = 0;var total8 = 0;var total9 = 0;var total10 = 0;
    var maxField = 10; //Input fields increment limitation
    var addButtonTax = $('.add_buttontax'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
   
   
    var fieldHTML = '<div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">SKU</label><input list="skus"  class="form-control sku'+x+'"  id="sku" name="sku[]"  autocomplete="off" required><datalist id="skus"><?php foreach($inventory as $results){?><option value="{{$results->sku}}"><?php } ?></datalist></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Item Name</label><input list="names" class="form-control name'+x+'"  id="name"  name="item_name[]" autocomplete="off" required><datalist id="names"><?php foreach($inventory as $results){?><option value="{{$results->name}}"><?php } ?></datalist></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Quantity</label><input type="text" name="quantity[]" class="form-control quantity'+x+'" id="quantity"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Rate</label><input type="text" class="form-control rate'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Percentage of tax</label><input type="text" class="form-control tax'+x+'" id="" name="tax[]" disabled></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Tax Amount</label><input type="text" class="form-control tax_amount'+x+'" id="" name="tax_amount[]" ></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Amount</label><input type="text" class="form-control amountts'+x+'" id="amountt" name="amount[]" ></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="plusbutton"><button type="button" class="remove_button plusbtn"><span class="glyphicon glyphicon-minus"></span></button></div></div></div>'; //New input field html
    
   
   
    var x = 1; //Initial field counter is 1
    $("#supplier").on('change',function(e){


var po_id =  e.target.value;
document.getElementById("invoice").innerHTML = po_id;

});

$("#customer").on('change',function(e){


var po_id =  e.target.value;
document.getElementById("invoice").innerHTML = po_id;

});

$("#nameitemm").on('change',function(e){


var po_id =  e.target.value;

$.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

  
    console.log(data);

  $.each(data,function(create,nameObj){
     
  $('#sku').val(nameObj.sku);

});

});

});


// $("#sku").on('change',function(e){


// var name_sku =  e.target.value;
// // return alert(name_sku);
// $.get('{{URL('/')}}/ajax-select-sku?name_sku='+ name_sku,function(data){

  
//     console.log(data);

//     $.each(data,function(create,nameObj){
     
//      $('#nameitemm').append('<option value ="'+nameObj.sku+'">'+nameObj.sku+'</option>');

// });

// });

// });









$("#name").on('change',function(e){


        var po_id =  e.target.value;
        
        $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){
        $('#sku').empty();

        $.each(data,function(create,subcatObj){

          $('#sku').append('<option value ="'+subcatObj.sku+'">'+subcatObj.sku+'</option>');
          $('#qty').append(''+subcatObj.stock+'');
      });



      });

});




$("#sku").on('change',function(e){


        var po_id =  e.target.value;
        $.get('{{URL('/')}}/ajax-select-sku?po_id='+ po_id,function(data){
        $('#name').empty();

        $.each(data,function(create,subcatObj){

          $('#name').append('<option value ="'+subcatObj.name+'">'+subcatObj.name+'</option>');
           $('#qty').append(''+subcatObj.stock+'').NumberFormat('en-IN', { maximumSignificantDigits: 3 }).format(number);
      });



      });

});


// $("#sku").on('change',function(e){

// console.log(e);

// var po_id =  e.target.value;

// $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

  
//     console.log(data);

//   $.each(data,function(create,nameObj){
     
//   $('#name').val(nameObj.name);

// });

// });

// });



// $("#sku").on('change',function(e){


// var po_id =  e.target.value;

// $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

  
//     console.log(data);

//   $.each(data,function(create,nameObj){
     
//   $('#sku').val(nameObj.sku);

// });

// });

// });




$("#tax,#quantitys,#rates").on('change',function(e){
  var rate = parseInt( document.getElementById("rates").value )
  var quantity = parseInt( document.getElementById("quantitys").value )
  var tax = parseInt(document.getElementById("tax").value)
  var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('#tax_amount').val(tax_amount);
 
  var total_amount = amount + tax_amount;
  $('#amounts').val(total_amount);  
  total = 0;
  total =  total_amount; 
                         document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
               
                           });

    //Once add button is clicked
    $(addButtonTax).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append('<div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">SKU</label><input list="skus"  class="form-control sku'+x+'"  id="sku" name="sku[]"  autocomplete="off" required><datalist id="skus"><?php foreach($inventory as $results){?><option value="{{$results->sku}}"><?php } ?></datalist></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Item Name</label><input list="names" class="form-control name'+x+'"  id="name"  name="item_name[]" autocomplete="off" required><datalist id="names"><?php foreach($inventory as $results){?><option value="{{$results->name}}"><?php } ?></datalist></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Quantity</label><input type="text" name="quantity[]" class="form-control quantitys'+x+'" id="quantity"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Rate</label><input type="text" class="form-control rates'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Percentage of tax</label><input type="text" class="form-control tax'+x+'" id="tax" name="tax[]" ></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Tax Amount</label><input type="text" class="form-control tax_amount'+x+'" id="tax_amount" name="tax_amount[]" ></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Amount</label><input type="text" class="form-control amountts'+x+'" id="amountt" name="amount[]" ></div></div></div><button type="button" class="remove_button_tax plusbtn"><span class="glyphicon glyphicon-minus"></span></button></div>'); //Add field html
          




            $(wrapper).on('change', '.sku2', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-sku?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name2').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.name2', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.sku2').val(nameObj.sku);            

});

});

   
    });

 




           

$(wrapper).on('change', '.sku3', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name3').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku4', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name4').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku5', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name5').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku6', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name6').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku7', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name7').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku8', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name8').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku9', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name9').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku10', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name10').val(nameObj.name);            

});

});

   
    });
          
            $(wrapper).on('change', '.rates2,.quantitys2,.tax2', function(e) {
      e.preventDefault();
      console.log("ok");
      var rate = $('.rates2').val();
     
      var quantity = $('.quantitys2').val();
        
      var tax = $('.tax2').val();
        
           $('.amountts2').val(rate * quantity);

           var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('.tax_amount2').val(tax_amount);

  var total_amount = amount + tax_amount;
  $('.amountts2').val(total_amount);  
  total2 = 0;
  total2 =  total_amount; 


                document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });

    $(wrapper).on('change', '.rates3,.quantitys3,.tax3', function(e) {
      e.preventDefault();
      var rate = $('.rates3').val();
     
      var quantity = $('.quantitys3').val();
        
      var tax = $('.tax3').val();
        
           $('.amountts3').val(rate * quantity);

           var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('.tax_amount3').val(tax_amount);

  var total_amount = amount + tax_amount;
  $('.amountts3').val(total_amount);  
  total3 = 0;
  total3 =  total_amount; 


                document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });
    $(wrapper).on('change', '.rates4,.quantitys4,.tax4', function(e) {
      e.preventDefault();
      var rate = $('.rates4').val();
     
      var quantity = $('.quantitys4').val();
        
      var tax = $('.tax4').val();
        
           $('.amountts4').val(rate * quantity);

           var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('.tax_amount4').val(tax_amount);

  var total_amount = amount + tax_amount;
  $('.amountts4').val(total_amount);  
  total4 = 0;
  total4 =  total_amount; 


                document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });

    $(wrapper).on('change', '.rates5,.quantitys5,.tax5', function(e) {
      e.preventDefault();
   
      var rate = $('.rates5').val();
     
      var quantity = $('.quantitys5').val();
        
      var tax = $('.tax5').val();
        
           $('.amountts5').val(rate * quantity);

           var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('.tax_amount5').val(tax_amount);

  var total_amount = amount + tax_amount;
  $('.amountts5').val(total_amount);  
  total5 = 0;
  total5 =  total_amount; 


                document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });

    $(wrapper).on('change', '.rates6,.quantitys6,.tax6', function(e) {
      e.preventDefault();
      var rate = $('.rates6').val();
     
      var quantity = $('.quantitys6').val();
        
      var tax = $('.tax6').val();
        
           $('.amountts6').val(rate * quantity);

           var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('.tax_amount6').val(tax_amount);

  var total_amount = amount + tax_amount;
  $('.amountts6').val(total_amount);  
  total6 = 0;
  total6 =  total_amount; 


                document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });

    $(wrapper).on('change', '.rates7,.quantitys7,.tax7', function(e) {
      e.preventDefault();
      var rate = $('.rates7').val();
     
      var quantity = $('.quantitys7').val();
        
      var tax = $('.tax7').val();
        
           $('.amountts7').val(rate * quantity);

           var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('.tax_amount7').val(tax_amount);

  var total_amount = amount + tax_amount;
  $('.amountts7').val(total_amount);  
  total7 = 0;
  total7 =  total_amount; 


                document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });

    $(wrapper).on('change', '.rates8,.quantitys8,.tax8', function(e) {
      e.preventDefault();
      var rate = $('.rates8').val();
     
      var quantity = $('.quantitys8').val();
        
      var tax = $('.tax8').val();
        
           $('.amountts8').val(rate * quantity);

           var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('.tax_amount8').val(tax_amount);

  var total_amount = amount + tax_amount;
  $('.amountts8').val(total_amount);  
  total8 = 0;
  total8 =  total_amount; 


                document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });

    $(wrapper).on('change', '.rates9,.quantitys9,.tax9', function(e) {
      e.preventDefault();
      var rate = $('.rates9').val();
     
      var quantity = $('.quantitys9').val();
        
      var tax = $('.tax9').val();
        
           $('.amountts9').val(rate * quantity);

           var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('.tax_amount9').val(tax_amount);

  var total_amount = amount + tax_amount;
  $('.amountts9').val(total_amount);  
  total9 = 0;
  total9 =  total_amount; 


                document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });
    $(wrapper).on('change', '.rates10,.quantitys10,.tax10', function(e) {
      e.preventDefault();
      var rate = $('.rates10').val();
     
      var quantity = $('.quantitys10').val();
        
      var tax = $('.tax10').val();
        
           $('.amountts10').val(rate * quantity);

           var amount = rate * quantity;
  var tax_amount = (amount*tax)/100;
  //total = amount + tax_amount;
  $('.tax_amount10').val(tax_amount);

  var total_amount = amount + tax_amount;
  $('.amountts10').val(total_amount);  
  total10 = 0;
  total10 =  total_amount; 


                document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button_tax', function(e){
        e.preventDefault();
        a =  $(this).parent('div').attr('class');
        console.log(a);
        var z = 0;
        var roww = "roww";
        var borderrow = " borderrow";
  
        for (z = 1; z<11; z++)
        {
          var sat = roww+z+borderrow;
        if(a == sat)
        {
        if(z == 2)
        {
          total2 = 0;
        }
        if(z == 3)
        {
          total3 = 0;
        }
        if(z == 4)
        {
          total4 = 0;
        }
        if(z == 5)
        {
          total5 = 0;
        }
        if(z == 6)
        {
          total6 = 0;
        }
        if(z == 7)
        {
          total7 = 0;
        }
        if(z == 8)
        {
          total8 = 0;
        }
        if(z == 9)
        {
          total9 = 0;
        }
        if(z == 10)
        {
          total10 = 0;
        }
        }
        }
        document.getElementById("totals").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
          
          $(this).parent('div').remove(); //Remove field html
          x--; //Decrement field counter
        
    });
});

</script>
<script>
$(document).ready(function(){
    // Get value on button click and show alert

  


    $("#quantityr").change(function(){
        var str = $("#rater").val();
        var q = $("#quantityr").val();
        // alert(q);
        $('#amountr').val(str * q);
       
                total = str * q;
                // alert(total);
                document.getElementById("totalr").innerHTML = total;
               
               

    });
});

</script>

<script>
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_buttonsale'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var total = 0;var total2 = 0;var total3 = 0;var total4 = 0;var total5 = 0;var total6 = 0;var total7 = 0;var total8 = 0;var total9 = 0;var total10 = 0;
    var x = 1; //Initial field counter is 1
    
    var fieldHTML = '<div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="sku">SKU</label><input list="skus"  class="form-control sku'+x+'"  id="sku" name="sku[]"  autocomplete="off" required><datalist id="skus"><?php foreach($inventory as $results){?><option value="{{$results->sku}}"><?php } ?></datalist></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="name">Item Name</label><input list="names" class="form-control name'+x+'"  id="name"  name="item_name[]" autocomplete="off" required><datalist id="names"><?php foreach($inventory as $results){?><option value="{{$results->name}}"><?php } ?></datalist></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="quantity">Quantity</label><input type="text" name="quantity[]" class="form-control quantity'+x+'" id="quantity"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="rate">Rate</label><input type="text" class="form-control rate'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><label for="amount">Amount</label><input type="text" class="form-control amountt'+x+'" id="amountt" name="amount[]" disabled></div></div><button type="button" class="remove_button plusbtn"><span class="glyphicon glyphicon-minus"></span></button></div>'; //New input field html 

    
//     $("#sku").on('click',function(e){

// console.log(e);

// var po_id =  e.target.value;

// $.get('{{URL('/')}}/ajax-select-sku?po_id='+ po_id,function(data){

  
//     console.log(data);

//   $.each(data,function(create,nameObj){
     
//   $('#name').val(nameObj.name);

// });

// });

// });

//for ceare payment

$("#partial").on('change',function(e){
          
 var rate =  document.getElementById("partial").value 

                document.getElementById("total2").innerHTML = rate;
                
                  });
          
                 





$("#rate").on('change',function(e){
          
 var rate = parseInt( document.getElementById("rate").value )

//  alert("jbjj");
             $("#quantity").on('change',function(e){
                    
                    
          var quantity  = parseInt( document.getElementById("quantity").value )
          
          // alert("jbjj");
          // alert(quantity);
                
                    internationalNumberFormat = new Intl.NumberFormat('en-US');
                   $('#amount').val(internationalNumberFormat.format(rate * quantity));
                
                total = 0;
                total = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
                  });
          
                  });
                  
                  
                  
          //            $("#quantity").on('change',function(e){
                    
                    
          
          
          // var quantity = parseInt( document.getElementById("quantity").value )
          
      
           
          //    $("#rate").on('change',function(e){
                    
                    
          // var rate  = parseInt( document.getElementById("rate").value )

                
          //          $('#amount').val(rate * quantity);
          //          total = rate * quantity;
          //          document.getElementById("total").innerHTML = total;
          //      total = 0;
          //       total = rate * quantity;
          //       document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
          //         });
               
          //         });

                
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            
//   $(wrapper).append('<div class="borderrow"><div class="row"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="sku">SKU</label><select class="js-example-basic-single form-control sku'+x+'" name="sku[]" required><option value=""> Select SKU</option><?php foreach($inventory as $results){?><option value="{{$results->sku}}">{{$results->sku}}</option><?php } ?></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="name">Item Name</label><select class="form-control js-example-basic-single name'+x+'" name="item_name[]" required><option value=""> Select Name</option><?php foreach($inventory as $results){?><option value="{{$results->name}}">{{$results->name}}</option><?php } ?></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Description</label><input type="text" class="form-control" name="description[]" ></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="quantity">Quantity</label><span id="qty'+x+'"></span><input type="text" name="quantity[]" class="form-control quantity'+x+'" id="quantity"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="rate">Rate</label><input type="text" class="form-control rate'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><label for="amount">Amount</label><input type="text" class="form-control amountt'+x+'" id="amountt" name="amount[]" disabled></div></div><button type="button" class="remove_button plusbtn"><span class="glyphicon glyphicon-minus"></span></button></div>'');

//   $(wrapper).append('<div class="borderrow"><div class="row"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="sku">SKU</label><select class="js-example-basic-single form-control sku'+x+'" name="sku[]" required><option value=""> Select SKU</option><?php foreach($inventory as $results){?><option value="{{$results->sku}}">{{$results->sku}}</option><?php } ?></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="name">Item Name</label><select class="form-control js-example-basic-single name'+x+'" name="item_name[]" required><option value=""> Select Name</option><?php foreach($inventory as $results){?><option value="{{$results->name}}">{{$results->name}}</option><?php } ?></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Description</label><input type="text" class="form-control" name="description[]" ></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="quantity">Quantity</label><span id="qty'+x+'"></span><input type="text" name="quantity[]" class="form-control quantity'+x+'" id="quantity"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="rate">Rate</label><input type="text" class="form-control rate'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><label for="amount">Amount</label><input type="text" class="form-control amountt'+x+'" id="amountt" name="amount[]" disabled></div></div>'); //Add field html
      $(wrapper).append('<div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="sku">SKU</label><input list="skus"  class="form-control sku'+x+'"  id="sku" name="sku[]"  autocomplete="off" required><datalist id="skus"><?php foreach($inventory as $results){?><option value="{{$results->sku}}"><?php } ?></datalist></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="name">Item Name</label><input list="names" class="form-control name'+x+'"  id="name"  name="item_name[]" autocomplete="off" required><datalist id="names"><?php foreach($inventory as $results){?><option value="{{$results->name}}"><?php } ?></datalist></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Description</label><input type="text" class="form-control" name="description[]" ></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="rate">Rate</label><input type="text" class="form-control rate'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="quantity">Quantity(<span id="qty"></span>)</label><input type="text" name="quantity[]" class="form-control quantity'+x+'" ></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><label for="amount">Amount</label><input type="text" class="form-control amountt'+x+'" id="amountt" name="amount[]" disabled></div></div><button type="button" class="remove_button plusbtn"><span class="glyphicon glyphicon-minus"></span></button></div>');      


            $(wrapper).on('change', '.sku2', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-sku?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name2').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.name2', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.sku2').val(nameObj.sku);            

});

});

   
    });

 
    $(wrapper).on('change', '.sku3', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-sku?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name3').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.name3', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.sku3').val(nameObj.sku);            

});

});

   
    });

   
    $(wrapper).on('change', '.sku4', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-sku?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name4').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.name4', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.sku4').val(nameObj.sku);            

});

});

   
    });

  
    $(wrapper).on('change', '.sku5', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-sku?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name5').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.name5', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.sku5').val(nameObj.sku);            

});

});

   
    });


    $(wrapper).on('change', '.sku6', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-sku?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name6').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.name6', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
      // alert(po_id);
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.sku6').val(nameObj.sku);            

});

});

   
    });
    $(wrapper).on('change', '.sku7', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name7').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku8', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name8').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku9', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name9').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku10', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name10').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.rate2', function(e) {
      e.preventDefault();
      var rate = $('.rate2').val();
     
      var quantity = $('.quantity2').val();
    //   echo   var rate = parseInt(rate)
         
           $('.amountt2').val(rate * quantity);

           total2 = 0;
                total2 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });

    $(wrapper).on('change', '.rate3', function(e) {
      e.preventDefault();
      var rate = $('.rate3').val();
     
      var quantity = $('.quantity3').val();
         // var rate = parseInt(rate)
         
           $('.amountt3').val(rate * quantity);
           total3 = 0;
                total3 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
      
    });


        }
    });
    $(wrapper).on('change', '.rate4', function(e) {
      e.preventDefault();
      var rate = $('.rate4').val();
     
      var quantity = $('.quantity4').val();
         // var rate = parseInt(rate)
         
           $('.amountt4').val(rate * quantity);
           total4 = 0;
                total4 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    

    $(wrapper).on('change', '.rate5', function(e) {
      e.preventDefault();
      var rate = $('.rate5').val();
     
      var quantity = $('.quantity5').val();
         // var rate = parseInt(rate)
         
           $('.amountt5').val(rate * quantity);
           total5 = 0;
                total5 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate6', function(e) {
      e.preventDefault();
      var rate = $('.rate6').val();
     
      var quantity = $('.quantity6').val();
         // var rate = parseInt(rate)
         
           $('.amountt6').val(rate * quantity);
           total6 = 0;
                total6 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate7', function(e) {
      e.preventDefault();
      var rate = $('.rate7').val();
     
      var quantity = $('.quantity7').val();
         // var rate = parseInt(rate)
         
           $('.amountt7').val(rate * quantity);
           total7 = 0;
                total7 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate8', function(e) {
      e.preventDefault();
      var rate = $('.rate8').val();
     
      var quantity = $('.quantity8').val();
         // var rate = parseInt(rate)
         
           $('.amountt8').val(rate * quantity);
           total8 = 0;
                total8 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate9', function(e) {
      e.preventDefault();
      var rate = $('.rate9').val();
     
      var quantity = $('.quantity9').val();
         // var rate = parseInt(rate)
         
           $('.amountt9').val(rate * quantity);
           total9 = 0;
                total9 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate10', function(e) {
      e.preventDefault();
      var rate = $('.rate10').val();
     
      var quantity = $('.quantity10').val();
         // var rate = parseInt(rate)
         
           $('.amountt10').val(rate * quantity);
           total10 = 0;
                total10 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });

    $(wrapper).on('change', '.quantity2', function(e) {
      e.preventDefault();
      var quantity = $('.quantity2').val();
     
      var rate = $('.rate2').val();
         // var rate = parseInt(rate)
         
           $('.amountt2').val(rate * quantity);
           total2 = 0;
                total2 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });

    $(wrapper).on('change', '.quantity3', function(e) {
      e.preventDefault();
      var quantity = $('.quantity3').val();
     
      var rate = $('.rate3').val();
         // var rate = parseInt(rate)
         
           $('.amountt3').val(rate * quantity);
           total3 = 0;
                total3 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });

    $(wrapper).on('change', '.quantity4', function(e) {
      e.preventDefault();
      var quantity = $('.quantity4').val();
     
      var rate = $('.rate4').val();
         // var rate = parseInt(rate)
         
           $('.amountt4').val(rate * quantity);
           total4 = 0;
                total4 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });

    $(wrapper).on('change', '.quantity5', function(e) {
      e.preventDefault();
      var quantity = $('.quantity5').val();
     
      var rate = $('.rate5').val();
         // var rate = parseInt(rate)
         
           $('.amountt5').val(rate * quantity);
           total5 = 0;
                total5 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });  
      $(wrapper).on('change', '.quantity6', function(e) {
      e.preventDefault();
      var quantity = $('.quantity6').val();
     
      var rate = $('.rate6').val();
         // var rate = parseInt(rate)
         
           $('.amountt6').val(rate * quantity);
           total6 = 0;
                total6 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });
    
        $(wrapper).on('change', '.quantity7', function(e) {
      e.preventDefault();
      var quantity = $('.quantity7').val();
     
      var rate = $('.rate7').val();
         // var rate = parseInt(rate)
         
           $('.amountt7').val(rate * quantity);
           total7 = 0;
                total7 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    }); 
    
       $(wrapper).on('change', '.quantity8', function(e) {
      e.preventDefault();
      var quantity = $('.quantity8').val();
     
      var rate = $('.rate8').val();
         // var rate = parseInt(rate)
         
           $('.amountt8').val(rate * quantity);
           total8 = 0;
                total8 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    }); 
    
       $(wrapper).on('change', '.quantity9', function(e) {
      e.preventDefault();
      var quantity = $('.quantity9').val();
     
      var rate = $('.rate9').val();
         // var rate = parseInt(rate)
         
           $('.amountt9').val(rate * quantity);
           total9 = 0;
                total9 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });  
    
      $(wrapper).on('change', '.quantity10', function(e) {
      e.preventDefault();
      var quantity = $('.quantity10').val();
     
      var rate = $('.rate10').val();
         // var rate = parseInt(rate)
         
           $('.amountt10').val(rate * quantity);
           total10 = 0;
                total10 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });    

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
      a =  $(this).parent('div').attr('class');
      console.log(a);
      var z = 0;
      var roww = "roww";
      var borderrow = " borderrow";

      for (z = 1; z<11; z++)
      {
        var sat = roww+z+borderrow;
      if(a == sat)
      {
      if(z == 2)
      {
        total2 = 0;
      }
      if(z == 3)
      {
        total3 = 0;
      }
      if(z == 4)
      {
        total4 = 0;
      }
      if(z == 5)
      {
        total5 = 0;
      }
      if(z == 6)
      {
        total6 = 0;
      }
      if(z == 7)
      {
        total7 = 0;
      }
      if(z == 8)
      {
        total8 = 0;
      }
      if(z == 9)
      {
        total9 = 0;
      }
      if(z == 10)
      {
        total10 = 0;
      }
      }
      }
      document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    
    });
});
</script>
<script>
$(document).ready(function(){

 $('#supplier').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.supplier') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#supplierlist').fadeIn();  
                    $('#supplierlist').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
        $('#supplier').val($(this).text());  
        $('#supplierlist').fadeOut();  
    });  

});
</script>
<script>
 
 
 
 
 
$(document).ready(function(){

 $('#customer').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"{{ route('autocomplete.customer') }}",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#customerlist').fadeIn();  
                    $('#customerlist').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
        $('#customer').val($(this).text());  
        $('#customerlist').fadeOut();  
    });  

});
</script>
<script type="text/javascript">
$("#customer_name").on('change',function(e){

var po_id =  e.target.value;
console.log(po_id);
document.getElementById("bills").innerHTML = po_id;
              

});
$("#supplier_name").on('change',function(e){

var po_id =  e.target.value;
console.log(po_id);
document.getElementById("bills").innerHTML = po_id;
              

});



    
$("#main").on('change',function(e){

      console.log(e);

      var cat_id = e.target.value;

      $.get('{{URL('/')}}/ajax-subcategory?cat_id='+ cat_id,function(data){
        $('#Sub').empty();
        $('#Sub').append('<option value="" disable="true" selected="true" >---Select Sub Category---</option>');

        $.each(data,function(create,subcatObj){

          $('#Sub').append('<option value ="'+subcatObj.sub_category+'">'+subcatObj.sub_category+'</option>');
      });



      });


  });


$("#p_account").on('change',function(e){

      console.log(e);

      var cat_id = e.target.value;
    //   alert (cat_id);
      $.get('{{URL('/')}}/ajax-coa-account?cat_id='+ cat_id,function(data){
          $('#SubCategory').empty();
          $('#mainCategory').empty();
        $.each(data,function(create,subcatObj){

          $('#SubCategory').append('<option value ="'+subcatObj.account_type+'">'+subcatObj.account_type+'</option>');
          $('#mainCategory').append('<option value ="'+subcatObj.nature_of_account+'">'+subcatObj.nature_of_account+'</option>');
          $("#mainCategory").attr('disabled', true);
          $("#SubCategory").attr('disabled', true);
      });



      });


  });


    $("#mainCategory").on('change',function(e){

      console.log(e);

      var cat_id = e.target.value;
      $.get('{{URL('/')}}/ajax-subcat?cat_id='+ cat_id,function(data){
        $('#SubCategory').empty();
        $('#SubCategory').append('<option value="" disable="true" selected="true" >---Select Account---</option>');

        $.each(data,function(create,subcatObj){

          $('#SubCategory').append('<option value ="'+subcatObj.account_type+'">'+subcatObj.account_type+'</option>');
      });



      });


  });
  
      $("#SubCategory").on('change',function(e){

      console.log(e);
      
      var type_id = e.target.value;
      
      $.get('{{URL('/')}}/ajax-product-type?type_id='+ type_id,function(data){
        console.log(data);
      $('#account_name').empty();
        $('#account_name').append('<option value="" disable="true" selected="true" >---Add Product Type---</option>');
        $.each(data,function(create,typeObj){
         
          $('#account_name').append('<option value ="'+typeObj.account_name+'">'+typeObj.account_name+'</option>');
      });
   


      });


  });
  
  
  

  $("#account_receivable").on('change',function(e){

var cat_id = e.target.value;

$.get('{{URL('/')}}/ajax/account/receivable?cat_id='+ cat_id,function(data){
  $('#amount_receivable').val(data);

});


});
$("#account_payable").on('change',function(e){

var cat_id = e.target.value;
console.log(cat_id);
$.get('{{URL('/')}}/ajax/account/payable?cat_id='+ cat_id,function(data){
  $('#amount_payable').val(data);

});


});     

  </script>

<script>
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_buttoncppr'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var total = 0;var total2 = 0;var total3 = 0;var total4 = 0;var total5 = 0;var total6 = 0;var total7 = 0;var total8 = 0;var total9 = 0;var total10 = 0;
    var x = 1; //Initial field counter is 1
    var fieldHTML = '<div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Tank Name</label><select class="form-control tank'+x+'" id="tank" name="tank_name[]"><option value="">Select Tank</option><?php foreach($tank as $results){?><option value="{{$results->pk_id}}">{{$results->tank_name}}</option><?php } ?></select><div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">SKU</label><select class="form-control sku'+x+'" id="sku" name="sku[]"><option value="">Select Item SKU</option><?php foreach($inventory as $results){?><option value="{{$results->sku}}">{{$results->sku}}</option><?php } ?></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Item Name</label><input type="text" class="form-control name'+x+'" id="name" name="item_name[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Quantity</label><input type="text" name="quantity[]" class="form-control quantity'+x+'" id="quantity"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Rate</label><input type="text" class="form-control rate'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><label>Amount</label><input type="text" class="form-control amountt'+x+'" id="amountt" name="amount[]" disabled></div></div><button class="remove_button plusbtn"><span class="glyphicon glyphicon-minus"></span></button></div>'; //New input field html 
//     $("#sku").on('change',function(e){

// console.log(e);

// var po_id =  e.target.value;

// $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

  
//     console.log(data);

//   $.each(data,function(create,nameObj){
     
//   $('#name').val(nameObj.name);

// });

// });

// });

$("#rate").on('change',function(e){
          
 var rate = parseInt( document.getElementById("rate").value )
          
           
             $("#quantity").on('change',function(e){
                    
                    
          var quantity  = parseInt( document.getElementById("quantity").value )
          
          
               
                
                   $('#amount').val(rate * quantity);
                
                total = 0;
                total = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
                  });
          
                  });
                  
                  
                  
                     $("#quantity").on('change',function(e){
                    
                    
          
          
          var quantity = parseInt( document.getElementById("quantity").value )
          
      
           
             $("#rate").on('change',function(e){
                    
                    
          var rate  = parseInt( document.getElementById("rate").value )

                
                   $('#amount').val(rate * quantity);
                   total = rate * quantity;
                   document.getElementById("total").innerHTML = total;
               total = 0;
                total = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                  });
               
                  });

                
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
          
            $(wrapper).append('<div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Tank Name</label><select class="form-control tank_name'+x+'" id="tank_name" name="tank_name[]"><option value="">Select Tank</option><?php foreach($tank as $results){?><option value="{{$results->pk_id}}">{{$results->tank_name}}</option><?php } ?></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">SKU</label><select class="form-control sku'+x+'" id="sku" name="sku[]"><option value="">Select Item SKU</option><?php foreach($inventory as $results){?><option value="{{$results->sku}}">{{$results->sku}}</option><?php } ?></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Item Name</label><input type="text" class="form-control name'+x+'" id="name" name="item_name[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Quantity</label><input type="text" name="quantity[]" class="form-control quantity'+x+'" id="quantity"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Rate</label><input type="text" class="form-control rate'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><label>Amount</label><input type="text" class="form-control amountt'+x+'" id="amountt" name="amount[]" disabled></div></div><button class="remove_button plusbtn"><span class="glyphicon glyphicon-minus"></span></button></div>'); //Add field html
           
            $(wrapper).on('change', '.sku2', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name2').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku3', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name3').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku4', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name4').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku5', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name5').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku6', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name6').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku7', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name7').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku8', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name8').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku9', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name9').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku10', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name10').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.rate2', function(e) {
      e.preventDefault();
      var rate = $('.rate2').val();
     
      var quantity = $('.quantity2').val();
         // var rate = parseInt(rate)
         
           $('.amountt2').val(rate * quantity);

           total2 = 0;
                total2 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });

    $(wrapper).on('change', '.rate3', function(e) {
      e.preventDefault();
      var rate = $('.rate3').val();
     
      var quantity = $('.quantity3').val();
         // var rate = parseInt(rate)
         
           $('.amountt3').val(rate * quantity);
           total3 = 0;
                total3 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
      
    });


        }
    });
    $(wrapper).on('change', '.rate4', function(e) {
      e.preventDefault();
      var rate = $('.rate4').val();
     
      var quantity = $('.quantity4').val();
         // var rate = parseInt(rate)
         
           $('.amountt4').val(rate * quantity);
           total4 = 0;
                total4 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    

    $(wrapper).on('change', '.rate5', function(e) {
      e.preventDefault();
      var rate = $('.rate5').val();
     
      var quantity = $('.quantity5').val();
         // var rate = parseInt(rate)
         
           $('.amountt5').val(rate * quantity);
           total5 = 0;
                total5 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate6', function(e) {
      e.preventDefault();
      var rate = $('.rate6').val();
     
      var quantity = $('.quantity6').val();
         // var rate = parseInt(rate)
         
           $('.amountt6').val(rate * quantity);
           total6 = 0;
                total6 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate7', function(e) {
      e.preventDefault();
      var rate = $('.rate7').val();
     
      var quantity = $('.quantity7').val();
         // var rate = parseInt(rate)
         
           $('.amountt7').val(rate * quantity);
           total7 = 0;
                total7 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate8', function(e) {
      e.preventDefault();
      var rate = $('.rate8').val();
     
      var quantity = $('.quantity8').val();
         // var rate = parseInt(rate)
         
           $('.amountt8').val(rate * quantity);
           total8 = 0;
                total8 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate9', function(e) {
      e.preventDefault();
      var rate = $('.rate9').val();
     
      var quantity = $('.quantity9').val();
         // var rate = parseInt(rate)
         
           $('.amountt9').val(rate * quantity);
           total9 = 0;
                total9 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate10', function(e) {
      e.preventDefault();
      var rate = $('.rate10').val();
     
      var quantity = $('.quantity10').val();
         // var rate = parseInt(rate)
         
           $('.amountt10').val(rate * quantity);
           total10 = 0;
                total10 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });

    $(wrapper).on('change', '.quantity2', function(e) {
      e.preventDefault();
      var quantity = $('.quantity2').val();
     
      var rate = $('.rate2').val();
         // var rate = parseInt(rate)
         
           $('.amountt2').val(rate * quantity);
           total2 = 0;
                total2 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });

    $(wrapper).on('change', '.quantity3', function(e) {
      e.preventDefault();
      var quantity = $('.quantity3').val();
     
      var rate = $('.rate3').val();
         // var rate = parseInt(rate)
         
           $('.amountt3').val(rate * quantity);
           total3 = 0;
                total3 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });

    $(wrapper).on('change', '.quantity4', function(e) {
      e.preventDefault();
      var quantity = $('.quantity4').val();
     
      var rate = $('.rate4').val();
         // var rate = parseInt(rate)
         
           $('.amountt4').val(rate * quantity);
           total4 = 0;
                total4 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });

    $(wrapper).on('change', '.quantity5', function(e) {
      e.preventDefault();
      var quantity = $('.quantity5').val();
     
      var rate = $('.rate5').val();
         // var rate = parseInt(rate)
         
           $('.amountt5').val(rate * quantity);
           total5 = 0;
                total5 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });  
      $(wrapper).on('change', '.quantity6', function(e) {
      e.preventDefault();
      var quantity = $('.quantity6').val();
     
      var rate = $('.rate6').val();
         // var rate = parseInt(rate)
         
           $('.amountt6').val(rate * quantity);
           total6 = 0;
                total6 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });
    
        $(wrapper).on('change', '.quantity7', function(e) {
      e.preventDefault();
      var quantity = $('.quantity7').val();
     
      var rate = $('.rate7').val();
         // var rate = parseInt(rate)
         
           $('.amountt7').val(rate * quantity);
           total7 = 0;
                total7 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    }); 
    
       $(wrapper).on('change', '.quantity8', function(e) {
      e.preventDefault();
      var quantity = $('.quantity8').val();
     
      var rate = $('.rate8').val();
         // var rate = parseInt(rate)
         
           $('.amountt8').val(rate * quantity);
           total8 = 0;
                total8 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    }); 
    
       $(wrapper).on('change', '.quantity9', function(e) {
      e.preventDefault();
      var quantity = $('.quantity9').val();
     
      var rate = $('.rate9').val();
         // var rate = parseInt(rate)
         
           $('.amountt9').val(rate * quantity);
           total9 = 0;
                total9 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });  
    
      $(wrapper).on('change', '.quantity10', function(e) {
      e.preventDefault();
      var quantity = $('.quantity10').val();
     
      var rate = $('.rate10').val();
         // var rate = parseInt(rate)
         
           $('.amountt10').val(rate * quantity);
           total10 = 0;
                total10 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });    

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
      a =  $(this).parent('div').attr('class');
      console.log(a);
      var z = 0;
      var roww = "roww";
      var borderrow = " borderrow";

      for (z = 1; z<11; z++)
      {
        var sat = roww+z+borderrow;
      if(a == sat)
      {
      if(z == 2)
      {
        total2 = 0;
      }
      if(z == 3)
      {
        total3 = 0;
      }
      if(z == 4)
      {
        total4 = 0;
      }
      if(z == 5)
      {
        total5 = 0;
      }
      if(z == 6)
      {
        total6 = 0;
      }
      if(z == 7)
      {
        total7 = 0;
      }
      if(z == 8)
      {
        total8 = 0;
      }
      if(z == 9)
      {
        total9 = 0;
      }
      if(z == 10)
      {
        total10 = 0;
      }
      }
      }
      document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    
    });
});
</script>
<script>
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_buttonsales'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var total = 0;var total2 = 0;var total3 = 0;var total4 = 0;var total5 = 0;var total6 = 0;var total7 = 0;var total8 = 0;var total9 = 0;var total10 = 0;
    var x = 1; //Initial field counter is 1
    var fieldHTML = '<div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">SKU</label><select class="form-control sku'+x+'" id="sku" name="sku[]"><option value="">Select Item SKU</option><?php foreach($inventory as $results){?><option value="{{$results->sku}}">{{$results->sku}}</option><?php } ?></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Item Name</label><input type="text" class="form-control name'+x+'" id="name" name="item_name[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Quantity</label><input type="text" name="quantity[]" class="form-control quantity'+x+'" id="quantity"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Rate</label><input type="text" class="form-control rate'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><h5>Amount</h5><input type="text" class="form-control amountt'+x+'" id="amountt" name="amount[]" disabled></div></div><button type="button" class="remove_button plusbtn"><span class="glyphicon glyphicon-minus marginsets"></span></button></div>'; //New input field html 
    

$("#rate").on('change',function(e){
          
 var rate =  document.getElementById("rate").value 
          
           
             $("#quantity").on('change',function(e){
                    
                    
          var quantity  =  document.getElementById("quantity").value 
          
          //parseInt ha
               
                
                  $('#amount').val(rate * quantity);
                
                total = 0;
                total = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
                  });
          
                  });
                  
                  
                  
                     $("#quantity").on('change',function(e){
                    
                    
          
          
          var quantity =  document.getElementById("quantity").value 
          
      
           
             $("#rate").on('change',function(e){
                    
                    
          var rate  = document.getElementById("rate").value 

                
                   $('#amount').val(rate * quantity);
                   total = rate * quantity;
                   document.getElementById("total").innerHTML = total;
               total = 0;
                total = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                  });
               
                  });

                
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
          
            $(wrapper).append('<div class="roww'+x+' borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">SKU</label><select class="form-control sku'+x+'" id="sku" name="sku[]"><option value="">Select Item SKU</option><?php foreach($inventory as $results){?><option value="{{$results->sku}}">{{$results->sku}}</option><?php } ?></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Item Name</label><input type="text" class="form-control name'+x+'" id="name" name="item_name[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Quantity</label><input type="text" name="quantity[]" class="form-control quantity'+x+'" id="quantity"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group "><label for="usr">Rate</label><input type="text" class="form-control rate'+x+'" id="rate" name="rate[]"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><h5>Amount</h5><input type="text" class="form-control amountt'+x+'" id="amountt" name="amount[]" disabled></div></div><button type="button" class="remove_button plusbtn"><span class="glyphicon glyphicon-minus marginsets"></span></button>'); //Add field html
           
            $(wrapper).on('change', '.sku2', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name2').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku3', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name3').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku4', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name4').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku5', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name5').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.sku6', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name6').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku7', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name7').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku8', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name8').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku9', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name9').val(nameObj.name);            

});

});

   
    });
    $(wrapper).on('change', '.sku10', function(e) {
      e.preventDefault();
      var po_id = $(this).val();
   $.get('{{URL('/')}}/ajax-select-item?po_id='+ po_id,function(data){

$.each(data,function(create,nameObj){
 $('.name10').val(nameObj.name);            

});

});

   
    });

    $(wrapper).on('change', '.rate2', function(e) {
      e.preventDefault();
      var rate = $('.rate2').val();
     
      var quantity = $('.quantity2').val();
         // var rate = parseInt(rate)
         
           $('.amountt2').val(rate * quantity);

           total2 = 0;
                total2 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
       
    });

    $(wrapper).on('change', '.rate3', function(e) {
      e.preventDefault();
      var rate = $('.rate3').val();
     
      var quantity = $('.quantity3').val();
         // var rate = parseInt(rate)
         
           $('.amountt3').val(rate * quantity);
           total3 = 0;
                total3 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
      
    });


        }
    });
    $(wrapper).on('change', '.rate4', function(e) {
      e.preventDefault();
      var rate = $('.rate4').val();
     
      var quantity = $('.quantity4').val();
         // var rate = parseInt(rate)
         
           $('.amountt4').val(rate * quantity);
           total4 = 0;
                total4 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    

    $(wrapper).on('change', '.rate5', function(e) {
      e.preventDefault();
      var rate = $('.rate5').val();
     
      var quantity = $('.quantity5').val();
         // var rate = parseInt(rate)
         
           $('.amountt5').val(rate * quantity);
           total5 = 0;
                total5 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate6', function(e) {
      e.preventDefault();
      var rate = $('.rate6').val();
     
      var quantity = $('.quantity6').val();
         // var rate = parseInt(rate)
         
           $('.amountt6').val(rate * quantity);
           total6 = 0;
                total6 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate7', function(e) {
      e.preventDefault();
      var rate = $('.rate7').val();
     
      var quantity = $('.quantity7').val();
         // var rate = parseInt(rate)
         
           $('.amountt7').val(rate * quantity);
           total7 = 0;
                total7 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate8', function(e) {
      e.preventDefault();
      var rate = $('.rate8').val();
     
      var quantity = $('.quantity8').val();
         // var rate = parseInt(rate)
         
           $('.amountt8').val(rate * quantity);
           total8 = 0;
                total8 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate9', function(e) {
      e.preventDefault();
      var rate = $('.rate9').val();
     
      var quantity = $('.quantity9').val();
         // var rate = parseInt(rate)
         
           $('.amountt9').val(rate * quantity);
           total9 = 0;
                total9 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });
    $(wrapper).on('change', '.rate10', function(e) {
      e.preventDefault();
      var rate = $('.rate10').val();
     
      var quantity = $('.quantity10').val();
         // var rate = parseInt(rate)
         
           $('.amountt10').val(rate * quantity);
           total10 = 0;
                total10 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
                
    });

    $(wrapper).on('change', '.quantity2', function(e) {
      e.preventDefault();
      var quantity = $('.quantity2').val();
     
      var rate = $('.rate2').val();
         // var rate = parseInt(rate)
         
           $('.amountt2').val(rate * quantity);
           total2 = 0;
                total2 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });

    $(wrapper).on('change', '.quantity3', function(e) {
      e.preventDefault();
      var quantity = $('.quantity3').val();
     
      var rate = $('.rate3').val();
         // var rate = parseInt(rate)
         
           $('.amountt3').val(rate * quantity);
           total3 = 0;
                total3 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });

    $(wrapper).on('change', '.quantity4', function(e) {
      e.preventDefault();
      var quantity = $('.quantity4').val();
     
      var rate = $('.rate4').val();
         // var rate = parseInt(rate)
         
           $('.amountt4').val(rate * quantity);
           total4 = 0;
                total4 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });

    $(wrapper).on('change', '.quantity5', function(e) {
      e.preventDefault();
      var quantity = $('.quantity5').val();
     
      var rate = $('.rate5').val();
         // var rate = parseInt(rate)
         
           $('.amountt5').val(rate * quantity);
           total5 = 0;
                total5 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });  
      $(wrapper).on('change', '.quantity6', function(e) {
      e.preventDefault();
      var quantity = $('.quantity6').val();
     
      var rate = $('.rate6').val();
         // var rate = parseInt(rate)
         
           $('.amountt6').val(rate * quantity);
           total6 = 0;
                total6 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });
    
        $(wrapper).on('change', '.quantity7', function(e) {
      e.preventDefault();
      var quantity = $('.quantity7').val();
     
      var rate = $('.rate7').val();
         // var rate = parseInt(rate)
         
           $('.amountt7').val(rate * quantity);
           total7 = 0;
                total7 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    }); 
    
       $(wrapper).on('change', '.quantity8', function(e) {
      e.preventDefault();
      var quantity = $('.quantity8').val();
     
      var rate = $('.rate8').val();
         // var rate = parseInt(rate)
         
           $('.amountt8').val(rate * quantity);
           total8 = 0;
                total8 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    }); 
    
       $(wrapper).on('change', '.quantity9', function(e) {
      e.preventDefault();
      var quantity = $('.quantity9').val();
     
      var rate = $('.rate9').val();
         // var rate = parseInt(rate)
         
           $('.amountt9').val(rate * quantity);
           total9 = 0;
                total9 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });  
    
      $(wrapper).on('change', '.quantity10', function(e) {
      e.preventDefault();
      var quantity = $('.quantity10').val();
     
      var rate = $('.rate10').val();
         // var rate = parseInt(rate)
         
           $('.amountt10').val(rate * quantity);
           total10 = 0;
                total10 = rate * quantity;
                document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
    });    

    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
      a =  $(this).parent('div').attr('class');
      console.log(a);
      var z = 0;
      var roww = "roww";
      var borderrow = " borderrow";

      for (z = 1; z<11; z++)
      {
        var sat = roww+z+borderrow;
      if(a == sat)
      {
      if(z == 2)
      {
        total2 = 0;
      }
      if(z == 3)
      {
        total3 = 0;
      }
      if(z == 4)
      {
        total4 = 0;
      }
      if(z == 5)
      {
        total5 = 0;
      }
      if(z == 6)
      {
        total6 = 0;
      }
      if(z == 7)
      {
        total7 = 0;
      }
      if(z == 8)
      {
        total8 = 0;
      }
      if(z == 9)
      {
        total9 = 0;
      }
      if(z == 10)
      {
        total10 = 0;
      }
      }
      }
      document.getElementById("total").innerHTML = total+total2+total3+total4+total5+total6+total7+total8+total9+total10;
        
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    
    });
});
</script>
<script>
$(document).ready(function(){
  var maxField = 10; //Input fields increment limitation
  var addButton = $('.add_button2'); //Add button selector
  var wrapper = $('.field_wrapper'); //Input field wrapper
  var fieldHTML = '<div class="borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Tank Name</label><input type="text" name="tank_name[]" class="form-control" id="usr"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Total Capacity</label><input type="text" name="total_capacity[]" class="form-control" id="usr"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Total Dip</label><input type="text" name="total_dip[]" class="form-control"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Opening Stock</label><input type="text" name="opening_stock[]" class="form-control" id=""></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Unit Of Measurement</label><select class="form-control" name="uom[]"><option value="Litre">Litre</option><option valu="QTY">QTY</option></select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Opening Balance</label><input type="number" name="opening_balance[]" class="form-control" id=""></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Opening Dip</label><input type="text" name="opening_dip[]" class="form-control" id=""></div></div></div><button class="remove_button plusbtn"><span class="glyphicon glyphicon-minus"></span></button></div>'; //New input field html 
  var x = 1; //Initial field counter is 1
  
  //Once add button is clicked
  $(addButton).click(function(){
      //Check maximum number of input fields
      if(x < maxField){ 
          x++; //Increment field counter
          $(wrapper).append(fieldHTML); //Add field html
      }
  });
  
  //Once remove button is clicked
  $(wrapper).on('click', '.remove_button', function(e){
      e.preventDefault();
      $(this).parent('div').remove(); //Remove field html
      x--; //Decrement field counter
  });
});
  </script>
<script>
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_buttonmachine'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Machine Name</label><input type="text" name="machine_name[]" class="form-control" id="usr"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Closing Reading</label><input type="text" name="closing_reading[]" class="form-control" id="usr"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Rate</label><input type="text" name="rate[]" class="form-control" id=""></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Current Dip</label><input type="text" name="current_dip[]" class="form-control" id=""></div></div></div><button class="remove_button plusbtn"><span class="glyphicon glyphicon-minus"></span></button></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});


</script>
<script>
function myFunction() {
  var checkBox = document.getElementById("myCheck");
  var text = document.getElementById("text");
  if (checkBox.checked == true){
    text.style.display = "block";
  } else {
     text.style.display = "none";
  }
}
</script>
<script>
$("#mydate2").datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", new Date());
$("#mydate").datepicker({ dateFormat: "yy-mm-dd"}).datepicker("setDate", new Date());
$("form :input").attr("autocomplete", "off");
</script>
@php
$result = DB::select("select* from account ");
        
        $bank = DB::select("select* from account where nature_of_account = 'Cash and Cash Equilants' ");
        
        $customer = DB::select("select customer_name from customer ");
        // return $customer;
        $supplier = DB::select("select supplier_name from supplier ");

        $employe = DB::select("select employe_name from employe ");
        // dd($result);
        $result1 = DB::select("select* from account where nature_of_account = 'Cash and Cash Equilants'");
@endphp
<script type="text/javascript">

$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div class="row"><div class="borderrow"><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label>Payee</label><select class="form-control" name="payee[]" ><option value=""></option><option value="">Select</option>@if($customer>0)@foreach($customer as $results)<option value="{{$results->customer_name}}">{{$results->customer_name}}</option>@endforeach @endif @if($supplier>0)@foreach($supplier as $results)<option value="{{$results->supplier_name}}">{{$results->supplier_name}}</option>@endforeach @endif</select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="sel1">Account Name</label><a href="{{URL('/')}}/admin/home/add/account" > ADD</a><select class="form-control" id="" name="account_name[]" required><option value="">Select Account Name</option>@if($result>0)@foreach($result as $results)<option value="{{$results->pk_id}}">{{$results->account_name}}{{$results->sub_account}}</option>@endforeach @endif</select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Payment Account</label><a href="{{URL('/')}}/admin/home/add/account" > ADD </a><select class="form-control" id="" name="payment_account[]" required><option value="">Select Account</option>@if($bank>0)@foreach($bank as $results)<option value="{{$results->account_name}}">{{$results->account_name}}</option>@endforeach @endif</select></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Description</label><input type="text" name="description[]" class="form-control"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="usr">Amount</label><input type="number" name="amount[]" class="form-control"></div></div></div><div class="col-lg-2 col-md-2 col-sm-12 col-xs-12"><div class="createadmininputs"><div class="form-group"><label for="mydate"> Date</label><input type="date" class="form-control"  name="date[]"></div></div></div><a href="javascript:void(0);" class="remove_button plusbtn"><span class="glyphicon glyphicon-minus marginsets"></span></a></div></div>'; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>

<script type="text/javascript">
      $("#testname").on('change',function(e){

        console.log(e);
        
        var cat_id =  e.target.value;
       
        $.get('{{URL('/')}}/ajax-subcat-test?cat_id='+ cat_id,function(data){
          console.log(data);
            $('#test_blance').empty();
            
            $.each(data,function(create,subcatObj){
             
              $('#test_blance').append('<input class="form-control" name="test_balance" value ="'+subcatObj.current_balance+'" readonly>');
          });

        });
         
    });
 
  </script>
<script type="text/javascript">
      $("#suppliername").on('change',function(e){

        console.log(e);
        
        var cat_id =  e.target.value;
       
        $.get('{{URL('/')}}/ajax-subcat-suppliername?cat_id='+ cat_id,function(data){
          console.log(data);
            $('#supplier_blance').empty();
            
            $.each(data,function(create,subcatObj){
             
              $('#supplier_blance').append('<input class="form-control" name="supplier_blance" value ="'+subcatObj.current_balance+'" readonly>');
          });

        });
         
    });
 
  </script>
  
  <script type="text/javascript">
      $("#subaccount").on('change',function(e){

        console.log(e);
        var cat_id =  e.target.value;
        
       
        $.get('{{URL('/')}}/ajax-subcat-Account_Name?cat_id='+ cat_id,function(data){
          console.log(data);
          $('#mainaccount').empty();
          $.each(data,function(create,subcatObj){
           
            $('#mainaccount').append('<option value ="'+subcatObj.account_name+'">'+subcatObj.account_name+'</option> ');
        });

        });
         
    });
 
 
 
 $('#mainaccount').change(function(e){
if($(this).val() == ''){
    $("#subaccount").prop('disabled',false);
}
else $("#subaccount").prop('disabled',true);
});

 $('#subaccount').change(function(e){
if($(this).val() == ''){
    $("#mainaccount").prop('disabled',false);
}
else $("#mainaccount").prop('disabled',true);
});
  </script>
</body>
</html>
