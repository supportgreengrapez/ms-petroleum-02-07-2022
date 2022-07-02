<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Mail;
use PDF;
use Illuminate\Http\Request;
use Response;
use SoapClient;
use App\Cart;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\UsersExport;
class adminController extends Controller
{
    public function admin_login_view()
    {

        if ((session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return Redirect::back();
        }
        else

        {

            return view('admin.login');
        }

    }
    public function logout()
    {
        session()
            ->flush();
        return redirect('/admin');
    }
    public function index(Request $request)
    {

        $this->validate($request, ['username' => 'required', 'password' => 'required']);
        $password = md5($request->input('password'));
        $username = $request->input('username');
        // dd($password,$username);
        $result = DB::select("select* from permissions where username = '$username' and password='$password'");

        // dd($result);
        // return $result;
        if (count($result) > 0)
        {
            if ($result[0]->Admin_Management == 1)
            {
                $request->session()
                    ->put('pk_id', $result[0]->pk_id);
                $request->session()
                    ->put('username', $username);
                $request->session()
                    ->put('name', $result[0]->{'fname'} . ' ' . $result[0]->{'lname'});

                $request->session()

                    ->put('bank_deposit', $result[0]->{'bank_deposit'});
                $request->session()
                    ->put('transfer_money', $result[0]->{'transfer_money'});
                $request->session()
                    ->put('Machine_Management_delete', $result[0]->{'Machine_Management_delete'});

                $request->session()
                    ->put('Admin_Management', $result[0]->{'Admin_Management'});

                $request->session()
                    ->put('Expense_Management', $result[0]->{'Expense_Management'});
                $request->session()
                    ->put('Expense_Management_edit', $result[0]->{'Expense_Management_edit'});
                $request->session()
                    ->put('Expense_Management_delete', $result[0]->{'Expense_Management_delete'});

                $request->session()
                    ->put('Customer_Management', $result[0]->{'Customer_Management'});
                $request->session()
                    ->put('Customer_Management_edit', $result[0]->{'Customer_Management_edit'});
                $request->session()
                    ->put('Customer_Management_delete', $result[0]->{'Customer_Management_delete'});

                $request->session()
                    ->put('Sales_Management', $result[0]->{'Sales_Management'});
                $request->session()
                    ->put('Sales_Management_edit', $result[0]->{'Sales_Management_edit'});
                $request->session()
                    ->put('Sales_Management_delete', $result[0]->{'Sales_Management_delete'});

                $request->session()
                    ->put('Supplier_Management', $result[0]->{'Supplier_Management'});
                $request->session()
                    ->put('Supplier_Management_edit', $result[0]->{'Supplier_Management_edit'});
                $request->session()
                    ->put('Supplier_Management_delete', $result[0]->{'Supplier_Management_delete'});

                $request->session()
                    ->put('Purchase_Management', $result[0]->{'Purchase_Management'});
                $request->session()
                    ->put('Purchase_Management_edit', $result[0]->{'Purchase_Management_edit'});
                $request->session()
                    ->put('Purchase_Management_delete', $result[0]->{'Purchase_Management_delete'});

                $request->session()
                    ->put('Category_Management', $result[0]->{'Category_Management'});
                $request->session()
                    ->put('Category_Management_edit', $result[0]->{'Category_Management_edit'});
                $request->session()
                    ->put('Category_Management_delete', $result[0]->{'Category_Management_delete'});

                $request->session()
                    ->put('Report', $result[0]->{'Report'});
                $request->session()
                    ->put('Report_edit', $result[0]->{'Report_edit'});
                $request->session()
                    ->put('Report_delete', $result[0]->{'Report_delete'});

                $request->session()
                    ->put('Item_Management', $result[0]->{'Item_Management'});
                $request->session()
                    ->put('Item_Management_edit', $result[0]->{'Item_Management_edit'});
                $request->session()
                    ->put('Item_Management_delete', $result[0]->{'Item_Management_delete'});

                $request->session()
                    ->put('Kachi_Parchi', $result[0]->{'Kachi_Parchi'});
                $request->session()
                    ->put('Kachi_Parchi_edit', $result[0]->{'Kachi_Parchi_edit'});
                $request->session()
                    ->put('Kachi_Parchi_delete', $result[0]->{'Kachi_Parchi_delete'});

                $request->session()
                    ->put('Pump_Management', $result[0]->{'Pump_Management'});
                $request->session()
                    ->put('Pump_Management_edit', $result[0]->{'Pump_Management_edit'});
                $request->session()
                    ->put('Pump_Management_delete', $result[0]->{'Pump_Management_delete'});

                $request->session()
                    ->put('Accounts_Management', $result[0]->{'Accounts_Management'});
                $request->session()
                    ->put('Accounts_Management_edit', $result[0]->{'Accounts_Management_edit'});
                $request->session()
                    ->put('Accounts_Management_delete', $result[0]->{'Accounts_Management_delete'});

                $request->session()
                    ->put('type', 'admin');

                return view('admin.home', compact('result'));

            }

            return view('admin.select_company', compact('result'));

        }
        else
        {
            return Redirect::back()
                ->withErrors('Username or Password is incorrect');
        }
    }
    
    public function admin_home()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return view('admin.home');

    }
    

    public function index_company(Request $request, $company, $username)
    {

        $result = DB::select("select* from permissions where username = '$username' and company='$company'");

        // dd($result);
        

        $request->session()
            ->put('pk_id', $result[0]->pk_id);
        $request->session()
            ->put('username', $username);
        $request->session()
            ->put('name', $result[0]->{'fname'} . ' ' . $result[0]->{'lname'});

        $request->session()
            ->put('bank_deposit', $result[0]->{'bank_deposit'});
        $request->session()
            ->put('transfer_money', $result[0]->{'transfer_money'});
        $request->session()
            ->put('Machine_Management_delete', $result[0]->{'Machine_Management_delete'});

        $request->session()
            ->put('Admin_Management', $result[0]->{'Admin_Management'});

        $request->session()
            ->put('Expense_Management', $result[0]->{'Expense_Management'});
        $request->session()
            ->put('Expense_Management_edit', $result[0]->{'Expense_Management_edit'});
        $request->session()
            ->put('Expense_Management_delete', $result[0]->{'Expense_Management_delete'});

        $request->session()
            ->put('Customer_Management', $result[0]->{'Customer_Management'});
        $request->session()
            ->put('Customer_Management_edit', $result[0]->{'Customer_Management_edit'});
        $request->session()
            ->put('Customer_Management_delete', $result[0]->{'Customer_Management_delete'});

        $request->session()
            ->put('Sales_Management', $result[0]->{'Sales_Management'});
        $request->session()
            ->put('Sales_Management_edit', $result[0]->{'Sales_Management_edit'});
        $request->session()
            ->put('Sales_Management_delete', $result[0]->{'Sales_Management_delete'});

        $request->session()
            ->put('Supplier_Management', $result[0]->{'Supplier_Management'});
        $request->session()
            ->put('Supplier_Management_edit', $result[0]->{'Supplier_Management_edit'});
        $request->session()
            ->put('Supplier_Management_delete', $result[0]->{'Supplier_Management_delete'});

        $request->session()
            ->put('Purchase_Management', $result[0]->{'Purchase_Management'});
        $request->session()
            ->put('Purchase_Management_edit', $result[0]->{'Purchase_Management_edit'});
        $request->session()
            ->put('Purchase_Management_delete', $result[0]->{'Purchase_Management_delete'});

        $request->session()
            ->put('Category_Management', $result[0]->{'Category_Management'});
        $request->session()
            ->put('Category_Management_edit', $result[0]->{'Category_Management_edit'});
        $request->session()
            ->put('Category_Management_delete', $result[0]->{'Category_Management_delete'});

        $request->session()
            ->put('Report', $result[0]->{'Report'});
        $request->session()
            ->put('Report_edit', $result[0]->{'Report_edit'});
        $request->session()
            ->put('Report_delete', $result[0]->{'Report_delete'});

        $request->session()
            ->put('Item_Management', $result[0]->{'Item_Management'});
        $request->session()
            ->put('Item_Management_edit', $result[0]->{'Item_Management_edit'});
        $request->session()
            ->put('Item_Management_delete', $result[0]->{'Item_Management_delete'});

        $request->session()
            ->put('Kachi_Parchi', $result[0]->{'Kachi_Parchi'});
        $request->session()
            ->put('Kachi_Parchi_edit', $result[0]->{'Kachi_Parchi_edit'});
        $request->session()
            ->put('Kachi_Parchi_delete', $result[0]->{'Kachi_Parchi_delete'});

        $request->session()
            ->put('Pump_Management', $result[0]->{'Pump_Management'});
        $request->session()
            ->put('Pump_Management_edit', $result[0]->{'Pump_Management_edit'});
        $request->session()
            ->put('Pump_Management_delete', $result[0]->{'Pump_Management_delete'});

        $request->session()
            ->put('Accounts_Management', $result[0]->{'Accounts_Management'});
        $request->session()
            ->put('Accounts_Management_edit', $result[0]->{'Accounts_Management_edit'});
        $request->session()
            ->put('Accounts_Management_delete', $result[0]->{'Accounts_Management_delete'});

        $request->session()
            ->put('company', $company);

        $request->session()
            ->put('type', 'admin');

        return view('admin.home', compact('result'));

    }

    public function customer_list_view()
    {

        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from customer");

        return view('admin.customer_list_view', compact('result'));
    }

