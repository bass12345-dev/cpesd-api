<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    
    public $user;
    public function __construct()
    {
        $this->user   = new UserModel;
    }

    public function get_users(){

        $items = [];

        if ($_GET['type'] == 'active') {
            $items = DB::table('users')->where('user_status', 'active')->get();
        }else if($_GET['type'] == 'inactive'){
            $items = DB::table('users')->where('user_status', 'inactive')->get();
        }

        return response()->json($items);

    }


    public function get_user_data(){

   

        $row = DB::table('users')->where('user_id', base64_decode($_GET['id']))->get();

        $items = array(

                'user_id' => $row[0]->user_id,
                'office_id' => $row[0]->off_id,
                'first_name' => $row[0]->first_name,   
                'last_name' => $row[0]->last_name,   
                'middle_name' => $row[0]->middle_name,   
                'extension' => $row[0]->extension,  
                'address' => $row[0]->address,     
                'contact_number' => $row[0]->contact_number,   
                'email_address' => $row[0]->email_address,                        
        );

        return response()->json($items);

    }

    public function register(Request $request){



        $items = array(
                'first_name'        => $request->input('first_name'),   
                'last_name'         => $request->input('last_name'),   
                'middle_name'       => $request->input('middle_name'),   
                'extension'         => $request->input('extension'),  
                'address'           => $request->input('address'),     
                'contact_number'    => $request->input('contact_number'),   
                'email_address'     => $request->input('email'),  
                'username'          => $request->input('user_name'),
                'password'          => $request->input('password'),
                'off_id'            => $request->input('office'),
                'user_created'      => date('Y-m-d H:i:s', time()),
                'user_status'       => 'active',
                'work_status'       => NULL,
                'user_type'         => 'user'
        );



        $check = DB::table('users')->where('username', $items['username'])->count();

        if ($check) {
            $data = array('message' => 'Username is Taken' , 'response' => false);
        }else {

            $add = DB::table('users')->insert($items);

                if ($add) {

                     $data = array('message' => 'Registered Successfully' , 'response' => true );

                }else {

                    $data = array('message' => 'Something Wrong' , 'response' => false );


                }


        }

 

        echo json_encode($data);

    }

    public function remove_user(Request $request, $id){

        $items = array(

                'user_status' => $request->input('status')
        );


     $update = DB::table('users')
                    ->where('user_id', $id)
                    ->update($items);

      if ($update) {

             $data = array('message' => 'Removed Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Error' , 'response' => false );


        }
       
       return response()->json($data);

    }

     


    
}
