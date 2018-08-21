<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\User;
use Excel;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExcelController extends Controller
{
    
    public function downloadUsersList(){

        $headings = array('User ID', 'Referrer ID', 'Username', 'Position', 'Pos ID', 'First Name', 'Last Name', 'SSN', 'Balance', 'HP Balance', 'Coin Balance', 'Join Date', 'Paid Status', 'Ver Status', 'Ver Code', 'Forget Code', 'Date of Birth', 'Email', 'Mobile', 'Street Address', 'City', 'Country', 'Post Code', 'created_at', 'updated_at');

         $users = User::select('id','referrer_id','username','position','posid','first_name','last_name','ssn','balance','hp_balance','coin_balance','join_date','paid_status','ver_status','ver_code','forget_code','birth_day','email','mobile','street_address','city','country','post_code','created_at','updated_at');

    //    Route::get('export.users.list', function(){
        
        $response = new StreamedResponse(function(){
            // Open output stream
            $handle = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($handle, [
                'User ID', 'Referrer ID', 'Username', 'Position', 'Pos ID', 'First Name', 'Last Name', 'SSN', 'Balance', 'HP Balance', 'Coin Balance', 'Join Date', 'Paid Status', 'Ver Status', 'Ver Code', 'Forget Code', 'Date of Birth', 'Email', 'Mobile', 'Street Address', 'City', 'Country', 'Post Code', 'created_at', 'updated_at'
            ]);

            \User::chunk(500, function($users) use($handle) {
                // Get all users
                foreach (User::all() as $user) {
                    // Add a new row with data
                    fputcsv($handle, [
                        $user->id, $user->referrer_id, $user->username, $user->position, $user->posid, $user->first_name, $user->last_name, $user->ssn, $user->balance, $user->hp_balance, $user->coin_balance, $user->join_date, $user->paid_status, $user->ver_status, $user->ver_code, $user->forget_code, $user->birth_day, $user->email, $user->mobile, $user->street_address, $user->city, $user->country, $user->post_code, $user->created_at, $user->updated_at
                    ]);
                }
            });    

            // Close the output stream
            fclose($handle);
        }, 200, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="export.csv"',
            ]);

        return $response;
  //  });
 
     /*   return Excel::create('user_list', function($excel) use ($headings) {
            $excel->sheet('user_list', function($sheet) use ($headings)
            { 
                $users = User::select('id','referrer_id','username','position','posid','first_name','last_name','ssn','balance','hp_balance','coin_balance','join_date','paid_status','ver_status','ver_code','forget_code','birth_day','email','mobile','street_address','city','country','post_code','created_at','updated_at')->get();

                foreach($users as $u){

                    if($u->paid_status == 1){
                        $paid_status = "Paid User";
                    }
                    else if($u->paid_status == 0){
                        $paid_status = "Free User";
                    }
                    else{
                        $paid_status = "Deactivated";   
                    }

                    $data[] = array(
                        $u->id,
                        $u->referrer_id,
                        $u->username,
                        $u->position,
                        $u->posid,
                        $u->first_name,
                        $u->last_name,
                        $u->ssn,
                        $u->balance,
                        $u->hp_balance,
                        $u->coin_balance,
                        $u->join_date,
                        $paid_status,
                        $u->ver_status,
                        $u->ver_code,
                        $u->forget_code,
                        $u->birth_day,
                        $u->email,
                        $u->mobile,
                        $u->street_address,
                        $u->city,
                        $u->country,
                        $u->post_code,
                        $u->created_at,
                        $u->updated_at,
                    );
                } 
                   
                $sheet->fromArray($data, null, 'A1', false, false);  
                $sheet->prependRow(1, $headings); 
            });
        })->download('xlsx');  

        Excel::create('Report', function($excel) use ($users) {
        $excel->sheet('report', function($sheet) use($users) {
            
            $sheet->appendRow(array('User ID', 'Referrer ID', 'Username', 'Position', 'Pos ID', 'First Name', 'Last Name', 'SSN', 'Balance', 'HP Balance', 'Coin Balance', 'Join Date', 'Paid Status', 'Ver Status', 'Ver Code', 'Forget Code', 'Date of Birth', 'Email', 'Mobile', 'Street Address', 'City', 'Country', 'Post Code', 'created_at', 'updated_at'));

            $users->chunk(100, function($rows) use ($sheet)
                {
                    foreach ($rows as $row)
                    {
                        $sheet->appendRow(array(
                            $row->id, $row->referrer_id, $row->username, $row->position, $row->posid, $row->first_name, $row->last_name, $row->ssn, $row->balance, $row->hp_balance, $row->coin_balance, $row->join_date, $row->paid_status, $row->ver_status, $row->ver_code, $row->forget_code, $row->birth_day, $row->email, $row->mobile, $row->street_address, $row->city, $row->country, $row->post_code, $row->created_at, $row->updated_at  
                        ));
                    }
                });
            });
        })->download('xlsx'); */
  
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
      /*  $validator = Validator::make(
          [
              'file'      => $request->file('import_file'),
              'extension' => strtolower($request->file('import_file')->getClientOriginalExtension()),
          ],
          [
              'file'          => 'required',
              'extension'      => 'required|in:csv,xlsx,xls',
          ]
        );

        $extensions = array("xls","xlsx","csv");
        $result = array($request->file('import_file')->getClientOriginalExtension()); */


    /*    if($request->hasFile('import_file')){
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
        } */
      //  return Redirect::back();
        
        return redirect('home')->with('message', 'Profile Successfully Updated ');
    
    }

}