    public function add_customer_view()
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return view('admin.add_customer_view');
    }

    public function add_customer(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $customer_name = $request->input('customer_name');

        $supp = DB::select("select* from customer where customer_name = '$customer_name'");
        //   return $supp;
        if (count($supp) > 0)
        {
            return Redirect::back()->withErrors('Customer already Exist');
        }
        else
        {
            DB::insert("insert into customer(main_customer,customer_name,cnic,phone,billing_address,ntn,strn,opening_balance,current_balance) values (?,?,?,?,?,?,?,?,?)", array(
                $request->input('main_customer') ,
                $request->input('customer_name') ,

                $request->input('cnic') ,
                $request->input('phone') ,
                $request->input('billing_address') ,
                $request->input('ntn') ,
                $request->input('strn') ,
                $request->input('opening_balance') ,
                $request->input('current_balance')
            ));

        }

        // dd($request->input('customer_name'),date('Y:m:y H:i:s'),$request->input('current_balance'));
        

        // $last_id = DB::getPdo()->lastInsertId();
        // if ($request->input('current_balance') < 0)
        // {
        //     // $amount_receivable = array();
        //     //     $amount_receivable['customer_name'] = $last_id;
        //     //      $amount_receivable['date'] = date('Y:m:y H:i:s');
        //     //     $amount_receivable['receiving_account'] = $request->input('current_balance');
        //     //     // dd($amount_receivable);
        //     //     $data = DB::table('account_receivable')->insert($amount_receivable);
        //     //     // dd($data);
        //     //      // DB::insert("insert into account_receivable (customer_name,date,receiving_account) values (?,?,?)",array($request->input('customer_name'),date('Y:m:y H:i:s'),$request->input('current_balance')));
        

        //     //   $result = DB::select("select* from account_receivable");
        

        //     $total_amount = $request->input('opening_balance');
        //     $account = DB::select("select* from account where account_type = 'Current Liabilities'");
        //     $c_balance = $account[0]->balance - $total_amount;
        //     $inc_balance = $account[0]->increase - $total_amount;
        //     DB::table('account')->where('account_type', "Current Liabilities")
        //         ->update(['balance' => $c_balance]);
        //     DB::table('account')->where('account_type', "Current Liabilities")
        //         ->update(['increase' => $inc_balance]);
        // }
        // else
        // {
        //     $total_amount = $request->input('opening_balance');
        //     $account = DB::select("select* from account where account_type = 'Cash'");
        //     $c_balance = $account[0]->balance + $total_amount;
        //     $inc_balance = $account[0]->increase + $total_amount;
        //     DB::table('account')->where('account_type', "Cash")
        //         ->update(['balance' => $c_balance]);
        //     DB::table('account')->where('account_type', "Cash")
        //         ->update(['increase' => $inc_balance]);
        //     $account = DB::select("select* from account where account_type = 'Capital'");
        //     $c_balance = $account[0]->balance + $total_amount;
        //     $inc_balance = $account[0]->increase + $total_amount;
        //     DB::table('account')->where('account_type', "Capital")
        //         ->update(['balance' => $c_balance]);
        //     DB::table('account')->where('account_type', "Capital")
        //         ->update(['increase' => $inc_balance]);
        // }
        return Redirect::back()
            ->withErrors('Customer Added');
    }

    //       if(count($account)<0)
    //   {
    //       $c_balance = $account[0]->balance - $total_amount;
    //       DB::table('account')->where('account_type',"Account Receivable")->update(['balance' =>$c_balance]);
    //   }
    // else{
    //     DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)",array('Account Receivable','Account Receivable','Account Receivable',$total_amount,NOW()));
    //     }
    

    public function customer_detail_view($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from customer where pk_id='$id'");

        return view('admin.customer_detail_view', compact('result'));
    }
    public function delete_customer($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::delete("delete from customer where pk_id='$id'");

        return redirect()->back();
    }
    public function edit_customer_view($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from customer where pk_id='$id'");

        return view('admin.edit_customer_view', compact('result'));
    }

    public function edit_customer(Request $request, $id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::table('customer')
            ->where('pk_id', $id)->update(['customer_name' => $request->input('customer_name') , 'cnic' => $request->input('cnic') , 'phone' => $request->input('phone') , 'billing_address' => $request->input('billing_address') , 'ntn' => $request->input('ntn') , 'strn' => $request->input('strn') , 'opening_balance' => $request->input('opening_balance') , 'current_balance' => $request->input('current_balance') ]);

        return redirect('/admin/home/customer/list/view');
    }

    public function search_customer(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        // dd($request->all(  ));
        $id_from = $request->input('id_from');
        $id_to = $request->input('id_to');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $opening_balance_from = $request->input('opening_balance_from');
        $opening_balance_to = $request->input('opening_balance_to');

        $current_balance_from = $request->input('current_balance_from');
        $current_balance_to = $request->input('current_balance_to');

        //   $result = DB::select("select* from supplier where pk_id BETWEEN '$id_from' AND '$id_to' and current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ");
        //   return $result;
        

        $result = "Select* from customer where ";
        $check = 0;
        if ($request->input('id_from'))
        {
            $result .= "pk_id BETWEEN '$id_from' AND '$id_to' ";
            $check = 1;
        }
        // dd($result);
        if ($request->input('date_from'))
        {
            if ($check == 1)
            {
                $result .= "and date BETWEEN '$date_from' AND '$date_to' ";
            }
            else
            {
                $result .= "date BETWEEN '$date_from' AND '$date_to' ";
                $check = 1;
            }
        }
        if ($request->input('opening_balance_from'))
        {
            if ($check == 1)
            {
                $result .= "and opening_balance BETWEEN '$opening_balance_from' AND '$opening_balance_to' ";
            }
            else
            {
                $result .= "opening_balance BETWEEN '$opening_balance_from' AND '$opening_balance_to' ";
                $check = 1;
            }

        }
        if ($request->input('current_balance_from'))
        {
            if ($check == 1)
            {
                $result .= "and current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ";
            }
            else
            {
                $result .= "current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ";
                $check = 1;
            }
        }
        // dd($result);
        $result = DB::select("$result");
        // dd($result);
        return view('admin.customer_list_view', compact('result'));

    }

    public function search_account(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        //   $result = DB::select("select* from supplier where pk_id BETWEEN '$id_from' AND '$id_to' and current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ");
        //   return $result;
        

        $result = "Select* from account where ";
        $check = 0;

        if ($request->input('date_from'))
        {
            if ($check == 1)
            {
                $result .= "and date BETWEEN '$date_from' AND '$date_to' ";
            }
            else
            {
                $result .= "date BETWEEN '$date_from' AND '$date_to' ";
                $check = 1;
            }
        }

        // dd($result);
        $result = DB::select("$result");
        // dd($result);
        return view('admin.view_account_list', compact('result'));

    }

    ///////////////////////////////////////////////////////////////////
    public function supplier_list_view()
    {

        {
            if (!(session()->has('type') && session()
                ->get('type') == 'admin'))
            {
                return redirect('/admin');
            }

            $result = DB::select("select* from supplier");

            return view('admin.supplier_list_view', compact('result'));
        }

    }
    public function add_supplier_view()
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return view('admin.add_supplier_view');
    }

    public function add_supplier(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $supplier = $request->input('supplier_name');

        $supp = DB::select("select* from supplier where supplier_name = '$supplier'");
        //   return $supp;
        if (count($supp) > 0)
        {
            return Redirect::back()->withErrors('Supplier already Exist');
        }
        else
        {
            DB::insert("insert into supplier(supplier_name,cnic,phone,billing_address,ntn,strn,opening_balance,current_balance) values (?,?,?,?,?,?,?,?)", array(
                $request->input('supplier_name') ,
                $request->input('cnic') ,
                $request->input('phone') ,
                $request->input('billing_address') ,
                $request->input('ntn') ,
                $request->input('strn') ,
                $request->input('opening_balance') ,
                $request->input('current_balance')
            ));

        }

        // $last_id = DB::getPdo()->lastInsertId();
        // $dataa = array();
        // $dataa['supplier_name'] = $last_id;
        // $dataa['date'] = date('Y:m:d H:i:s');
        // $dataa['amount_payed'] = $request->input('current_balance');
        // DB::table('account_payable')
        //     ->insert($dataa);
        // //     DB::insert("insert into account_payable (supplier_name,date,amount_payed,paying_method,paying_account) values (?,?,?,?,?)",array($request->input('supplier_name'),$request->input('date'),$request->input('amount_payed'),$request->input('paying_method'),$request->input('paying_account')));
        // // $result = DB::select("select* from account_payable");
        

        // $result = DB::select("select* from account_payable");
        // $total_amount = $request->input('current_balance');
        // $account = DB::select("select* from account where account_type = 'Account Payable'");
        // if (count($account) > 0)
        // {
        //     $c_balance = $account[0]->balance + $total_amount;
        //     DB::table('account')->where('account_type', "Account Payable")
        //         ->update(['balance' => $c_balance]);
        // }
        // else
        // {
        //     DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
        //         'Account Receivable',
        //         'Account Receivable',
        //         'Account Receivable',
        //         $total_amount,
        //         NOW()
        //     ));
        // }
        // if (count($account) < 0)
        // {
        //     $c_balance = $account[0]->balance + $total_amount;
        //     DB::table('account')->where('account_type', "Account Payable")
        //         ->update(['balance' => $c_balance]);
        // }
        // else
        // {
        //     DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
        //         'Account Receivable',
        //         'Account Receivable',
        //         'Account Receivable',
        //         $total_amount,
        //         NOW()
        //     ));
        // }
        return Redirect::back()
            ->withErrors('Supplier Added');
    }

    public function supplier_detail_view($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from supplier where pk_id='$id'");

        return view('admin.supplier_detail_view', compact('result'));
    }
    public function delete_supplier($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::delete("delete from supplier where pk_id='$id'");

        return redirect()->back();
    }
    public function edit_supplier_view($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from supplier where pk_id='$id'");

        return view('admin.edit_supplier_view', compact('result'));
    }

    public function edit_supplier(Request $request, $id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::table('supplier')
            ->where('pk_id', $id)->update(['supplier_name' => $request->input('supplier_name') , 'cnic' => $request->input('cnic') , 'phone' => $request->input('phone') , 'billing_address' => $request->input('billing_address') , 'ntn' => $request->input('ntn') , 'strn' => $request->input('strn') , 'opening_balance' => $request->input('opening_balance') , 'current_balance' => $request->input('current_balance') ]);

        return redirect('/admin/home/supplier/list/view');
    }

    public function search_supplier(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $id_from = $request->input('id_from');
        $id_to = $request->input('id_to');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $opening_balance_from = $request->input('opening_balance_from');
        $opening_balance_to = $request->input('opening_balance_to');

        $current_balance_from = $request->input('current_balance_from');
        $current_balance_to = $request->input('current_balance_to');

        //   $result = DB::select("select* from supplier where pk_id BETWEEN '$id_from' AND '$id_to' and current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ");
        //   return $result;
        

        $result = "Select* from supplier where ";

        $check = 0;
        if ($request->input('id_from'))
        {
            $result .= "pk_id BETWEEN '$id_from' AND '$id_to' ";
            $check = 1;
        }
        // dd($result);
        if ($request->input('date_from'))
        {
            if ($check == 1)
            {
                $result .= "and date BETWEEN '$date_from' AND '$date_to' ";
            }
            else
            {
                $result .= "date BETWEEN '$date_from' AND '$date_to' ";
                $check = 1;
            }
        }
        if ($request->input('opening_balance_from'))
        {
            if ($check == 1)
            {
                $result .= "and opening_balance BETWEEN '$opening_balance_from' AND '$opening_balance_to' ";
            }
            else
            {
                $result .= "opening_balance BETWEEN '$opening_balance_from' AND '$opening_balance_to' ";
                $check = 1;
            }

        }

        if ($request->input('current_balance_from'))
        {
            $result .= "current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ";
            $check = 1;
        }

        //     if($request->input('current_balance_from'))
        //     {
        //         if($check==1)
        //         {
        //                   $result .= "and current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ";
        //     }
        //     else{
        //         $result .= "current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ";
        //         $check = 1;
        //     }
        // }
        // dd($result);
        $result = DB::select("$result");
        return view('admin.supplier_list_view', compact('result'));

    }

    /////////////////////////////////////////////////////
    public function main_category_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from main_category");

        return view('admin.view_main_category_list', compact('result'));

    }

    public function add_main_category_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return view('admin.add_main_category_view');

    }

    public function add_main_category(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $cat = $request->input('mainCategory');
        // if(($request->input('mainCategory'))>0)
        // {
        $item_id = substr($cat, 0, 2);
        $count = DB::select("select* from main_category order by SKU desc");
        if (count($count) > 0)
        {
            $count = $count[0]->SKU;
            $count = $count + 1;
            $item_id = $item_id . $count;
        }

        //  return  $item_id;
        $result = DB::select(DB::raw("SELECT * FROM main_category WHERE main_category = :value") , array(
            'value' => $cat,
        ));
        if (count($result) > 0)
        {
            return Redirect::back()->withErrors('Category already Exist');

        }
        else

        {

            DB::insert("insert into main_category (item_id,main_category) values (?,?)", array(
                $item_id,
                $request->input('mainCategory')
            ));

        }
        return Redirect::back()
            ->withErrors('Category Added');
        // }
        

        
    }
    public function edit_main_category_view($sku)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from main_category where SKU = '$sku'");

        return view('admin.edit_main_category', compact('result'));

    }

    public function edit_main_category(Request $request, $sku)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $cat = $request->input('mainCategory');
        $item_id = substr($cat, 0, 2);

        $count = DB::select("select* from main_category where SKU = '$sku' ");
        $count = $count[0]->SKU;
        $item_id = $item_id . $count;
        // dd($item_id);
        $result = DB::select("select* from main_category where main_category = '$cat' ");
        if (count($result) > 0)
        {
            return Redirect::back()->withErrors('Category already Exist');

        }
        else

        {

            $main_category = $request->input('mainCategory');

            DB::table('main_category')
                ->where('SKU', $sku)->update(['item_id' => $item_id, 'main_category' => $main_category]);
            return redirect('/admin/home/view/main/category');

        }
    }

    public function delete_main_category($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        DB::delete("delete from main_category where SKU = '$id'");

        return redirect()->back();
    }

    ////////////////////////////////////
    public function add_product_type_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from main_category");
        $result1 = DB::select("select* from sub_category");
        return view('admin.add_product_type_view', compact('result', 'result1'));
    }

    public function add_product_type(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        // ============================ type ================================//
        $category = $request->input('mainCategory');
        $a = $request->input('sub_item');
        $name = $request->input('name');
        // if(( $request->input('name'))>0)
        // {
        $inventory = DB::select("select * from product_type where main_category='$category' and sub_category = '$a' and product_type = '$name'");
        if (count($inventory) > 0)
        {
            return Redirect::back()->withErrors('Item Name already Exist');
        }
        else
        {
            $sub_category = DB::select(DB::raw("SELECT * FROM sub_category WHERE sub_category = :value") , array(
                'value' => $a,
            ));

            if (count($sub_category) > 0)
            {
                $a = $sub_category[0]->sub_category;

            }
            else
            {

                $sub_category = DB::select(DB::raw("SELECT * FROM sub_category WHERE SKU = :value") , array(
                    'value' => $a,
                ));

                if (count($sub_category) > 0)

                {
                    $a = $sub_category[0]->sub_category;
                }
                else
                {
                    $a = "";
                }
            }
            $inventory = DB::select("select* from product_type where main_category ='$category' and sub_category = '$a' order by pk_id desc");
            if (count($inventory) > 0)
            {
                $sub_category = DB::select("select* from sub_category where main_category = '$category' and sub_category='$a'");
                if (count($sub_category) > 0)
                {
                    $sub_item_id = $sub_category[0]->sub_item_id;
                }
                $sku = $inventory[0]->sku;
                $sku = substr($sku, strpos($sku, "-") + 1);
                $sku = substr($sku, strpos($sku, "-") + 1);
                $sku = substr($sku, 2);
                $sku = $sku + 1;
                $inventory_id = substr($name, 0, 2);
                $sku = $sub_item_id . "-" . $inventory_id . $sku;
            }
            else
            {
                $sub_category = DB::select("select* from sub_category where main_category = '$category' and sub_category='$a'");
                // return $sub_category;
                if (count($sub_category) > 0)
                {
                    $sub_item_id = $sub_category[0]->sub_item_id;
                }
                $inventory_id = substr($name, 0, 2);
                $sku = $sub_item_id . "-" . $inventory_id . "1";
            }

            DB::insert("insert into product_type (sku,main_category,sub_category,product_type,description) values (?,?,?,?,?)", array(
                $sku,
                $category,
                $a,
                $request->input('name') ,
                $request->input('description')
            ));
            //  return redirect('/admin/home/view/product/type');
            
        }
        // }
        return redirect('/admin/home/view/product/type');

    }

    public function edit_product_type_view($pk_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from product_type where pk_id = '$pk_id'");

        return view('admin.edit_inventory', compact('result'));

    }

    public function edit_product_type(Request $request, $pk_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $cat = $request->input('productType');
        $cat1 = urldecode($request->input('mainCategory'));

        $cat2 = $request->input('subCategory');

        $result = DB::select(DB::raw("SELECT * FROM product_type WHERE product_type = :value and main_category= :value2 and sub_category= :value3 ") , array(
            'value' => $cat,
            'value2' => $cat1,
            'value3' => $cat2,
        ));
        if (count($result) > 0)
        {
            return Redirect::back()->withErrors('Product Type already Exist');

        }
        else

        {

            DB::table('product_type')
                ->where('pk_id', $pk_id)->update(['product_type' => $cat, 'main_category' => $cat1, 'sub_category' => $cat2]);
            return redirect('/admin/home/view/product/type');

        }
    }
    public function product_type_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from product_type");

        return view('admin.product_type_list_view', compact('result'));

    }

    ////////////////////////////////////
    public function add_sub_category_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from main_category");
        return view('admin.add_sub_category_view', compact('result'));
    }

    public function add_sub_category(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $category = $request->input('mainCategory');

        $cat = $request->input('subCategory');

        $result = DB::select(DB::raw("SELECT * FROM sub_category WHERE sub_category = :value and main_category= :value2") , array(
            'value' => $cat,
            'value2' => $category,
        ));

        //     $result = DB::select("select* from sub_category where sub_category = '$cat' and main_category='$category'  ");
        if (count($result) > 0)
        {
            return Redirect::back()->withErrors('Subcategory already Exist');

        }
        else

        {

            $category = $request->input('mainCategory');

            $main_category = DB::select("select* from main_category where main_category='$category' ");
            if (count($main_category) > 0)
            {
                $item_id = $main_category[0]->item_id;
            }
            $sub_category = DB::select("select* from sub_category where main_category='$category' order by SKU desc");
            if (count($sub_category) > 0)
            {
                $sub_item_id = $sub_category[0]->sub_item_id;
                $sub_item_id = substr($sub_item_id, strpos($sub_item_id, "-") + 1);
                $sub_item_id = substr($sub_item_id, 2);
                $sub_item_id = $sub_item_id + 1;
            }
            else
            {
                $sub_item_id = 1;
            }
            $sub_id = substr($cat, 0, 2);
            $sub_item_id = $item_id . "-" . $sub_id . $sub_item_id;
            DB::insert("insert into sub_category (sub_item_id,main_category,sub_category) values (?,?,?)", array(
                $sub_item_id,
                $category,
                $request->input('subCategory')
            ));
            return Redirect::back()
                ->withErrors('Sub Category Added');
        }
    }

    public function sub_category_list_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from sub_category");

        return view('admin.view_sub_category_list', compact('result'));

    }

    public function edit_sub_category_view($sku)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from main_category");

        $result1 = DB::select("select* from sub_category where SKU = '$sku'");

        return view('admin.edit_sub_category', compact('result', 'result1'));

    }

    public function edit_sub_category(Request $request, $sku)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $category = $request->input('mainCategory');
        $cat = $request->input('subCategory');

        $result = DB::select(DB::raw("SELECT * FROM sub_category WHERE sub_category = :value and main_category= :value2") , array(
            'value' => $cat,
            'value2' => $main_category,
        ));

        if (count($result) > 0)
        {
            return Redirect::back()->withErrors('Subcategory already Exist');

        }
        else

        {

            $main_category = DB::select("select* from main_category where main_category='$category' ");
            if (count($main_category) > 0)
            {
                $item_id = $main_category[0]->item_id;
            }
            $sub_category = DB::select("select* from sub_category where SKU ='$sku'");
            if (count($sub_category) > 0)
            {
                $sub_item_id = $sub_category[0]->sub_item_id;
                $sub_item_id = substr($sub_item_id, strpos($sub_item_id, "-") + 1);
                $sub_item_id = substr($sub_item_id, 2);
            }
            else
            {
                $sub_item_id = 1;
            }
            $sub_id = substr($cat, 0, 2);
            $sub_item_id = $item_id . "-" . $sub_id . $sub_item_id;
            DB::table('sub_category')->where('SKU', $sku)->update(['sub_item_id' => $sub_item_id, 'main_category' => $category, 'sub_category' => $cat]);
            return redirect('/admin/home/view/sub/category');

        }
    }

    public function delete_sub_category($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        DB::delete("delete from sub_category where SKU = '$id'");

        return redirect()->back();
    }

    public function delete_sale_list($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        // $result = DB::select("select * from detail_sale where sale_id = '$id' ");
        // $quantity = $result[0]->quantity;
        // $sku = $result[0]->sku;
        // //   return $quantity;
        // $result1 = DB::select("select * from inventory where sku = '$sku' ");
        // $new_q = $result1[0]->stock;
        // $new_q1 = $new_q + $quantity;
        // DB::table('inventory')->where('sku', $sku)->update(['stock' => $new_q1]);
        // DB::delete("delete from sale where pk_id = '$id'");
        // DB::delete("delete from detail_sale where sale_id = '$id'");
        

        DB::table('sale')
            ->where('pk_id', $id)->update(['status' => 'Inactive']);

        return redirect()
            ->back();
    }

    public function delete_purchase_list($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        // $result = DB::select("select * from detail_purchase where purchase_id = '$id' ");
        // $quantity = $result[0]->quantity;
        // $sku = $result[0]->sku;
        // $op = $result[0]->amount;
        // //   return $quantity;
        // $result1 = DB::select("select * from inventory where sku = '$sku' ");
        // $new_q = $result1[0]->stock;
        // $new_op = $result1[0]->opening_balance;
        // $new_op1 = $new_op + $op;
        // $new_q1 = $new_q + $quantity;
        // DB::table('inventory')->where('sku', $sku)->update(['stock' => $new_q1]);
        // DB::table('inventory')->where('sku', $sku)->update(['opening_balance' => $new_op1]);
        // DB::delete("delete from purchase where pk_id = '$id'");
        // DB::delete("delete from detail_purchase where purchase_id = '$id'");
        

        DB::table('purchase')
            ->where('pk_id', $id)->update(['status' => 'Inactive']);

        return redirect()
            ->back();
    }

    public function add_account_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $account_name = DB::select("select * from account where account_name !='NULL' ");
        $account_nature = DB::select("select * from account_nature  where nature_of_account != 'Purchase'");
        $account_type = DB::select("select * from account_type");
        // return $account_name;
        return view('admin.coa.add_account_view', compact('account_name', 'account_nature', 'account_type'));
    }

    //     public function add_account(Request $request) {
    //         if(!(session()->has('type') && session()->get('type')=='admin'))
    // {
    //    return redirect('/admin');
    // }
    //               $date = $request->input('date');
    //               $subbb = $request->input('Cash_and_Cash_Equilants');
    //               $Purchase = $request->input('Purchase');
    

    // $sub = $request->input('sub_account');
    // // return $Purchase;
    // // return $sub;
    //             if(empty($sub) )
    //             {
    //               DB::insert("insert into account (account_type,account_name,description,balance,date) values (?,?,?,?,?)",array($request->input('Purchase'),$request->input('account_name'),$request->input('description'),$request->input('balance'),$date));
    

    //             }
    //             else
    //             {
    

    //               DB::insert("insert into account (account_type,sub_account,description,balance,date) values (?,?,?,?,?)",array($request->input('sub_account'),  $request->input('account_name'),$request->input('description'),$request->input('balance'),$date));
    

    //             }
    

    //              return redirect('/admin/home/view/account');
    // }
    

    public function add_account(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $date = $request->input('date');

        $Cash_and_Cash_Equilants = $request->input('Cash_and_Cash_Equilants');
        // return $Cash_and_Cash_Equilants;
        $Purchase = $request->input('Purchase');

        $Account_Reciveable = $request->input('Account_Reciveable');

        $Account_Payable = $request->input('Account_Payable');

        $Fixed_Asset = $request->input('Fixed_Asset');

        $Expense = $request->input('Expense');

        $Current_Asset = $request->input('Current_Asset');

        $Revenue = $request->input('Revenue');

        $Owners_Equity = $request->input('Owners_Equity');

        $Liabilities = $request->input('Current Liabilities');

        $detail_type = $request->input('detail_type');

        if ($request->input('detail_type') == 'Cash_and_Cash_Equilants')
        {
            $detail_type = 'Cash';
        }
        elseif ($request->input('detail_type') == 'Account_Payable')
        {
            $detail_type = 'Account Payable';
        }
        elseif ($request->input('detail_type') == 'Account_Reciveable')
        {
            $detail_type = 'Current Liabilities';
        }
        elseif ($request->input('detail_type') == 'Revenue')
        {
            $detail_type = 'Sales Retail';
        }
        // return $detail_type;
        

        // return $request->input('account_name');
        $sub = $request->input('sub_account');

        if (empty($sub))
        {

            DB::insert("insert into account (account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                $detail_type,
                $request->input('account_name') ,
                $request->input('description') ,
                $request->input('balance') ,
                $date
            ));

        }
        else
        {
            return $request->input('sub_account');
            DB::insert("insert into account (account_type,sub_account,description,balance,date) values (?,?,?,?,?)", array(
                $request->input('sub_account') ,
                $request->input('account_name') ,
                $request->input('description') ,
                $request->input('balance') ,
                $date
            ));

        }
        $total_amount = $request->input('balance');
        if ($request->input('detail_type') == "Capital")
        {
            $account = DB::select("select* from account where account_type = 'Cash'");
            if (count($account) > 0)
            {
                $c_balance = $account[0]->increase + $total_amount;
                // DB::table('account')->where('pk_id',$account[0]->pk_id)->update(['balance' =>$c_balance]);
                DB::table('account')->where('pk_id', $account[0]->pk_id)
                    ->update(['increase' => $c_balance]);
            }
            else
            {

                DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                    'Account Receivable',
                    'Account Receivable',
                    'Account Receivable',
                    $total_amount,
                    NOW()
                ));

            }

            $accountss = DB::select("select* from account where account_type = 'Capital'");

            if (count($accountss) > 0)
            {
                $c_balance = $accountss[0]->increase + $total_amount;

                DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                    ->update(['increase' => $c_balance]);

            }

        }

        return redirect('/admin/home/view/account');

    }

    public function account_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {

            return redirect('/admin');
        }
        // ->where('account.pk_id','account_receivable.acount_type_id')->where('account.pk_id','account_payable.acount_type_id')->
        // $result = DB::table('account')->join('account_receivable','account.pk_id','=','account_receivable.acount_type_id')->join('account_payable','account.pk_id','=','account_payable.acount_type_id')->select('account.*',DB::raw('SUM(account_receivable.amount_received) As account_receivable'),DB::raw('SUM(account_payable.amount_payed) As account_payable'))->get();
        $result = DB::select('select * from account ');
        // $total_invest = DB::select("select SUM(amount) from bank_deposit where account_type = '$accounts'");
        // $recievable_sum = DB::table('account_receivable')->SUM('amount_received');
        // // dd($recievable_sum);
        // $payed_sum = DB::table('account_payable')->SUM('amount_payed');
        // $expence_sum = DB::table('expense')->SUM('amount');
        // $sale_sum = DB::table('sale')->where('sale_type','=','sale')->SUM('total_amount');
        // $purchase_sum= DB::table('purchase')->where('purchase_type','=','purchase')->SUM('total_amount');
        // // dd($purchase_sum);
        //   // $total_amount = DB::select("select SUM(total_amount) from purchase where purchase_type = 'purchase'");
        // // $sale_sum = DB::select("select SUM(total_amount) from sale where sale_type = 'sale'");
        // // dd($sale_sum,$expence_sum);
        // $result = json_decode(json_encode($result), true);
        // $count = count($result);
        // $result[0]['sum_amount']=1500;
        // $result[1]['sum_amount']=$recievable_sum;
        // $result[2]['sum_amount']=$payed_sum;
        // $result[3]['sum_amount']=$expence_sum;
        // $result[4]['sum_amount']=$sale_sum;
        // $result[5]['sum_amount']=$purchase_sum;
        // $result[6]['sum_amount']=$purchase_sum;
        // $i = 7;
        // if($count>7)
        // {
        //   foreach ($result as $value) {
        //     $result[$i]['sum_amount'] = 'Not Connected';
        //     if($i == $count)
        //     break;
        //   }
        // }
        // dd($result);
        return view('admin.view_account_list', compact('result'));

    }

    public function account_detailed_view(Request $request, $pk_id, $account_name)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        //  return $account_name;
        $sub_account = DB::select("select sub_account,account_name from account where pk_id= '$pk_id'");
        //  return $sub_account;
        //  $result1= $result1[0]->account_name;
        // $sub_account =$sub_account[0]->sub_account ;
        //  return $sub_account;
        if ($sub_account[0]->sub_account == "$account_name")
        {
            // return "inve";
            $resultbal = DB::select("select* from account where account_name='$account_name'   ");
            //  return $resultbal;
            $result = DB::select("select * from expense where account_name= '$pk_id'");
            // return $result;
            $result2 = DB::select("select * from bank_deposit where account_type= '$pk_id'");
            // return $result2;
            return view('admin.view_dec_account_detail', compact('result2', 'result', 'resultbal'));
        }

        if ($sub_account[0]->account_type == 'Owners Equity')
        {
            //  return "sd";
            $resultbal = DB::select("select* from account where account_name='$account_name'   ");
            //  return $resultbal;
            $result3 = DB::select("select * from bank_deposit where main_account='$pk_id' ");
            $result4 = DB::select("select * from expense where main_account='$pk_id' ");
            // $result4= DB::select("select amount from expense where main_account='$pk_id' ");
            // $totat = DB::table('expense')->sum('amount');
            // return $result3;
            return view('admin.view-machine-table', compact('result3', 'result4'));
        }

        if ($sub_account[0]->sub_account == "$account_name")
        {
            // return "inve";
            $resultbal = DB::select("select* from account where account_name='$account_name'   ");
            //  return $resultbal;
            $result = DB::select("select * from expense where account_name= '$pk_id'");
            // return $result;
            $result2 = DB::select("select * from bank_deposit where account_type= '$pk_id'");
            // return $result2;
            return view('admin.view_dec_account_detail', compact('result2', 'result', 'resultbal'));
        }
        if ($sub_account[0]->sub_account == "$account_name")
        {
            // return "drr";
            $result = DB::select("select * from expense where account_name= '$pk_id'");
            $resultbal = DB::select("select* from account where account_name='$account_name'   ");

            return view('admin.view_dec_account_detail', compact('result', 'resultbal'));
        }

    }

    public function manage_account_detailed_view(Request $request, $pk_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $pk_id;
        $sub_account = DB::select("select sub_account,account_type,account_name from account where pk_id= '$pk_id'");
        //  return $sub_account;
        $sub_accountss = DB::select("select account_name from account where pk_id= '$pk_id'");

        // $sub_accountss = DB::select("select pk_id from account where pk_id= '$pk_id'");
        // return $sub_accountss;
        $sub_accountss = $sub_accountss[0]->account_name;
        // return $sub_accountss;
        // $sub_account =$sub_account[0]->sub_account ;
        //  return $sub_accountss[0]->account_name;
        if ($sub_account[0]->account_type == 'Sales Retail')
        {
            //  return "sd";
            $p_invoice = "0";
            $s_invoice = "0";
            $bank_deposit = "0";
            $result3 = "0";
            $result4 = "0";
            $purchase = "0";
            $purchase_invoice = "0";
            $sale = DB::select("select * from sale  ");
            $sale_invoice = DB::select("select * from sale_invoice  ");

            return view('admin.view-machine-table', compact('bank_deposit', 'sale', 'result3', 'result4', 'sale_invoice', 'purchase', 'purchase_invoice', 'p_invoice', 's_invoice'));
        }

        if ($sub_account[0]->account_type == 'Purchase')
        {
            //  return "sd";
            $sale = "0";
            $sale_invoice = "0";
            $p_invoice = "0";
            $s_invoice = "0";
            $bank_deposit = "0";
            $result3 = "0";
            $result4 = "0";
            $purchase = DB::select("select * from purchase  ");
            $purchase_invoice = DB::select("select * from purchase_invoice  ");

            return view('admin.view-machine-table', compact('bank_deposit', 'purchase', 'result3', 'result4', 'purchase_invoice', 'sale', 'sale_invoice', 'p_invoice', 's_invoice'));
        }

        if ($sub_account[0]->account_type == 'Cash')
        {
            //  return "sd";
            $account_namee = $sub_account[0]->account_name;
            $sale = "0";
            $sale_invoice = "0";

            $p_invoice = DB::select("select * from purchase_invoice where account_type='$account_namee'  ");
            $s_invoice = DB::select("select * from sale_invoice where account_type='$account_namee'  ");
            $bank_deposit = DB::select("select * from bank_deposit where account='$account_namee'  ");
            // $expense=DB::select("select * from expense where payment_account='$account_namee'  ");
            $result3 = "0";
            $result4 = "0";
            $purchase = "0";
            $purchase_invoice = "0";

            return view('admin.view-machine-table', compact('bank_deposit', 'purchase', 'result3', 'result4', 'purchase_invoice', 'sale', 'sale_invoice', 'p_invoice', 's_invoice'));
        }

        if ($sub_account[0]->account_type == 'Owners Equity')
        {
            //  return "sd";
            $sale = "0";
            $sale_invoice = "0";
            $purchase = "0";
            $purchase_invoice = "0";
            $p_invoice = "0";
            $s_invoice = "0";
            $bank_deposit = "0";
            $resultbal = DB::select("select* from account where account_name='$sub_accountss'   ");
            $test = DB::select("select* from account where pk_id='$pk_id'   ");
            $test1 = $test[0]->account_name;

            $result3 = DB::select("select * from bank_deposit where recive_from='$pk_id'  ");
            //  return  $result3;
            

            // $result3 = DB::select("select * from bank_deposit,account where bank_deposit.recive_from='account.pk_id' and account.pk_id='$pk_id' ");
            $result4 = DB::select("select * from expense where main_account='Owners Equity' ");
            // $result4= DB::select("select amount from expense where main_account='$pk_id' ");
            // $totat = DB::table('expense')->sum('amount');
            // return $sub_accountss;
            return view('admin.view-machine-table', compact('bank_deposit', 'result3', 'result4', 'resultbal', 'purchase_invoice', 'sale', 'sale_invoice', 'purchase', 'p_invoice', 's_invoice'));
        }
        //  return $sub_account[0]->account_name;
        if ($sub_account[0]->account_name == $sub_accountss)
        {
            return "dsd";
            $resultbal = DB::select("select* from account where account_name='$sub_accountss'   ");
            $resultbale = $resultbal[0]->balance;

            $result3 = DB::select("select* from bank_deposit where account='$sub_accountss'   ");
            // return $result3;
            $resultnew = DB::select("select* from money_transfer where recive_account='$pk_id'   ");
            // $acc_name = DB::select("select account_name from account where account_name='$sub_accountss'   ");
            // $acc_name=$acc_name[0]->account_name;
            // return $result3;
            // return $result3;
            $result4 = DB::select("select * from expense where main_account='$pk_id' ");
            // return $result4;
            // $result4= DB::select("select amount from expense where main_account='$pk_id' ");
            // $totat = DB::table('expense')->sum('amount');
            // return $result3;
            return view('admin.view-machine-table', compact('result3', 'result4', 'resultnew', 'resultbal'));
        }

    }

    // public function account_detailed_view($pk_id) {
    //   if(!(session()->has('type') && session()->get('type')=='admin'))
    //   {
    //     return redirect('/admin');
    //   }
    //     $result = DB::select("select * from expense where account_name= '$pk_id'");
    //     return view('admin.view_dec_account_detail', compact('result'));
    //   }
    

    public function balance(Request $request)
    {
        $value = $request->Input('cat_id');

        $subcategories = DB::select(DB::raw("SELECT * FROM account WHERE pk_id = :value") , array(
            'value' => $value,
        ));

        return $subcategories;

    }

    public function edit_account_view($sku)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from main_category");

        $result1 = DB::select("select* from sub_category where SKU = '$sku'");

        return view('admin.edit_sub_category', compact('result', 'result1'));

    }

    public function edit_account(Request $request, $sku)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $main_category = $request->input('mainCategory');
        $cat = $request->input('subCategory');

        $result = DB::select(DB::raw("SELECT * FROM sub_category WHERE sub_category = :value and main_category= :value2") , array(
            'value' => $cat,
            'value2' => $main_category,
        ));

        if (count($result) > 0)
        {
            return Redirect::back()->withErrors('Subcategory already Exist');

        }
        else

        {

            DB::table('sub_category')
                ->where('SKU', $sku)->update(['main_category' => $main_category, 'sub_category' => $cat]);
            return redirect('/admin/home/view/sub/category');

        }
    }

    public function delete_account($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        DB::delete("delete from sub_category where SKU = '$id'");

        return redirect()->back();
    }

    ///////////////////////////////////////////
    public function sub(Request $request)
    {
        $value = $request->Input('cat_id');

        $subcategories = DB::select(DB::raw("SELECT * FROM sub_category WHERE main_category = :value") , array(
            'value' => $value,
        ));

        return Response::json($subcategories);

    }

    public function add_inventory_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select * from main_category ORDER BY SKU DESC");

        return view('admin.add_inventory_view', compact('result'));
    }

    public function add_inventory_view_list()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select * from main_category ORDER BY SKU DESC");

        return view('admin.add_inventory_view_list', compact('result'));
    }

    public function add_inventory(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $item = urldecode($request->input('item'));
        $a = $request->input('sub_item');

        $name = $request->input('name');
        $inventory = DB::select("select* from inventory where name = '$name'");
        // return count($inventory);
        if (count($inventory) > 0)
        {
            return Redirect::back()->withErrors('Inventory Name already Exist');
        }
        else
        {
            $sub_category = DB::select(DB::raw("SELECT * FROM sub_category WHERE sub_category = :value") , array(
                'value' => $a,
            ));

            if (count($sub_category) > 0)
            {
                $a = $sub_category[0]->sub_category;

            }
            else
            {

                $sub_category = DB::select(DB::raw("SELECT * FROM sub_category WHERE SKU = :value") , array(
                    'value' => $a,
                ));

                if (count($sub_category) > 0)

                {
                    $a = $sub_category[0]->sub_category;
                }
                else
                {
                    $a = "";
                }
            }
            $inventory = DB::select("select* from inventory where item ='$item' and sub_item = '$a' order by pk_id desc");
            if (count($inventory) > 0)
            {
                $sub_category = DB::select("select* from sub_category where main_category = '$item' and sub_category='$a'");
                if (count($sub_category) > 0)
                {
                    $sub_item_id = $sub_category[0]->sub_item_id;
                }
                $sku = $inventory[0]->sku;

                $sku = substr($sku, strpos($sku, "-") + 1);
                $sku = substr($sku, strpos($sku, "-") + 1);
                $sku = substr($sku, 2);
                $sku = $sku + 1;

                $inventory_id = substr($name, 0, 2);
                $sku = $sub_item_id . "-" . $inventory_id . $sku;

            }
            else
            {
                $sub_category = DB::select("select* from sub_category where main_category = '$item' and sub_category='$a'");
                if (count($sub_category) > 0)
                {
                    $sub_item_id = $sub_category[0]->sub_item_id;
                }
                else
                {
                    $sub_item_id = 'BG';
                }
                $inventory_id = substr($name, 0, 2);
                $sku = $sub_item_id . "-" . $inventory_id . "1";
            }
            $stockk = $request->input('stock');
            $openingg_balance = $request->input('opening_balance');
            if ($stockk > 0)
            {
                $devide = $openingg_balance / $stockk;
            }
            else
            {
                $devide = "0";
            }

            DB::insert("insert into inventory (sku,item,sub_item,name,uom,stock,opening_balance,balance,description) values (?,?,?,?,?,?,?,?,?)", array(
                $sku,
                $item,
                $a,
                $request->input('name') ,
                $request->input('uom') ,
                $request->input('stock') ,
                $request->input('opening_balance') ,
                $devide,
                $request->input('description')
            ));
            return redirect('/admin/home/view/inventory');
        }

    }

    public function add_inventories(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $item = urldecode($request->input('item'));
        $a = $request->input('sub_item');
        $name = $request->input('name');
        $inventory = DB::select("select* from inventory where name = '$name'");
        // return count($inventory);
        if (count($inventory) > 0)
        {
            return Redirect::back()->withErrors('Inventory Name already Exist');
        }
        else
        {
            $sub_category = DB::select(DB::raw("SELECT * FROM sub_category WHERE sub_category = :value") , array(
                'value' => $a,
            ));

            if (count($sub_category) > 0)
            {
                $a = $sub_category[0]->sub_category;

            }
            else
            {

                $sub_category = DB::select(DB::raw("SELECT * FROM sub_category WHERE SKU = :value") , array(
                    'value' => $a,
                ));

                if (count($sub_category) > 0)

                {
                    $a = $sub_category[0]->sub_category;
                }
                else
                {
                    $a = "";
                }
            }
            $inventory = DB::select("select* from inventory where item ='$item' and sub_item = '$a' order by pk_id desc");
            if (count($inventory) > 0)
            {
                $sub_category = DB::select("select* from sub_category where main_category = '$item' and sub_category='$a'");
                if (count($sub_category) > 0)
                {
                    $sub_item_id = $sub_category[0]->sub_item_id;
                }
                $sku = $inventory[0]->sku;

                $sku = substr($sku, strpos($sku, "-") + 1);
                $sku = substr($sku, strpos($sku, "-") + 1);
                $sku = substr($sku, 2);
                $sku = $sku + 1;

                $inventory_id = substr($name, 0, 2);
                $sku = $sub_item_id . "-" . $inventory_id . $sku;

            }
            else
            {
                $sub_category = DB::select("select* from sub_category where main_category = '$item' and sub_category='$a'");
                if (count($sub_category) > 0)
                {
                    $sub_item_id = $sub_category[0]->sub_item_id;
                }
                $inventory_id = substr($name, 0, 2);
                $sku = $sub_item_id . "-" . $inventory_id . "1";
            }
            $stockk = $request->input('stock');
            $openingg_balance = $request->input('opening_balance');
            if ($stockk > 0)
            {
                $devide = $openingg_balance / $stockk;
            }
            else
            {
                $devide = "0";
            }

            DB::insert("insert into inventory (sku,item,sub_item,name,uom,stock,opening_balance,balance,description) values (?,?,?,?,?,?,?,?,?)", array(
                $sku,
                $item,
                $a,
                $request->input('name') ,
                $request->input('uom') ,
                $request->input('stock') ,
                $request->input('opening_balance') ,
                $devide,
                $request->input('description')
            ));
            return redirect('admin/home/add/sale/invioce/view');
        }

    }

    public function inventory_list_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from inventory ORDER BY pk_id DESC");

        return view('admin.view_inventory_list', compact('result'));

    }

    public function inventory_detail_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from inventory where pk_id = '$id'");

        return view('admin.view_inventory_detail', compact('result'));

    }

    public function edit_inventory_view($sku)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result1 = DB::select("select* from main_category");

        $result = DB::select("select* from inventory where pk_id = '$sku'");

        return view('admin.edit_inventory', compact('result', 'result1'));

    }

    public function edit_inventory(Request $request, $sku)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $main_category = urldecode($request->input('item'));

        $a = $request->input('sub_item');
        $name = $request->input('name');
        $sub_category = DB::select(DB::raw("SELECT * FROM sub_category WHERE sub_category = :value") , array(
            'value' => $a,
        ));

        if (count($sub_category) > 0)
        {
            $a = $sub_category[0]->sub_category;

        }
        else
        {

            $sub_category = DB::select(DB::raw("SELECT * FROM sub_category WHERE SKU = :value") , array(
                'value' => $a,
            ));

            if (count($sub_category) > 0)

            {
                $a = $sub_category[0]->sub_category;
            }
            else
            {
                $a = "";
            }
        }

        $inventory = DB::select("select* from inventory where item ='$main_category' and sub_item = '$a' and name = '$name'");
        if (count($inventory) > 0)
        {
            DB::table('inventory')->where('pk_id', $sku)->update(['uom' => $request->input('uom') , 'stock' => $request->input('stock') , 'opening_balance' => $request->input('opening_balance') ]);

        }
        else
        {
            $sub_category = DB::select("select* from sub_category where main_category = '$main_category' and sub_category='$a'");
            if (count($sub_category) > 0)
            {
                $sub_item_id = $sub_category[0]->sub_item_id;
            }
            $inventory = DB::select("select * from inventory where pk_id = '$sku'");
            if (count($inventory) > 0)
            {
                $in_id = $inventory[0]->sku;
                $in_id = substr($in_id, strpos($in_id, "-") + 1);
                $in_id = substr($in_id, strpos($in_id, "-") + 1);
                $in_id = substr($in_id, 2);
                $inventory_id = substr($name, 0, 2);
                $in_id = $sub_item_id . "-" . $inventory_id . $in_id;
            }
        }
        DB::table('inventory')->where('pk_id', $sku)->update(['sku' => $in_id, 'item' => $main_category, 'sub_item' => $a, 'name' => $request->input('name') , 'uom' => $request->input('uom') , 'stock' => $request->input('stock') , 'opening_balance' => $request->input('opening_balance') ]);
        return redirect('/admin/home/view/inventory');

    }

    public function delete_inventory($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        DB::delete("delete from inventory where pk_id = '$id'");

        return redirect()->back();
    }

    /////////////////////
    public function select_item(Request $request)
    {
        $value = $request->Input('po_id');

        $name = DB::select(DB::raw("SELECT * FROM inventory WHERE name = :value") , array(
            'value' => $value,
        ));
        return $name;

        return Response::json($name);

    }

    public function select_sku(Request $request)
    {
        $value = $request->Input('po_id');

        // return $value;
        $sku = DB::select(DB::raw("SELECT * FROM inventory WHERE sku = :value") , array(
            'value' => $value,
        ));
        return $sku;

        return Response::json($sku);

    }

    public function select_coa(Request $request)
    {
        $value = $request->Input('cat_id');

        $sku = DB::select(DB::raw("SELECT * FROM account WHERE account_name = :value") , array(
            'value' => $value,
        ));

        return Response::json($sku);

    }

    public function add_sale_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $inventory = DB::select("select* from inventory");
        $result = DB::select("select * from customer");
        $sale = DB::select("select * from sale ORDER BY pk_id DESC");
        $account_type = DB::table('account')->where('account_type', 'Cash')
            ->get();

        if (count($sale) > 0)
        {
            $sale_id = $sale[0]->pk_id + 1;
        }
        else
        {
            $sale_id = 1;
        }

        return view('admin.add_sale_view', compact('result', 'sale_id', 'inventory', 'account_type'));
    }

    public function reciept_sale_add_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $inventory = DB::select("select* from inventory");
        $result = DB::select("select * from customer");
        $sale = DB::select("select * from sale ORDER BY pk_id DESC");
        // $account_type = DB::table('account')->where('nature_of_account', 'Assets')
        //     ->get();
        $account_type = DB::select("select * from account where nature_of_account='Assets'");
        if (count($sale) > 0)
        {
            $sale_id = $sale[0]->pk_id + 1;
        }
        else
        {
            $sale_id = 1;
        }

        return view('admin.add_sale_receipt', compact('result', 'sale_id', 'inventory', 'account_type'));
    }

    public function add_sale_invioce_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $inventory = DB::select("select* from inventory");
        $result = DB::select("select * from customer");
        $sale = DB::select("select * from sale ORDER BY pk_id DESC");
        $account_type = DB::table('account')->where('account_type', 'Cash')
            ->get();

        if (count($sale) > 0)
        {
            $sale_id = $sale[0]->pk_id + 1;
        }
        else
        {
            $sale_id = 1;
        }

        return view('admin.add_invoice', compact('result', 'sale_id', 'inventory', 'account_type'));
    }

    public function add_bal_invioce_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select * from customer");

        $account_type = DB::table('account')->where('nature_of_account', 'Assets')
            ->get();

        return view('admin.add_bal', compact('result', 'account_type'));
    }

    public function add_bal_invioce(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $account_name = $request->input('account_name');
        $c_name = $request->input('customer_name');
        $total_amount = $request->input('amount');

        $cus_name = DB::select("select* from customer where pk_id = '$c_name'");
        $c_balance = $cus_name[0]->current_balance + $total_amount;
        DB::table('customer')->where('pk_id', $c_name)->update(['current_balance' => $c_balance]);

        $account = DB::select("select* from account where account_name = '$account_name'");
        if (count($account) > 0)
        {
            $c_balance = $account[0]->balance - $total_amount;

            DB::table('account')->where('pk_id', $account[0]->pk_id)
                ->update(['balance' => $c_balance]);

        }

        $result = DB::select("select * from customer");

        $account_type = DB::table('account')->where('nature_of_account', 'Assets')
            ->get();

        return view('admin.bal_by_customer_list_view', compact('result'));
    }

    public function create_payment_bal_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $result1 = DB::select("select* from customer where pk_id = '$id'");
        $payment_account = DB::select("select* from account where nature_of_account = 'Assets'");

        $customer = $result1[0]->customer_name;
        $total = $result1[0]->current_balance;

        $account_type = DB::table('account')->where('nature_of_account', 'Assets')
            ->get();
        return view('admin.create_payment_bal', compact('result1', 'customer', 'total', 'account_type'));

    }

    public function create_payment_bal(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $account_name = $request->input('account_name');
        $partial = $request->input('partial');
        $account_cash1 = DB::select("select* from account where account_name = '$account_name'");
        if (count($account_cash1))
        {
            $account_cash2 = $account_cash1[0]->balance;
            $partial2 = $account_cash2 + $partial;
            $account_cash = DB::table('account')->where('account_name', $account_name)->update(['balance' => "$partial2"]);
            // $increase = DB::table('account')->where('account_name', $account_name)->update(['increase' => "$partial2"]);
        }
        else
        {
            return Redirect::back()->withErrors('Please Select an Account!...');
        }

        $account_name = $request->input('account_name');
        $c_name = $request->input('customer_name');
        $total_amount = $request->input('partial');

        $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
        $c_balance = $cus_name[0]->current_balance - $total_amount;
        DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);

        $result = DB::select("select * from customer");

        $account_type = DB::table('account')->where('nature_of_account', 'Assets')
            ->get();

        return view('admin.bal_by_customer_list_view', compact('result'));
    }

    public function add_sale(Request $request)
    {
        return "hello";
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {

            return redirect('/admin');
        }

        if ($request->input('sale_type') == "sale")
        {

            $total_amount = 0;
            $sku = $request->input('sku');
            // return $sku;
            $wordCount = count($sku);
            $item_name = $request->input('item_name');
            $rate = $request->input('rate');
            $quantity = $request->input('quantity');

            $i = 0;
            for ($i = 0;$i < $wordCount;$i++)
            {
                $total_amount = $total_amount + ($quantity[$i] * $rate[$i]);
            }

            $sale = "kachi parchi";

            DB::insert("insert into sale(bill_date,sale,customer_name,account_type,sale_type,company_name,vehicle_no,total_amount,created_at) values (?,?,?,?,?,?,?,?,?)", array(
                $request->input('date') ,
                $sale,
                $request->input('customer_name') ,
                $request->input('account_type') ,
                $request->input('sale_type') ,
                $request->input('company_name') ,
                $request->input('vehicle_no') ,
                $total_amount,
                $request->input('date')
            ));
            $c_name = $request->input('customer_name');
            // return $c_name;
            $cus_name = DB::select("select* from customer where pk_id = '$c_name'");
            $c_balance = $cus_name[0]->current_balance + $total_amount;
            DB::table('customer')->where('pk_id', $c_name)->update(['current_balance' => $c_balance]);

            $result = DB::select("select* from sale order by pk_id DESC");
            for ($i = 0;$i < $wordCount;$i++)
            {
                $amount = $quantity[$i] * $rate[$i];
                DB::insert("insert into detail_sale (sale_id,sku,item_name,quantity,rate,amount) values (?,?,?,?,?,?)", array(
                    $result[0]->pk_id,
                    $sku[$i],
                    $item_name[$i],
                    $quantity[$i],
                    $rate[$i],
                    $amount
                ));
                $inventory = DB::select("select * from inventory where sku = '$sku[$i]'");
                if (count($inventory) > 0)
                {
                    $stock = $inventory[0]->stock - $quantity[$i];
                    DB::table('inventory')->where('sku', $sku[$i])->update(['stock' => $stock]);
                }

            }

            // if($request->input('account_type'))
            //   {
            //     DB::enableQueryLog();
            //         $account_type_id = $request->input('account_type');
            //         $account = DB::select("select* from account where pk_id =".$account_type_id);
            //         $purchase_account = DB::select("select* from account where account_type = 'Purchase Manegment'");
            //                    $query = DB::getQueryLog();
            //       // print_r($query);
            //       // dd($account, $account_type_id);
            //       if(count($account)>0)
            //       {
            //         if(isset($purchase_account[0])){
            //         $puchase_amount = $purchase_account[0]->balance-$total_amount;
            //          $result = DB::table('account')->where('account_type','Purchase Manegment')->update(['balance' =>$puchase_amount]);
            //       }
            //        $sale_account = DB::select("select* from account where account_type ='Sale Manegment'");
            //       if(isset($sale_account[0]) && !empty($sale_account[0]))
            //       {
            //         $sale_balance = $sale_account[0]->balance + $total_amount;
            //         $result = DB::table('account')->where('pk_id',$sale_account[0]->pk_id)->update(['balance' =>$sale_balance]);
            //       }
            //           $c_balance = $account[0]->balance + $total_amount;
            //           $result = DB::table('account')->where('pk_id',$account[0]->pk_id)->update(['balance' =>$c_balance]);
            

            //       }
            //       else{
            //           DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)",array('Account Receivable','Account Receivable','Account Receivable',$total_amount,NOW()));
            //           }
            //       }
            

            if ($request->input('account_type') == "credit")
            {
                $account = DB::select("select* from account where account_type = 'Sales Retail'");
                if (count($account) > 0)
                {
                    $c_balance = $account[0]->balance + $total_amount;
                    $c_balance_increase = $account[0]->increase + $total_amount;
                    DB::table('account')->where('pk_id', $account[0]->pk_id)
                        ->update(['balance' => $c_balance]);
                    DB::table('account')->where('pk_id', $account[0]->pk_id)
                        ->update(['increase' => $c_balance_increase]);
                }
                else
                {

                    DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                        'Account Receivable',
                        'Account Receivable',
                        'Account Receivable',
                        $total_amount,
                        NOW()
                    ));

                }

                // $c_name = $request->input('customer_name');
                // $cus_name = DB::select("select* from customer where pk_id = '$c_name'");
                // $c_balance = $cus_name[0]->current_balance - $total_amount;
                // DB::table('customer')->where('pk_id', $c_name)->update(['current_balance' => $c_balance]);
                $accountss = DB::select("select* from account where account_type = 'Account Receivable'");

                if (count($accountss) > 0)
                {

                    $c_balance = $accountss[0]->balance + $total_amount;
                    $c_balance_increase = $accountss[0]->increase + $total_amount;
                    DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                        ->update(['balance' => $c_balance]);
                    DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                        ->update(['increase' => $c_balance_increase]);

                }

            }

            // ======================= Cash ==========================//
            if ($request->input('account_type') == "cash")
            {

                $account = DB::select("select* from account where account_type = 'Cash'");

                if (count($account) > 0)
                {
                    $c_balance = $account[0]->balance + $total_amount;
                    $c_balance_increase = $account[0]->increase + $total_amount;
                    DB::table('account')->where('pk_id', $account[0]->pk_id)
                        ->update(['balance' => $c_balance]);
                    DB::table('account')->where('pk_id', $account[0]->pk_id)
                        ->update(['increase' => $c_balance_increase]);
                }
                else
                {

                    DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                        'Cash',
                        'Cash',
                        'Cash',
                        $total_amount,
                        NOW()
                    ));

                }

                $accountss = DB::select("select* from account where account_type = 'Sales Retail'");

                if (count($accountss) > 0)
                {
                    $c_balance = $accountss[0]->increase + $total_amount;

                    DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                        ->update(['increase' => $c_balance]);

                }
            }

        }
        else
        {
            return "false";
        }

        return redirect('/admin/home/view/sale/by/customer');

    }

    public function reciept_sale_add(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {

            return redirect('/admin');
        }

        // return "sd";
        $total_amount = 0;
        $sku = $request->input('sku');
        // return $sku;
        $wordCount = count($sku);
        $item_name = $request->input('item_name');

        $description = $request->input('description');

        $date = $request->input('date');

        $customer_name = $request->input('customer_name');

        $item_name = $request->input('item_name');
        $address = DB::select("select* from customer where pk_id = '$customer_name'");

        $address = $address[0]->billing_address;

        $rate = $request->input('rate');
        $quantity = $request->input('quantity');
        $i = 0;
        for ($i = 0;$i < $wordCount;$i++)
        {
            $total_amount = $total_amount + ($quantity[$i] * $rate[$i]);
        }

        $sale = "Receipt";

        DB::insert("insert into sale(bill_date,address,sale,customer_name,account_type,sale_type,company_name,vehicle_no,total_amount,created_at) values (?,?,?,?,?,?,?,?,?,?)", array(
            $request->input('date') ,
            $address,
            $sale,
            $request->input('customer_name') ,
            $request->input('account_type') ,
            $sale,
            $request->input('company_name') ,
            $request->input('vehicle_no') ,
            $total_amount,
            $request->input('date')
        ));

        $result = DB::select("select* from sale order by pk_id DESC");
        for ($i = 0;$i < $wordCount;$i++)
        {
            $amount = $quantity[$i] * $rate[$i];
            DB::insert("insert into detail_sale (sale_id,sku,item_name,quantity,rate,amount) values (?,?,?,?,?,?)", array(
                $result[0]->pk_id,
                $sku[$i],
                $item_name[$i],
                $quantity[$i],
                $rate[$i],
                $amount
            ));
            $inventory = DB::select("select * from inventory where sku = '$sku[$i]'");

            if (count($inventory) > 0)
            {
                $stock = $inventory[0]->stock - $quantity[$i];
                DB::table('inventory')->where('sku', $sku[$i])->update(['stock' => $stock]);
            }

            if ($request->input('account_type') == "cash")
            {
                $account_typee = $request->input('ref_no');
                $account = DB::select("select* from account where account_name = '$account_typee'");

                if (count($account) > 0)
                {
                    $c_balance = $account[0]->balance + $amount;
                    $c_balance_increase = $account[0]->increase + $amount;
                    DB::table('account')->where('pk_id', $account[0]->pk_id)
                        ->update(['balance' => $c_balance]);
                    DB::table('account')->where('pk_id', $account[0]->pk_id)
                        ->update(['increase' => $c_balance_increase]);
                }
                else
                {

                    DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                        'Cash',
                        'Cash',
                        'Cash',
                        $total_amount,
                        NOW()
                    ));

                }

                $accountss = DB::select("select* from account where account_type = 'Sales Retail'");

                if (count($accountss) > 0)
                {
                    $c_balance = $accountss[0]->balance + $amount;

                    $c_balance_increase = $accountss[0]->increase + $amount;

                    DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                        ->update(['balance' => $c_balance]);

                    DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                        ->update(['increase' => $c_balance_increase]);

                }
            }
            $c_name = $request->input('customer_name');
            // return $c_name;
            $cus_name = DB::select("select* from customer where pk_id = '$c_name'");
            $c_balance = $cus_name[0]->current_balance + $amount;
            DB::table('customer')->where('pk_id', $c_name)->update(['current_balance' => $c_balance]);

        }

        DB::insert("insert into sale_receipt (sale_id,customer_name,address,date,account_type,ref_no,description) values (?,?,?,?,?,?,?)", array(
            $result[0]->pk_id,
            $request->input('customer_name') ,
            $request->input('address') ,
            $request->input('date') ,
            $request->input('account_type') ,
            $request->input('ref_no') ,
            $request->input('description')
        ));

        return redirect('/admin/home/view/sale/by/customer');

    }

    public function add_sale_invioce(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {

            return redirect('/admin');
        }

        // return $request->input('date2') ;
        $total_amount = 0;
        $sale_type = "sale";
        $sku = $request->input('sku');
        // return $sku;
        $wordCount = count($sku);
        $item_name = $request->input('item_name');
        // return $item_name;
        $rate = $request->input('rate');
        $quantity = $request->input('quantity');
        $desc = $request->input('description');
        // return $request->input('customer_name');
        $customer_name = $request->input('customer_name');
        // return $customer_name;
        $address = DB::select("select* from customer where pk_id = '$customer_name'");

        $address = $address[0]->billing_address;

        $i = 0;
        for ($i = 0;$i < $wordCount;$i++)
        {
            $total_amount = $total_amount + ($quantity[$i] * $rate[$i]);

        }

        $inventory = DB::select("select* from inventory where name = '$item_name[0]'");

        $inventory = $inventory[0]->stock;
        // return $quantity[0];
        if ($inventory > 0 && $quantity[0] <= $inventory)
        {

            $sale = "invoice";
            $account_type = "credit";
            DB::insert("insert into sale(bill_date,due_date,sale,address,customer_name,account_type,sale_type,total_amount,balance) values (?,?,?,?,?,?,?,?,?)", array(
                $request->input('date') ,
                $request->input('date2') ,
                $sale,
                $address,
                $request->input('customer_name') ,
                $account_type,
                $sale_type,
                $total_amount,
                $total_amount
            ));

            $c_name = $request->input('customer_name');
            // return $c_name;
            $cus_name = DB::select("select* from customer where pk_id = '$c_name'");
            $c_balance = $cus_name[0]->current_balance + $total_amount;
            DB::table('customer')->where('pk_id', $c_name)->update(['current_balance' => $c_balance]);

            $result = DB::select("select* from sale order by pk_id DESC");
            for ($i = 0;$i < $wordCount;$i++)
            {
                $amount = $quantity[$i] * $rate[$i];
                //  return $amount;
                DB::insert("insert into detail_sale (sale_id,sku,item_name,quantity,rate,amount) values (?,?,?,?,?,?)", array(
                    $result[0]->pk_id,
                    $sku[$i],
                    $item_name[$i],
                    $quantity[$i],
                    $rate[$i],
                    $amount
                ));
                $inventory = DB::select("select * from inventory where sku = '$sku[$i]'");
                //   return $inventory;
                if (count($inventory) > 0)
                {
                    $balance = $inventory[0]->balance;
                    $new_balance = $balance * $quantity[$i];
                    $op_update = $inventory[0]->opening_balance - $new_balance;

                    DB::table('inventory')->where('sku', $sku[$i])->update(['opening_balance' => $op_update]);

                    $stock = $inventory[0]->stock - $quantity[$i];
                    DB::table('inventory')->where('sku', $sku[$i])->update(['stock' => $stock]);
                }

                if ($account_type == "credit")
                {
                    $account = DB::select("select* from account where account_type = 'Sales Retail'");
                    if (count($account) > 0)
                    {
                        $c_balance = $account[0]->increase + $amount;
                        DB::table('account')->where('pk_id', $account[0]->pk_id)
                            ->update(['balance' => $c_balance]);
                        DB::table('account')->where('pk_id', $account[0]->pk_id)
                            ->update(['increase' => $c_balance]);
                    }
                    else
                    {

                        DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                            'Account Receivable',
                            'Account Receivable',
                            'Account Receivable',
                            $total_amount,
                            NOW()
                        ));

                    }

                    $accountss = DB::select("select* from account where account_type = 'Account Receivable'");

                    if (count($accountss) > 0)
                    {

                        $c_balance = $accountss[0]->increase + $amount;
                        DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                            ->update(['balance' => $c_balance]);
                        DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                            ->update(['increase' => $c_balance]);

                    }

                }

            }
        }
        else
        {

            return Redirect::back()->withErrors('Inventory kam han!...');

        }

        return redirect('/admin/home/view/sale/by/customer');

    }

    public function sale_by_customer_list_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $total_amount = DB::select("select SUM(total_amount) from sale where sale_type = 'sale'");

        $result = DB::select("select* from customer");
        $result2 = DB::select("select* from sale ");

        return view('admin.sale_by_customer_list_view', compact('result2', 'result', 'total_amount'));

    }

    public function bal_by_customer_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from customer");

        return view('admin.bal_by_customer_list_view', compact('result'));

    }
    
        public function bal_by_supplier_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from supplier");

        return view('admin.bal_by_supplier_list_view', compact('result'));

    }

    public function all_sale()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $total_amount = DB::select("select SUM(total_amount) from sale ");
        $item_name = DB::select("select* from sale,detail_sale where detail_sale.sale_id = sale.pk_id  ");

        $item_name2 = DB::select("select* from sale,detail_tax_sale where detail_tax_sale.sale_id = sale.pk_id  ");

        $cus_name = DB::select("select customer_name from sale,detail_sale where detail_sale.sale_id = sale.pk_id  ");

        // return $item_name;
        $result = DB::select("select* from customer");
        $result2 = DB::select("select* from sale");

        return view('admin.all_sale', compact('result2', 'item_name2', 'result', 'total_amount', 'item_name', 'cus_name'));

    }

    public function sale_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from customer where pk_id = '$id'");
        $result3 = DB::select("select* from sale where pk_id = '$id' and status ='active'");
        //  return  $id;
        //         $customer = $result3[0]->customer_name;
        // return $customer;
        $result = DB::select("select* from sale where customer_name = '$id' and status ='active' and (sale = 'invoice' or sale = 'tax')  ");
        // return $result;
        $total = $result[0]->total_amount;
        $sale_id = $result[0]->pk_id;
        $customer = $result[0]->customer_name;
        $customer_name = $result1[0]->customer_name;
        //  $customer = $result1[0]->customer_name;
        //  $total= $result1[0]->total_amount;
        

        // $result11 = DB::select("select* from sale where customer_name = '$id' and sale_type = 'sale'");
        // $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale_type = 'sale' ");
        

        $customer2 = DB::select("select* from customer where pk_id = '$customer'");
        $due_date = DB::select("select* from sale_invoice where customer_name = '$customer_name' ");
        // return $result;
        $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale = 'invoice' and sale_type= 'sale' and status !='inactive' ");

        // $total_amount2 = DB::select("select SUM(return_amount) from sale where customer_name = '$id' and sale = 'invoice' and sale_type= 'return' and return_amount != total_amount   ");
        // return   $result3[0]->total_amount;
        return view('admin.view_sale_list', compact('sale_id', 'result3', 'customer2', 'result', 'result1', 'total_amount'));

    }

    public function inactive_sale_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from customer where pk_id = '$id'");
        $result3 = DB::select("select* from sale where pk_id = '$id' and status ='inactive'");
        //  return  $id;
        //         $customer = $result3[0]->customer_name;
        // return $customer;
        $result = DB::select("select* from sale where customer_name = '$id' and status ='inactive' and (sale = 'invoice' or sale = 'tax')  ");
        // return $result;
        if (count($result) > 0)
        {

            $total = $result[0]->total_amount;
            $sale_id = $result[0]->pk_id;
            $customer = $result[0]->customer_name;
            $customer_name = $result1[0]->customer_name;
            //  $customer = $result1[0]->customer_name;
            //  $total= $result1[0]->total_amount;
            

            // $result11 = DB::select("select* from sale where customer_name = '$id' and sale_type = 'sale'");
            // $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale_type = 'sale' ");
            

            $customer2 = DB::select("select* from customer where pk_id = '$customer'");
            $due_date = DB::select("select* from sale_invoice where customer_name = '$customer_name' ");
            // return $result;
            $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale = 'invoice' and sale_type= 'sale' and status ='inactive' ");

            // $total_amount2 = DB::select("select SUM(return_amount) from sale where customer_name = '$id' and sale = 'invoice' and sale_type= 'return' and return_amount != total_amount   ");
            // return   $result3[0]->total_amount;
            return view('admin.view_sale_list', compact('sale_id', 'result3', 'customer2', 'result', 'result1', 'total_amount'));

        }

        else
        {
            return Redirect::back()->withErrors('No Invoice Found!...');
        }
    }

    public function paid_sale_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from customer where pk_id = '$id'");
        $result3 = DB::select("select* from sale where pk_id = '$id' and status ='active' and balance = '0'");
        //  return  $id;
        //         $customer = $result3[0]->customer_name;
        // return $customer;
        $result = DB::select("select* from sale where customer_name = '$id' and status ='active' and balance = '0' and (sale = 'invoice' or sale = 'tax')  ");
        // return $result;
        if (count($result) > 0)
        {
            $total = $result[0]->total_amount;
            $sale_id = $result[0]->pk_id;
            $customer = $result[0]->customer_name;
            $customer_name = $result1[0]->customer_name;
            //  $customer = $result1[0]->customer_name;
            //  $total= $result1[0]->total_amount;
            

            // $result11 = DB::select("select* from sale where customer_name = '$id' and sale_type = 'sale'");
            // $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale_type = 'sale' ");
            

            $customer2 = DB::select("select* from customer where pk_id = '$customer'");
            $due_date = DB::select("select* from sale_invoice where customer_name = '$customer_name' ");
            // return $result;
            $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale = 'invoice' and balance = '0' and status ='active' ");

            // $total_amount2 = DB::select("select SUM(return_amount) from sale where customer_name = '$id' and sale = 'invoice' and sale_type= 'return' and return_amount != total_amount   ");
            // return   $result3[0]->total_amount;
            return view('admin.view_sale_list', compact('sale_id', 'result3', 'customer2', 'result', 'result1', 'total_amount'));
        }

        else
        {
            return Redirect::back()->withErrors('No Invoice Found!...');
        }
    }

    public function open_sale_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from customer where pk_id = '$id'");
        $result3 = DB::select("select* from sale where pk_id = '$id' and status ='active' and paid_amount='0'");
        //  return  $id;
        //         $customer = $result3[0]->customer_name;
        // return $customer;
        $result = DB::select("select* from sale where customer_name = '$id' and status ='active' and paid_amount='0' and (sale = 'invoice' or sale = 'tax')  ");
        // return $result;
        if (count($result) > 0)
        {
            $total = $result[0]->total_amount;
            $sale_id = $result[0]->pk_id;
            $customer = $result[0]->customer_name;
            $customer_name = $result1[0]->customer_name;
            //  $customer = $result1[0]->customer_name;
            //  $total= $result1[0]->total_amount;
            $customer2 = DB::select("select* from customer where pk_id = '$customer'");
            $due_date = DB::select("select* from sale_invoice where customer_name = '$customer_name' ");
            // return $result;
            $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale = 'invoice' and paid_amount='0' and status ='active' ");

            // $total_amount2 = DB::select("select SUM(return_amount) from sale where customer_name = '$id' and sale = 'invoice' and sale_type= 'return' and return_amount != total_amount   ");
            // return   $result3[0]->total_amount;
            return view('admin.view_sale_list', compact('sale_id', 'result3', 'customer2', 'result', 'result1', 'total_amount'));

        }

        else
        {
            return Redirect::back()->withErrors('No Invoice Found!...');
        }

    }

    public function partial_sale_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from customer where pk_id = '$id'");
        $result3 = DB::select("select* from sale where pk_id = '$id' and status ='active' and paid_amount>0 and paid_amount<total_amount   ");
        //  return  $id;
        //         $customer = $result3[0]->customer_name;
        // return $customer;
        $result = DB::select("select* from sale where customer_name = '$id' and status ='active' and paid_amount>0 and paid_amount<total_amount and (sale = 'invoice' or sale = 'tax')  ");
        // return $result;
        if (count($result) > 0)
        {
            $total = $result[0]->total_amount;
            $sale_id = $result[0]->pk_id;
            $customer = $result[0]->customer_name;
            $customer_name = $result1[0]->customer_name;
            //  $customer = $result1[0]->customer_name;
            //  $total= $result1[0]->total_amount;
            $customer2 = DB::select("select* from customer where pk_id = '$customer'");
            $due_date = DB::select("select* from sale_invoice where customer_name = '$customer_name' ");
            // return $result;
            $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale = 'invoice' and paid_amount>0 and paid_amount<total_amount and status ='active' ");

            // $total_amount2 = DB::select("select SUM(return_amount) from sale where customer_name = '$id' and sale = 'invoice' and sale_type= 'return' and return_amount != total_amount   ");
            // return   $result3[0]->total_amount;
            return view('admin.view_sale_list', compact('sale_id', 'result3', 'customer2', 'result', 'result1', 'total_amount'));

        }

        else
        {
            return Redirect::back()->withErrors('No Invoice Found!...');
        }

    }

    public function create_payment_sale_view_test($id, $sale)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $result1 = DB::select("select* from sale where pk_id = '$id'");
        $customer = $result1[0]->customer_name;
        $total = $result1[0]->total_amount;
        $customer2 = DB::select("select* from customer where pk_id = '$customer'");

        // $remain = DB::select("select* from sale_invoice where sale_id = '$id'");
        $remain = DB::table('sale_invoice')->where('sale_id', $id)->sum('partial');
        if ($remain > 0)
        {
            $new_total = $total - $remain;
            //  return $new_total;
            
        }
        else
        {
            $new_total = $total;
        }

        $result = DB::select("select* from sale where customer_name = '$id' and sale_type = 'sale'");
        $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale_type = 'sale'");

        return view('admin.receive_payment', compact('total', 'result', 'new_total', 'customer2', 'result1', 'total_amount'));

    }

    public function sale_list_view_receipt($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return "jhhh";
        $result1 = DB::select("select* from customer where pk_id = '$id'");

        $result = DB::select("select* from sale where customer_name = '$id' and sale = 'receipt'");

        $customer_name = $result1[0]->customer_name;

        $due_date = DB::select("select* from sale_receipt where customer_name = '$customer_name' ");
        // return $result;
        $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale = 'receipt'");

        return view('admin.view_sale_list_receipt', compact('result', 'result1', 'total_amount'));

    }

    public function create_payment_purchase_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $payment_account = DB::select("select* from account where nature_of_account = 'Assets'");
        $result1 = DB::select("select* from purchase where pk_id = '$id'");
        $supplier = $result1[0]->supplier_name;
        $total = $result1[0]->total_amount;
        $supplier2 = DB::select("select* from supplier where pk_id = '$supplier'");
        // return $supplier2;
        

        // $remain = DB::select("select* from sale_invoice where sale_id = '$id'");
        $remain = DB::table('purchase_invoice')->where('purchase_id', $id)->sum('partial');
        if ($remain > 0)
        {
            $new_total = $total - $remain;
            //  return $new_total;
            
        }
        else
        {
            $new_total = $total;
        }

        $result = DB::select("select* from purchase where supplier_name = '$id' and purchase_type = 'purchase'");
        $total_amount = DB::select("select SUM(total_amount) from purchase where supplier_name = '$id' and purchase_type = 'purchase'");

        return view('admin.receive_payment_purchase', compact('total', 'result', 'new_total', 'supplier2', 'result1', 'total_amount', 'payment_account'));

    }

    public function create_payment_purchase(Request $request, $id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $account_name = $request->input('account_type');
        $partial = $request->input('partial');
        
        $account_cash1 = DB::select("select* from account where account_name = '$account_name'");
        $bal = $account_cash1[0]->balance;
        if (count($account_cash1))
        {
            if($bal >= $partial){
                $account_cash2 = $account_cash1[0]->balance;
                $partial2 = $account_cash2 - $partial;
                $account_cash = DB::table('account')->where('account_name', $account_name)->update(['balance' => "$partial2" , 'increase' => "$partial2"]);
            }
            else{
                return Redirect::back()->withErrors('Amount in payment account is insufficient...');
            }
        }
        else
        {
            return Redirect::back()->withErrors('Please Select an Account!...');
        }

        // return $result;
        $supplier_name = $request->input('supplier_name');
        // return $supplier_name;
        $date = $request->input('date');
        $account_type = $request->input('account_type');
        $deposit_to = $request->input('deposit_to');
        $description = $request->input('description');
        // $due_date = $request->input('due_date');
        $org_amount = $request->input('org_amount');
        $partial = $request->input('partial');
        $result = DB::select("select* from purchase_invoice where purchase_id= '$id'  ");

        if (count($result) > 0)
        {

            $sum = DB::table('purchase_invoice')->where('purchase_id', $id)->sum('partial');
            $result2 = DB::select("select* from purchase_invoice where purchase_id= '$id' ORDER BY pk_id DESC ");

            $sum2 = $org_amount - $sum;
            // return $sum2;
            if ($partial <= $sum2)
            {

                $paymentt1 = $result2[0]->remain;
                $payment1 = $paymentt1 - $partial;
                // return $sum;
                DB::insert("insert into purchase_invoice 
              (purchase_id,supplier_name,date,account_type,deposit_to,description,org_amount,partial,remain) 
              values (?,?,?,?,?,?,?,?,?)", array(
                    $id,
                    $supplier_name,
                    $date,
                    $account_type,
                    $deposit_to,
                    $description,
                    $org_amount,
                    $partial,
                    $payment1
                ));

                $summ = DB::table('purchase_invoice')->where('purchase_id', $id)->sum('partial');

                $result5 = DB::select("select* from purchase where pk_id= '$id'  ");
                $balance = $result5[0]->balance;
                $new_balance = $balance - $summ;

                $balance_update = DB::table('purchase')->where('pk_id', $id)->update(['balance' => $new_balance]);

                $resultt = DB::table('purchase')->where('pk_id', $id)->update(['paid_amount' => $summ]);

                $s_name = $request->input('supplier_name');
                $cus_name = DB::select("select* from supplier where supplier_name = '$s_name'");
                $c_balance = $cus_name[0]->current_balance - $partial;
                $update = DB::table('supplier')->where('supplier_name', $s_name)->update(['current_balance' => $c_balance]);

                // $account_name = $request->input('account_type');
                // $partial = $request->input('partial');
                // $accountz = DB::select("select* from account where account_name = '$account_name'");

                // if (count($accountz) > 0)
                // {
                //     $c_balance = $accountz[0]->balance - $partial;
                //     $c_balance_decrease = $accountz[0]->decrease + $partial;

                //     DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                //         ->update(['balance' => $c_balance]);

                //     DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                //         ->update(['decrease' => $c_balance_decrease]);
                // }

            }
            // else
            // {
            //     $c_name = $request->input('supplier_name');
            //     $cus_name = DB::select("select* from supplier where supplier_name = '$c_name'");
            //     $id = $cus_name[0]->pk_id;
            //     // return $id;
            //     return redirect('admin/home/view/purchase/' . $id)->withErrors('Payment Acceed!...');
            // }
            

            elseif ($partial > $sum2)
            {

                $paymentt1 = $result2[0]->remain;
                $payment1 = $paymentt1 - $partial;
                // return $sum;
                DB::insert("insert into purchase_invoice 
              (purchase_id,supplier_name,date,account_type,deposit_to,description,org_amount,partial,remain) 
              values (?,?,?,?,?,?,?,?,?)", array(
                    $id,
                    $supplier_name,
                    $date,
                    $account_type,
                    $deposit_to,
                    $description,
                    $org_amount,
                    $partial,
                    $payment1
                ));

                $summ = DB::table('purchase_invoice')->where('purchase_id', $id)->sum('partial');

                $result5 = DB::select("select* from purchase where pk_id= '$id'  ");
                $balance = $result5[0]->balance;
                $new_balance = $balance - $summ;

                $balance_update = DB::table('purchase')->where('pk_id', $id)->update(['balance' => $new_balance]);

                $resultt = DB::table('purchase')->where('pk_id', $id)->update(['paid_amount' => $summ]);

                $s_name = $request->input('supplier_name');
                $cus_name = DB::select("select* from supplier where supplier_name = '$s_name'");
                $c_balance = $cus_name[0]->current_balance - $partial;
                $update = DB::table('supplier')->where('supplier_name', $s_name)->update(['current_balance' => $c_balance]);

                $account_name = $request->input('account_type');
                $partial = $request->input('partial');
                $accountz = DB::select("select* from account where account_name = '$account_name'");

                if (count($accountz) > 0)
                {
                    $c_balance = $accountz[0]->balance - $partial;
                    $c_balance_decrease = $accountz[0]->decrease + $partial;

                    DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                        ->update(['balance' => $c_balance]);

                    DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                        ->update(['decrease' => $c_balance_decrease]);
                }

            }

        }
        elseif ($partial <= $org_amount)
        {
            $payment1 = $org_amount - $partial;
            
            DB::insert("insert into purchase_invoice (purchase_id,supplier_name,date,account_type,deposit_to,description,org_amount,partial,remain) values (?,?,?,?,?,?,?,?,?)", array(
                $id,
                $supplier_name,
                $date,
                $account_type,
                $deposit_to,
                $description,
                $org_amount,
                $partial,
                $payment1
            ));
            $resultt = DB::table('purchase')->where('pk_id', $id)->update(['paid_amount' => $partial]);

            $summ = DB::table('purchase_invoice')->where('purchase_id', $id)->sum('partial');

            $result5 = DB::select("select* from purchase where pk_id= '$id'  ");
            $balance = $result5[0]->balance;
            $new_balance = $balance - $summ;

            $balance_update = DB::table('purchase')->where('pk_id', $id)->update(['balance' => $new_balance]);

            $s_name = $request->input('supplier_name');
            $cus_name = DB::select("select* from supplier where supplier_name = '$s_name'");
            // return $partial;
            $c_balance = $cus_name[0]->current_balance - $partial;
            $update = DB::table('supplier')->where('supplier_name', $s_name)->update(['current_balance' => $c_balance]);

        //     $account_name = $request->input('account_type');
        //     $partial = $request->input('partial');
        //     $accountz = DB::select("select* from account where account_name = '$account_name'");

        // return $accountz;
        //     if (count($accountz) > 0)
        //     {
        //         $c_balance = $accountz[0]->balance - $partial;
        //         $c_balance_decrease = $accountz[0]->decrease + $partial;

        //         DB::table('account')->where('pk_id', $accountz[0]->pk_id)
        //             ->update(['balance' => $c_balance]);

        //         DB::table('account')->where('pk_id', $accountz[0]->pk_id)
        //             ->update(['decrease' => $c_balance_decrease]);
        //     }

        }
        
        elseif ($partial > $org_amount)
        {
            
            $payment1 = $org_amount - $partial;
            //  return "f";
            DB::insert("insert into purchase_invoice (purchase_id,supplier_name,date,account_type,deposit_to,description,org_amount,partial,remain) values (?,?,?,?,?,?,?,?,?)", array(
                $id,
                $supplier_name,
                $date,
                $account_type,
                $deposit_to,
                $description,
                $org_amount,
                $partial,
                $payment1
            ));
            $resultt = DB::table('purchase')->where('pk_id', $id)->update(['paid_amount' => $partial]);

            $summ = DB::table('purchase_invoice')->where('purchase_id', $id)->sum('partial');

            $result5 = DB::select("select* from purchase where pk_id= '$id'  ");
            $balance = $result5[0]->balance;
            $new_balance = $balance - $summ;

            $balance_update = DB::table('purchase')->where('pk_id', $id)->update(['balance' => $new_balance]);

            $s_name = $request->input('supplier_name');
            $cus_name = DB::select("select* from supplier where supplier_name = '$s_name'");
            // return $partial;
            $c_balance = $cus_name[0]->current_balance - $partial;
            $update = DB::table('supplier')->where('supplier_name', $s_name)->update(['current_balance' => $c_balance]);

            // $account_name = $request->input('account_type');
            // $partial = $request->input('partial');
            // $accountz = DB::select("select* from account where account_name = '$account_name'");

            // if (count($accountz) > 0)
            // {
            //     $c_balance = $accountz[0]->balance - $partial;
            //     $c_balance_decrease = $accountz[0]->decrease + $partial;

            //     DB::table('account')->where('pk_id', $accountz[0]->pk_id)
            //         ->update(['balance' => $c_balance]);

            //     DB::table('account')->where('pk_id', $accountz[0]->pk_id)
            //         ->update(['decrease' => $c_balance_decrease]);
            // }

        }
        
        

        $c_name = $request->input('supplier_name');
        $cus_name = DB::select("select* from supplier where supplier_name = '$c_name'");
        $id = $cus_name[0]->pk_id;
        // return $id;
        return redirect('admin/home/view/purchase/' . $id)->withErrors('Payment recives Successfully!...');

    }

    public function create_payment_sale_view($id, $sale)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $result1 = DB::select("select* from sale where pk_id = '$id'");
        $payment_account = DB::select("select* from account where nature_of_account = 'Assets'");

        $customer = $result1[0]->customer_name;
        $total = $result1[0]->total_amount;
        $customer2 = DB::select("select* from customer where pk_id = '$customer'");

        // $remain = DB::select("select* from sale_invoice where sale_id = '$id'");
        $remain = DB::table('sale_invoice')->where('sale_id', $id)->sum('partial');
        if ($remain > 0)
        {
            $new_total = $total - $remain;
            //  return $new_total;
            
        }
        else
        {
            $new_total = $total;
        }

        $result = DB::select("select* from sale where customer_name = '$id' and sale_type = 'sale'");
        $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale_type = 'sale'");

        return view('admin.receive_payment', compact('total', 'result', 'new_total', 'customer2', 'result1', 'total_amount', 'payment_account'));

    }

    public function create_payment_sale(Request $request, $id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        

        // return $result;
        $account_name = $request->input('account_type');
        $partial = $request->input('partial');

        $account_cash1 = DB::select("select* from account where account_name = '$account_name'");
        if (count($account_cash1))
        {
            $account_cash2 = $account_cash1[0]->balance;
            $partial2 = $account_cash2 + $partial;
            $account_cash = DB::table('account')->where('account_name', $account_name)->update(['balance' => "$partial2"]);
        }
        else
        {
            return Redirect::back()->withErrors('Please Select an Account!...');
        }

        $customer_name = $request->input('customer_name');

        $date = $request->input('date');
        $account_type = $request->input('account_type');
        $deposit_to = $request->input('deposit_to');
        $description = $request->input('description');
        $due_date = $request->input('due_date');

        $org_amount = $request->input('org_amount');

        $partial = $request->input('partial');
        $result = DB::select("select* from sale_invoice where sale_id= '$id'  ");

        if (count($result) > 0)
        {

            $sum = DB::table('sale_invoice')->where('sale_id', $id)->sum('partial');
            $result2 = DB::select("select* from sale_invoice where sale_id= '$id' ORDER BY pk_id DESC ");

            $sum2 = $org_amount - $sum;
            // return $sum2;
            if ($partial <= $sum2)
            {

                $paymentt1 = $result2[0]->remain;
                $payment1 = $paymentt1 - $partial;
                // return $sum;
                DB::insert("insert into sale_invoice 
              (sale_id,customer_name,date,account_type,deposit_to,description,due_date,org_amount,partial,remain) 
              values (?,?,?,?,?,?,?,?,?,?)", array(
                    $id,
                    $customer_name,
                    $date,
                    $account_type,
                    $deposit_to,
                    $description,
                    $due_date,
                    $org_amount,
                    $partial,
                    $payment1
                ));

                $summ = DB::table('sale_invoice')->where('sale_id', $id)->sum('partial');

                //  $paid_bal_update=  DB::table('sale')->where('pk_id', $id)->update(['paid_amount' =>'0']);
                $resultt = DB::table('sale')->where('pk_id', $id)->update(['paid_amount' => $summ]);

                $result5 = DB::select("select* from sale where pk_id= '$id'  ");
                $balance = $result5[0]->balance;
                $new_balance = $balance - $partial;

                $balance_update = DB::table('sale')->where('pk_id', $id)->update(['balance' => $new_balance]);

                $c_name = $request->input('customer_name');
                //   return $c_name;
                $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
                
                // if($cus_name[0]->current_balance > 0)
                // {
                //     $r_bln=(-$cus_name[0]->current_balance);
                //     $c_balance = $cus_name[0]->current_balance + 0;
                //     $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);
                // }
                // elseif($cus_name[0]->current_balance < 0)
                // {
                //     $r_bln=(-$cus_name[0]->current_balance);
                //     $c_balance = $r_bln - $partial;
                //     $m_sign =(-$c_balance);
                //     $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $m_sign]);
                // }
                
                $c_balance = $cus_name[0]->current_balance - $partial;
                $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);

                $account_name = $request->input('account_type');
                $partial = $request->input('partial');
                $accountz = DB::select("select* from account where account_name = '$account_name'");

                if (count($accountz) > 0)
                {

                    $c_balance_increase = $accountz[0]->increase + $partial;

                    DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                        ->update(['increase' => $c_balance_increase]);
                }
                else
                {

                    DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                        'Account Receivable',
                        'Account Receivable',
                        'Account Receivable',
                        $partial,
                        NOW()
                    ));

                }

                $accountzz = DB::select("select* from account where account_type = 'Account Receivable'");
                //  return $accountzz;
                if (count($accountzz) > 0)
                {

                    $c_balance = $accountzz[0]->balance - $partial;
                    $c_balance_increase = $accountzz[0]->increase - $partial;
                    DB::table('account')->where('pk_id', $accountzz[0]->pk_id)
                        ->update(['balance' => $c_balance]);
                    DB::table('account')->where('pk_id', $accountzz[0]->pk_id)
                        ->update(['increase' => $c_balance_increase]);

                }

            }

            elseif ($partial > $sum2)
            {

                $paymentt1 = $result2[0]->remain;
                $payment1 = $paymentt1 - $partial;
                // return $sum;
                DB::insert("insert into sale_invoice 
              (sale_id,customer_name,date,account_type,deposit_to,description,due_date,org_amount,partial,remain) 
              values (?,?,?,?,?,?,?,?,?,?)", array(
                    $id,
                    $customer_name,
                    $date,
                    $account_type,
                    $deposit_to,
                    $description,
                    $due_date,
                    $org_amount,
                    $partial,
                    $payment1
                ));

                $summ = DB::table('sale_invoice')->where('sale_id', $id)->sum('partial');

                //  $paid_bal_update=  DB::table('sale')->where('pk_id', $id)->update(['paid_amount' =>'0']);
                $resultt = DB::table('sale')->where('pk_id', $id)->update(['paid_amount' => $summ]);

                $result5 = DB::select("select* from sale where pk_id= '$id'  ");
                $balance = $result5[0]->balance;
                $new_balance = $balance - $partial;

                $balance_update = DB::table('sale')->where('pk_id', $id)->update(['balance' => $new_balance]);

                $c_name = $request->input('customer_name');
                //   return $c_name;
                $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
               
                // if($cus_name[0]->current_balance >= 0)
                // {
                    
                // $r_bln=(-$cus_name[0]->current_balance);
                // $c_balance = $cus_name[0]->current_balance + 0;
                // $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);
                // }
                // elseif($cus_name[0]->current_balance < 0){
                    
                // $r_bln=(-$cus_name[0]->current_balance);
                // $c_balance = $r_bln - $partial;
                // $m_sign =(-$c_balance);
                // $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $m_sign]);
                // }
                $c_balance = $cus_name[0]->current_balance - $partial;
                $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);

                $account_name = $request->input('account_type');
                $partial = $request->input('partial');
                $accountz = DB::select("select* from account where account_name = '$account_name'");

                if (count($accountz) > 0)
                {

                    $c_balance_increase = $accountz[0]->increase + $partial;

                    DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                        ->update(['increase' => $c_balance_increase]);
                }
                else
                {

                    DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                        'Account Receivable',
                        'Account Receivable',
                        'Account Receivable',
                        $partial,
                        NOW()
                    ));

                }

                $accountzz = DB::select("select* from account where account_type = 'Account Receivable'");
                //  return $accountzz;
                if (count($accountzz) > 0)
                {

                    $c_balance = $accountzz[0]->balance + $partial;
                    $c_balance_increase = $accountzz[0]->decrease + $partial;
                    DB::table('account')->where('pk_id', $accountzz[0]->pk_id)
                        ->update(['balance' => $c_balance]);
                    DB::table('account')->where('pk_id', $accountzz[0]->pk_id)
                        ->update(['decrease' => $c_balance_increase]);

                }

            }

            // else
            // {
            //     $c_name = $request->input('customer_name');
            //     $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
            //     $id = $cus_name[0]->pk_id;
            //     // return $id;
            //     return redirect('admin/home/view/sale/' . $id)->withErrors('Payment Acceed!...');;
            // }
            
        }
        elseif ($partial <= $org_amount)
        {
            $payment1 = $org_amount - $partial;
            //  return "f";
            DB::insert("insert into sale_invoice (sale_id,customer_name,date,account_type,deposit_to,description,due_date,org_amount,partial,remain) values (?,?,?,?,?,?,?,?,?,?)", array(
                $id,
                $customer_name,
                $date,
                $account_type,
                $deposit_to,
                $description,
                $due_date,
                $org_amount,
                $partial,
                $payment1
            ));
            $resultt = DB::table('sale')->where('pk_id', $id)->update(['paid_amount' => $partial]);

            $summ = DB::table('sale_invoice')->where('sale_id', $id)->sum('partial');
            $result5 = DB::select("select* from sale where pk_id= '$id'  ");
            $balance = $result5[0]->balance;
            $new_balance = $balance - $partial;

            $balance_update = DB::table('sale')->where('pk_id', $id)->update(['balance' => $new_balance]);

            $c_name = $request->input('customer_name');
            $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
            // return $partial;
            // if($cus_name[0]->current_balance >= 0)
            // {
                
            // $r_bln=(-$cus_name[0]->current_balance);
            // $c_balance = $cus_name[0]->current_balance + 0;
            // $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);
            // }
            // elseif($cus_name[0]->current_balance < 0){
                
            // $r_bln=(-$cus_name[0]->current_balance);
            // $c_balance = $r_bln - $partial;
            // $m_sign =(-$c_balance);
            // $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $m_sign]);
            // }
            $c_balance = $cus_name[0]->current_balance - $partial;
            $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);

            $account_name = $request->input('account_type');
            $partial = $request->input('partial');
            $accountz = DB::select("select* from account where account_name = '$account_name'");

            if (count($accountz) > 0)
            {

                $c_balance_increase = $accountz[0]->increase + $partial;

                DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                    ->update(['increase' => $c_balance_increase]);
            }
            else
            {

                DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                    'Account Receivable',
                    'Account Receivable',
                    'Account Receivable',
                    $partial,
                    NOW()
                ));

            }

            $accountzz = DB::select("select* from account where account_type = 'Account Receivable'");
            //  return $accountzz;
            if (count($accountzz) > 0)
            {

                $c_balance = $accountzz[0]->balance - $partial;
                $c_balance_increase = $accountzz[0]->increase - $partial;
                DB::table('account')->where('pk_id', $accountzz[0]->pk_id)
                    ->update(['balance' => $c_balance]);
                DB::table('account')->where('pk_id', $accountzz[0]->pk_id)
                    ->update(['increase' => $c_balance_increase]);

            }

        }

        elseif ($partial > $org_amount)
        {
            $payment1 = $org_amount - $partial;
            //  return "f";
            DB::insert("insert into sale_invoice (sale_id,customer_name,date,account_type,deposit_to,description,due_date,org_amount,partial,remain) values (?,?,?,?,?,?,?,?,?,?)", array(
                $id,
                $customer_name,
                $date,
                $account_type,
                $deposit_to,
                $description,
                $due_date,
                $org_amount,
                $partial,
                $payment1
            ));
            $resultt = DB::table('sale')->where('pk_id', $id)->update(['paid_amount' => $partial]);

            $summ = DB::table('sale_invoice')->where('sale_id', $id)->sum('partial');
            $result5 = DB::select("select* from sale where pk_id= '$id'  ");
            $balance = $result5[0]->balance;
            $new_balance = $balance - $partial;

            $balance_update = DB::table('sale')->where('pk_id', $id)->update(['balance' => $new_balance]);

            $c_name = $request->input('customer_name');
            $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
            // return $partial;
            // if($cus_name[0]->current_balance >= 0)
            // {
                
            // $r_bln=(-$cus_name[0]->current_balance);
            // $c_balance = $cus_name[0]->current_balance + 0;
            // $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);
            // }
            // elseif($cus_name[0]->current_balance < 0){
                
            // $r_bln=(-$cus_name[0]->current_balance);
            // $c_balance = $r_bln - $partial;
            // $m_sign =(-$c_balance);
            // $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $m_sign]);
            // }
            
            $c_balance = $cus_name[0]->current_balance - $partial;
            $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);
            
            $account_name = $request->input('account_type');
            $partial = $request->input('partial');
            $accountz = DB::select("select* from account where account_name = '$account_name'");

            if (count($accountz) > 0)
            {

                $c_balance_increase = $accountz[0]->increase + $partial;

                DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                    ->update(['increase' => $c_balance_increase]);
            }
            else
            {

                DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                    'Account Receivable',
                    'Account Receivable',
                    'Account Receivable',
                    $partial,
                    NOW()
                ));

            }

            $accountzz = DB::select("select* from account where account_type = 'Account Receivable'");
            //  return $accountzz;
            if (count($accountzz) > 0)
            {

                $c_balance_increase = $accountzz[0]->decrease + $partial;

                DB::table('account')->where('pk_id', $accountzz[0]->pk_id)
                    ->update(['decrease' => $c_balance_increase]);

            }

        }

        // else
        // {
        //     $c_name = $request->input('customer_name');
        //     $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
        //     $id = $cus_name[0]->pk_id;
        //     // return $id;
        //     return redirect('admin/home/view/sale/' . $id)->withErrors('Payment Acceed!...');
        // }
        

        $c_name = $request->input('customer_name');
        $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
        $id = $cus_name[0]->pk_id;
        // return $id;
        return redirect('admin/home/view/sale/' . $id)->withErrors('Payment Recieved Successfully!...');

    }

    public function sale_return_by_customer_list_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = DB::select("select SUM(total_amount) from sale where sale_type = 'return'");

        $result = DB::select("select* from customer");

        return view('admin.sale_return_by_customer_list_view', compact('result', 'total_amount'));

    }

    public function sale_return_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $result1 = DB::select("select* from customer where pk_id = '$id'");

        $result = DB::select("select* from sale where customer_name = '$id' and sale_type = 'return'");
        $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' and sale_type = 'return'");

        return view('admin.view_sale_return_list', compact('result', 'result1', 'total_amount'));

    }

    public function sale_return_detail_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from detail_sale where sale_id = '$id'");
        $result1 = DB::select("select* from sale where pk_id = '$id'");
        $customer = $result1[0]->customer_name;
        $customer = DB::select("select* from customer where pk_id = '$customer'");
        return view('admin.sale_return_detail_view', compact('result', 'result1', 'customer'));

    }

    public function sale_detailed_by_customer($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        //             if($sale == "tax")
        //  {
        //     $result = DB::select("select* from detail_tax_sale where sale_id = '$id'");
        //  }
        //  else{
        $result = DB::select("select* from detail_sale where sale_id = '$id'");
        //  }
        // return $result;
        $result1 = DB::select("select* from sale where pk_id = '$id'");
        $customer = $result1[0]->customer_name;
        $customer = DB::select("select* from customer where pk_id = '$customer'");
        return view('admin.sale_detail_by_customer', compact('result', 'result1', 'customer', 'sale'));

    }

    public function purchase_detailed_by_customer($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        //             if($sale == "tax")
        //  {
        //     $result = DB::select("select* from detail_tax_sale where sale_id = '$id'");
        //  }
        //  else{
        $result = DB::select("select* from detail_purchase where purchase_id = '$id'");
        //  }
        // return $result;
        $result1 = DB::select("select* from purchase where pk_id = '$id'");
        $customer = $result1[0]->supplier_name;
        $customer = DB::select("select* from supplier where pk_id = '$customer'");
        return view('admin.purchase_detail_by_customer', compact('result', 'result1', 'customer', 'sale'));

    }

    public function sale_detailed_by_customer_name($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        //             if($sale == "tax")
        //  {
        //     $result = DB::select("select* from detail_tax_sale where sale_id = '$id'");
        //  }
        //  else{
        $result = DB::select("select* from detail_sale where sale_id = '$id'");
        //  }
        // return $result;
        $result1 = DB::select("select* from sale where customer_name = '$id'");
        // $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' ");
        $total_amount = DB::table('sale')->where('customer_name', $id)->sum('total_amount');
        // $customer = $result1[0]->customer_name;
        $customer = DB::select("select* from customer where pk_id = '$id'");
        //  return $total_amount;
        $sale = "";
        return view('admin.view_sale_customer', compact('total_amount', 'result', 'result1', 'customer', 'sale'));

    }

    public function sale_detail_view($id, $sale)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        if ($sale == "tax")
        {
            $result = DB::select("select* from detail_tax_sale where sale_id = '$id'");
        }
        else
        {
            $result = DB::select("select* from detail_sale where sale_id = '$id'");
        }
        $result1 = DB::select("select* from sale where pk_id = '$id'");
        $customer = $result1[0]->customer_name;
        $customer = DB::select("select* from customer where pk_id = '$customer'");
        return view('admin.sale_detail_view', compact('result', 'result1', 'customer', 'sale'));

    }

    public function sale_invoice_print($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $result = DB::select("select* from detail_sale where sale_id = '$id'");

        $result1 = DB::select("select* from sale where pk_id = '$id'");
        // return  $result1;
        $customer = $result1[0]->customer_name;
        $customer = DB::select("select* from customer where pk_id = '$customer'");
        return view('admin.invoice', compact('result', 'result1', 'customer'));

    }

    public function edit_sale_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result1 = DB::select("select* from sale where pk_id = '$id'");
        $customer = $result1[0]->customer_name;
        $customer = DB::select("select* from customer");
        $inventory = DB::select("select* from inventory");
        $result = DB::select("select* from detail_sale where sale_id = '$id'");

        return view('admin.edit_sale_view', compact('result', 'result1', 'customer', 'inventory'));

    }

    public function edit_sale(Request $request, $id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $total_amount = 0;
        $sku = $request->input('sku');
        $wordCount = count($sku);
        $item_name = $request->input('item_name');
        $rate = $request->input('rate');
        $quantity = $request->input('quantity');
        $i = 0;
        for ($i = 0;$i < $wordCount;$i++)
        {
            $total_amount = $total_amount + ($quantity[$i] * $rate[$i]);
        }
        DB::table('sale')->where('pk_id', $id)->update(['customer_name' => $request->input('customer_name') , 'account_type' => $request->input('account_type') , 'sale_type' => $request->input('sale_type') , 'company_name' => $request->input('company_name') , 'vehicle_no' => $request->input('vehicle_no') , 'total_amount' => $total_amount]);

        DB::delete("delete from detail_sale where sale_id = '$id'");
        for ($i = 0;$i < $wordCount;$i++)
        {
            $amount = $quantity[$i] * $rate[$i];
            DB::insert("insert into detail_sale (sale_id,sku,item_name,quantity,rate,amount) values (?,?,?,?,?,?)", array(
                $id,
                $sku[$i],
                $item_name[$i],
                $quantity[$i],
                $rate[$i],
                $amount
            ));
        }

        return redirect('/admin/home/view/sale/by/customer');

    }

    public function delete_sale($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        DB::delete("delete from inventory where pk_id = '$id'");

        return redirect()->back();
    }

    /////////////////////
    public function add_sale_tax_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {

            return redirect('/admin')
                ->withErrors('Login Please!...');
        }
        // else{
        //   return Redirect::back()->withErrors('Logged!...');
        // }
        $inventory = DB::select("select* from inventory");
        $result = DB::select("select * from customer");
        $sale = DB::select("select * from sale ORDER BY pk_id DESC");
        $account_type = DB::table('account')->where('account_type', 'Cash')
            ->get();
        if (count($sale) > 0)
        {
            $sale_id = $sale[0]->pk_id + 1;
        }
        else
        {
            $sale_id = 1;
        }

        return view('admin.add_sale_tax_view', compact('result', 'sale_id', 'inventory', 'account_type'));
    }

    public function add_sale_tax(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $sale_type = $request->input('sale_type');
        if ($sale_type == "sale")
        {
            $total_amount = 0;
            $sku = $request->input('sku');
            $wordCount = count($sku);
            $item_name = $request->input('item_name');
            $rate = $request->input('rate');
            $quantity = $request->input('quantity');
            $tax = $request->input('tax');
            $tax_amount = $request->input('tax_amount');
            $amount = $request->input('amount');
            $receiving_method = "bank";
            $i = 0;
            for ($i = 0;$i < $wordCount;$i++)
            {
                $total_amount = $total_amount + $amount[$i];
            }
            $inventory = DB::select("select* from inventory where name = '$item_name[0]'");

            $inventory = $inventory[0]->stock;
            // return $quantity[0];
            if ($inventory > 0 && $quantity[0] <= $inventory)
            {
                $sale = "tax";
                // dd($request->all());
                DB::insert("insert into sale (sti,sale,customer_name,account_type,sale_type,company_name,vehicle_no,total_amount) values (?,?,?,?,?,?,?,?)", array(
                    $request->input('sti') ,
                    $sale,
                    $request->input('customer_name') ,
                    $request->input('account_type') ,
                    $request->input('sale_type') ,
                    $request->input('company_name') ,
                    $request->input('vehicle_no') ,
                    $total_amount
                ));
                $result = DB::select("select* from sale order by pk_id DESC");
                for ($i = 0;$i < $wordCount;$i++)
                {
                    DB::insert("insert into detail_tax_sale (sale_id,sku,item_name,quantity,rate,tax,tax_amount,amount) values (?,?,?,?,?,?,?,?)", array(
                        $result[0]->pk_id,
                        $sku[$i],
                        $item_name[$i],
                        $quantity[$i],
                        $rate[$i],
                        $tax[$i],
                        $tax_amount[$i],
                        $amount[$i]
                    ));
                    $inventory = DB::select("select * from inventory where sku = '$sku[$i]'");
                    if (count($inventory) > 0)
                    {
                        $stock = $inventory[0]->stock - $quantity[$i];
                        DB::table('inventory')->where('sku', $sku[$i])->update(['stock' => $stock]);
                    }

                    if ($request->input('account_type') == "credit")
                    {
                        $account = DB::select("select* from account where account_type = 'Sales Retail'");
                        if (count($account) > 0)
                        {
                            $c_balance = $account[0]->increase + $total_amount;
                            $c_balance_bal = $account[0]->balance + $total_amount;
                            DB::table('account')->where('pk_id', $account[0]->pk_id)
                                ->update(['balance' => $c_balance_bal]);
                            DB::table('account')->where('pk_id', $account[0]->pk_id)
                                ->update(['increase' => $c_balance]);
                        }
                        else
                        {

                            DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                                'Account Receivable',
                                'Account Receivable',
                                'Account Receivable',
                                $total_amount,
                                NOW()
                            ));

                        }

                        $accountss = DB::select("select* from account where account_type = 'Account Receivable'");

                        if (count($accountss) > 0)
                        {
                            $c_balance = $accountss[0]->increase + $total_amount;
                            $c_balance_bal = $accountss[0]->balance + $total_amount;
                            DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                                ->update(['increase' => $c_balance]);
                            DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                                ->update(['balance' => $c_balance_bal]);
                        }

                    }

                }
            }
            else
            {

                return Redirect::back()->withErrors('Inventory kam han!...');

            }

        }

        elseif ($sale_type == "return")
        {

            $total_amount = 0;
            $sku = $request->input('sku');
            $wordCount = count($sku);
            $item_name = $request->input('item_name');
            $rate = $request->input('rate');
            $quantity = $request->input('quantity');
            $tax = $request->input('tax');
            $tax_amount = $request->input('tax_amount');
            $amount = $request->input('amount');
            $receiving_method = "bank";
            $i = 0;
            for ($i = 0;$i < $wordCount;$i++)
            {
                $total_amount = $total_amount + $amount[$i];
            }
            $sale = "tax";
            // dd($request->all());
            DB::insert("insert into sale (sti,sale,customer_name,account_type,sale_type,company_name,vehicle_no,total_amount) values (?,?,?,?,?,?,?,?)", array(
                $request->input('sti') ,
                $sale,
                $request->input('customer_name') ,
                $request->input('account_type') ,
                $request->input('sale_type') ,
                $request->input('company_name') ,
                $request->input('vehicle_no') ,
                $total_amount
            ));
            $result = DB::select("select* from sale order by pk_id DESC");
            for ($i = 0;$i < $wordCount;$i++)
            {
                DB::insert("insert into detail_tax_sale (sale_id,sku,item_name,quantity,rate,tax,tax_amount,amount) values (?,?,?,?,?,?,?,?)", array(
                    $result[0]->pk_id,
                    $sku[$i],
                    $item_name[$i],
                    $quantity[$i],
                    $rate[$i],
                    $tax[$i],
                    $tax_amount[$i],
                    $amount[$i]
                ));
                $inventory = DB::select("select * from inventory where sku = '$sku[$i]'");
                if (count($inventory) > 0)
                {
                    $stock = $inventory[0]->stock + $quantity[$i];
                    DB::table('inventory')->where('sku', $sku[$i])->update(['stock' => $stock]);
                }

                if ($request->input('account_type') == "credit")
                {
                    $account = DB::select("select* from account where account_type = 'Sales Retail'");
                    if (count($account) > 0)
                    {
                        $c_balance = $account[0]->decrease + $total_amount;
                        $c_balance_bal = $account[0]->balance - $total_amount;
                        DB::table('account')->where('pk_id', $account[0]->pk_id)
                            ->update(['balance' => $c_balance_bal]);
                        DB::table('account')->where('pk_id', $account[0]->pk_id)
                            ->update(['decrease' => $c_balance]);
                    }
                    else
                    {

                        DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                            'Account Receivable',
                            'Account Receivable',
                            'Account Receivable',
                            $total_amount,
                            NOW()
                        ));

                    }

                    $accountss = DB::select("select* from account where account_type = 'Account Receivable'");

                    if (count($accountss) > 0)
                    {
                        $c_balance = $accountss[0]->decrease + $total_amount;
                        $c_balance_bal = $accountss[0]->balance - $total_amount;
                        DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                            ->update(['decrease' => $c_balance]);
                        DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                            ->update(['balance' => $c_balance_bal]);
                    }

                }

            }
        }

        return redirect('/admin/home/view/sale/by/customer');

    }

    /////////////////////
    public function add_purchase_tax_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $inventory = DB::select("select* from inventory");
        $result = DB::select("select * from supplier");
        $sale = DB::select("select * from purchase ORDER BY pk_id DESC");

        $account_type = DB::table('account')->where('account_type', 'Cash')
            ->orwhere('account_type', 'Bank Account')
            ->get();
        if (count($sale) > 0)
        {
            $sale_id = $sale[0]->pk_id + 1;
        }
        else
        {
            $sale_id = 1;
        }

        if (count($sale) > 0)
        {
            $sale_id = $sale[0]->pk_id + 1;
        }
        else
        {
            $sale_id = 1;
        }

        return view('admin.add_purchase_tax_view', compact('result', 'sale_id', 'inventory', 'account_type'));
    }

    public function add_purchase_tax(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $purchase_type = $request->input('purchase_type');
        if ($purchase_type == "purchase")
        {
            $total_amount = 0;
            $sku = $request->input('sku');
            $wordCount = count($sku);
            $item_name = $request->input('item_name');
            $rate = $request->input('rate');
            $quantity = $request->input('quantity');
            $tax = $request->input('tax');
            $tax_amount = $request->input('tax_amount');
            $amount = $request->input('amount');
            $i = 0;
            for ($i = 0;$i < $wordCount;$i++)
            {
                $total_amount = $total_amount + $amount[$i];
            }
            $purchase = "tax";
            // dd($request->all());
            DB::insert("insert into purchase (sti,purchase,supplier_name,account_type,purchase_type,company_name,vehicle_no,total_amount) values (?,?,?,?,?,?,?,?)", array(
                $request->input('sti') ,
                $purchase,
                $request->input('supplier_name') ,
                $request->input('account_type') ,
                $request->input('purchase_type') ,
                $request->input('company_name') ,
                $request->input('vehicle_no') ,
                $total_amount
            ));
            $result = DB::select("select* from purchase order by pk_id DESC");

            for ($i = 0;$i < $wordCount;$i++)
            {
                DB::insert("insert into detail_tax_purchase (purchase_id,sku,item_name,quantity,rate,tax,tax_amount,amount,purchase_type) values (?,?,?,?,?,?,?,?,?)", array(
                    $result[0]->pk_id,
                    $sku[$i],
                    $item_name[$i],
                    $quantity[$i],
                    $rate[$i],
                    $tax[$i],
                    $tax_amount[$i],
                    $amount[$i],
                    $purchase_type
                ));

                $inventory = DB::select("select * from inventory where sku = '$sku[$i]'");
                if (count($inventory) > 0)
                {
                    $stock = $inventory[0]->stock + $quantity[$i];
                    DB::table('inventory')->where('sku', $sku[$i])->update(['stock' => $stock]);
                }

                if ($request->input('account_type') == "credit")
                {
                    $account = DB::select("select* from account where account_type = 'Account Payable'");
                    if (count($account) > 0)
                    {
                        $c_balance = $account[0]->balance + $total_amount;
                        $c_balance_inc = $account[0]->increase + $total_amount;
                        DB::table('account')->where('pk_id', $account[0]->pk_id)
                            ->update(['balance' => $c_balance]);
                        DB::table('account')->where('pk_id', $account[0]->pk_id)
                            ->update(['increase' => $c_balance_inc]);

                    }
                    else
                    {

                        DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                            'Account Payable',
                            'Account Payable',
                            'Account Payable',
                            $total_amount,
                            NOW()
                        ));

                    }
                }

            }
        }
        elseif ($purchase_type == "return")

        {
            $total_amount = 0;
            $sku = $request->input('sku');
            $wordCount = count($sku);
            $item_name = $request->input('item_name');
            $rate = $request->input('rate');
            $quantity = $request->input('quantity');
            $tax = $request->input('tax');
            $tax_amount = $request->input('tax_amount');
            $amount = $request->input('amount');
            $i = 0;
            for ($i = 0;$i < $wordCount;$i++)
            {
                $total_amount = $total_amount + $amount[$i];
            }
            $purchase = "tax";
            // dd($request->all());
            DB::insert("insert into purchase (sti,purchase,supplier_name,account_type,purchase_type,company_name,vehicle_no,total_amount) values (?,?,?,?,?,?,?,?)", array(
                $request->input('sti') ,
                $purchase,
                $request->input('supplier_name') ,
                $request->input('account_type') ,
                $request->input('purchase_type') ,
                $request->input('company_name') ,
                $request->input('vehicle_no') ,
                $total_amount
            ));
            $result = DB::select("select* from purchase order by pk_id DESC");

            for ($i = 0;$i < $wordCount;$i++)
            {
                DB::insert("insert into detail_tax_purchase (purchase_id,sku,item_name,quantity,rate,tax,tax_amount,amount,purchase_type) values (?,?,?,?,?,?,?,?,?)", array(
                    $result[0]->pk_id,
                    $sku[$i],
                    $item_name[$i],
                    $quantity[$i],
                    $rate[$i],
                    $tax[$i],
                    $tax_amount[$i],
                    $amount[$i],
                    $purchase_type
                ));

                $inventory = DB::select("select * from inventory where sku = '$sku[$i]'");
                if (count($inventory) > 0)
                {
                    $stock = $inventory[0]->stock - $quantity[$i];
                    DB::table('inventory')->where('sku', $sku[$i])->update(['stock' => $stock]);
                }

                if ($request->input('account_type') == "credit")
                {
                    $account = DB::select("select* from account where account_type = 'Account Payable'");
                    if (count($account) > 0)
                    {
                        $c_balance = $account[0]->balance - $total_amount;
                        $c_balance_inc = $account[0]->increase - $total_amount;
                        DB::table('account')->where('pk_id', $account[0]->pk_id)
                            ->update(['balance' => $c_balance]);
                        DB::table('account')->where('pk_id', $account[0]->pk_id)
                            ->update(['increase' => $c_balance_inc]);

                    }
                    else
                    {

                        DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                            'Account Payable',
                            'Account Payable',
                            'Account Payable',
                            $total_amount,
                            NOW()
                        ));

                    }
                }

            }
        }
        return redirect('/admin/home/view/purchase/by/supplier');

    }

    function fetch(Request $request)
    {
        if ($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('inventory')->where('name', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row)
            {
                $output .= '
       <li><a href="#" class="form-control" style="border-bottom-right-radius: 18px; border-top-left-radius: 18px;">' . $row->name . '</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    function fetchsupplier(Request $request)
    {
        if ($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('supplier')->where('supplier_name', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row)
            {
                $output .= '
       <li><a href="#" class="form-control" style="border-bottom-right-radius: 18px; border-top-left-radius: 18px;">' . $row->supplier_name . '</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    function fetchcustomer(Request $request)
    {
        if ($request->get('query'))
        {
            $query = $request->get('query');
            $data = DB::table('customer')->where('customer_name', 'LIKE', "%{$query}%")->get();
            $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row)
            {
                $output .= '
       <li><a href="#" class="form-control" style="border-bottom-right-radius: 18px; border-top-left-radius: 18px;">' . $row->customer_name . '</a></li>
       ';
            }
            $output .= '</ul>';
            echo $output;
        }
    }

    ///////////////////
    public function add_purchase_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $inventory = DB::select("select* from inventory");
        $result = DB::select("select * from supplier");
        $sale = DB::select("select * from purchase ORDER BY pk_id DESC");
        // $account_type  = DB::table('account')->where('account_type','Cash')->get();
        $account_type = DB::table('account')->where('account_type', 'Cash')
            ->orwhere('account_type', 'Bank Account')
            ->get();
        if (count($sale) > 0)
        {
            $sale_id = $sale[0]->pk_id + 1;
        }
        else
        {
            $sale_id = 1;
        }

        return view('admin.add_purchase_view', compact('result', 'sale_id', 'inventory', 'account_type'));
    }

    public function add_purchase(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // if ($request->input('account_type') == "cash")
        // {
        //     $account = DB::select("select* from account where account_type = 'Cash'");
        //     if (empty($account))
        //     {
        //         return Redirect::back()->withErrors('Cash Account Not Exist');
        //     }
        // }
        $purchase_type = "purchase";

        // return "puchase";
        $total_amount = 0;
        $sku = $request->input('sku');
        $wordCount = count($sku);
        $item_name = $request->input('item_name');
        $rate = $request->input('rate');
        $quantity = $request->input('quantity');
        $i = 0;
        for ($i = 0;$i < $wordCount;$i++)
        {
            $total_amount = $total_amount + ($quantity[$i] * $rate[$i]);
        }
        $purchase = "kachi parchi";
        DB::insert("insert into purchase (bill_date,purchase,supplier_name,account_type,purchase_type,company_name,vehicle_no,total_amount,balance,created_at) values (?,?,?,?,?,?,?,?,?,?)", array(
            $request->input('date') ,
            $purchase,
            $request->input('supplier_name') ,
            $request->input('account_type') ,
            $request->input('purchase_type') ,
            $request->input('company_name') ,
            $request->input('vehicle_no') ,
            $total_amount,
            $total_amount,
            $request->input('date')
        ));
        $result = DB::select("select* from purchase order by pk_id DESC");
        //              $result[0]->sku
        

        //  $last_id = DB::getPdo()->lastInsertId();
        //              $account = DB::select("select* from inventory where pk_id = '$last_id'");
        //              if(count($account)>0)
        //              {
        //                 $op_update= $account[0]->opening_balance+$total_amount;
        //                   DB::table('inventory')->where('sku', $sku[$i])->update(['opening_balance' =>$op_update]);
        //              }
        for ($i = 0;$i < $wordCount;$i++)
        {
            $amount = $quantity[$i] * $rate[$i];
            DB::insert("insert into detail_purchase (purchase_id,sku,item_name,quantity,rate,amount,purchase_type) values (?,?,?,?,?,?,?)", array(
                $result[0]->pk_id,
                $sku[$i],
                $item_name[$i],
                $quantity[$i],
                $rate[$i],
                $amount,
                $purchase_type
            ));
            $inventory = DB::select("select * from inventory where sku = '$sku[$i]'");
            if (count($inventory) > 0)
            {
                $op_update = $inventory[0]->opening_balance + $amount;
                $stock = $inventory[0]->stock + $quantity[$i];
                DB::table('inventory')->where('sku', $sku[$i])->update(['stock' => $stock]);

                DB::table('inventory')->where('sku', $sku[$i])->update(['opening_balance' => $op_update]);

            }

            $c_name = $request->input('supplier_name');
            // return $c_name;
            $cus_name = DB::select("select* from supplier where pk_id = '$c_name'");
            $c_balance = $cus_name[0]->current_balance + $amount;
            DB::table('supplier')->where('pk_id', $c_name)->update(['current_balance' => $c_balance]);

            $account = DB::select("select* from account where account_type = 'Account Payable'");
            if (count($account) > 0)
            {
                $c_balance = $account[0]->balance + $amount;

                DB::table('account')->where('pk_id', $account[0]->pk_id)
                    ->update(['balance' => $c_balance]);

            }
            else
            {

                DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                    'Account Payable',
                    'Account Payable',
                    'Account Payable',
                    $total_amount,
                    NOW()
                ));

            }

            $accountz = DB::select("select* from account where account_type = 'purchase'");
            if (count($account) > 0)
            {
                $c_balance = $accountz[0]->balance + $amount;
                $c_balance_inc = $accountz[0]->increase + $amount;
                DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                    ->update(['balance' => $c_balance]);
                DB::table('account')->where('pk_id', $accountz[0]->pk_id)
                    ->update(['increase' => $c_balance_inc]);

            }

            // else
            // {
            //     DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
            //         'Account Payable',
            //         'Account Payable',
            //         'Account Payable',
            //         $total_amount,
            //         NOW()
            //     ));
            // }
            

            
        }

        return redirect('/admin/home/view/purchase/by/supplier');

    }
    public function purchase_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from supplier where pk_id = '$id'");

        $result = DB::select("select* from purchase where supplier_name = '$id' and status='active' ");
        $total_amount = DB::select("select SUM(total_amount) from purchase where supplier_name = '$id' ");

        return view('admin.view_purchase_list', compact('result', 'result1', 'total_amount'));

    }

    public function open_purchase_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from supplier where pk_id = '$id'");

        $result = DB::select("select* from purchase where supplier_name = '$id' and status='active' and paid_amount='0' ");
        $total_amount = DB::select("select SUM(total_amount) from purchase where supplier_name = '$id' and paid_amount='0' ");

        return view('admin.view_purchase_list', compact('result', 'result1', 'total_amount'));

    }

    public function partial_purchase_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from supplier where pk_id = '$id'");

        $result = DB::select("select* from purchase where supplier_name = '$id' and status='active' and paid_amount>0 and paid_amount<total_amount ");
        $total_amount = DB::select("select SUM(total_amount) from purchase where supplier_name = '$id' and paid_amount>0 and paid_amount<total_amount ");

        return view('admin.view_purchase_list', compact('result', 'result1', 'total_amount'));

    }

    public function paid_purchase_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from supplier where pk_id = '$id'");

        $result = DB::select("select* from purchase where supplier_name = '$id' and status='active' and balance='0' ");
        $total_amount = DB::select("select SUM(total_amount) from purchase where supplier_name = '$id' and balance='0' ");

        return view('admin.view_purchase_list', compact('result', 'result1', 'total_amount'));

    }

    public function inactive_purchase_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from supplier where pk_id = '$id'");

        $result = DB::select("select* from purchase where supplier_name = '$id' and status='inactive'  ");
        $total_amount = DB::select("select SUM(total_amount) from purchase where supplier_name = '$id'  ");

        return view('admin.view_purchase_list', compact('result', 'result1', 'total_amount'));

    }

    public function purchase_return_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from supplier where pk_id = '$id'");

        $result = DB::select("select* from purchase where supplier_name = '$id' and purchase_type = 'return'");
        $total_amount = DB::select("select SUM(total_amount) from purchase where supplier_name = '$id' and purchase_type = 'return'");

        return view('admin.view_purchase_return_list', compact('result', 'result1', 'total_amount'));

    }

    public function purchase_detail_view($id, $purchase)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        if ($purchase == "tax")
        {
            $result = DB::select("select* from detail_tax_purchase where purchase_id = '$id'");
        }
        else
        {
            $result = DB::select("select* from detail_purchase where purchase_id = '$id'");
        }
        $result1 = DB::select("select* from purchase where pk_id = '$id'");
        $supplier = $result1[0]->supplier_name;
        $supplier = DB::select("select* from supplier where pk_id = '$supplier'");
        return view('admin.purchase_detail_view', compact('result', 'result1', 'supplier', 'purchase'));

    }

    public function purchase_detail_view_print($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return "asd";
        $result = DB::select("select* from detail_purchase where purchase_id = '$id'");

        $result1 = DB::select("select* from purchase where pk_id = '$id'");
        $supplier = $result1[0]->supplier_name;
        $supplier = DB::select("select* from supplier where pk_id = '$supplier'");
        return view('admin.purchase_invoice_print', compact('result', 'result1', 'supplier'));

    }

    public function purchase_return_detail_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from detail_purchase where purchase_id = '$id'");
        $result1 = DB::select("select* from purchase where pk_id = '$id'");
        $supplier = $result1[0]->supplier_name;
        $supplier = DB::select("select* from supplier where pk_id = '$supplier'");
        return view('admin.purchase_return_detail_view', compact('result', 'result1', 'supplier'));

    }
    public function purchase_by_supplier_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = DB::select("select SUM(total_amount) from purchase where purchase_type = 'purchase'");
        // dd($total_amount);
        $result = DB::select("select* from supplier");

        return view('admin.purchase_by_supplier_list_view', compact('result', 'total_amount'));

    }

    public function purchase_return_by_supplier_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = DB::select("select SUM(total_amount) from purchase where purchase_type = 'purchase return'");

        $result = DB::select("select* from supplier");

        return view('admin.purchase_return_by_supplier_list_view', compact('result', 'total_amount'));

    }
    public function edit_purchase_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result1 = DB::select("select* from purchase where pk_id = '$id'");
        $supplier = $result1[0]->supplier_name;
        $supplier = DB::select("select* from supplier");
        $inventory = DB::select("select* from inventory");
        $result = DB::select("select* from detail_purchase where purchase_id = '$id'");

        return view('admin.edit_purchase_view', compact('result', 'result1', 'supplier', 'inventory'));

    }

    public function edit_purchase(Request $request, $id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $total_amount = 0;
        $sku = $request->input('sku');
        $wordCount = count($sku);
        $item_name = $request->input('item_name');
        $rate = $request->input('rate');
        $quantity = $request->input('quantity');
        $i = 0;
        for ($i = 0;$i < $wordCount;$i++)
        {
            $total_amount = $total_amount + ($quantity[$i] * $rate[$i]);
        }
        DB::table('purchase')->where('pk_id', $id)->update(['supplier_name' => $request->input('supplier_name') , 'account_type' => $request->input('account_type') , 'purchase_type' => $request->input('purchase_type') , 'company_name' => $request->input('company_name') , 'vehicle_no' => $request->input('vehicle_no') , 'total_amount' => $total_amount]);

        DB::delete("delete from detail_purchase where purchase_id = '$id'");
        for ($i = 0;$i < $wordCount;$i++)
        {
            $amount = $quantity[$i] * $rate[$i];
            DB::insert("insert into detail_purchase (purchase_id,sku,item_name,quantity,rate,amount) values (?,?,?,?,?,?)", array(
                $id,
                $sku[$i],
                $item_name[$i],
                $quantity[$i],
                $rate[$i],
                $amount
            ));
        }

        return redirect('/admin/home/view/purchase/by/supplier');

    }

    public function delete_purchase($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        DB::delete("delete from purchase where pk_id = '$id'");

        DB::delete("delete from detail_purchase where purchase_id = '$id'");
        return redirect()->back();
    }

    public function purchase_by_item_list_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = DB::select("select SUM(amount) from detail_purchase");
        $result = DB::select("select* from inventory");
        return view('admin.purchase_by_item_list_view', compact('result', 'total_amount'));

    }
    public function purchase_detail_by_item_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from detail_purchase,purchase where detail_purchase.sku = '$id' and detail_purchase.purchase_id = purchase.pk_id");

        $total_amount = DB::select("select SUM(amount) from detail_purchase where sku = '$id'");
        return view('admin.purchase_detail_by_item_view', compact('total_amount', 'result'));

    }

    public function purchase_by_invoice_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = DB::select("select SUM(total_amount) from purchase");
        $result = DB::select("select* from purchase");
        $result1 = DB::select("select* from supplier");
        // return $result[0]->supplier_name;
        return view('admin.purchase_by_invoice_list_views', compact('result', 'result1', 'total_amount'));

    }

    public function search_purchase_by_invoice_list_view_date(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $result = "Select* from purchase where ";

        // $result = "Select* from expense where ";
        $check = 0;

        if ($request->input('date_from'))
        {
            if ($check == 1)
            {
                $result .= "and created_at BETWEEN '$date_from' AND '$date_to' ";
            }
            else
            {
                $result .= "created_at BETWEEN '$date_from' AND '$date_to' ";
                $check = 1;
            }
        }

        $total_amount = DB::select("select SUM(total_amount) from purchase where created_at BETWEEN '$date_from' AND '$date_to'  ");
        // $result = DB::select("select* from sale");
        $result1 = DB::select("select* from supplier");
        // return $result[0]->supplier_name;
        

        $result = DB::select("$result");

        return view('admin.purchase_by_invoice_list_views', compact('result', 'total_amount', 'result1'));

    }

    public function purchase_by_invoice_list_view_supplier(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $name = $request->input('supplier_name');

        $total_amount = DB::select("select SUM(total_amount) from purchase where supplier_name= '$name'");
        // return $total_amount;
        $result = DB::select("select* from purchase where supplier_name= '$name'");
        // return $result ;
        $result1 = DB::select("select* from supplier");
        return view('admin.purchase_by_invoice_list_views', compact('result', 'total_amount', 'result1'));

    }

    public function sale_by_invoice_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $total_amount = DB::select("select SUM(total_amount) from sale");
        $result = DB::select("select* from sale");
        $result1 = DB::select("select* from customer");

        return view('admin.sale_by_invoice_list_views', compact('result', 'total_amount', 'result1'));

    }

    public function sale_by_invoice_list_view_pdf()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = DB::select("select SUM(total_amount) from sale");
        $result = DB::select("select* from sale");
        $result1 = DB::select("select* from customer");

        $pdf = PDF::loadView('admin.sale_by_invoice_list_views_pdf', compact('result', 'total_amount', 'result1'));

        return $pdf->download('testt.pdf');

    }

    public function expense_report()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $total_amount = DB::select("select SUM(amount) from expense");
        $result = DB::select("select* from expense");
        // return $result;
        $result1 = DB::select("select* from customer");
        // return $result;
        

        return view('admin.expense_report', compact('result', 'total_amount', 'result1'));

    }

    public function expense_report_pdf()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = DB::select("select SUM(amount) from expense");
        $result = DB::select("select* from expense");
        // return $result;
        $result1 = DB::select("select* from customer");

        $pdf = PDF::loadView('admin.expense_report_pdf', compact('result', 'total_amount', 'result1'));

        return $pdf->download('test.pdf');

    }

    public function expense_report_print()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $total_amount = DB::select("select SUM(amount) from expense");
        $result = DB::select("select* from expense");
        $result1 = DB::select("select* from customer");
        // return $result;
        

        return view('admin.expense_report_print', compact('result', 'total_amount', 'result1'));

    }

    public function print_page()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $total_amount = DB::select("select SUM(total_amount) from sale");
        $result = DB::select("select* from sale");
        $result1 = DB::select("select* from customer");
        // return $result[0]->supplier_name;
        

        return view('admin.printpage', compact('result', 'total_amount', 'result1'));

    }

    public function pdf_sale_by_customer()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $total_amount = DB::select("select SUM(total_amount) from sale");
        $result = DB::select("select* from sale");
        $result1 = DB::select("select* from customer");
        // return $result[0]->supplier_name;
        // return view('admin.pdf_sale_by_customer',compact('result','total_amount','result1'));
        $pdf = PDF::loadView('admin.pdf_sale_by_customer', compact('result', 'total_amount', 'result1'));

        return $pdf->download('test.pdf');

        // return view('admin.printpage',compact('result','total_amount','result1'));
        
    }

    public function pdf_test()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $pdf = PDF::loadView('admin.pdf_test');

        return $pdf->download('test.pdf');

    }

    public function csv_export()
    {

        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function search_sale_by_invoice_list_view_date(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $tax_sale = $request->input('tax_sale');
        //  return $tax_sale;
        $result = "Select* from sale where ";

        // $result = "Select* from expense where ";
        $check = 0;

        if ($request->input('date_from'))
        {
            if ($check == 1)
            {
                $result .= "and created_at BETWEEN '$date_from' AND '$date_to' ";
            }
            else
            {
                $result .= "created_at BETWEEN '$date_from' AND '$date_to' ";
                $check = 1;
            }
        }

        if ($request->input('tax_sale'))
        {
            if ($check == 1)
            {
                return "ads";
                $result .= "created_at BETWEEN '$date_from' AND '$date_to' ";
            }
            else
            {
                $result .= "created_at BETWEEN '$date_from' AND '$date_to' ";
                $check = 1;
            }
        }

        $total_amount = DB::select("select SUM(total_amount) from sale  where created_at BETWEEN '$date_from' AND '$date_to' ");
        // $result = DB::select("select* from sale");
        $result1 = DB::select("select* from customer");
        // return $result[0]->supplier_name;
        

        $result = DB::select("$result");

        return view('admin.sale_by_invoice_list_views', compact('result', 'total_amount', 'result1'));

    }

    public function sale_by_invoice_list_view_customer(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $name = $request->input('customer_name');

        $total_amount = DB::select("select SUM(total_amount) from sale where customer_name= '$name'");
        // return $total_amount;
        $result = DB::select("select* from sale where customer_name= '$name'");
        // return $result ;
        $result1 = DB::select("select* from customer");
        return view('admin.sale_by_invoice_list_views', compact('result', 'total_amount', 'result1'));

    }

    public function purchase_detail_by_invoice_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from purchase where pk_id = '$id'");
        $supplier = $result1[0]->supplier_name;
        $supplier = DB::select("select* from supplier where pk_id = '$supplier'");
        $result = DB::select("select* from detail_purchase where purchase_id = '$id'");
        return view('admin.purchase_detail_by_invoice_view', compact('result', 'result1', 'supplier'));

    }

    public function sale_detail_by_invoice_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from sale where pk_id = '$id'");
        $customer = $result1[0]->customer_name;
        $customer = DB::select("select* from customer where pk_id = '$customer'");
        $result = DB::select("select* from detail_sale where sale_id = '$id'");
        return view('admin.sale_detail_by_invoice_view', compact('result', 'result1', 'customer'));

    }

    ///////////////////////
    public function pump_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from pump where status = '0'");
        return view('admin.pump_list_view', compact('result'));

    }

    public function add_pump_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return view('admin.add_pump_view');
    }
    public function add_pump(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = 0;
        $pump_name = $request->input('pump_name');

        $tank_name = $request->input('tank_name');
        $total_capacity = $request->input('total_capacity');
        $total_dip = $request->input('total_dip');
        $opening_stock = $request->input('opening_stock');
        $uom = $request->input('uom');
        $opening_balance = $request->input('opening_balance');
        $opening_dip = $request->input('opening_dip');

        $wordCount = count($tank_name);

        DB::insert("insert into pump (pump_name,pump_address) values (?,?)", array(
            $request->input('pump_name') ,
            $request->input('pump_address')
        ));
        $result = DB::select("select* from pump where pump_name = '$pump_name' order by pk_id DESC");
        if (count($result) > 0)
        {
            $pump_id = $result[0]->pk_id;
            for ($i = 0;$i < $wordCount;$i++)
            {
                DB::insert("insert into tank (pump_id,tank_name,total_capacity,total_dip,opening_stock,uom,opening_balance,opening_dip) values (?,?,?,?,?,?,?,?)", array(
                    $result[0]->pk_id,
                    $tank_name[$i],
                    $total_capacity[$i],
                    $total_dip[$i],
                    $opening_stock[$i],
                    $uom[$i],
                    $opening_balance[$i],
                    $opening_dip[$i]
                ));

            }
        }
        return redirect('/admin/home/view/pump');

    }

    public function edit_pump_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from pump where pk_id = '$id'");
        return view('admin.edit_pump_view', compact('result'));
    }
    public function edit_pump(Request $request, $id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        DB::table('pump')
            ->where('pk_id', $id)->update(['pump_name' => $request->input('pump_name') , 'pump_address' => $request->input('pump_address') ]);

        return redirect('/admin/home/view/pump');

    }

    public function delete_pump($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $status = 1;
        DB::table('pump')->where('pk_id', $id)->update(['status' => $status]);

        return redirect()->back();

    }

    /////////////////////////
    public function machine_list_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result1 = DB::select("select* from pump where pk_id = '$id'");
        $result = DB::select("select* from machine where pump_id = '$id'");
        $result = DB::table('machine')->join('pump', 'pump.pk_id', '=', 'machine.pump_id')
            ->where('pump.pk_id', $id)->get();
        // dd($result);
        // dd($resul;;t,$result1);
        // $result = DB::table('pump')
        return view('admin.machine_list_view', compact('result', 'result1'));

    }

    public function add_machine_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from pump where pk_id = '$id'");
        $result1 = DB::select("select* from tank where pump_id = '$id'");
        return view('admin.add_machine_view', compact('result', 'result1', 'id'));
    }

    public function add_machine(Request $request, $id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $machine_name = $request->input('machine_name');
        $closing_reading = $request->input('closing_reading');
        $rate = $request->input('rate');
        $current_dip = $request->input('current_dip');

        $wordCount = count($machine_name);

        for ($i = 0;$i < $wordCount;$i++)
        {
            DB::insert("insert into machine (pump_id,tank_id,machine_name,closing_reading,rate,current_dip) values (?,?,?,?,?,?)", array(
                $id,
                $request->input('tank_name') ,
                $machine_name[$i],
                $closing_reading[$i],
                $rate[$i],
                $current_dip[$i]
            ));

        }

        return redirect("/admin/home/view/machine/$id");

    }
    public function machine_detail_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from machine where pk_id = '$id'");
        if (!empty($result))
        {

            $tank_id = $result[0]->tank_id;
            $result1 = DB::select("select* from tank where pk_id = '$tank_id'");
            return view('admin.machine_detail_view', compact('result', 'result1'));
        }
        else
        {
            return view('admin.machine_detail_view');
        }

    }

    public function edit_machine_view($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from machine where pk_id='$id'");
        $pump_id = $result[0]->pump_id;
        $result1 = DB::select("select* from pump where pk_id='$pump_id'");
        $result2 = DB::select("select* from tank");
        return view('admin.edit_machine_view', compact('result', 'result1', 'result2'));
    }

    public function edit_machine(Request $request, $id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::table('machine')
            ->where('pk_id', $id)->update(['tank_id' => $request->input('tank_name') , 'machine_name' => $request->input('machine_name') , 'closing_reading' => $request->input('closing_reading') , 'rate' => $request->input('rate') , 'current_dip' => $request->input('current_dip') ]);

        return redirect("admin/home/view/machine/detail/$id");
    }
    public function delete_machine($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::delete("delete from machine where pk_id = '$id'");
        return redirect()->back();

    }
    //////////////////////////
    public function edit_tank_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from tank where pk_id = '$id'");
        $pump_id = $result[0]->pump_id;
        $result1 = DB::select("select* from pump where pk_id='$pump_id'");

        return view('admin.edit_tank_view', compact('result', 'result1'));
    }

    public function edit_tank(Request $request, $id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::table('tank')
            ->where('pk_id', $id)->update(['tank_name' => $request->input('tank_name') , 'total_capacity' => $request->input('total_capacity') , 'total_dip' => $request->input('total_dip') , 'opening_stock' => $request->input('opening_stock') , 'uom' => $request->input('uom') , 'opening_balance' => $request->input('opening_balance') , 'opening_dip' => $request->input('opening_dip') ]);
        $result = DB::select("select* from tank where pk_id = '$id'");
        $pump_id = $result[0]->pump_id;

        return redirect("admin/home/view/machine/$pump_id");
    }

    ////////////////////////////////////////////////
    public function pump_purchase_by_supplier_list_view($pump_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        session()
            ->put('pump_id', $pump_id);
        $total_amount = DB::select("select SUM(total_amount) from purchase where purchase_type='purchase'");
        $pump = DB::select("select* from pump where pk_id = '$pump_id'");
        $result = DB::select("select* from supplier");

        return view('admin.pump_purchase_by_supplier_list_view', compact('result', 'total_amount', 'pump_id', 'pump'));

    }

    public function pump_purchase_return_by_supplier_list_view($pump_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        session()
            ->put('pump_id', $pump_id);
        $total_amount = DB::select("select SUM(total_amount) from purchase where purchase_type='purchase return'");
        $pump = DB::select("select* from pump where pk_id = '$pump_id'");
        $result = DB::select("select* from supplier");

        return view('admin.pump_purchase_return_by_supplier_list_view', compact('result', 'total_amount', 'pump_id', 'pump'));

    }

    public function add_pump_purchase_view($pump_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $pump = DB::select("select* from pump where pk_id = '$pump_id'");
        $tank = DB::select("select* from tank where pump_id = '$pump_id'");
        $inventory = DB::select("select* from inventory");
        $result = DB::select("select * from supplier");
        $sale = DB::select("select * from pump_purchase ORDER BY pk_id DESC");
        if (count($sale) > 0)
        {
            $sale_id = $sale[0]->pk_id + 1;
        }
        else
        {
            $sale_id = 1;
        }

        return view('admin.add_pump_purchase_view', compact('result', 'tank', 'sale_id', 'inventory', 'pump_id', 'pump'));
    }

    public function add_pump_purchase(Request $request, $pump_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $sku = $request->input('sku');
        $tank_name = $request->input('tank_name');
        $item_name = $request->input('item_name');
        $total_amount = 0;
        $wordCount = count($tank_name);
        $quantity = $request->input('quantity');
        $rate = $request->input('rate');
        $i = 0;
        for ($i = 0;$i < $wordCount;$i++)
        {
            $total_amount = $total_amount + ($quantity[$i] * $rate[$i]);
        }

        DB::insert("insert into pump_purchase (pump_id,supplier_name,account_type,purchase_type,company_name,vehicle_no,total_amount) values (?,?,?,?,?,?,?)", array(
            $pump_id,
            $request->input('supplier_name') ,
            $request->input('account_type') ,
            $request->input('purchase_type') ,
            $request->input('company_name') ,
            $request->input('vehicle_no') ,
            $total_amount
        ));
        $result = DB::select("select* from pump_purchase order by pk_id DESC");
        for ($i = 0;$i < $wordCount;$i++)
        {
            $amount = $quantity[$i] * $rate[$i];
            DB::insert("insert into pump_detail_purchase (purchase_id,tank_id,sku,item_name,quantity,rate,amount) values (?,?,?,?,?,?,?)", array(
                $result[0]->pk_id,
                $tank_name[$i],
                $sku[$i],
                $item_name[$i],
                $quantity[$i],
                $rate[$i],
                $amount
            ));
        }

        return redirect("/admin/home/view/pump/purchase/by/supplier/$pump_id");

    }

    public function pump_for_purchase_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from pump");
        return view('admin.pump_for_purchase_list_view', compact('result'));

    }

    public function pump_purchase_list_view($id, $pump_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $pump = DB::select("select* from pump where pk_id = '$pump_id'");
        $result1 = DB::select("select* from supplier where pk_id = '$id'");

        $result = DB::select("select* from pump_purchase where supplier_name = '$id' and purchase_type = 'purchase'");
        $total_amount = DB::select("select SUM(total_amount) from pump_purchase where supplier_name = '$id' and purchase_type = 'purchase'");

        return view('admin.view_pump_purchase_list', compact('result', 'result1', 'total_amount', 'pump', 'pump_id'));

    }
    public function pump_purchase_return_list_view($id, $pump_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $pump = DB::select("select* from pump where pk_id = '$pump_id'");
        $result1 = DB::select("select* from supplier where pk_id = '$id'");

        $result = DB::select("select* from pump_purchase where supplier_name = '$id' and purchase_type = 'purchase return'");
        $total_amount = DB::select("select SUM(total_amount) from pump_purchase where supplier_name = '$id' and purchase_type = 'purchase return'");

        return view('admin.view_pump_purchase_return_list', compact('result', 'result1', 'total_amount', 'pump', 'pump_id'));

    }

    public function pump_purchase_detail_view($id, $purchase)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        if ($purchase == "tax")
        {
            $result = DB::select("select* from pump_detail_purchase_tax where purchase_id = '$id'");
        }
        else
        {
            $result = DB::select("select* from pump_detail_purchase where purchase_id = '$id'");
        }

        $result1 = DB::select("select* from pump_purchase where pk_id = '$id' and purchase_type='purchase'");
        $pump_id = $result1[0]->pump_id;
        $pump = DB::select("select* from pump where pk_id = '$pump_id'");
        $supplier = $result1[0]->supplier_name;
        $supplier = DB::select("select* from supplier where pk_id = '$supplier'");
        return view('admin.pump_purchase_detail_view', compact('pump', 'result', 'result1', 'supplier'));

    }

    public function pump_purchase_return_detail_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from pump_detail_purchase where purchase_id = '$id'");
        $result1 = DB::select("select* from pump_purchase where pk_id = '$id' and purchase_type='purchase return'");
        $pump_id = $result1[0]->pump_id;
        $pump = DB::select("select* from pump where pk_id = '$pump_id'");
        $supplier = $result1[0]->supplier_name;
        $supplier = DB::select("select* from supplier where pk_id = '$supplier'");
        return view('admin.pump_purchase_return_detail_view', compact('pump', 'result', 'result1', 'supplier'));

    }

    public function edit_pump_purchase_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result1 = DB::select("select* from pump_purchase where pk_id = '$id'");
        $pump_id = $result1[0]->pump_id;
        $pump = DB::select("select* from pump where pk_id = '$pump_id'");
        $supplier = $result1[0]->supplier_name;
        $result = DB::select("select* from supplier");
        $inventory = DB::select("select* from inventory");
        $detail = DB::select("select* from pump_detail_purchase where purchase_id = '$id'");
        $tank_id = $detail[0]->tank_id;
        $tank = DB::select("select* from tank where pk_id = '$tank_id'");
        return view('admin.edit_pump_purchase_view', compact('result', 'tank', 'result1', 'supplier', 'inventory', 'pump', 'id', 'detail'));

    }

    ////////////////////////////////////////////////
    public function add_pump_purchase_tax_view($pump_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $pump = DB::select("select* from pump where pk_id = '$pump_id'");
        $tank = DB::select("select* from tank where pump_id = '$pump_id'");
        $inventory = DB::select("select* from inventory");
        $result = DB::select("select * from supplier");
        $sale = DB::select("select * from pump_purchase ORDER BY pk_id DESC");
        if (count($sale) > 0)
        {
            $sale_id = $sale[0]->pk_id + 1;
        }
        else
        {
            $sale_id = 1;
        }

        return view('admin.add_pump_purchase_tax_view', compact('result', 'tank', 'sale_id', 'inventory', 'pump_id', 'pump'));
    }

    public function add_pump_purchase_tax(Request $request, $pump_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $sku = $request->input('sku');
        $tank_name = $request->input('tank_name');
        $item_name = $request->input('item_name');
        $total_amount = 0;
        $wordCount = count($item_name);
        $quantity = $request->input('quantity');
        $rate = $request->input('rate');
        $tax = $request->input('tax');
        $tax_amount = $request->input('tax_amount');
        $amount = $request->input('amount');
        $pump_purchase = "tax";
        $i = 0;

        for ($i = 0;$i < $wordCount;$i++)
        {
            $total_amount = $total_amount + $amount[$i];
        }

        DB::insert("insert into pump_purchase (pump_id,sti,pump_purchase,supplier_name,account_type,purchase_type,company_name,vehicle_no,total_amount) values (?,?,?,?,?,?,?,?,?)", array(
            $pump_id,
            $request->input('sti') ,
            $pump_purchase,
            $request->input('supplier_name') ,
            $request->input('account_type') ,
            $request->input('purchase_type') ,
            $request->input('company_name') ,
            $request->input('vehicle_no') ,
            $total_amount
        ));
        $result = DB::select("select* from pump_purchase order by pk_id DESC");
        for ($i = 0;$i < $wordCount;$i++)
        {

            DB::insert("insert into pump_detail_purchase_tax (purchase_id,tank_id,sku,item_name,quantity,rate,tax,tax_amount,amount) values (?,?,?,?,?,?,?,?,?)", array(
                $result[0]->pk_id,
                $tank_name[$i],
                $sku[$i],
                $item_name[$i],
                $quantity[$i],
                $rate[$i],
                $tax[$i],
                $tax_amount[$i],
                $amount[$i]
            ));
        }

        return redirect("/admin/home/view/pump/purchase/by/supplier/$pump_id");

    }

    /////////////////////////////////////////////////
    public function test()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return view('admin.test');

    }
    public function test_post(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $sku = $request->input('mytextt');
        return $sku;
        return view('admin.test');

    }

    /////////////////////////////////////////
    public function add_account_receivable_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $account_type = DB::table('account')->where('account_type', 'Cash')
            ->get();
        $result = DB::select("select* from customer");
        // dd($result);
        return view('admin.add_account_receivable_view', compact('result', 'account_type'));

    }

    public function add_account_receivable(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        } //dd($request->all());
        $tst = $request->input('customer_name');
        // return $tst;
        DB::insert("insert into account_receivable (customer_name,date,amount_received,receiving_method,receiving_account,acount_type_id) values (?,?,?,?,?,?)", array(
            $request->input('customer_name') ,
            $request->input('date') ,
            $request->input('amount_received') ,
            $request->input('receiving_method') ,
            $request->input('amount_receivable') ,
            $request->input('account_type')
        ));
        $result = DB::select("select* from account_receivable");

        $total_amount = $request->input('amount_received');

        // dd($request->all());
        $account_type_id = $request->input('account_type');

        $account = DB::select("select* from account where pk_id =" . $account_type_id);
        $account_receivable = DB::select("select* from account where account_type ='Account Receivable'");
        // $account = DB::select("select* from account where account_type = 'Account Payable'");
        if (count($account) > 0)
        {

            $c_balance = $account[0]->balance + $total_amount;
            $account_receivable = $account_receivable[0]->balance + $total_amount;

            DB::table('account')->where('pk_id', $account_type_id)->update(['balance' => $c_balance]);
            DB::table('account')->where('account_type', 'Account Receivable')
                ->update(['balance' => $account_receivable]);

        }
        else
        {

            DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                'Account Receivable',
                'Account Receivable',
                'Account Receivable',
                $total_amount,
                NOW()
            ));

        }

        //   $account = DB::select("select* from account where account_type = 'Account Receivable'");
        //   if(count($account)>0)
        //   {
        //       $c_balance = $account[0]->balance + $total_amount;
        //       DB::table('account')->where('account_type',"Account Receivable")->update(['balance' =>$c_balance]);
        //   }
        // else{
        //         DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)",array('Account Receivable','Account Receivable','Account Receivable',$total_amount,NOW()));
        //         }
        // dd($result);
        return view('admin.account_receivable_list_view', compact('result'));

    }
    public function select_account_receivable(Request $request)
    {
        $value = $request->Input('cat_id');
        $account_type = "credit";
        $total_amount = 0;
        $result = DB::select("select * from sale where customer_name='$value' and account_type='$account_type'");
        if (count($result) > 0)
        {
            foreach ($result as $results)
            {
                $total_amount = $total_amount + $results->total_amount;
            }
        }
        return $total_amount;

    }
    //////////////////////////////////////////////
    public function add_account_payable_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $account_type = DB::table('account')->where('account_type', 'Cash')
            ->get();
        $result = DB::select("select* from supplier");
        // dd($result,$account_type);
        return view('admin.add_account_payable_view', compact('result', 'account_type'));

    }

    public function add_account_payable(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // dd($request->all());
        DB::insert("insert into account_payable (supplier_name,date,amount_payed,paying_method,paying_account) values (?,?,?,?,?)", array(
            $request->input('supplier_name') ,
            $request->input('date') ,
            $request->input('amount_payed') ,
            $request->input('paying_method') ,
            $request->input('amount_payable')
        ));
        $result = DB::select("select* from account_payable");

        $total_amount = $request->input('amount_payed');
        $account_type_id = $request->input('account_type');

        $account = DB::select("select* from account where pk_id =" . $account_type_id);

        if ($request->input('account_type'))
        {
            DB::enableQueryLog();
            $account_type_id = $request->input('account_type');
            $account = DB::select("select* from account where pk_id =" . $account_type_id);
            $account_payble = DB::select("select* from account where account_type = 'Account Payable' ");
            $query = DB::getQueryLog();
            // print_r($query);
            // dd($account, $account_type_id);
            if (count($account) > 0)
            {

                $c_balance = $account[0]->balance - $total_amount;
                $p_balance = $account_payble[0]->balance - $total_amount;
                $resultt = DB::table('account')->where('pk_id', $account[0]->pk_id)
                    ->update(['balance' => $c_balance]);
                $resultt = DB::table('account')->where('account_type', 'Account Payable')
                    ->update(['balance' => $p_balance]);

            }
            else
            {

                DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)", array(
                    'Account Receivable',
                    'Account Receivable',
                    'Account Receivable',
                    $total_amount,
                    NOW()
                ));

            }
        }

        // $account = DB::select("select* from account where account_type = 'Account Payable'");
        //   if(count($account)>0)
        //   {
        //       $c_balance = $account[0]->balance + $total_amount;
        //       DB::table('account')->where('account_type',"Account Payable")->update(['balance' =>$c_balance]);
        //   }
        // else{
        //         DB::insert("insert into account(account_type,account_name,description,balance,date) values (?,?,?,?,?)",array('Account Receivable','Account Receivable','Account Receivable',$total_amount,NOW()));
        //         }
        // dd($resultt);
        return redirect()->route('account.payable.list');

    }
    public function select_account_payable(Request $request)
    {
        $value = $request->Input('cat_id');
        $account_type = "credit";
        $total_amount = 0;
        $result = DB::select("select * from purchase where supplier_name='$value' and account_type='$account_type'");
        if (count($result) > 0)
        {
            foreach ($result as $results)
            {
                $total_amount = $total_amount + $results->total_amount;
            }
        }
        return $total_amount;

    }
    ///////////////////////////////////////////////
    public function report_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return view('admin.report_list_view');

    }

    public function inventory_report()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select * from inventory ");

        return view('admin.inventory_report', compact('result'));

    }

    public function inventory_report_pdf()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select * from inventory ");

        $pdf = PDF::loadView('admin.inventory_report_pdf', compact('result'));

        return $pdf->download('test.pdf');

    }

    public function inventory_report_print()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select * from inventory ");

        return view('admin.inventory_report_print', compact('result'));

    }

    public function profit_report_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $sale = DB::table('detail_sale')->sum('amount');
        $purchase = DB::table('purchase')->sum('total_amount');
        // $expense = DB::table('expense')->sum('amount');
        $expense = "0";
        // return $purchase;
        $gross_profit = $sale - $purchase;
        $net_income = $gross_profit - $expense;
        return view('admin.profit_loss', compact('sale', 'purchase', 'gross_profit', 'expense', 'net_income'));

    }

    public function profit_report_pdf()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $sale = DB::table('detail_sale')->sum('amount');
        $purchase = DB::table('purchase')->sum('total_amount');
        // $expense = DB::table('expense')->sum('amount');
        $expense = "0";
        // return $purchase;
        $gross_profit = $sale - $purchase;
        $net_income = $gross_profit - $expense;

        $pdf = PDF::loadView('admin.profit&loss_pdf', compact('sale', 'purchase', 'gross_profit', 'expense', 'net_income'));

        return $pdf->download('test.pdf');

    }

    public function profit_report_print()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $sale = DB::table('detail_sale')->sum('amount');
        $purchase = DB::table('purchase')->sum('total_amount');
        // $expense = DB::table('expense')->sum('amount');
        $expense = "0";
        // return $purchase;
        $gross_profit = $sale - $purchase;
        $net_income = $gross_profit - $expense;
        return view('admin.profit_loss_print', compact('sale', 'purchase', 'gross_profit', 'expense', 'net_income'));

    }

    public function balance_sheet()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        // $sale = DB::table('deatail_sale')->sum('total_amount');
        $asset = DB::table('account')->where('account_type', 'Cash')
            ->sum('increase');

        $sale = DB::table('detail_sale')->sum('amount');
        $purchase = DB::table('purchase')->sum('total_amount');
        // $expense = DB::table('expense')->sum('amount');
        $expense = "0";
        // return $purchase;
        $gross_profit = $sale - $purchase;
        $net_income = $gross_profit - $expense;

        $AR = DB::table('account')->where('account_type', 'Account Receivable')
            ->sum('increase');
        $capital = DB::table('account')->where('account_type', 'Capital')
            ->sum('increase');
        $AP = DB::table('detail_purchase')->sum('amount');

        return view('admin.balance_sheet', compact('net_income', 'AR', 'AP', 'asset', 'capital'));

    }

    public function balance_sheet_pdf()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        // $sale = DB::table('deatail_sale')->sum('total_amount');
        $asset = DB::table('account')->where('account_type', 'Cash')
            ->sum('increase');

        $sale = DB::table('detail_sale')->sum('amount');
        $purchase = DB::table('purchase')->sum('total_amount');
        // $expense = DB::table('expense')->sum('amount');
        $expense = "0";
        // return $purchase;
        $gross_profit = $sale - $purchase;
        $net_income = $gross_profit - $expense;

        $AR = DB::table('account')->where('account_type', 'Current Liabilities')
            ->sum('increase');
        $capital = DB::table('account')->where('account_type', 'Capital')
            ->sum('increase');
        $AP = DB::table('detail_purchase')->sum('amount');

        $pdf = PDF::loadView('admin.balance_sheet_pdf', compact('net_income', 'AR', 'AP', 'asset', 'capital'));

        return $pdf->download('testt.pdf');

    }

    public function balance_sheet_print()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        // $sale = DB::table('deatail_sale')->sum('total_amount');
        $asset = DB::table('account')->where('account_type', 'Cash')
            ->sum('increase');

        $sale = DB::table('detail_sale')->sum('amount');
        $purchase = DB::table('purchase')->sum('total_amount');
        // $expense = DB::table('expense')->sum('amount');
        $expense = "0";
        // return $purchase;
        $gross_profit = $sale - $purchase;
        $net_income = $gross_profit - $expense;

        $AR = DB::table('account')->where('account_type', 'Current Liabilities')
            ->sum('increase');
        $capital = DB::table('account')->where('account_type', 'Capital')
            ->sum('increase');
        $AP = DB::table('detail_purchase')->sum('amount');

        return view('admin.balance_sheet_print', compact('net_income', 'AR', 'AP', 'asset', 'capital'));

    }

    public function account_payable_list_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from account_payable");
        $amount_payed = DB::select("select SUM(amount_payed) from account_payable");

        return view('admin.account_payable_list_view', compact('result', 'amount_payed'));

    }

    public function account_receivable_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        // $result = DB::select("select* from sale where sale = 'invoice'");
        

        $customer = DB::select("select * from customer");
        // foreach($customer as $results)
        // $customer=   $results->pk_id;
        

        $result = DB::select("select* from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id ");

        // $total_amount = DB::table('sale')->where('customer_name', '11')->sum('total_amount');
        // return $result;
        // $total = DB::select("select SUM(total_amount) from sale where sale = 'invoice'  ");
        $total = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id ");

        // $amount_received = DB::select("select SUM(receiving_account) from account_receivable");
        // $result2 = DB::table('sale_invoice')->where('org_amount','<=' ,'30000')->sum('org_amount');
        // $result3 = DB::select("select SUM(org_amount) from sale where  org_amount < 60000");
        // $result3 = DB::table('sale_invoice')->where('org_amount','>=' ,'30000' )->sum('org_amount');
        // $result3 = DB::select("select SUM(total_amount) from sale where sale = 'invoice' and  total_amount <= '30000' ");
        

        $result3 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and sale.total_amount <= '30000' ");

        // $result4 = DB::select("select SUM(total_amount) from sale where sale = 'invoice' and  total_amount >= '30000' and total_amount <= '60000' ");
        $result4 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and  sale.total_amount >= '30000' and sale.total_amount <= '60000' ");

        // $result5 = DB::select("select SUM(total_amount) from sale where sale = 'invoice' and  total_amount >= '60000' and total_amount <= '90000' ");
        $result5 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and  sale.total_amount >= '60000' and sale.total_amount <= '90000' ");

        // $result6 = DB::select("select SUM(total_amount) from sale where sale = 'invoice' and  total_amount >= '90000' ");
        $result6 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and  sale.total_amount >= '90000' ");

        // return $result3;
        return view('admin.account_receivable', compact('total', 'result', 'result3', 'result4', 'result5', 'result6', 'customer'));

    }

    public function account_receivable_list_view_print()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $customer = DB::select("select * from customer");

        $result = DB::select("select* from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id ");
        $total = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id ");

        $result3 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and sale.total_amount <= '30000' ");
        $result4 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and  sale.total_amount >= '30000' and sale.total_amount <= '60000' ");

        $result5 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and  sale.total_amount >= '60000' and sale.total_amount <= '90000' ");
        $result6 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and  sale.total_amount >= '90000' ");

        return view('admin.account_receivable_list_view_print', compact('total', 'result', 'result3', 'result4', 'result5', 'result6', 'customer'));

    }

    public function account_receivable_list_view_pdf()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $customer = DB::select("select * from customer");

        $result = DB::select("select* from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id ");
        $total = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id ");

        $result3 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and sale.total_amount <= '30000' ");
        $result4 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and  sale.total_amount >= '30000' and sale.total_amount <= '60000' ");

        $result5 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and  sale.total_amount >= '60000' and sale.total_amount <= '90000' ");
        $result6 = DB::select("select SUM(total_amount)  from sale,customer where sale.sale = 'invoice' and sale.customer_name= customer.pk_id and  sale.total_amount >= '90000' ");

        $pdf = PDF::loadView('admin.account_receivable_pdf', compact('total', 'result', 'result3', 'result4', 'result5', 'result6', 'customer'));

        return $pdf->download('testt.pdf');

    }

    public function account_payable_reporting()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $supplier = DB::select("select* from supplier ");

        $result = DB::select("select* from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id ");
        // return $result;
        // $total = DB::select("select SUM(total_amount) from sale where sale = 'invoice'  ");
        $total = DB::select("select SUM(total_amount)  from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id ");

        $result3 = DB::select("select SUM(total_amount)  from  purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and purchase.total_amount <= '30000' ");

        // $result4 = DB::select("select SUM(total_amount) from sale where sale = 'invoice' and  total_amount >= '30000' and total_amount <= '60000' ");
        $result4 = DB::select("select SUM(total_amount)  from  purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and  purchase.total_amount >= '30000' and purchase.total_amount <= '60000' ");

        $result5 = DB::select("select SUM(total_amount)  from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and  purchase.total_amount >= '60000' and purchase.total_amount <= '90000' ");

        $result6 = DB::select("select SUM(total_amount)  from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and  purchase.total_amount >= '90000' ");

        return view('admin.account_payable', compact('supplier', 'total', 'result', 'result3', 'result4', 'result5', 'result6'));

    }

    public function account_payable_reporting_pdf()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $supplier = DB::select("select* from supplier ");

        $result = DB::select("select* from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id ");
        // return $result;
        // $total = DB::select("select SUM(total_amount) from sale where sale = 'invoice'  ");
        $total = DB::select("select SUM(total_amount)  from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id ");

        $result3 = DB::select("select SUM(total_amount)  from  purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and purchase.total_amount <= '30000' ");

        // $result4 = DB::select("select SUM(total_amount) from sale where sale = 'invoice' and  total_amount >= '30000' and total_amount <= '60000' ");
        $result4 = DB::select("select SUM(total_amount)  from  purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and  purchase.total_amount >= '30000' and purchase.total_amount <= '60000' ");

        $result5 = DB::select("select SUM(total_amount)  from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and  purchase.total_amount >= '60000' and purchase.total_amount <= '90000' ");

        $result6 = DB::select("select SUM(total_amount)  from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and  purchase.total_amount >= '90000' ");

        $pdf = PDF::loadView('admin.account_payable_pdf', compact('supplier', 'total', 'result', 'result3', 'result4', 'result5', 'result6'));

        return $pdf->download('testt.pdf');

    }

    public function account_payable_reporting_print()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $supplier = DB::select("select* from supplier ");

        $result = DB::select("select* from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id ");

        // $total = DB::select("select SUM(total_amount) from sale where sale = 'invoice'  ");
        $total = DB::select("select SUM(total_amount)  from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id ");

        $result3 = DB::select("select SUM(total_amount)  from  purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and purchase.total_amount <= '30000' ");

        // $result4 = DB::select("select SUM(total_amount) from sale where sale = 'invoice' and  total_amount >= '30000' and total_amount <= '60000' ");
        $result4 = DB::select("select SUM(total_amount)  from  purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and  purchase.total_amount >= '30000' and purchase.total_amount <= '60000' ");

        $result5 = DB::select("select SUM(total_amount)  from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and  purchase.total_amount >= '60000' and purchase.total_amount <= '90000' ");

        $result6 = DB::select("select SUM(total_amount)  from purchase,supplier where purchase.purchase_type = 'purchase' and purchase.supplier_name= supplier.pk_id and  purchase.total_amount >= '90000' ");

        return view('admin.account_payable_print', compact('supplier', 'total', 'result', 'result3', 'result4', 'result5', 'result6'));

    }

    public function purchase_detailed_by_customer_name($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        //             if($sale == "tax")
        //  {
        //     $result = DB::select("select* from detail_tax_sale where sale_id = '$id'");
        //  }
        //  else{
        $result = DB::select("select* from detail_purchase where purchase_id = '$id'");
        //  }
        // return $result;
        $result1 = DB::select("select* from purchase where supplier_name = '$id' ");
        // $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$id' ");
        $total_amount = DB::table('purchase')->where('supplier_name', $id)->sum('total_amount');
        // $customer = $result1[0]->customer_name;
        $supplier = DB::select("select* from supplier where pk_id = '$id'");
        //  return $total_amount;
        $purchase = "";
        return view('admin.view_purchase_customer', compact('total_amount', 'result', 'result1', 'supplier', 'purchase'));

    }

    ////////////////////////////////////////////////////
    public function expense_list_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from expense");

        return view('admin.expense_list_view', compact('result'));

    }
    // public function expense_report() {
    // if(!(session()->has('type') && session()->get('type')=='admin'))
    // {
    //   return redirect('/admin');
    // }
    // $data = array();
    //  $date = \Carbon\Carbon::today()->subDays(7);
    //  $data = DB::table('expense')->where('date','>=',$date)->get();
    //  $expense = DB::table('expense')->where('date','>=',$date)->sum('amount');
    //   return view('admin.expence_report',compact('expense'))->with('data',$data);
    // }
    public function edit_expense_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result2 = DB::select("select* from expense where pk_id ='$id'");
        $result = DB::select("select* from account where account_type='Expense'");
        $result1 = DB::select("select* from account where nature_of_account = 'Assets'");
        return view('admin.edit_expense_view', compact('result', 'result1', 'result2'));

    }

    public function add_expense_view()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from account where nature_of_account !='Assets'");

        $bank = DB::select("select* from account where nature_of_account = 'Assets'");

        $customer = DB::select("select customer_name from customer ");
        // return $customer;
        $supplier = DB::select("select supplier_name from supplier ");

        $employe = DB::select("select employe_name from employe ");
        // dd($result);
        $result1 = DB::select("select* from account where nature_of_account = 'Assets'");
        return view('admin.add_expense_view', compact('result', 'result1', 'customer', 'supplier', 'employe', 'bank'));

    }

    public function add_expense(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        
        $total_amount = "0";
        $sku = $request->input('account_name');
        
        $payee = $request->input('payee');
        
        $account_name = $request->input('account_name');
        
        $payment_method = $request->input('payment_method');
        
        $payment_account = $request->input('payment_account');
        
        $description = $request->input('description');
        $amount = $request->input('amount');
        // $date = $request->input('date');
        if (!empty($request->input('date')))
        {
            $date = $request->input('date');
        }
        else
        {
            $date = date('Y:m:d');
        }
        
        $payment_account_amount = DB::select("select * from account where account_name ='$payment_account'");
        
        $pay_amount = $payment_account_amount[0]->balance;
        
        if($pay_amount >= $amount){
            
        $total_amount = $total_amount + $amount;
        DB::insert("insert into expense (payee,payment_account,account_name,description,amount,date) values (?,?,?,?,?,?)", array(
            $payee,
            $payment_account,
            $account_name,
            $description,
            $amount,
            $date
        ));

        $payment_accountt = DB::select("select * from account where account_name ='$payment_account'");
            if (!empty($payment_accountt))
            {
                $stock = $payment_accountt[0]->balance - $amount;
                DB::table('account')->where('account_name', $payment_account)->update(['balance' => $stock , 'increase' => $stock]);

            }

            $acc_name = DB::select("select * from account where pk_id ='$account_name'");
            if (!empty($acc_name))
            {
                $stock2 = $acc_name[0]->balance + $amount;
                
                $stock3 = $acc_name[0]->decrease + $amount;
                
                
                DB::table('account')->where('pk_id', $account_name)->update(['balance' => $stock2 , 'decrease' => $stock3]);

            }
            
            
        
        $result = DB::select("select* from expense");
        return view('admin.expense_list_view', compact('result'))->withErrors('PKR' . $total_amount . ' is successfully Credit');
        }
        else{
        
            return Redirect::back()->withErrors('Amount in payment account is insufficient...');
        }

    }

    public function edit_expense(Request $request, $id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $date = NOW();
        DB::table('expense')->where('pk_id', $id)->update(['payee' => $request->input('payee') , 'account_name' => $request->input('account_name') , 'payment_method' => $request->input('payment_method') , 'payment_account' => $request->input('payment_account') , 'description' => $request->input('description') , 'amount' => $request->input('amount') , 'date' => $date]);

        return redirect('/admin/home/view/expense');

    }

    public function search_purchase(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        //   $purchase_from =  $request->input('purchase_from');
        //   $purchase_to =  $request->input('purchase_to');
        //   $d_invoice_from =  $request->input('d_invoice_from');
        //   $d_invoice_to =  $request->input('d_invoice_to');
        $current_balance_from = $request->input('current_balance_from');
        $current_balance_to = $request->input('current_balance_to');
        $total_amount = DB::select("select SUM(total_amount) from purchase where purchase_type = 'purchase'");

        $total_q1 = DB::select("select SUM(quantity) from detail_purchase,purchase where detail_purchase.purchase_id = purchase.pk_id  and purchase.purchase_type = 'purchase'");
        $total_q2 = DB::select("select SUM(quantity) from detail_tax_purchase,purchase where detail_tax_purchase.purchase_id = purchase.pk_id  and purchase.purchase_type = 'purchase'");

        $total_purchase = $total_q1[0]->{'SUM(quantity)'} + $total_q2[0]->{'SUM(quantity)'};

        $result = "Select* from supplier where ";

        $check = 0;

        if ($request->input('current_balance_from'))
        {
            if ($check == 1)
            {
                $result .= "and current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ";
            }
            else
            {
                $result .= "current_balance BETWEEN '$current_balance_from' AND '$current_balance_to' ";
                $check = 1;
            }
        }

        if ($request->input('purchase'))
        {
            if ($check == 1)
            {
                $result .= "and $total_purchase BETWEEN '$purchase_from' AND '$purchase_to' ";
            }
            else
            {
                $result .= "$total_purchase BETWEEN '$purchase_from' AND '$purchase_to' ";
                $check = 1;
            }
        }

        $result = DB::select("$result");

        return view('admin.purchase_by_supplier_list_view', compact('result', 'total_amount', 'total_purchase'));

    }

    public function search_sale(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');

        }

        $check = 0;

        $total_amount = DB::select("select SUM(total_amount) from sale where sale_type = 'sale'");
        $result = DB::select("select* from customer");

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');
        $tax_sale = $request->input('tax_sale');
        //  return $tax_sale;
        

        // $result = "Select* from sale where ";
        //             if($request->input('date_from'))
        //           {
        //            $result .= "created_at BETWEEN '$date_from' AND '$date_to' ";
        

        //             }
        

        //             $result1 = DB::select("$result");
        if (($request->input('date_from') && $request->input('date_to')) > 0)
        {
            // return "ads";
            $result1 = DB::select("select* from sale where created_at BETWEEN '$date_from' AND '$date_to' ");
            // return $result1;
            $total_amount = DB::select("select SUM(total_amount) from sale where created_at BETWEEN '$date_from' AND '$date_to' ");

            $item_name = DB::select("select* from sale,detail_sale where detail_sale.sale_id = sale.pk_id and created_at BETWEEN '$date_from' AND '$date_to' ");

            // $cus_name = DB::select("select customer_name from sale,detail_sale where detail_sale.sale_id = sale.pk_id  and sale.sale='tax' ");
            // // return $item_name;
            //   $result = DB::select("select* from customer");
            return view('admin.all_sale', compact('result1', 'total_amount', 'item_name'));
        }

        if (($request->input('tax_sale')) > 0)
        {
            // return "ads";
            if ($check = 1)
            {
                // return "ads";
                $result1 = DB::select("select* from sale,detail_tax_sale where detail_tax_sale.sale_id= sale.pk_id   ");
                // return $result1;
                $total_amount = DB::select("select SUM(amount) from detail_tax_sale ");
                $item_name = DB::select("select* from sale,detail_tax_sale where detail_tax_sale.sale_id = sale.pk_id  ");

                $cus_name = DB::select("select customer_name from sale,detail_sale where detail_sale.sale_id = sale.pk_id  and sale.sale='tax' ");

                // return $item_name;
                $result = DB::select("select* from customer");

                return view('admin.all_sale_tax', compact('result1', 'result', 'total_amount', 'item_name', 'cus_name'));

            }

        }

        $total_amount = DB::select("select SUM(total_amount) from sale ");

        $item_name = DB::select("select* from sale,detail_sale where detail_sale.sale_id = sale.pk_id and created_at BETWEEN '$date_from' AND '$date_to' ");
        $cus_name = DB::select("select customer_name from sale,detail_sale where detail_sale.sale_id = sale.pk_id  and sale.sale='tax' ");

        return view('admin.all_sale', compact('result1', 'result', 'total_amount', 'item_name', 'cus_name'));

    }

    public function search_sale_tax(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');

        }

        $id_from = $request->input('id_from');
        $id_to = $request->input('id_to');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $amount_from = $request->input('amount_from');
        $amount_to = $request->input('amount_to');

        // return "ads";
        $result1 = DB::select("select* from detail_tax_sale where created_at BETWEEN '$date_from' AND '$date_to' ");
        // return $result1;
        $total_amount = DB::select("select SUM(amount) from detail_tax_sale where created_at BETWEEN '$date_from' AND '$date_to' ");

        $item_name = DB::select("select* from sale,detail_tax_sale where detail_tax_sale.sale_id = sale.pk_id ");

        // return $result;
        return view('admin.all_sale_tax', compact('result1', 'total_amount', 'item_name'));
    }

    public function search_expense(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $id_from = $request->input('id_from');
        $id_to = $request->input('id_to');

        $date_from = $request->input('date_from');
        $date_to = $request->input('date_to');

        $amount_from = $request->input('amount_from');
        $amount_to = $request->input('amount_to');

        $result = "Select* from expense where ";

        // $result = "Select* from expense where ";
        $check = 0;
        if ($request->input('id_from'))
        {
            $result .= "pk_id BETWEEN '$id_from' AND '$id_to' ";
            $check = 1;
        }

        if ($request->input('date_from'))
        {
            if ($check == 1)
            {
                $result .= "and date BETWEEN '$date_from' AND '$date_to' ";
            }
            else
            {
                $result .= "date BETWEEN '$date_from' AND '$date_to' ";
                $check = 1;
            }
        }
        if ($request->input('amount_from'))
        {
            if ($check == 1)
            {
                $result .= "and amount BETWEEN '$amount_from' AND '$amount_to' ";
            }
            else
            {
                $result .= "amount BETWEEN '$amount_from' AND '$amount_to' ";
                $check = 1;
            }

        }

        $result = DB::select("$result");
        return view('admin.expense_list_view', compact('result'));

    }

    public function add_bank_deposit_view()
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        // $result = DB::select("select* from account_type where nature_of_account = 'Assets' ");
        // $result = DB::select("select * from account  where account_type = 'Owners Equity' and account_name != 'NULL'");
        $result = DB::select("select * from account  where nature_of_account != 'Assets'");
        $result2 = DB::select("select* from account  where account_type IN('Bank','Cash')");
        // $sub_account = DB::select("select* from account where sub_account != 'NULL' ");
        $sub_account = DB::select("select account_name from account ");
        
        $result1 = DB::select("select distinct * from account where account_type ='Owners Equity'");
        $value ="Owners Equity";
        $subcategories = DB::select(DB::raw("SELECT * FROM account WHERE account_type = :value") , array(
            'value' => $value,
        ));
        return view('admin.create_bank_deposit', compact('result', 'result1', 'sub_account','result2' ,'subcategories'));
    }
    public function sub_Account_Name(Request $request)
    {
        $value = $request->Input('cat_id');

        // $subcategories = DB::select(DB::raw("SELECT * FROM sale WHERE customer_name = :value") , array(
        //     'value' => $value,
        // ));
        // $subcategories = DB::select(DB::raw("SELECT * FROM account WHERE account_type = :value and sub_account != 'NULL'") , array(
        //     'value' => $value,
        // ));
        $acc = DB::select(DB::raw("SELECT * FROM account WHERE sub_account = :value") , array(
            'value' => $value,
        ));

        $accounts_id = $acc[0]->main_account_id;
        
        $subcategories = DB::select(DB::raw("SELECT * FROM account WHERE pk_id = :value") , array(
            'value' => $accounts_id,
        ));
        
        return Response::json($subcategories);

    }

    public function add_bank_deposit(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $recive_from = $request->input('recive_from');
        $account_name2 = $request->input('account_name2');
        $pk_id = $request->input('pk_id');
        // $sub = $request->input('payment_acc');
        $sub ="Owners Equity";
        
        $sub_account = $request->input('sub_account');
        $bank_account = $request->input('account_name');
        $total_amount = $request->input('amount');
        $owner = "Owners Equity";

        if (!empty($request->input('date')))
        {
            $date = $request->input('date');
        }
        else
        {
            $date = date('Y:m:d');
        }
        
        DB::insert("insert into bank_deposit(account_type,sub_account,description,payment_method,amount,account) 
                      values (?,?,?,?,?,?)", array(
            $sub,
            $sub_account,
            $request->input('description') ,
            $bank_account,
            $total_amount,
            $account_name2
        ));
        
        $last_id = DB::getPdo()->lastInsertId();
        $account = DB::select("select* from bank_deposit where pk_id = '$last_id'");
        $accounts = $account[0]->account_type;
        $account_bank = $account[0]->account;
        $sub_account = $account[0]->sub_account;
        
        // $account_num = DB::select("select* from account where pk_id = '$pk_id'");
        // $account_nume = $account_num[0]->account_name;
        
        // $account = DB::select("select* from account where pk_id = '$pk_id'");
        
        // $c_balance = $account[0]->balance + $total_amount;
        
        // $total_invest = DB::select("select SUM(amount) from bank_deposit where account_type = '$accounts'");
         
        // $total_investss = DB::select("select SUM(amount) from bank_deposit where account = '$bank_account'");
        
        
         
        if(!empty($sub_account))
        {
            $totat = DB::table('bank_deposit')->where('sub_account', "$sub_account")->sum('amount');
            $accountss = DB::select("select* from account where sub_account ='$sub_account'");
            $c_balanceee= $accountss[0]->balance + $total_amount;
            DB::table('account')->where('sub_account', "$sub_account")->update(['balance' => $totat]);
            
        }
        else{
            $totat = DB::table('bank_deposit')->where('account', "$account_bank")->sum('amount');
            $accountss = DB::select("select* from account where account_name ='$account_bank'");
            $c_balanceee= $accountss[0]->balance + $total_amount;
            DB::table('account')->where('account_name', "$account_name2")->update(['balance' => $totat]);
        }
        
        DB::table('account')->where('account_name', "$bank_account")->update(['balance' => $c_balanceee]);
        
        $account1 = DB::select("select* from account where account_name = '$bank_account'");
        
        if (count($account1) > 0)
        {
            $c_balance = $account1[0]->increase + $total_amount;
            
            DB::table('account')->where('pk_id', $account1[0]->pk_id)
                ->update(['increase' => $c_balance]);
        }
        
        // $account = DB::select("select* from bank_deposit where pk_id = '$last_id'");
        
        // $accounts = $account[0]->account_type;
        
        
        if(!empty($sub_account)){
            $sub_accounts = DB::select("select* from account where sub_account = '$sub_account'");
            
            if (count($sub_accounts) > 0)
            {
                $c_balance = $sub_accounts[0]->increase + $total_amount;
    
                DB::table('account')->where('pk_id', $sub_accounts[0]->pk_id)
                    ->update(['increase' => $c_balance]);
    
            }
            
        }
        else{
            
            $accountss = DB::select("select* from account where account_name = '$account_bank'");
    
            if (count($accountss) > 0)
            {
                $c_balance = $accountss[0]->increase + $total_amount;
    
                DB::table('account')->where('pk_id', $accountss[0]->pk_id)
                    ->update(['increase' => $c_balance]);
    
            }
        }
        
        return Redirect::back()->withErrors('PKR:' . $total_amount . ' is successfully Added');
    }

    public function sale_report()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = DB::select("select SUM(amount) from detail_sale");
        $result = DB::select("select* from inventory");

        return view('admin.view_sale_reports', compact('total_amount', 'result'));
    }

    public function sale_detail_by_item_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from detail_sale,sale where detail_sale.sku = '$id' and detail_sale.sale_id = sale.pk_id");

        $total_amount = DB::select("select SUM(amount) from detail_sale where sku = '$id'");
        return view('admin.sale_detail_by_item_view', compact('total_amount', 'result'));

    }

    public function transfer_of_money()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from account where nature_of_account = 'Assets' ");

        // $total_amount = DB::select("select SUM(amount) from detail_sale where sku = '$id'");
        return view('admin.transfer_of_money', compact('result'));

    }

    public function transfer_money(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        if (!empty($request->input('date')))
        {
            $date = $request->input('date');
        }
        else
        {
            $date = date('Y:m:d');
        }

        $fund_from_id = $request->input('fund_from');

        $tansfer_amount = $request->input('tansfer_amount');
        // return $tansfer_amount;
        $fund_to_id = $request->input('fund_to');
        // return $fund_to_id;
        $fund_from = DB::select("select balance from account where pk_id = '$fund_from_id'");
        $account_data = DB::select("select* from account where pk_id = '$fund_from_id'");

        $account_type = $account_data[0]->account_type;
        //  return $account_type;
        $fund_to = DB::select("select balance from account where pk_id = '$fund_to_id'");
        //  $fund_to = $fund_to[0]->balance;
        //  return $fund_to;
        $fund_inc = $fund_to[0]->balance + $tansfer_amount;

        $fund_dec = $fund_from[0]->balance - $tansfer_amount;
        // return $fund_dec;
        DB::table('account')->where('pk_id', $fund_from_id)->update(['balance' => $fund_dec, 'increase' =>$fund_dec]);

        DB::table('account')->where('pk_id', $fund_to_id)->update(['balance' => $fund_inc, 'increase' =>$fund_inc]);

        DB::insert("insert into money_transfer(account_type,sender_account,recive_account,description,transfer_amount,date) 
            values (?,?,?,?,?,?)", array(
            $account_type,
            $fund_from_id,
            $fund_to_id,
            $request->input('description') ,

            $tansfer_amount,
            $date
        ));

        return Redirect::back()->withErrors('Your Amount Saved');;

    }

    public function trial_balance()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from account  ");

        $total_amount = DB::table('account')->where('account_type', 'Sales Retail')->sum('increase');
        $salee = DB::select("select* from sale  ");
        if (count($salee) > 0)
        {
            $sale = $salee[0]->sale_type;

        }
        else
        {
            $sale = '0';
        }
        // $detail_purchase = DB::select("select* from detail_purchase where purchase_type='purchase'  ");
        $detail_purchase = DB::select("select* from account where account_type='Purchase'");

        $purchase_inc = $detail_purchase[0]->increase;

        $detail_purchase_tax = DB::select("select* from detail_tax_purchase where purchase_type='purchase'  ");

        // return $detail_purchase;
        // $detail_purchase_sum_sim = DB::table('detail_purchase')->where('purchase_type', 'purchase')
        //     ->sum('amount');
        $detail_purchase_sum_sim = DB::table('supplier')->sum('current_balance');
        $detail_purchase_tax_sum = DB::table('detail_tax_purchase')->where('purchase_type', 'purchase')
            ->sum('amount');

        $detail_purchase_sum = $detail_purchase_sum_sim + $detail_purchase_tax_sum;

        // return $detail_purchase_sum;
        $detail_purchase_return = DB::select("select* from detail_purchase where purchase_type='return'  ");

        $detail_purchase_return_tax = DB::select("select* from detail_tax_purchase where purchase_type='return'  ");
        // return $detail_purchase_return;
        $detail_purchase_sum_return_sim = DB::table('detail_purchase')->where('purchase_type', 'return')
            ->sum('amount');
        // return $detail_purchase_sum_return_sim;
        $detail_purchase_sum_return_tax = DB::table('detail_tax_purchase')->where('purchase_type', 'return')
            ->sum('amount');

        $detail_purchase_sum_return = $detail_purchase_sum_return_sim + $detail_purchase_sum_return_tax;

        // return $detail_purchase_sum_return;
        // return $detail_purchase_sum;
        
        $total_amount2 = DB::table('account')->where('account_type', 'Cash')
            ->sum('increase');  
        $total_amount3 = DB::table('account')->where('account_type', 'Cash')
            ->sum('decrease');
        $result = DB::select("select* from account where account_type = 'Sales Retail' ");
        $sale_inc = $result[0]->increase;
        $sale_decrease = $result[0]->decrease;
        

        $customer = DB::select("select* from customer where current_balance >0  or current_balance < 0 ");
        $current_balance = DB::table('customer')->sum('current_balance');
        
        if(!empty($current_balance))
        { 
            $current_balance1 = $current_balance;
            $current_balance2 = '0';
        }
        else
        {
            $current_balance2 = $current_balance;
            $current_balance1 = '0';
        }

        // if (count($Capital) > 0)
        // {
        //     $Capital_inc = $Capital[0]->increase;

        // }
        // else
        // {
        //     $Capital_inc = "0";
        // }

        $Capital = DB::select("select* from account where account_type = 'Owners Equity'");
        if (count($Capital) > 0)
        {
            $Capitals = $Capital[0]->increase;
            $Capital_dec = $Capital[0]->decrease;
        }
        else
        {
            $Capitals = '0';
            $Capital_dec = "0";
        }
        
        $capital_increase = DB::table('account')->where('account_type', 'Owners Equity')
            ->sum('increase');
        
        $capital_decrease = DB::table('account')->where('account_type', 'Owners Equity')
            ->sum('decrease');

        $Capital_sub = DB::select("select * from account where  account_type='Owners Equity' LIMIT 1");
        // return $Capital_sub;
        if (count($Capital_sub) > 0)
        {
            $Capital_sub_inc = $Capital_sub[0]->increase;

        }
        else
        {
            $Capital_sub_inc = '0';
        }

        $Capital_sub_decrease = DB::select("select * from account where  account_type='Owners Equity' and decrease != 'NULL'  ");
        //  return $Capital_sub_dec;
        if (count($Capital_sub_decrease) > 0)
        {
            $Capital_sub_dec = $Capital_sub_decrease[0]->decrease;

        }
        else
        {
            $Capital_sub_dec = '0';
        }

        $result = DB::select("select* from account where account_type = 'Owners Equity' ");
        if (count($result) > 0)
        {
            $own_inc = $result[0]->increase;
        }
        else
        {
            $own_inc = '0';
        }

        $bank = DB::select("select* from account where account_type = 'Bank' ");
        if (count($bank) > 0)
        {
            $bankk = $bank[0]->increase;
            $bankk_dec = $bank[0]->decrease;
        }
        else
        {
            $bankk = '0';
            $bankk_dec = "0";
        }

        
        $increase = DB::table('account')->where('account_type', 'Bank')
            ->sum('increase');
        
        $decrease = DB::table('account')->where('account_type', 'Bank')
            ->sum('decrease');
            
        $result = DB::select("select* from account where account_type = 'Purchase' ");

        if (count($result) > 0)
        {
            $pur_inc = $result[0]->increase;

        }
        else
        {
            $pur_inc = '0';
        }

        $expense = DB::select("select* from account where nature_of_account = 'Expense' ");
        if (count($expense) > 0)
        {
            $expense_inc = $expense[0]->increase;
            $expense_dec = $expense[0]->decrease;

        }
        else
        {
            $expense_inc = "0";
            $expense_dec = "0";
        }
        
        $exp_increase = DB::table('account')->where('nature_of_account','Expense')
            ->sum('increase');
        
        $exp_decrease = DB::table('account')->where('nature_of_account','Expense')
            ->sum('decrease');
            
        $supplier = DB::select("select* from supplier where current_balance > 0 or current_balance < 0");

        $current_balance_purchase = DB::table('supplier')->sum('current_balance');
        if ($current_balance_purchase > 0)
        {
            $current_balance1_purchase = $current_balance_purchase;
            $current_balance2_purchase = '0';
        }
        else
        {
            $current_balance2_purchase = $current_balance_purchase;
            $current_balance1_purchase = '0';
        }

        $resullt = DB::select("select* from account where account_type = 'Cash' ");
        $coh_inc = $resullt[0]->increase;
        
        $coh_dec = $resullt[0]->decrease;
        $resullt2 = DB::select("select* from account where account_type = 'Account Receivable' ");
        $lib_inc = $resullt2[0]->increase;
        $lib_decrease = $resullt2[0]->decrease;
        
        return view('admin.trial_balance', compact('current_balance2_purchase','current_balance1_purchase','current_balance_purchase','current_balance','current_balance2', 'current_balance1', 'customer', 'supplier', 'purchase_inc', 'bank', 'bankk', 'bankk_dec', 'expense_dec', 'detail_purchase_return_tax', 'detail_purchase_tax', 'lib_decrease', 'sale_decrease', 'detail_purchase_return', 'detail_purchase_sum_return', 'expense', 'total_amount3', 'expense_inc', 'Capital_sub_dec', 'coh_dec', 'Capital_sub_decrease', 'Capital_sub_inc', 'Capital_sub', 'Capital', 'capital_increase' ,'capital_decrease','detail_purchase_sum', 'detail_purchase', 'own_inc', 'pur_inc', 'sale_inc', 'coh_inc', 'lib_inc', 'total_amount2', 'result', 'sale', 'salee', 'total_amount','increase','decrease','exp_increase','exp_decrease'));

    }

    public function trial_balance_pdf()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from account  ");

        $total_amount = DB::table('account')->where('account_type', 'Sales Retail')
            ->sum('increase');
        $salee = DB::select("select* from sale  ");
        if (count($salee) > 0)
        {
            $sale = $salee[0]->sale_type;

        }
        else
        {
            $sale = '0';
        }
        $detail_purchase = DB::select("select* from detail_purchase where purchase_type='purchase'  ");

        $detail_purchase_tax = DB::select("select* from detail_tax_purchase where purchase_type='purchase'  ");

        // return $detail_purchase;
        $detail_purchase_sum_sim = DB::table('detail_purchase')->where('purchase_type', 'purchase')
            ->sum('amount');

        $detail_purchase_tax_sum = DB::table('detail_tax_purchase')->where('purchase_type', 'purchase')
            ->sum('amount');

        $detail_purchase_sum = $detail_purchase_sum_sim + $detail_purchase_tax_sum;

        // return $detail_purchase_sum;
        $detail_purchase_return = DB::select("select* from detail_purchase where purchase_type='return'  ");

        $detail_purchase_return_tax = DB::select("select* from detail_tax_purchase where purchase_type='return'  ");
        // return $detail_purchase_return;
        $detail_purchase_sum_return_sim = DB::table('detail_purchase')->where('purchase_type', 'return')
            ->sum('amount');
        // return $detail_purchase_sum_return_sim;
        $detail_purchase_sum_return_tax = DB::table('detail_tax_purchase')->where('purchase_type', 'return')
            ->sum('amount');

        $detail_purchase_sum_return = $detail_purchase_sum_return_sim + $detail_purchase_sum_return_tax;

        // return $detail_purchase_sum_return;
        // return $detail_purchase_sum;
        $total_amount2 = DB::table('account')->where('account_type', 'Cash')
            ->sum('increase');
        $total_amount3 = DB::table('account')->where('account_type', 'Cash')
            ->sum('decrease');
        $result = DB::select("select* from account where account_type = 'Sales Retail' ");
        $sale_inc = $result[0]->increase;
        $sale_decrease = $result[0]->decrease;

        $Capital = DB::select("select* from account where account_type = 'Owners Equity' ");

        if (count($Capital) > 0)
        {
            $Capital_inc = $Capital[0]->increase;

        }
        else
        {
            $Capital_inc = "0";
        }

        $Capital_sub = DB::select("select * from account where  account_type='Owners Equity' LIMIT 1");
        // return $Capital_sub;
        if (count($Capital_sub) > 0)
        {
            $Capital_sub_inc = $Capital_sub[0]->increase;

        }
        else
        {
            $Capital_sub_inc = '0';
        }

        $Capital_sub_decrease = DB::select("select * from account where  account_type='Owners Equity' and decrease != 'NULL'  ");
        //  return $Capital_sub_dec;
        if (count($Capital_sub_decrease) > 0)
        {
            $Capital_sub_dec = $Capital_sub_decrease[0]->decrease;

        }
        else
        {
            $Capital_sub_dec = '0';
        }

        $result = DB::select("select* from account where account_type = 'Owners Equity' ");
        if (count($result) > 0)
        {
            $own_inc = $result[0]->increase;
        }
        else
        {
            $own_inc = '0';
        }

        $bank = DB::select("select* from account where account_type = 'bank' ");
        if (count($bank) > 0)
        {
            $bankk = $bank[0]->increase;
        }
        else
        {
            $bankk = '0';
        }

        $result = DB::select("select* from account where account_type = 'Purchase' ");

        if (count($result) > 0)
        {
            $pur_inc = $result[0]->increase;

        }
        else
        {
            $pur_inc = '0';
        }

        $expense = DB::select("select* from account where account_type = 'Expense' ");
        if (count($expense) > 0)
        {
            $expense_inc = $expense[0]->increase;

        }
        else
        {
            $expense_inc = '0';
        }

        // $result = DB::select("select* from account where sub_account = 'Owners investment' ");
        // $own_invest_inc= $result[0]->increase;
        

        $resullt = DB::select("select* from account where account_type = 'Cash' ");
        $coh_inc = $resullt[0]->increase;
        $coh_dec = $resullt[0]->decrease;
        $resullt2 = DB::select("select* from account where account_type = 'Account Receivable' ");
        $lib_inc = $resullt2[0]->increase;
        $lib_decrease = $resullt2[0]->decrease;
        // return $total_amount;
        // $total_amount = DB::select("select SUM(amount) from detail_sale where sku = '$id'");
        $pdf = PDF::loadView('admin.trial_balance_pdf', compact('bank', 'bankk', 'detail_purchase_return_tax', 'detail_purchase_tax', 'lib_decrease', 'sale_decrease', 'detail_purchase_return', 'detail_purchase_sum_return', 'expense', 'total_amount3', 'expense_inc', 'Capital_sub_dec', 'coh_dec', 'Capital_sub_decrease', 'Capital_sub_inc', 'Capital_sub', 'Capital', 'Capital_inc', 'detail_purchase_sum', 'detail_purchase', 'own_inc', 'pur_inc', 'sale_inc', 'coh_inc', 'lib_inc', 'total_amount2', 'result', 'sale', 'salee', 'total_amount'));

        return $pdf->download('test.pdf');
        // return $total_amount;
        // $total_amount = DB::select("select SUM(amount) from detail_sale where sku = '$id'");
        

        
    }

    public function trial_balance_print()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from account  ");

        $total_amount = DB::table('account')->where('account_type', 'Sales Retail')
            ->sum('increase');
        $salee = DB::select("select* from sale  ");
        if (count($salee) > 0)
        {
            $sale = $salee[0]->sale_type;

        }
        else
        {
            $sale = '0';
        }
        $detail_purchase = DB::select("select* from detail_purchase where purchase_type='purchase'  ");

        $detail_purchase_tax = DB::select("select* from detail_tax_purchase where purchase_type='purchase'  ");

        // return $detail_purchase;
        $detail_purchase_sum_sim = DB::table('detail_purchase')->where('purchase_type', 'purchase')
            ->sum('amount');

        $detail_purchase_tax_sum = DB::table('detail_tax_purchase')->where('purchase_type', 'purchase')
            ->sum('amount');

        $detail_purchase_sum = $detail_purchase_sum_sim + $detail_purchase_tax_sum;

        // return $detail_purchase_sum;
        $detail_purchase_return = DB::select("select* from detail_purchase where purchase_type='return'  ");

        $detail_purchase_return_tax = DB::select("select* from detail_tax_purchase where purchase_type='return'  ");
        // return $detail_purchase_return;
        $detail_purchase_sum_return_sim = DB::table('detail_purchase')->where('purchase_type', 'return')
            ->sum('amount');
        // return $detail_purchase_sum_return_sim;
        $detail_purchase_sum_return_tax = DB::table('detail_tax_purchase')->where('purchase_type', 'return')
            ->sum('amount');

        $detail_purchase_sum_return = $detail_purchase_sum_return_sim + $detail_purchase_sum_return_tax;

        // return $detail_purchase_sum_return;
        // return $detail_purchase_sum;
        $total_amount2 = DB::table('account')->where('account_type', 'Cash')
            ->sum('increase');
        $total_amount3 = DB::table('account')->where('account_type', 'Cash')
            ->sum('decrease');
        $result = DB::select("select* from account where account_type = 'Sales Retail' ");
        $sale_inc = $result[0]->increase;
        $sale_decrease = $result[0]->decrease;

        $Capital = DB::select("select* from account where account_type = 'Owners Equity' ");

        if (count($Capital) > 0)
        {
            $Capital_inc = $Capital[0]->increase;

        }
        else
        {
            $Capital_inc = "0";
        }

        $Capital_sub = DB::select("select * from account where  account_type='Owners Equity' LIMIT 1");
        // return $Capital_sub;
        if (count($Capital_sub) > 0)
        {
            $Capital_sub_inc = $Capital_sub[0]->increase;

        }
        else
        {
            $Capital_sub_inc = '0';
        }

        $Capital_sub_decrease = DB::select("select * from account where  account_type='Owners Equity' and decrease != 'NULL'  ");
        //  return $Capital_sub_dec;
        if (count($Capital_sub_decrease) > 0)
        {
            $Capital_sub_dec = $Capital_sub_decrease[0]->decrease;

        }
        else
        {
            $Capital_sub_dec = '0';
        }

        $result = DB::select("select* from account where account_type = 'Owners Equity' ");
        if (count($result) > 0)
        {
            $own_inc = $result[0]->increase;
        }
        else
        {
            $own_inc = '0';
        }

        $bank = DB::select("select* from account where account_type = 'bank' ");
        if (count($bank) > 0)
        {
            $bankk = $bank[0]->increase;
        }
        else
        {
            $bankk = '0';
        }

        $result = DB::select("select* from account where account_type = 'Purchase' ");

        if (count($result) > 0)
        {
            $pur_inc = $result[0]->increase;

        }
        else
        {
            $pur_inc = '0';
        }

        $expense = DB::select("select* from account where account_type = 'Expense' ");
        if (count($expense) > 0)
        {
            $expense_inc = $expense[0]->increase;

        }
        else
        {
            $expense_inc = '0';
        }

        // $result = DB::select("select* from account where sub_account = 'Owners investment' ");
        // $own_invest_inc= $result[0]->increase;
        

        $resullt = DB::select("select* from account where account_type = 'Cash' ");
        $coh_inc = $resullt[0]->increase;
        $coh_dec = $resullt[0]->decrease;
        $resullt2 = DB::select("select* from account where account_type = 'Account Receivable' ");
        $lib_inc = $resullt2[0]->increase;
        $lib_decrease = $resullt2[0]->decrease;
        // return $total_amount;
        // $total_amount = DB::select("select SUM(amount) from detail_sale where sku = '$id'");
        return view('admin.trial_balance_print', compact('bank', 'bankk', 'detail_purchase_return_tax', 'detail_purchase_tax', 'lib_decrease', 'sale_decrease', 'detail_purchase_return', 'detail_purchase_sum_return', 'expense', 'total_amount3', 'expense_inc', 'Capital_sub_dec', 'coh_dec', 'Capital_sub_decrease', 'Capital_sub_inc', 'Capital_sub', 'Capital', 'Capital_inc', 'detail_purchase_sum', 'detail_purchase', 'own_inc', 'pur_inc', 'sale_inc', 'coh_inc', 'lib_inc', 'total_amount2', 'result', 'sale', 'salee', 'total_amount'));
        // return $total_amount;
        // $total_amount = DB::select("select SUM(amount) from detail_sale where sku = '$id'");
        
    }

    public function admin_list()
    {
        $result = DB::select("select* from admin_details");

        return view('admin.admin_list', compact('result'));

    }
    public function admin_detail($id)
    {
        $result = DB::select("select* from admin_details where pk_id= '$id'");

        return view('admin.admin_detail', compact('result'));

    }

    public function add_admin_view()
    {
        return view('admin.add_admin');
    }

    public function create_admin(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $bank_deposit = 1;

        $transfer_money = 1;

        $Machine_Management_delete = 1;

        $Admin_Management = 1;

        $Expense_Management = 1;

        $Expense_Management_edit = 1;

        $Expense_Management_delete = 1;

        $Customer_Management = 1;

        $Customer_Management_edit = 1;

        $Customer_Management_delete = 1;

        $Sales_Management = 1;
        $Sales_Management_edit = 1;

        $Sales_Management_delete = 1;

        $Supplier_Management = 1;

        $Supplier_Management_edit = 1;

        $Supplier_Management_delete = 1;

        $Purchase_Management = 1;

        $Purchase_Management_edit = 1;

        $Purchase_Management_delete = 1;

        $Category_Management = 1;

        $Category_Management_edit = 1;

        $Category_Management_delete = 1;

        $Report = 1;

        $Report_edit = 1;

        $Report_delete = 1;

        $Item_Management = 1;

        $Item_Management_edit = 1;

        $Item_Management_delete = 1;

        $Kachi_Parchi = 1;

        $Kachi_Parchi_edit = 1;

        $Kachi_Parchi_delete = 1;

        $Pump_Management = 1;

        $Pump_Management_edit = 1;

        $Pump_Management_delete = 1;

        $Accounts_Management = 1;

        $Accounts_Management_edit = 1;

        $Accounts_Management_delete = 1;

        if ($request->input('pass') == $request->input('c_pass'))
        {
            $username = $request->input('email');

            $result = DB::select("select* from permissions where username = '$username' ");

            if (count($result) > 0)
            {

                return Redirect::back()->withErrors('Username already Exist');
            }
            else
            {
                DB::insert("insert into permissions (fname,lname, username, password, bank_deposit,
          transfer_money,Machine_Management_delete,
          Admin_Management, Expense_Management, Expense_Management_edit, Expense_Management_delete,
          Customer_Management,Customer_Management_edit, Customer_Management_delete,
          Sales_Management,Sales_Management_edit, Sales_Management_delete,
          Supplier_Management,Supplier_Management_edit,Supplier_Management_delete,
          Purchase_Management,Purchase_Management_edit, Purchase_Management_delete,
          Category_Management,Category_Management_edit, Category_Management_delete,
          Report,Report_edit, Report_delete,
          Item_Management,Item_Management_edit, Item_Management_delete,
          Kachi_Parchi,Kachi_Parchi_edit, Kachi_Parchi_delete,
          Pump_Management,Pump_Management_edit, Pump_Management_delete,
           Accounts_Management,Accounts_Management_edit,Accounts_Management_delete)
            values (?,?,?,?
            ,?,?,?,?,?,?,
            ?,?,?,?,?,?,
            ?,?,?,?,?,?,
            ?,?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?,?,?,
            ?,?,?)", array(
                    $request->input('fname') ,
                    $request->input('lname') ,
                    $request->input('email') ,
                    md5($request->input('pass')) ,
                    $bank_deposit,
                    $transfer_money,
                    $Machine_Management_delete,
                    $Admin_Management,
                    $Expense_Management,
                    $Expense_Management_edit,
                    $Expense_Management_delete,
                    $Customer_Management,
                    $Customer_Management_edit,
                    $Customer_Management_delete,
                    $Sales_Management,
                    $Sales_Management_edit,
                    $Sales_Management_delete,
                    $Supplier_Management,
                    $Supplier_Management_edit,
                    $Supplier_Management_delete,
                    $Purchase_Management,
                    $Purchase_Management_edit,
                    $Purchase_Management_delete,
                    $Category_Management,
                    $Category_Management_edit,
                    $Category_Management_delete,
                    $Report,
                    $Report_edit,
                    $Report_delete,
                    $Item_Management,
                    $Item_Management_edit,
                    $Item_Management_delete,
                    $Kachi_Parchi,
                    $Kachi_Parchi_edit,
                    $Kachi_Parchi_delete,
                    $Pump_Management,
                    $Pump_Management_edit,
                    $Pump_Management_delete,
                    $Accounts_Management,
                    $Accounts_Management_edit,
                    $Accounts_Management_delete
                ));

                return redirect('/admin/view/admin/list');
            }

        }
        else
        {
            return Redirect::back()->withErrors('Password does not match');
        }
    }

    public function print_page_purchase()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $total_amount = DB::select("select SUM(total_amount) from purchase");
        $result = DB::select("select* from purchase");
        $result1 = DB::select("select* from supplier");
        // return $result[0]->supplier_name;
        return view('admin.print_page_purchase', compact('result', 'result1', 'total_amount'));

    }

    public function sale_return_view($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $result = DB::select("select * from  sale where pk_id = '$id' ");
        $result1 = DB::select("select * from  detail_sale where sale_id = '$id' ");
        // return $result1;
        $result2 = DB::select("select * from  sale_invoice where sale_id = '$id' ");

        $q1 = DB::select("select SUM(quantity) from detail_sale where sale_id='$id'");
        if (count($q1) > 0)
        {
            $q1 = ($q1[0]->{'SUM(quantity)'});
            // return $q1;
            
        }
        $q2 = DB::select("select SUM(quantity) from sale_return where sale_id='$id'");
        if (count($q2) > 0)
        {
            $q2 = ($q2[0]->{'SUM(quantity)'});
            $quantity_available = $q1 - $q2;
        }

        // return $quantity_available;
        return view('admin.invoice_return', compact('result', 'result1', 'id', 'quantity_available'));

    }

    public function sale_return(Request $request, $id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $customer_name;
        $customer_name = $request->input('customer_name');
        $date = $request->input('date');
        $date2 = $request->input('date2');
        $sku = $request->input('sku');
        $item_name = $request->input('item_name');
        $quantity = $request->input('quantity');
        $rate = $request->input('rate');
        $amount = $request->input('amount');
        // return $amount;
        $q = DB::table('detail_sale')->where('sale_id', $id)->sum('quantity');

        if ($quantity <= $q)
        {

            DB::insert("insert into sale_return(sale_id,customer_name,bill_date,due_date,sku,item_name,
quantity,rate,amount) values (?,?,?,?,?,?,?,?,?)", array(
                $id,
                $customer_name,
                $date,
                $date2,
                $sku,
                $item_name,
                $quantity,
                $rate,
                $amount
            ));

            $result1 = DB::select("select * from  customer where customer_name = '$customer_name' ");
            $current_balance = $result1[0]->current_balance;
            $new_current_balance = $current_balance - $amount;
            DB::table('customer')->where('customer_name', $customer_name)->update(['current_balance' => $new_current_balance]);

            $return_amount = DB::select("select * from  sale where pk_id = '$id' ");
            $return_amountt = $return_amount[0]->return_amount;
            $return_amount2 = $return_amountt + $amount;
            DB::table('sale')->where('pk_id', $id)->update(['return_amount' => $return_amount2]);
            $paid_amount = $return_amount[0]->paid_amount;
            $payment = DB::select("select * from  sale_invoice where sale_id = '$id' ");

            if (count($payment) > 0)
            {
                $new_balance = $paid_amount - $amount;

            }
            else
            {
                $new_balance = $return_amount[0]->total_amount - $amount;
            }

            DB::table('sale')->where('pk_id', $id)->update(['balance' => $new_balance]);

            DB::table('sale')->where('pk_id', "$id")->update(['sale_type' => 'return']);
        }
        else
        {
            $result = DB::select("select * from  customer where customer_name = '$customer_name' ");
            $cus_id = $result[0]->pk_id;

            return redirect('admin/home/view/sale/' . $cus_id)->withErrors('Quantity Exceed!...');

        }
        $result = DB::select("select * from  customer where customer_name = '$customer_name' ");
        $cus_id = $result[0]->pk_id;

        return redirect('admin/home/view/sale/return/' . $cus_id)->withErrors('Returned Successfuly!...');

    }

    public function create_payment_sale_return_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $result1 = DB::select("select* from sale where pk_id = '$id' ");
        $customer = $result1[0]->customer_name;
        $total = $result1[0]->total_amount;
        $customer2 = DB::select("select* from customer where pk_id = '$customer'");

        // $remain = DB::select("select* from sale_invoice where sale_id = '$id'");
        $remain = DB::table('sale_invoice')->where('sale_id', $id)->sum('partial');

        if ($remain > 0)
        {
            $new_total = $remain;
            //  return $new_total;
            
        }
        else
        {
            $new_total = '0';
        }

        $result = DB::select("select* from sale_return where sale_id = '$id' ");
        if (count($result) > 0)
        {
            $returned = $result[0]->amount;
        }
        else
        {
            $returned = '0';
        }

        $total_amount = DB::select("select SUM(total_amount) from sale where pk_id = '$id' ");

        return view('admin.receive_payment_sale_return', compact('returned', 'total', 'result', 'new_total', 'customer2', 'result1', 'total_amount'));

    }

    public function create_payment_sale_return(Request $request, $id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        

        // return $result;
        $customer_name = $request->input('customer_name');

        $date = $request->input('date');
        $account_type = $request->input('paid');
        $deposit_to = $request->input('returned');
        $description = $request->input('description');
        $due_date = $request->input('due_date');

        $org_amount = $request->input('org_amount');
        // return $org_amount;
        $partial = $request->input('payment');

        $result = DB::select("select* from sale_invoice where sale_id= '$id'  ");

        DB::insert("insert into returned_payment 
      (sale_id,customer_name,date,description,due_date,original_amount,paid,returned,payment) 
      values (?,?,?,?,?,?,?,?,?)", array(
            $id,
            $customer_name,
            $date,
            $description,
            $due_date,
            $org_amount,
            $account_type,
            $deposit_to,
            $partial
        ));

        $summ = DB::table('sale_invoice')->where('sale_id', $id)->sum('partial');

        //  $paid_bal_update=  DB::table('sale')->where('pk_id', $id)->update(['paid_amount' =>'0']);
        // $resultt=  DB::table('sale')->where('pk_id', $id)->update(['paid_amount' =>$summ]);
        $sale = DB::select("select* from sale where pk_id = '$id'");
        $sale2 = $sale[0]->balance;
        $new_balance = $sale2 + $partial;
        DB::table('sale')->where('pk_id', $id)->update(['balance' => $new_balance]);

        $c_name = $request->input('customer_name');
        //   return $c_name;
        $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
        $c_balance = $cus_name[0]->current_balance + $partial;
        //   return $c_balance;
        DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);

        $c_name = $request->input('customer_name');
        $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
        $id = $cus_name[0]->pk_id;
        // return $id;
        return redirect('/admin/home/view/sale/return/' . $id)->withErrors('Payment Recieved Successfully!...');

    }

    // =================== PURCHASE RETURN +++++++++++++++++++//
    public function purchase_return_view($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $result = DB::select("select * from  purchase where pk_id = '$id' ");
        $result1 = DB::select("select * from  detail_purchase where purchase_id = '$id' ");
        // return $result1;
        $result2 = DB::select("select * from  purchase_invoice where purchase_id = '$id' ");
        $q1 = DB::select("select SUM(quantity) from detail_purchase where purchase_id='$id'");
        if (count($q1) > 0)
        {
            $q1 = ($q1[0]->{'SUM(quantity)'});
            // return $q1;
            
        }
        $q2 = DB::select("select SUM(quantity) from purchase_return where purchase_id='$id'");
        if (count($q2) > 0)
        {
            $q2 = ($q2[0]->{'SUM(quantity)'});
            $quantity_available = $q1 - $q2;
        }

        return view('admin.purchase_invoice_return', compact('result', 'result1', 'id', 'quantity_available'));

    }

    public function purchase_return(Request $request, $id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $customer_name;
        $supplier_name = $request->input('supplier_name');
        $date = $request->input('date');

        $sku = $request->input('sku');
        $item_name = $request->input('item_name');
        $quantity = $request->input('quantity');
        $rate = $request->input('rate');
        $amount = $request->input('amount');
        // return $amount;
        $q = DB::table('detail_purchase')->where('purchase_id', $id)->sum('quantity');

        if ($quantity <= $q)
        {

            DB::insert("insert into purchase_return(purchase_id,supplier_name,bill_date,sku,item_name,
quantity,rate,amount) values (?,?,?,?,?,?,?,?)", array(
                $id,
                $supplier_name,
                $date,
                $sku,
                $item_name,
                $quantity,
                $rate,
                $amount
            ));

            $result1 = DB::select("select * from  supplier where supplier_name = '$supplier_name' ");
            $current_balance = $result1[0]->current_balance;
            $new_current_balance = $current_balance - $amount;
            DB::table('supplier')->where('supplier_name', $supplier_name)->update(['current_balance' => $new_current_balance]);

            $return_amount = DB::select("select * from  purchase where pk_id = '$id' ");
            $return_amountt = $return_amount[0]->returned_amount;
            $return_amount2 = $return_amountt + $amount;
            DB::table('purchase')->where('pk_id', $id)->update(['returned_amount' => $return_amount2]);
            $paid_amount = $return_amount[0]->paid_amount;

            $payment = DB::select("select * from  purchase_invoice where purchase_id = '$id' ");

            if (count($payment) > 0)
            {
                $new_balance = $paid_amount - $amount;

            }
            else
            {
                $new_balance = $return_amount[0]->total_amount - $amount;
            }

            DB::table('purchase')->where('pk_id', $id)->update(['balance' => $new_balance]);

            DB::table('purchase')->where('pk_id', "$id")->update(['purchase_type' => 'return']);

        }
        else
        {
            $result = DB::select("select * from  supplier where supplier_name = '$supplier_name' ");
            $cus_id = $result[0]->pk_id;

            return redirect('admin/home/view/purchase/' . $cus_id)->withErrors('Quantity Exceed!...');

        }

        $result = DB::select("select * from  supplier where supplier_name = '$supplier_name' ");
        $cus_id = $result[0]->pk_id;

        return redirect('admin/home/view/purchase/return/' . $cus_id)->withErrors('Returned Successfuly!...');

    }

    public function create_payment_purchase_return_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        $result1 = DB::select("select* from purchase where pk_id = '$id' ");
        $supplier = $result1[0]->supplier_name;
        $total = $result1[0]->total_amount;
        $supplier2 = DB::select("select* from supplier where pk_id = '$supplier'");

        // $remain = DB::select("select* from sale_invoice where sale_id = '$id'");
        $remain = DB::table('purchase_invoice')->where('purchase_id', $id)->sum('partial');

        if ($remain > 0)
        {
            $new_total = $remain;
            //  return $new_total;
            
        }
        else
        {
            $new_total = '0';
        }

        $result = DB::select("select* from purchase_return where purchase_id = '$id' ");
        if (count($result) > 0)
        {
            $returned = $result[0]->amount;
        }
        else
        {
            $returned = '0';
        }

        $total_amount = DB::select("select SUM(total_amount) from purchase where pk_id = '$id' ");

        return view('admin.receive_payment_purchase_return', compact('returned', 'total', 'result', 'new_total', 'supplier2', 'result1', 'total_amount'));

    }

    public function create_payment_purchase_return(Request $request, $id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $supplier_name = $request->input('supplier_name');

        $date = $request->input('date');
        $account_type = $request->input('paid');
        $deposit_to = $request->input('returned');
        $description = $request->input('description');
        $due_date = $request->input('due_date');

        $org_amount = $request->input('org_amount');
        // return $org_amount;
        $partial = $request->input('payment');

        $result = DB::select("select* from purchase_invoice where purchase_id= '$id'  ");

        DB::insert("insert into purchase_returned_payment 
      (purchase_id,supplier_name,date,description,due_date,original_amount,paid,returned,payment) 
      values (?,?,?,?,?,?,?,?,?)", array(
            $id,
            $supplier_name,
            $date,
            $description,
            $due_date,
            $org_amount,
            $account_type,
            $deposit_to,
            $partial
        ));

        $summ = DB::table('purchase_invoice')->where('purchase_id', $id)->sum('partial');

        $purchase = DB::select("select* from purchase where pk_id = '$id'");
        $purchase2 = $purchase[0]->balance;
        $new_balance = $purchase2 + $partial;
        DB::table('purchase')->where('pk_id', $id)->update(['balance' => $new_balance]);

        //  $paid_bal_update=  DB::table('sale')->where('pk_id', $id)->update(['paid_amount' =>'0']);
        // $resultt=  DB::table('sale')->where('pk_id', $id)->update(['paid_amount' =>$summ]);
        

        $c_name = $request->input('supplier_name');
        //   return $c_name;
        $cus_name = DB::select("select* from supplier where supplier_name = '$c_name'");
        $c_balance = $cus_name[0]->current_balance + $partial;
        //   return $c_balance;
        DB::table('supplier')->where('supplier_name', $c_name)->update(['current_balance' => $c_balance]);

        $c_name = $request->input('supplier_name');
        $cus_name = DB::select("select* from supplier where supplier_name = '$c_name'");
        $id = $cus_name[0]->pk_id;
        // return $id;
        return redirect('/admin/home/view/purchase/return/' . $id)->withErrors('Payment Recieved Successfully!...');

    }

    public function new ()
    {

        $summ = DB::table('purchase')->where('supplier_name', '11')
            ->sum('total_amount');
        // return $summ;
        DB::table('supplier')
            ->where('pk_id', '11')
            ->update(['total_purchase' => $summ]);

        return "done";

    }
    public function sale_payment_history($id, $c_name)
    {
        // return $id;
        $result = DB::select("select* from sale_invoice where sale_id = '$id'");
        $result3 = DB::select("select* from sale where pk_id = '$id'");
        $org_amount = $result3[0]->total_amount;
        $result2 = DB::select("select* from sale where pk_id= '$id' and sale_type = 'return'");
        if (count($result) || count($result2) > 0)
        {

            $summ = DB::table('sale_invoice')->where('sale_id', "$id")->sum('partial');
            return view('admin.sale_payment_history', compact('result', 'summ', 'result2', 'org_amount', 'c_name'));
        }
        else
        {
            return Redirect::back()
                ->withErrors('No Payment Found');
        }

    }

    public function sale_payment_history_edit_view($sale_id, $pk_id)
    {
        // return $id;
        $result1 = DB::select("select* from sale where pk_id = '$sale_id'");
        $payment_account = DB::select("select* from account where nature_of_account = 'Assets'");

        $customer = $result1[0]->customer_name;
        $total = $result1[0]->total_amount;
        $customer2 = DB::select("select* from customer where pk_id = '$customer'");

        $invoice_amount1 = DB::select("select* from sale_invoice where pk_id = '$pk_id'");
        $invoice_amount = $invoice_amount1[0]->partial;
        $payment_account1 = $invoice_amount1[0]->account_type;

        // $remain = DB::select("select* from sale_invoice where sale_id = '$id'");
        $remain = DB::table('sale_invoice')->where('sale_id', $sale_id)->sum('partial');
        if ($remain > 0)
        {
            $new_total = $total - $remain;
            //  return $new_total;
            
        }
        else
        {
            $new_total = $total;
        }

        $result = DB::select("select* from sale where customer_name = '$sale_id' and sale_type = 'sale'");
        $total_amount = DB::select("select SUM(total_amount) from sale where customer_name = '$sale_id' and sale_type = 'sale'");

        return view('admin.receive_payment_edit', compact('pk_id', 'payment_account1', 'total', 'result', 'new_total', 'customer2', 'result1', 'total_amount', 'payment_account', 'invoice_amount'));

    }

    public function edit_payment_sale(Request $request, $sale_id, $pk_id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return $id;
        

        // return $result;
        $account_name = $request->input('account_type');
        $partial = $request->input('partial');

        $account_cash1 = DB::select("select* from account where account_name = '$account_name'");
        if (count($account_cash1))
        {
            $account_cash2 = $account_cash1[0]->balance;
            $partial2 = $account_cash2 + $partial;
            $account_cash = DB::table('account')->where('account_name', $account_name)->update(['balance' => "$partial2"]);
        }
        else
        {
            return Redirect::back()->withErrors('Please Select an Account!...');
        }

        $customer_name = $request->input('customer_name');

        $date = $request->input('date');
        $account_type = $request->input('account_type');
        $deposit_to = $request->input('deposit_to');
        $description = $request->input('description');
        $due_date = $request->input('due_date');

        $org_amount = $request->input('org_amount');
        // return $org_amount;
        $partial = $request->input('partial');
        $result = DB::select("select* from sale_invoice where sale_id= '$sale_id'  ");

        if (count($result) > 0)
        {

            $sum = DB::table('sale_invoice')->where('sale_id', $sale_id)->sum('partial');
            $result2 = DB::select("select* from sale_invoice where pk_id= '$pk_id' ");
            $result22 = $result2[0]->partial;

            $sum2 = $org_amount - $sum;
            // return $sum2;
            if ($partial <= $sum2)
            {

                $paymentt1 = $result2[0]->remain;
                $payment1 = $paymentt1 - $partial + $result22;
                // return $sum;
                $account_cash = DB::table('sale_invoice')->where('pk_id', $pk_id)->update(['account_type' => "$account_type", 'partial' => "$partial", 'remain' => " $payment1"]);

                //     DB::insert("insert into sale_invoice
                //   (sale_id,customer_name,date,account_type,deposit_to,description,due_date,org_amount,partial,remain)
                //   values (?,?,?,?,?,?,?,?,?,?)", array(
                //         $id,
                //         $customer_name,
                //         $date,
                //         $account_type,
                //         $deposit_to,
                //         $description,
                //         $due_date,
                //         $org_amount,
                //         $partial,
                //         $payment1
                //     ));
                $summ = DB::table('sale_invoice')->where('sale_id', $sale_id)->sum('partial');

                //  $paid_bal_update=  DB::table('sale')->where('pk_id', $id)->update(['paid_amount' =>'0']);
                $resultt = DB::table('sale')->where('pk_id', $sale_id)->update(['paid_amount' => $summ]);

                $result5 = DB::select("select* from sale where pk_id= '$sale_id'  ");
                $balance = $result5[0]->balance;
                $new_balance = $balance - $partial + $result22;

                $balance_update = DB::table('sale')->where('pk_id', $sale_id)->update(['balance' => $new_balance]);

                // $c_name = $request->input('customer_name');
                // //   return $c_name;
                // $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
                // $c_balance = $cus_name[0]->current_balance + $partial;
                // //   return $c_balance;
                // DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);
                
            }
            else
            {
                $c_name = $request->input('customer_name');
                $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
                $id = $cus_name[0]->pk_id;
                // return $id;
                return redirect('admin/home/view/sale/' . $id)->withErrors('Payment Acceed!...');;

            }

        }
        elseif ($partial <= $org_amount)
        {

            $result2 = DB::select("select* from sale_invoice where pk_id= '$pk_id' ");
            $result22 = $result2[0]->partial;

            $payment1 = $org_amount - $partial + $result22;
            //  return "f";
            $account_cash = DB::table('sale_invoice')->where('pk_id', $pk_id)->update(['account_type' => "$account_type", 'partial' => "$partial", 'remain' => " $payment1"]);

            // DB::insert("insert into sale_invoice (sale_id,customer_name,date,account_type,deposit_to,description,due_date,org_amount,partial,remain) values (?,?,?,?,?,?,?,?,?,?)", array(
            //     $id,
            //     $customer_name,
            //     $date,
            //     $account_type,
            //     $deposit_to,
            //     $description,
            //     $due_date,
            //     $org_amount,
            //     $partial,
            //     $payment1
            // ));
            $resultt = DB::table('sale')->where('pk_id', $sale_id)->update(['paid_amount' => $partial]);

            $summ = DB::table('sale_invoice')->where('sale_id', $sale_id)->sum('partial');
            $result5 = DB::select("select* from sale where pk_id= '$sale_id'  ");
            $balance = $result5[0]->balance;
            $new_balance = $balance - $partial;

            $balance_update = DB::table('sale')->where('pk_id', $sale_id)->update(['balance' => $new_balance]);

            // $c_name = $request->input('customer_name');
            // $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
            // // return $partial;
            // $c_balance = $cus_name[0]->current_balance + $partial;
            // $update = DB::table('customer')->where('customer_name', $c_name)->update(['current_balance' => $c_balance]);
            
        }
        else
        {

            $c_name = $request->input('customer_name');
            $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
            $id = $cus_name[0]->pk_id;
            // return $id;
            return redirect('admin/home/view/sale/' . $id)->withErrors('Payment Acceed!...');
        }

        $c_name = $request->input('customer_name');
        $cus_name = DB::select("select* from customer where customer_name = '$c_name'");
        $id = $cus_name[0]->pk_id;
        // return $id;
        return redirect('admin/home/view/sale/' . $id)->withErrors('Payment Updated Successfully!...');

    }

    public function purchase_payment_history($id, $s_name)
    {
        // return $id;
        $result = DB::select("select* from purchase_invoice where purchase_id = '$id'");
        if (count($result) > 0)
        {

            $summ = DB::table('purchase_invoice')->where('purchase_id', "$id")->sum('partial');
            return view('admin.purchase_payment_history', compact('result', 'summ', 's_name'));
        }
        else
        {
            return Redirect::back()
                ->withErrors('No Payment Found');
        }

    }

    public function create_admin_view()
    {

        return view('admin.create_admin');

    }

    public function admin_list_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from permissions where Admin_Management='1' ");
        // return $result;
        return view('admin.view_admin_list', compact('result'));

    }

    public function edit_admin_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from permissions where pk_id='$id' ");
        return view('admin.edit_admin_view', compact('result'));

    }

    public function edit_admin(Request $request, $id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::table('permissions')
            ->where('pk_id', $id)->update(['fname' => $request->input('fname') , 'lname' => $request->input('lname') , 'username' => $request->input('email')

        ]);

        return redirect('/admin/view/admin/list');
    }

    public function delete_admin($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        DB::delete("delete from permissions where pk_id = '$id'");
        return redirect()->back();

    }

    public function add_company_view()
    {

        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        return view('admin.create-company');

    }

    public function add_company(Request $request)
    {

        $company_name = $request->input('company_name');

        $result = DB::select("select* from company where company_name = '$company_name' ");

        if (count($result) > 0)
        {

            return Redirect::back()->withErrors('Company already Exist');
        }
        else
        {
            DB::insert("insert into company (fname,company_name, phone, address,bussiness_type,industry)
                        values (?,?,?,?,?,?)", array(
                $request->input('fname') ,
                $request->input('company_name') ,
                $request->input('phone') ,
                $request->input('address') ,
                $request->input('b_type') ,
                $request->input('industry') ,

            ));

            return redirect('/admin/home/company/list');
        }
    }

    public function company_list_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from company ");
        return view('admin.view_company_list', compact('result'));

    }

    public function view_company_permissions()
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from permissions where company !='null' ");
        return view('admin.view_company_permissions', compact('result'));

    }

    public function edit_company_view($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from company where pk_id='$id' ");
        return view('admin.edit_company_view', compact('result'));

    }

    public function edit_company(Request $request, $id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::table('company')
            ->where('pk_id', $id)->update(['fname' => $request->input('fname') , 'company_name' => $request->input('company_name') , 'phone' => $request->input('phone') , 'address' => $request->input('address') , 'bussiness_type' => $request->input('b_type') , 'industry' => $request->input('industry') ,

        ]);

        return redirect('/admin/home/company/list');
    }

    public function view_company_detail($id)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from company where pk_id='$id'");
        return view('admin.view_company', compact('result'));

    }

    public function delete_company($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        DB::delete("delete from company where pk_id = '$id'");
        return redirect()->back();

    }

    public function permission_view()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $result = DB::select("select* from company");
        return view('admin.create_permission', compact('result'));

    }

    public function add_permission(Request $request)
    {
        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $bank_deposit = 0;
        $transfer_money = 0;
        $Machine_Management_delete = 0;

        $Admin_Management = 0;

        $Expense_Management = 0;
        $Expense_Management_edit = 0;
        $Expense_Management_delete = 0;

        $Customer_Management = 0;
        $Customer_Management_edit = 0;
        $Customer_Management_delete = 0;

        $Sales_Management = 0;
        $Sales_Management_edit = 0;
        $Sales_Management_delete = 0;

        $Supplier_Management = 0;
        $Supplier_Management_edit = 0;
        $Supplier_Management_delete = 0;

        $Purchase_Management = 0;
        $Purchase_Management_edit = 0;
        $Purchase_Management_delete = 0;

        $Category_Management = 0;
        $Category_Management_edit = 0;
        $Category_Management_delete = 0;

        $Report = 0;
        $Report_edit = 0;
        $Report_delete = 0;

        $Item_Management = 0;
        $Item_Management_edit = 0;
        $Item_Management_delete = 0;

        $Kachi_Parchi = 0;
        $Kachi_Parchi_edit = 0;
        $Kachi_Parchi_delete = 0;

        $Pump_Management = 0;
        $Pump_Management_edit = 0;
        $Pump_Management_delete = 0;

        $Accounts_Management = 0;
        $Accounts_Management_edit = 0;
        $Accounts_Management_delete = 0;

        if ($request->input('bank_deposit'))
        {
            $bank_deposit = 1;
        }
        if ($request->input('transfer_money'))
        {
            $transfer_money = 1;
        }
        if ($request->input('Machine_Management_delete'))
        {
            $Machine_Management_delete = 1;
        }

        if ($request->input('Admin_Management'))
        {
            $Admin_Management = 1;
        }

        if ($request->input('Expense_Management'))
        {
            $Expense_Management = 1;
        }
        if ($request->input('Expense_Management_edit'))
        {
            $Expense_Management_edit = 1;
        }
        if ($request->input('Expense_Management_delete'))
        {
            $Expense_Management_delete = 1;
        }

        if ($request->input('Customer_Management'))
        {
            $Customer_Management = 1;
        }
        if ($request->input('Customer_Management_edit'))
        {
            $Customer_Management_edit = 1;
        }
        if ($request->input('Customer_Management_delete'))
        {
            $Customer_Management_delete = 1;
        }

        if ($request->input('Sales_Management'))
        {
            $Sales_Management = 1;
        }
        if ($request->input('Sales_Management_edit'))
        {
            $Sales_Management_edit = 1;
        }
        if ($request->input('Sales_Management_delete'))
        {
            $Sales_Management_delete = 1;
        }

        if ($request->input('Supplier_Management'))
        {
            $Supplier_Management = 1;
        }
        if ($request->input('Supplier_Management_edit'))
        {
            $Supplier_Management_edit = 1;
        }
        if ($request->input('Supplier_Management_delete'))
        {
            $Supplier_Management_delete = 1;
        }

        if ($request->input('Purchase_Management'))
        {
            $Purchase_Management = 1;
        }
        if ($request->input('Purchase_Management_edit'))
        {
            $Purchase_Management_edit = 1;
        }
        if ($request->input('Purchase_Management_delete'))
        {
            $Purchase_Management_delete = 1;
        }

        if ($request->input('Category_Management'))
        {
            $Category_Management = 1;
        }
        if ($request->input('Category_Management_edit'))
        {
            $Category_Management_edit = 1;
        }
        if ($request->input('Category_Management_delete'))
        {
            $Category_Management_delete = 1;
        }

        if ($request->input('Report'))
        {
            $Report = 1;
        }
        if ($request->input('Report_edit'))
        {
            $Report_edit = 1;
        }
        if ($request->input('Report_delete'))
        {
            $Report_delete = 1;
        }

        if ($request->input('Item_Management'))
        {
            $Item_Management = 1;
        }
        if ($request->input('Item_Management_edit'))
        {
            $Item_Management_edit = 1;
        }
        if ($request->input('Item_Management_delete'))
        {
            $Item_Management_delete = 1;
        }

        if ($request->input('Kachi_Parchi'))
        {
            $Kachi_Parchi = 1;
        }
        if ($request->input('Kachi_Parchi_edit'))
        {
            $Kachi_Parchi_edit = 1;
        }
        if ($request->input('Kachi_Parchi_delete'))
        {
            $Kachi_Parchi_delete = 1;
        }

        if ($request->input('Pump_Management'))
        {
            $Pump_Management = 1;
        }
        if ($request->input('Pump_Management_edit'))
        {
            $Pump_Management_edit = 1;
        }
        if ($request->input('Pump_Management_delete'))
        {
            $Pump_Management_delete = 1;
        }

        if ($request->input('Accounts_Management'))
        {
            $Accounts_Management = 1;
        }
        if ($request->input('Accounts_Management_edit'))
        {
            $Accounts_Management_edit = 1;
        }
        if ($request->input('Accounts_Management_delete'))
        {
            $Accounts_Management_delete = 1;
        }

        if ($bank_deposit == 0 && $Admin_Management == 0 && $Expense_Management == 0 && $Customer_Management == 0 && $Sales_Management == 0 && $Supplier_Management == 0 && $Purchase_Management == 0 && $Category_Management == 0 && $Report == 0 && $Item_Management == 0 && $Kachi_Parchi == 0 && $Pump_Management == 0 && $Accounts_Management == 0)
        {
            return Redirect::back()->withErrors('atleast you neeed to select one permission');

        }

        $username = $request->input('username');
        $company = $request->input('company_name');
        $result2 = DB::select("select* from permissions where company = '$company' and username='$username'");

        //  return  $result2 ;
        if (count($result2) > 0)
        {
            return Redirect::back()->withErrors('you have added this company already');

        }
        else
        {

            DB::insert("insert into permissions (username,company, bank_deposit,
                                    transfer_money,Machine_Management_delete,
                                    Admin_Management, Expense_Management, Expense_Management_edit, Expense_Management_delete,
                                    Customer_Management,Customer_Management_edit, Customer_Management_delete,
                                    Sales_Management,Sales_Management_edit, Sales_Management_delete,
                                    Supplier_Management,Supplier_Management_edit,Supplier_Management_delete,
                                    Purchase_Management,Purchase_Management_edit, Purchase_Management_delete,
                                    Category_Management,Category_Management_edit, Category_Management_delete,
                                    Report,Report_edit, Report_delete,
                                    Item_Management,Item_Management_edit, Item_Management_delete,
                                    Kachi_Parchi,Kachi_Parchi_edit, Kachi_Parchi_delete,
                                    Pump_Management,Pump_Management_edit, Pump_Management_delete,
                                     Accounts_Management,Accounts_Management_edit,Accounts_Management_delete)
                                      values (?,?
                                      ,?,?,?,?,?,?,
                                      ?,?,?,?,?,?,
                                      ?,?,?,?,?,?,
                                      ?,?,?,?,?,?,
                                      ?,?,?,?,?,
                                      ?,?,?,?,?,
                                      ?,?,?)", array(

                $request->input('username') ,
                $request->input('company_name') ,
                $bank_deposit,
                $transfer_money,
                $Machine_Management_delete,
                $Admin_Management,
                $Expense_Management,
                $Expense_Management_edit,
                $Expense_Management_delete,
                $Customer_Management,
                $Customer_Management_edit,
                $Customer_Management_delete,
                $Sales_Management,
                $Sales_Management_edit,
                $Sales_Management_delete,
                $Supplier_Management,
                $Supplier_Management_edit,
                $Supplier_Management_delete,
                $Purchase_Management,
                $Purchase_Management_edit,
                $Purchase_Management_delete,
                $Category_Management,
                $Category_Management_edit,
                $Category_Management_delete,
                $Report,
                $Report_edit,
                $Report_delete,
                $Item_Management,
                $Item_Management_edit,
                $Item_Management_delete,
                $Kachi_Parchi,
                $Kachi_Parchi_edit,
                $Kachi_Parchi_delete,
                $Pump_Management,
                $Pump_Management_edit,
                $Pump_Management_delete,
                $Accounts_Management,
                $Accounts_Management_edit,
                $Accounts_Management_delete
            ));
        }
        $username = $request->input('username');
        $result = DB::select("select* from permissions where username = '$username' ORDER BY pk_id DESC");
        $customer_name = $result[0]->{'fname'};
        $data = array(
            'customer_name' => $customer_name,
            'username' => $username,
            'company' => $request->input('company_name') ,

        );
        Mail::send('employe_set_password', $data, function ($message) use ($username)
        {

            $message->from('info@general.greengrapez.com', 'MS');

            $message->to($username)->subject('Password Reset Confirmation Link');

        });
        return redirect()
            ->back()
            ->with('message', 'A Password set link sent to your email');

    }

    public function reset_password_view($username, $company)
    {

        return view('admin.set_password', compact('username', 'company'));

    }

    public function password_change(Request $request, $username, $company)
    {
        $password = md5($request->input('password'));
        $fname = $request->input('fname');
        $lname = $request->input('lname');
        DB::update("update permissions set password ='$password',fname ='$fname',lname ='$lname' where username='$username' and company = '$company'   ");
        return redirect('/admin')->with('message', 'Your Password has been Set Successfully');
    }

    public function add_employe_view()
    {

        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return view('admin.add_employe_view');
    }
    public function add_employe(Request $request)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        $employe_name = $request->input('employe_name');

        $supp = DB::select("select* from employe where employe_name = '$employe_name'");
        //   return $supp;
        if (count($supp) > 0)
        {
            return Redirect::back()->withErrors('employe already Exist');
        }
        else
        {
            DB::insert("insert into employe(employe_name,cnic,phone,billing_address,email,ntn,strn,opening_balance,current_balance) values (?,?,?,?,?,?,?,?,?)", array(
                $request->input('employe_name') ,
                $request->input('cnic') ,
                $request->input('phone') ,
                $request->input('billing_address') ,
                $request->input('email') ,
                $request->input('ntn') ,
                $request->input('strn') ,
                $request->input('opening_balance') ,
                $request->input('current_balance')
            ));

        }

        // dd($request->input('customer_name'),date('Y:m:y H:i:s'),$request->input('current_balance'));
        

        return Redirect::back()
            ->withErrors('Employee Added ');
    }
    public function employe_list_view()
    {

        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        // return "asd";
        $result = DB::select("select* from employe");

        return view('admin.employe_list_view', compact('result'));
    }

    public function employe_detail_view($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from employe where pk_id='$id'");

        return view('admin.employe_detail_view', compact('result'));
    }
    public function delete_employe($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::delete("delete from employe where pk_id='$id'");

        return redirect()->back();
    }
    public function edit_employe_view($id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $result = DB::select("select* from employe where pk_id='$id'");

        return view('admin.edit_employe_view', compact('result'));
    }

    public function edit_employe(Request $request, $id)
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        DB::table('employe')
            ->where('pk_id', $id)->update(['employe_name' => $request->input('employe_name') , 'cnic' => $request->input('cnic') , 'phone' => $request->input('phone') , 'billing_address' => $request->input('billing_address') , 'ntn' => $request->input('ntn') , 'strn' => $request->input('strn') , 'opening_balance' => $request->input('opening_balance') , 'current_balance' => $request->input('current_balance') ]);

        return redirect('/admin/home/view/employe/list');
    }


    public function add_nature_of_account_view()
    {

        if (!(session()->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        return view('admin.coa.add_nature_of_account');
    }

    public function add_nature_of_account(Request $request)
    {

        $coa = $request->input('coa');

        $result = DB::select("select* from account_nature where nature_of_account = '$coa' ");

        if (count($result) > 0)
        {

            return Redirect::back()->withErrors('Nature already Exist');
        }
        else
        {
            DB::insert("insert into account_nature (nature_of_account)
                        values (?)", array(
                $request->input('coa') ,

            ));

            return redirect('/admin/home/add/account');
        }
    }

    public function add_account_type_view()
    {

        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $noa = DB::select("select* from account_nature  ");

        return view('admin.coa.add_account_type', compact('noa'));
    }

    public function add_account_type(Request $request)
    {

        $account_type = $request->input('account_type');

        $result = DB::select("select* from account_type where account_type = '$account_type' ");

        if (count($result) > 0)
        {

            return Redirect::back()->withErrors('account_type already Exist');
        }
        else
        {
            DB::insert("insert into account_type (nature_of_account,account_type)
                        values (?,?)", array(
                $request->input('noa') ,
                $request->input('account_type') ,

            ));

            return redirect('/admin/home/add/account');
        }
    }

    public function add_account_name(Request $request)
    {

        $noa = $request->input('noa');
        $account_type = $request->input('account_type');
        $account_name = $request->input('account_name');

        $result = DB::select("select* from account where account_name = '$account_name' ");

        $sub = $request->input('sub_account');

        if (!empty($sub))
        {

            $sub = $request->input('sub_account');

            $result = DB::select("select* from account where account_name = '$sub' ");
            $noa = $result[0]->nature_of_account;
            $account_type = $result[0]->account_type;
            $account_name = $result[0]->pk_id;

            DB::insert("insert into account (nature_of_account,account_type,main_account_id,sub_account,description,balance,date)
                        values (?,?,?,?,?,?,?)", array(
                $noa,
                $account_type,
                $account_name,
                $request->input('account_name') ,

                $request->input('description') ,
                $request->input('balance') ,
                $request->input('date') ,

            ));

        }
        else
        {

            // return "fgg";
            DB::insert("insert into account (nature_of_account,account_type,account_name,description,balance,date)
                        values (?,?,?,?,?,?)", array(
                $request->input('noa') ,
                $request->input('account_type') ,
                $request->input('account_name') ,

                $request->input('description') ,
                $request->input('balance') ,
                $request->input('date') ,

            ));
        }

        return redirect('/admin/home/view/account');

    }

    public function subb(Request $request)
    {
        $value = $request->Input('cat_id');

        $subcategories = DB::select(DB::raw("SELECT * FROM account_type WHERE nature_of_account = :value") , array(
            'value' => $value,
        ));

        return Response::json($subcategories);

    }

    public function type(Request $request)
    {
        $type_id = $request->Input('type_id');

        $subcategories = DB::select(DB::raw("SELECT * FROM account WHERE account_type = :value") , array(
            'value' => $type_id,
        ));

        //  $sub_id = DB::select("select* from product_type where sub_category = '$sub_id' and username='admin' ");
        return Response::json($subcategories);

    }

    public function trial_balance_detail(Request $request)
    {

        $result = DB::select("select* from purchase  ");
        $result1 = DB::select("select* from detail_purchase  ");
        $total = DB::table('detail_purchase')->sum('amount');

        return view('admin.trial_balance_detail', compact('result', 'result1', 'total'));

    }

    public function account_test()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }

        // $account_name = DB::select("select * from account where account_name !='NULL' ");
        //  $account_nature = DB::select("select * from account_nature  ");
        //   $account_type = DB::select("select * from account_type  ");
        // return $account_name;
        $result = DB::select("select * from customer");
        $account_type = DB::table('account')->where('nature_of_account', 'Assets')
            ->get();
        return view('admin.coa.add_account_test', compact('result' ,'account_type'));
    }
    public function account_supplier()
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $supplier = DB::select("select * from supplier");
        $account_type = DB::table('account')->where('nature_of_account', 'Assets')
            ->get();
        return view('admin.coa.add_account_supplier', compact('account_type','supplier'));
    }

    public function test_account(Request $request)
    {
        $value = $request->Input('cat_id');

        // $subcategories = DB::select(DB::raw("SELECT * FROM sale WHERE customer_name = :value") , array(
        //     'value' => $value,
        // ));
        $subcategories = DB::select(DB::raw("SELECT * FROM customer WHERE pk_id = :value") , array(
            'value' => $value,
        ));

        return Response::json($subcategories);

    }
    public function suppliername_account(Request $request)
    {
        $value = $request->Input('cat_id');

        // $subcategories = DB::select(DB::raw("SELECT * FROM sale WHERE customer_name = :value") , array(
        //     'value' => $value,
        // ));
        $subcategories = DB::select(DB::raw("SELECT * FROM supplier WHERE pk_id = :value") , array(
            'value' => $value,
        ));

        return Response::json($subcategories);

    }
    public function account_test_form(Request $request)
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
            
        $pk_id = $request->Input('name');
        $payment_type = $request->Input('payment_type');
        $test_balance = $request->Input('test_balance');
        $test_amount = $request->Input('test_amount');
        $account_name = $request->Input('account_name');
        
        if($payment_type =="Payment"){
            
            // $balance = $test_balance + $test_amount;
            // return $balance;
            // $account_cash = DB::table('customer')->where('pk_id', $pk_id)->update(['current_balance' => "$balance" ,'payment_type'=>"$payment_type"]);
            
            
            $account_cash = DB::select("select* from account where account_name = '$account_name'");
            if (count($account_cash))
            {
                
                $account_cash2 = $account_cash[0]->balance;
                if($account_cash2 >= $test_amount){
                    $partial = $account_cash2 - $test_amount;
                    // $partial = $test_balance - $test_amount;
                    $account_cash = DB::table('account')->where('account_name', $account_name)->update(['balance' => "$partial",'increase' => "$partial" ]);
                    // $increase = DB::table('account')->where('account_name', $account_name)->update(['increase' => "$partial2"]);
                }
                else{
                    return Redirect::back()->withErrors('Amount in payment account is insufficient...');
                }
            }
            else
            {
                return Redirect::back()->withErrors('Please Select an Account!...');
            }
            
            $balance = $test_balance + $test_amount;
            $customer_bal = DB::table('customer')->where('pk_id', $pk_id)->update(['current_balance' => "$balance",'payment_type'=>"$payment_type"]);
            
        }
        elseif($payment_type =="Received"){
            
            // if($test_balance =="0"){
            //     $balance = $test_balance + $test_amount;
                
            //     $account_cash = DB::table('customer')->where('pk_id', $pk_id)->update(['current_balance' => "$balance",'payment_type'=>"$payment_type"]);
            // }
            // else{
            //     $balance = $test_balance - $test_amount;
            //     // return $balance;
            //     $account_cash = DB::table('customer')->where('pk_id', $pk_id)->update(['current_balance' => "$balance",'payment_type'=>"$payment_type"]);
            // }
            
            
            $account_cash = DB::select("select* from account where account_name = '$account_name'");
            
            if (count($account_cash))
            {
                $account_cash2 = $account_cash[0]->balance;
                $partial = $account_cash2 + $test_amount;
                
                // $partial = $test_balance + $test_amount;
                $account_cash = DB::table('account')->where('account_name', $account_name)->update(['balance' => "$partial",'increase' => "$partial"]);
                // $increase = DB::table('account')->where('account_name', $account_name)->update(['increase' => "$partial2"]);
            }
            else
            {
                return Redirect::back()->withErrors('Please Select an Account!...');
            }
            
            $balance = $test_balance - $test_amount;
            
            $customer_bal = DB::table('customer')->where('pk_id', $pk_id)->update(['current_balance' => "$balance",'payment_type'=>"$payment_type"]);
            
        }
        return redirect('/admin/home/view/bal/by/customer');
    }
    public function account_supplier_form(Request $request)
    {
        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $pk_id = $request->Input('suppliername');
        $payment_type = $request->Input('payment_type');
        $test_balance = $request->Input('supplier_blance');
        $test_amount = $request->Input('test_amount');
        $account_name = $request->Input('account_name');
        
        
        if($payment_type =="Received"){
            
            
            $account_cash = DB::select("select* from account where account_name = '$account_name'");
            if (count($account_cash))
            {
                $account_cash2 = $account_cash[0]->balance;
                $partial = $account_cash2 + $test_amount;
                // $partial = $test_balance - $test_amount;
                $account_cash = DB::table('account')->where('account_name', $account_name)->update(['balance' => "$partial",'increase' => "$partial" ]);
                // $increase = DB::table('account')->where('account_name', $account_name)->update(['increase' => "$partial2"]);
            }
            else
            {
                return Redirect::back()->withErrors('Please Select an Account!...');
            }
            $abc =(-($test_amount));
            
            $balance = $test_balance - $abc;
            $customer_bal = DB::table('supplier')->where('pk_id', $pk_id)->update(['current_balance' => "$balance",'payment_type'=>"$payment_type"]);
            
        }
        elseif($payment_type =="Payment"){
            
            
            $account_cash = DB::select("select* from account where account_name = '$account_name'");
            if (count($account_cash))
            {
                
                $account_cash2 = $account_cash[0]->balance;
                if($account_cash2 >= $test_amount){
                    
                $partial = $account_cash2 - $test_amount;
                
                // $partial = $test_balance + $test_amount;
                $account_cash = DB::table('account')->where('account_name', $account_name)->update(['balance' => "$partial",'increase' => "$partial"]);
                // $increase = DB::table('account')->where('account_name', $account_name)->update(['increase' => "$partial2"]);
                    
                }
                else{
                    return Redirect::back()->withErrors('Amount in payment account is insufficient...');
                }
            }
            
            else
            {
                return Redirect::back()->withErrors('Please Select an Account!...');
            }
            
            $balance = $test_balance -  $test_amount;
            $customer_bal = DB::table('supplier')->where('pk_id', $pk_id)->update(['current_balance' => "$balance",'payment_type'=>"$payment_type"]);
            
        }
        return redirect('/admin/home/view/bal/by/supplier');
    }
    
    public function zero()
    {

        if (!(session()
            ->has('type') && session()
            ->get('type') == 'admin'))
        {
            return redirect('/admin');
        }
        $zero = '0';
        DB::table('account')->update(['balance' => $zero, 'increase' => $zero, 'decrease' => $zero]);
        DB::table('customer')->update(['current_balance' => $zero , 'total_sale' => $zero ,'opening_balance' => $zero]);
        DB::table('supplier')->update(['current_balance' => $zero , 'total_purchase' => $zero ,'opening_balance' => $zero]);
        DB::delete("delete from bank_deposit");
        DB::delete("delete from detail_sale");
        DB::delete("delete from detail_purchase");
        DB::delete("delete from expense");
        DB::delete("delete from sale");
        DB::delete("delete from purchase");

        return redirect('/admin/home');
    }
}

