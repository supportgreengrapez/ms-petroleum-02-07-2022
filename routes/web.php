<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/admin/logout','adminController@logout');
Route::get('/admin','adminController@admin_login_view');
Route::get('/','adminController@admin_login_view');
Route::post('/admin/login','adminController@index');
Route::get('/admin/home','adminController@admin_home');


Route::get('/ajax-subcategory','adminController@sub');

Route::get('/ajax-subcat','adminController@subb');
Route::get('/ajax-product-type','adminController@type');

Route::get('/index/{company}/{username}','adminController@index_company');

Route::get('/indexx','adminController@index');

Route::get('/admin/home/customer/list/view','adminController@customer_list_view');
Route::get('/admin/home/customer/detail/view/{id}','adminController@customer_detail_view');
Route::get('/admin/home/add/customer','adminController@add_customer_view');
Route::post('/admin/home/add/customer','adminController@add_customer');
Route::get('/admin/home/edit/customer/{id}','adminController@edit_customer_view');
Route::post('/admin/home/edit/customer/{id}','adminController@edit_customer');
Route::get('/admin/home/delete/customer/{id}','adminController@delete_customer');
Route::post('/admin/home/search/customer','adminController@search_customer');


Route::get('/admin/add/nature/of/account','adminController@add_nature_of_account_view');

Route::post('/admin/add/nature/of/account/list','adminController@add_nature_of_account');

Route::get('/admin/add/account/type','adminController@add_account_type_view');

Route::post('/admin/add/account/type/list','adminController@add_account_type');


Route::get('/admin/home/delete/sale/list/{id}','adminController@delete_sale_list');

Route::get('/admin/home/delete/purchase/list/{id}','adminController@delete_purchase_list');

Route::get('/admin/home/add/bank/deposit/view','adminController@add_bank_deposit_view');
Route::get('/ajax-subcat-Account_Name','adminController@sub_Account_Name');
Route::post('/admin/home/add/bank/deposit','adminController@add_bank_deposit');


Route::get('/admin/view/admin/list','adminController@admin_list_view');
Route::get('/admin/create/admin','adminController@create_admin_view');
Route::post('/admin/add/admin','adminController@create_admin');
Route::get('/admin/edit/admin/view/{id}','adminController@edit_admin_view');
Route::post('/admin/edit/admin/{id}','adminController@edit_admin');
Route::get('/admin/delete/admin/{id}','adminController@delete_admin');

Route::get('/admin/view/permissions/list','adminController@view_company_permissions');


Route::get('/admin/sale/invoice/print/{id}','adminController@sale_invoice_print');

Route::get('/admin/view/pdf_test','adminController@pdf_test');


Route::get('/admin/home/supplier/list/view','adminController@supplier_list_view');
Route::get('/admin/home/supplier/detail/view/{id}','adminController@supplier_detail_view');
Route::get('/admin/home/add/supplier','adminController@add_supplier_view');
Route::post('/admin/home/add/supplier','adminController@add_supplier');
Route::get('/admin/home/edit/supplier/{id}','adminController@edit_supplier_view');
Route::post('/admin/home/edit/supplier/{id}','adminController@edit_supplier');
Route::get('/admin/home/delete/supplier/{id}','adminController@delete_supplier');
Route::post('/admin/home/search/supplier','adminController@search_supplier');
Route::post('/admin/home/search/account','adminController@search_account');

Route::get('/admin/home/view/main/category','adminController@main_category_list_view');
Route::get('/admin/home/add/main/category','adminController@add_main_category_view');
Route::post('/admin/home/add/main/category','adminController@add_main_category');
Route::get('/admin/home/edit/main/category/{sku}','adminController@edit_main_category_view');
Route::post('/admin/home/edit/main/category/{sku}','adminController@edit_main_category');
Route::get('/admin/home/delete/main/category/{pk_id}','adminController@delete_main_category');

Route::get('/admin/home/add/sub/category','adminController@add_sub_category_view');
Route::post('/admin/home/add/sub/category','adminController@add_sub_category');
Route::get('/admin/home/view/sub/category','adminController@sub_category_list_view');
Route::get('/admin/home/edit/sub/category/{sku}','adminController@edit_sub_category_view');
Route::post('/admin/home/edit/sub/category/{sku}','adminController@edit_sub_category');
Route::get('/admin/home/delete/sub/category/{pk_id}','adminController@delete_sub_category');

