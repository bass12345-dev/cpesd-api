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
    public $app_key;
    public function __construct()
    {
        $this->user   = new UserModel;
        $this->app_key   = config('app.key');
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
                'username'      => $row[0]->username                   
        );

        return response()->json($items);

    }

    public function register(Request $request){


        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {

         $now = new \DateTime();
        $now->setTimezone(new \DateTimezone('Asia/Manila'));
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
                'user_created'      => $now->format('Y-m-d H:i:s'),
                'user_status'       => 'active',
                'work_status'       => NULL,
                'user_type'         => 'user'
        );



        $check = DB::table('users')->where('username', $items['username'])->count();

        if ($check) {
            $data = array('message' => 'Username is Taken' , 'response' => false);
        }else {


            if (strlen($items['password']) >= 5) {

            $add = DB::table('users')->insert($items);

                if ($add) {

                     $data = array('message' => 'Registered Successfully' , 'response' => true );

                }else {

                    $data = array('message' => 'Something Wrong' , 'response' => false );


                }

            }else {
                 $data = array('message' => 'Password is too short' , 'response' => false );
            }


        }

 

           }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
    }
       
       return response()->json($data);

    }

    public function remove_user(Request $request, $id){

        $items = array(

                'user_status' => $request->input('status')
        );


     $update = DB::table('users')
                    ->where('user_id', $id)
                    ->update($items);

      if ($update) {

             $data = array('message' => 'Status Updated Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Error' , 'response' => false );


        }
       
       return response()->json($data);

    }


    public function delete_user(Request $request, $id){



        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {

            $delete =  UserModel::where('user_id', $id)->delete();

                if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => true );

                }else {
                    $data = array('message' => 'Error', 'response' => false);
                }
        

    }else {

         $data = array('message' => 'Request Unauthorized' , 'response' => false );

    }

        echo json_encode($data);

    }

  

  public  function update_profile(Request $request, $id){

    $authorization = $request->header('Authorization');

    $id =  base64_decode($id);

    if ($authorization == $this->app_key) {

      $items = array(
                'first_name'        => $request->input('first_name'),   
                'last_name'         => $request->input('last_name'),   
                'middle_name'       => $request->input('middle_name'),   
                'extension'         => $request->input('extension'),  
                'address'           => $request->input('address'),     
                'contact_number'    => $request->input('contact_number'),   
                'email_address'     => $request->input('email'),  
                'username'          => $request->input('user_name'),
                'off_id'            => $request->input('office'),
                
        );


     $update = DB::table('users')
                    ->where('user_id', $id)
                    ->update($items);

      if ($update) {

             $data = array('message' => 'Updated Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong/No Changes Apply' , 'response' => false );


        }
       
        }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
        }
       
       return response()->json($data);
  }   



  public  function update_password_to_default(Request $request, $id){

      $authorization = $request->header('Authorization');




        if ($authorization == $this->app_key) {

            $id =  $id;
            $key = DB::table('users')->where('user_id', $id);

            if ($key->count() > 0) {


                $update     = DB::table('users')
                    ->where('user_id', $id)
                    ->update(array('password'=> password_hash($key->get()[0]->username, PASSWORD_DEFAULT) ));


                 if ($update) {
                    
                  $data = array('message' => 'Updated Successfully' , 'response' => true );

                }else {

                  $data = array('message' => 'Something Wrong' , 'response' => false );
                }

                return response()->json($data);

            }else {

                  return response()->json(['message'=>'Invalid Old Security Code','response'=> false]);
            }


        }else {

             return response()->json(array('message' => 'Request Unauthorized' , 'response' => false )); 
        }


  }


   public  function update_password(Request $request, $id){

        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {

        $id =  base64_decode($id);
        $new = $request->input('new_password');
        $old = $request->input('old_password');


        if (strlen($new) >= 5) {
            // code...
    

        $key = DB::table('users')->where('user_id', $id);

        if ($key->count() > 0) {

            $verify_password = password_verify($old,$key->get()[0]->password); 

            if ($verify_password) {

                $update     = DB::table('users')
                    ->where('user_id', $id)
                    ->update(array('password'=> password_hash($new, PASSWORD_DEFAULT) ));


                 if ($update) {
                    
                  $data = array('message' => 'Updated Successfully' , 'response' => true );

                }else {

                  $data = array('message' => 'Something Wrong' , 'response' => false );
                }

                return response()->json($data);

                // code...
            }else {

                  return response()->json(['message'=>'Invalid Old Security Code','response'=> false]);
            }

           

        }else{

             return response()->json(['message'=>'ID not found','response'=> false]);


        }

    }else{

        return response()->json(['message'=>'New Password is too short','response'=> false]);
    }


         }else {

             return response()->json(array('message' => 'Request Unauthorized' , 'response' => false )); 
        }



   }


    
}
