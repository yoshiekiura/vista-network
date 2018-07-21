<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\User;
use Excel;

class ExcelController extends Controller
{
    
    public function downloadUsersList(){

        $headings = array('User Number', 'Username', 'Referrer ID', 'Position', 'Customer No', 'First Name', 'Last Name', 'Tax ID', 'SSN', 'Balance', 'Join Date', 'Paid Status', 'Date of Birth', 'Email', 'Mobile', 'Street Address', 'City', 'Country', 'Post Code');

 
        return Excel::create('user_list', function($excel) use ($headings) {
            $excel->sheet('user_list', function($sheet) use ($headings)
            { 
                $users = User::all();
                foreach($users as $u){

                    if($u->paid_status == 1){
                        $paid_status = "Paid User";
                    }
                    else if($u->paid_status != 1){
                        $paid_status = "Deactivated";
                    }
                    else{
                        $paid_status = "Free User";   
                    }

                    $data[] = array(
                        $u->id,
                        $u->username,
                        $u->referrer_id,
                        $u->position,
                        $u->customer_no,
                        $u->first_name,
                        $u->last_name,
                        $u->tax_id,
                        $u->ssn,
                        $u->balance,
                        $u->join_date,
                        $paid_status,
                        $u->birth_day,
                        $u->email,
                        $u->mobile,
                        $u->street_address,
                        $u->city,
                        $u->country,
                        $u->post_code
                    );
                } 
                   
                $sheet->fromArray($data, null, 'A1', false, false);  
                $sheet->prependRow(1, $headings); 
            });
        })->download('xlsx'); 
 
    }

  /*  public function importUsersList(Request $request)
    {
        if($request->hasFile('import_file')){
            Excel::load($request->file('import_file')->getRealPath(), function ($reader) {
                foreach ($reader->toArray() as $key => $row) {
                    $data['title'] = $row['title'];
                    $data['description'] = $row['description'];

                    if(!empty($data)) {
                        DB::table('post')->insert($data);
                    }
                }
            });
        }

        Session::put('success', 'Youe file successfully import in database!!!');

        return back();
    } */

    public function usersImport(Request $request)
    {
        if($request->hasFile('import_file')){
            $path = $request->file('import_file')->getRealPath();
            $data = \Excel::load($path)->get();
            if($data->count()){
                foreach($data as $key => $value){
                    $user_list[] = [
                                    'id' => $value->id, 
                                    'username' => $value->username,
                                    'referrer_id' => $value->referrer_id, 
                                    'fname' => $value->fname,
                                    'lname' => $value->lname, 
                                    'email' => $value->email,
                                    'tax_id' => $value->tax_id, 
                                    'mobile' => $value->Phone,
                                    'street_address' => $value->street_address, 
                                    'city' => $value->city,
                                    'post_code' => $value->post_code,
                                    'join_date' => Carbon::today(),
                                    'balance' => 0,
                                    'status' => 1,
                                    'paid_status' => 0,
                                    'ver_status' => 0,
                                    'ver_code' => $pin,
                                    'forget_code' => 0,
                                    'posid' => $posid,
                                    'tauth' => 0,
                                    'tfver' => 1,
                                    'emailv' => 0,
                                    'smsv' => 1,
                                   ];
                }
                if(!empty($user_list)){
                    User::insert($user_list);
                    \Session::flash('message', 'File Imported Successfully.');
                }
            }
        }else{
            \Session::flash('warning', 'There is no file to import');
        }
      //  return Redirect::back();
        return redirect('home')->with('message', 'Profile Successfully Updated ');
    }

}