Route::get('/admin/home/add/product/type','adminController@add_product_type_view');
Route::post('/admin/home/add/product/type','adminController@add_product_type');
Route::get('/admin/home/view/product/type','adminController@product_type_list_view');
Route::get('/admin/home/edit/product/type/{pk_id}','adminController@edit_product_type_view');
Route::post('/admin/home/edit/product/type/{pk_id}','adminController@edit_product_type');
Route::get('/admin/home/delete/product/type/{id}','adminController@delete_product_type');

Route::get('/admin/home/add/account','adminController@add_account_view');
Route::post('/admin/home/add/account','adminController@add_account_name');
Route::get('/admin/home/view/account','adminController@account_list_view');

Route::get('/admin/home/add/balance','adminController@account_test');
Route::get('/admin/home/add/balance/supplier','adminController@account_supplier');
Route::get('/ajax-subcat-test','adminController@test_account');
Route::post('/admin/add/payment/test','adminController@account_test_form');
Route::post('/admin/add/payment/supplier','adminController@account_supplier_form');
Route::get('/admin/home/add/balance','adminController@account_test');

Route::get('/ajax-subcat-suppliername','adminController@suppliername_account');


Route::get('/admin/home/view/account/detail/{pk_id}/{account_name}','adminController@account_detailed_view');
Route::get('/admin/home/view/account/detail/{pk_id}','adminController@manage_account_detailed_view');

Route::get('/ajax','adminController@balance');

Route::get('/admin/home/view/inc/account/detail/{pk_id}','adminController@inc_account_detailed_view');

Route::get('/admin/home/view/transfer_of_money','adminController@transfer_of_money');

Route::post('/admin/home/add/transfer_of_money','adminController@transfer_money');

Route::get('/admin/home/inventory/print','adminController@inventory_report_print');

Route::get('/admin/home/edit/account/{sku}','adminController@edit_account_view');
Route::post('/admin/home/edit/account/{sku}','adminController@edit_account');
Route::get('/admin/home/delete/account/{pk_id}','adminController@delete_account');


Route::get('/admin/home/add/inventory/list','adminController@add_inventory_view_list');
Route::post('/admin/home/add/inventories','adminController@add_inventories');

Route::get('/admin/home/add/inventory','adminController@add_inventory_view');
Route::post('/admin/home/add/inventory','adminController@add_inventory');
Route::get('/admin/home/view/inventory','adminController@inventory_list_view');
Route::get('/admin/home/view/inventory/detail/{pk_id}','adminController@inventory_detail_view');
Route::get('/admin/home/edit/inventory/{sku}','adminController@edit_inventory_view');
Route::post('/admin/home/edit/inventory/{sku}','adminController@edit_inventory');
Route::get('/admin/home/delete/inventory/{pk_id}','adminController@delete_inventory');


Route::get('/admin/home/add/sale','adminController@add_sale_view');

Route::get('/nh','pc@index');
Route::get('/admin/home/add/sale/invioce/view','adminController@add_sale_invioce_view');

Route::post('/admin/home/add/sale/invioce','adminController@add_sale_invioce');

Route::get('/admin/home/add/bal/invioce','adminController@add_bal_invioce_view');
Route::post('/admin/home/add/bal/invioce','adminController@add_bal_invioce');

Route::get('/admin/home/create/bal/payment/{id}','adminController@create_payment_bal_view');

Route::post('/admin/home/create/bal/payment','adminController@create_payment_bal');

Route::post('/admin/home/add/sale','adminController@add_sale');

Route::get('/admin/home/view/sale/by/customer','adminController@sale_by_customer_list_view');
Route::get('/admin/home/view/bal/by/customer','adminController@bal_by_customer_view');
Route::get('/admin/home/view/bal/by/supplier','adminController@bal_by_supplier_view');
Route::get('/admin/home/view/all/sales','adminController@all_sale');


Route::get('/admin/home/view/sale/payment/history/{id}/{c_name}','adminController@sale_payment_history');


Route::get('/admin/home/edit/invoice/payment/{sale_id}/{pk_id}','adminController@sale_payment_history_edit_view');



Route::get('/admin/home/view/purchase/payment/history/{id}/{s_name}','adminController@purchase_payment_history');


Route::get('/admin/home/view/sale/{id}','adminController@sale_list_view');


Route::get('/admin/home/view/inactive/sale/{id}','adminController@inactive_sale_list_view');
Route::get('/admin/home/view/inactive/purchase/{id}','adminController@inactive_purchase_list_view');

Route::get('/admin/home/view/paid/sale/{id}','adminController@paid_sale_list_view');
Route::get('/admin/home/view/paid/purchase/{id}','adminController@paid_purchase_list_view');

Route::get('/admin/home/view/open/sale/{id}','adminController@open_sale_list_view');

Route::get('/admin/home/view/open/purchase/{id}','adminController@open_purchase_list_view');

Route::get('/admin/home/view/partial/sale/{id}','adminController@partial_sale_list_view');

Route::get('/admin/home/view/partial/purchase/{id}','adminController@partial_purchase_list_view');

Route::get('/admin/home/view/sale/receipt/list/{id}','adminController@sale_list_view_receipt');

Route::get('/admin/home/add/sale/reciept/view','adminController@reciept_sale_add_view');

Route::post('/admin/home/add/sale/reciept','adminController@reciept_sale_add');

Route::get('/admin/home/create/sale/payment/{id}/{sale}','adminController@create_payment_sale_view');

Route::get('/admin/home/create/purchase/payment/{id}','adminController@create_payment_purchase_view');

Route::post('/admin/home/create/purchase_invoice/payment/{id}','adminController@create_payment_purchase');

Route::get('/admin/home/view/purchase/by/supplier/name/deatiled/{id}','adminController@purchase_detailed_by_customer_name');


Route::post('/admin/home/create/sale_invoice/payment/{id}','adminController@create_payment_sale');

Route::post('/admin/home/edit/sale_invoice/payment/{sale_id}/{pk_id}','adminController@edit_payment_sale');




Route::get('/admin/home/view/sale/detail/{id}/{sale}','adminController@sale_detail_view');

Route::get('/admin/home/view/sale/by/customer/deatiled/{id}','adminController@sale_detailed_by_customer');
Route::get('admin/home/view/sale/by/customer/name/deatiled/{id}','adminController@sale_detailed_by_customer_name');

Route::get('new','adminController@new');


Route::get('/admin/home/view/purchase/by/customer/deatiled/{id}','adminController@purchase_detailed_by_customer');





Route::get('/admin/home/edit/sale/{pk_id}','adminController@edit_sale_view');
Route::post('/admin/home/edit/sale/{pk_id}','adminController@edit_sale');
Route::get('/admin/home/delete/sale/{pk_id}','adminController@delete_sale');
Route::get('/admin/home/view/sale/return/by/customer','adminController@sale_return_by_customer_list_view');
Route::get('/admin/home/view/sale/return/{id}','adminController@sale_return_list_view');


Route::get('/admin/home/create/sale/return/payment/{id}','adminController@create_payment_sale_return_view');

Route::get('/admin/home/create/purchase/return/payment/{id}','adminController@create_payment_purchase_return_view');



Route::post('/admin/home/create/sale/return/payment/submit/{pk_id}','adminController@create_payment_sale_return');

Route::post('/admin/home/create/purchase/return/payment/submit/{pk_id}','adminController@create_payment_purchase_return');


Route::get('/admin/home/view/sale/return/detail/{id}','adminController@sale_return_detail_view');
Route::get('/ajax-select-item','adminController@select_item');
Route::get('/ajax-select-sku','adminController@select_sku');

Route::get('/ajax-coa-account','adminController@select_coa');

Route::get('/create/item/name/invoice','adminController@invoice_item_name');

Route::get('/admin/home/add/sale/tax','adminController@add_sale_tax_view');
Route::post('/admin/home/add/sale/tax','adminController@add_sale_tax');

Route::post('/autocomplete/fetch', 'adminController@fetch')->name('autocomplete.fetch');

Route::post('/autocomplete/supplier', 'adminController@fetchsupplier')->name('autocomplete.supplier');

Route::post('/autocomplete/customer', 'adminController@fetchcustomer')->name('autocomplete.customer');

Route::get('/admin/home/add/purchase','adminController@add_purchase_view');
Route::post('/admin/home/add/purchase','adminController@add_purchase');
Route::get('/admin/home/view/purchase/by/supplier','adminController@purchase_by_supplier_list_view');
Route::post('/admin/home/search/purchase','adminController@search_purchase');
Route::post('/admin/home/search/sale','adminController@search_sale');
Route::post('/admin/home/search/sale/tax','adminController@search_sale_tax');

Route::get('/admin/home/do/sale/return/{id}','adminController@sale_return_view');

Route::get('/admin/home/do/purchase/return/{id}','adminController@purchase_return_view');


Route::post('/admin/home/add/sale/invioce/return/{id}','adminController@sale_return');


Route::post('/admin/home/add/purchase/invioce/return/{id}','adminController@purchase_return');



Route::get('/admin/home/view/purchase/{id}','adminController@purchase_list_view');
Route::get('/admin/home/view/purchase/detail/{id}/{purchase}','adminController@purchase_detail_view');

Route::get('/admin/purchase/invoice/print/{id}','adminController@purchase_detail_view_print');
Route::get('/admin/home/edit/purchase/{pk_id}','adminController@edit_purchase_view');
Route::post('/admin/home/edit/purchase/{pk_id}','adminController@edit_purchase');
Route::get('/admin/home/delete/purchase/{pk_id}','adminController@delete_purchase');
Route::get('/admin/home/view/purchase/return/by/supplier','adminController@purchase_return_by_supplier_list_view');
Route::get('/admin/home/view/purchase/return/{id}','adminController@purchase_return_list_view');
Route::get('/admin/home/view/purchase/return/detail/{id}','adminController@purchase_return_detail_view');
Route::get('/ajax-select-item','adminController@select_item');

Route::get('/admin/home/add/purchase/tax','adminController@add_purchase_tax_view');
Route::post('/admin/home/add/purchase/tax','adminController@add_purchase_tax');

Route::get('/admin/home/view/purchase/by/item','adminController@purchase_by_item_list_view');
Route::get('/admin/home/view/purchase/detail/by/item/{id}','adminController@purchase_detail_by_item_view');

Route::get('/admin/home/view/purchase/by/invoice','adminController@purchase_by_invoice_list_view');


Route::post('/admin/home/search/purchase/invoice/by/date','adminController@search_purchase_by_invoice_list_view_date');

Route::post('/admin/home/search/purchase/by/invoice','adminController@purchase_by_invoice_list_view_supplier');


Route::get('/admin/home/view/sale/by/invoice','adminController@sale_by_invoice_list_view');

Route::get('/admin/home/view/sale/by/invoice/pdf','adminController@sale_by_invoice_list_view_pdf');



Route::get('/admin/home/view/list','adminController@admin_list');
Route::get('/admin/home/view/admin/detail/{id}','adminController@admin_detail');
Route::get('/admin/home/add/admin/view','adminController@add_admin_view');
Route::post('/admin/home/add/admin','adminController@create_admin');

Route::get('/admin/home/print/sale/by/customer','adminController@print_page');
Route::get('/admin/home/print/purchase/by/customer','adminController@print_page_purchase');
Route::get('/admin/home/pdf/sale/by/customer','adminController@pdf_sale_by_customer');

Route::get('/admin/home/excel/sale/by/customer','adminController@csv_export');

Route::get('/admin/home/view/trial/balance','adminController@trial_balance');
Route::get('/admin/home/view/trial/balance/print','adminController@trial_balance_print');

Route::get('/admin/home/view/trial/balance/pdf','adminController@trial_balance_pdf');

Route::get('/admin/home/view/trial/balance/detail','adminController@trial_balance_detail');


Route::post('/admin/home/search/sale/by/invoice','adminController@sale_by_invoice_list_view_customer');

Route::post('/admin/home/search/invoice/by/date','adminController@search_sale_by_invoice_list_view_date');

Route::get('/admin/home/view/purchase/detail/by/invoice/{id}','adminController@purchase_detail_by_invoice_view');

Route::get('/admin/home/view/sale/detail/by/invoice/{id}','adminController@sale_detail_by_invoice_view');


Route::get('/admin/home/add/pump','adminController@add_pump_view');
Route::post('/admin/home/add/pump','adminController@add_pump');
Route::get('/admin/home/edit/pump/{id}','adminController@edit_pump_view');
Route::post('/admin/home/edit/pump/{id}','adminController@edit_pump');
Route::get('/admin/home/delete/pump/{id}','adminController@delete_pump');
Route::get('/admin/home/view/pump','adminController@pump_list_view');
Route::get('/admin/home/edit/tank/{id}','adminController@edit_tank_view');
Route::post('/admin/home/edit/tank/{id}','adminController@edit_tank');

Route::get('/admin/home/add/machine/{id}','adminController@add_machine_view');
Route::post('/admin/home/add/machine/{id}','adminController@add_machine');
Route::get('/admin/home/view/machine/{id}','adminController@machine_list_view');
Route::get('/admin/home/view/machine/detail/{id}','adminController@machine_detail_view');
Route::get('/admin/home/edit/machine/{id}','adminController@edit_machine_view');
Route::post('/admin/home/edit/machine/{id}','adminController@edit_machine');
Route::get('/admin/home/delete/machine/{id}','adminController@delete_machine');

Route::get('/admin/home/view/pump/for/purchase','adminController@pump_for_purchase_list_view');
Route::get('/admin/home/view/pump/purchase/by/supplier/{id}','adminController@pump_purchase_by_supplier_list_view');
Route::get('/admin/home/add/pump/purchase/{id}','adminController@add_pump_purchase_view');
Route::post('/admin/home/add/pump/purchase/{id}','adminController@add_pump_purchase');
Route::get('/admin/home/view/pump/purchase/{id}/{pump_id}','adminController@pump_purchase_list_view');
Route::get('/admin/home/view/pump/purchases/detail/{id}/{purchase}','adminController@pump_purchase_detail_view');
Route::get('/admin/home/view/pump/purchase/return/by/supplier/{id}','adminController@pump_purchase_return_by_supplier_list_view');
Route::get('/admin/home/view/pump/purchase/return/{id}/{pump_id}','adminController@pump_purchase_return_list_view');
Route::get('/admin/home/view/pump/purchases/return/detail/{id}','adminController@pump_purchase_return_detail_view');
Route::get('/admin/home/edit/pump/purchase/{pk_id}','adminController@edit_pump_purchase_view');
// Route::post('/admin/home/edit/purchase/{pk_id}','adminController@edit_purchase');
// Route::get('/admin/home/delete/purchase/{pk_id}','adminController@delete_purchase');
// Route::get('/ajax-select-item','adminController@select_item');

Route::get('/admin/home/add/pump/purchase/tax/{id}','adminController@add_pump_purchase_tax_view');
Route::post('/admin/home/add/pump/purchase/tax/{id}','adminController@add_pump_purchase_tax');


 Route::get('/test','adminController@test');
 Route::post('/test','adminController@test_post');

Route::get('/admin/home/view/account/receivable','adminController@account_receivable_list_view');

Route::get('/admin/home/view/account/payable/reporting','adminController@account_payable_reporting');
Route::get('/admin/home/view/account/payable/pdf/download/hd/kj','adminController@account_payable_reporting_pdf');
Route::get('/admin/home/view/account/payable/print','adminController@account_payable_reporting_print');



Route::get('/admin/home/print/accont/recieveable','adminController@account_receivable_list_view_print');

Route::get('/admin/home/print/accont/recieveable/download/pdf','adminController@account_receivable_list_view_pdf');

Route::get('/admin/home/add/account/receivable/view','adminController@add_account_receivable_view');
Route::post('/admin/home/add/account/receivable','adminController@add_account_receivable');
Route::get('/ajax/account/receivable','adminController@select_account_receivable');

Route::get('/admin/home/view/report','adminController@report_list_view');



Route::get('/admin/home/view/inventory/report','adminController@inventory_report');

Route::get('/admin/home/view/inventory/report/download/pdf','adminController@inventory_report_pdf');

Route::get('/admin/home/view/balance/sheet','adminController@balance_sheet');
Route::get('/admin/home/view/balance/sheet/download/pdf','adminController@balance_sheet_pdf');
Route::get('/admin/home/print/balance/sheet','adminController@balance_sheet_print');

Route::get('/admin/home/view/profit/loss/report','adminController@profit_report_view');
Route::get('/admin/home/view/profit/loss/report/print','adminController@profit_report_print');

Route::get('/admin/home/view/profit/loss/report/pdf','adminController@profit_report_pdf');


Route::get('/admin/home/view/account/payable','adminController@account_payable_list_view')->name('account.payable.list');
Route::get('/admin/home/add/account/payable/view','adminController@add_account_payable_view')->name('add.account.payable');
Route::post('/admin/home/add/account/payable','adminController@add_account_payable');
Route::get('/ajax/account/payable','adminController@select_account_payable');

Route::get('/admin/home/view/expense','adminController@expense_list_view');
Route::get('/admin/expense/report','adminController@expense_report');
Route::get('/admin/expense/report/pdf/download','adminController@expense_report_pdf');
Route::get('/admin/expense/report/print','adminController@expense_report_print');

Route::post('/admin/home/search/expense','adminController@search_expense');
Route::get('/admin/home/add/expense/view','adminController@add_expense_view');
Route::post('/admin/home/add/expense','adminController@add_expense');
Route::get('/admin/home/edit/expense/view/{id}','adminController@edit_expense_view');
Route::post('/admin/home/edit/expense/{id}','adminController@edit_expense');

Route::get('/admin/home/view/sale/reports/fg/fg/fg/fg','adminController@sale_report');
Route::get('/admin/home/view/sale/detail/by/item/{id}','adminController@sale_detail_by_item_view');


//Clear Cache facade value:
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
//Reoptimized class loader:
Route::get('/optimize', function() {
    $exitCode = Artisan::call('optimize');
    return '<h1>Reoptimized class loader</h1>';
});
//Route cache:
Route::get('/route-cache', function() {
    $exitCode = Artisan::call('route:cache');
    return '<h1>Routes cached</h1>';
});
//Clear Route cache:
Route::get('/route-clear', function() {
    $exitCode = Artisan::call('route:clear');
    return '<h1>Route cache cleared</h1>';
});
//Clear View cache:
Route::get('/view-clear', function() {
    $exitCode = Artisan::call('view:clear');
    return '<h1>View cache cleared</h1>';
});
//Clear Config cache:
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Clear Config cleared</h1>';
});



Route::get('/set/pass/{username}/{company}','adminController@reset_password_view');

Route::post('/password/change/{username}/{company}','adminController@password_change');

Route::get('/admin/home/add/company/view','adminController@add_company_view');

Route::post('/admin/home/add/company','adminController@add_company');
Route::get('/admin/home/company/list','adminController@company_list_view');
Route::get('/admin/edit/company/view/{id}','adminController@edit_company_view');

Route::post('/admin/edit/company/{id}','adminController@edit_company');
Route::get('/admin/company/detailed/view/{id}','adminController@view_company_detail');
Route::get('/admin/delete/company/{id}','adminController@delete_company');


Route::get('/admin/create/permissions/view','adminController@permission_view');

Route::post('/admin/create/permissions','adminController@add_permission');

//...........employe creation............//

Route::get('/admin/create/employe/view','adminController@add_employe_view');

Route::post('/admin/home/add/employe','adminController@add_employe');
Route::get('/admin/home/view/employe/list','adminController@employe_list_view');

Route::get('/admin/home/employe/detail/view/{id}','adminController@employe_detail_view');

Route::get('/admin/home/edit/employe/{id}','adminController@edit_employe_view');
Route::post('/admin/home/edit/employe/{id}','adminController@edit_employe');
Route::get('/admin/home/delete/employe/{id}','adminController@delete_employe');

Route::get('/admin/home/zero','adminController@zero');


Route::post('/update','adminController@update');