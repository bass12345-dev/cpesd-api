<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\UserModel;
class AuthController extends Controller
{

    public $app_key;
    public function __construct()
    {
        $this->app_key   = config('app.key');
    }
    public function verify_code(Request $request){

         $authorization = $request->header('Authorization');

         if ($authorization == $this->app_key) {

    	 $key = DB::table('security')->where('us_id', 8);
    	 
    	 if ($key->count() > 0) {
            
    	 	 $verify_code = password_verify($request->input('code'),$key->get()[0]->security_code); 

                if ($verify_code) {

        	 	$user = $key->get()[0];
        	 	return response()->json(['message'=>$user->us_id,'response' => true]);
        	 }else {
        	 	return response()->json(['message'=>'Invalid Security Code', 'response' => false]);
             }
    	 }else {
             return response()->json(['message'=>'ID not found Please Contact Developer','response'=> false]);
         }


       }else {

             return response()->json(array('message' => 'Request Unauthorized' , 'response' => false )); 
        }
    	 
    }


    public function verify_b_user(Request $request){


    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {

      $id = $request->input('id');
      $key = DB::table('security')->where('us_id', $id);

       if ($key->count() > 0) {
            return response()->json([ 'response' => true]);
       }else {
             return response()->json(['response'=> false]);
         }

           }else {
             return response()->json(['response'=> false]);
        }
       



    }


    public function verify_dt_user(Request $request){

    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {

      $id = $request->input('id');
      $key = DB::table('users')->where('user_id', $id);

       if ($key->count() > 0) {
            return response()->json([ 'response' => true]);
       }else {
             return response()->json(['response'=> false]);
         }
         
          }else {
             return response()->json(['response'=> false]);
        }


    }

    public function verify_dt_admin(Request $request){

      $id = $request->input('id');
      $key = DB::table('users')->where('user_id', $id)->where('user_type','admin');

       if ($key->count() > 0) {
            return response()->json([ 'response' => true]);
       }else {
             return response()->json(['response'=> false]);
         }
         


    }

    public function verify_user(Request $request){

         $authorization = $request->header('Authorization');

         if ($authorization == $this->app_key) {


            $username = $request->input('username');
            $password = $request->input('password');


          


            $user = DB::table('users')->where('username', $request->input('username'));

       

            if ($user->count() > 0 ) {

                $check = password_verify($password, $user->get()[0]->password);

                if ($check) {

                     

                     return response()->json(['message'=>'Success.','response'=> true,'data' => $user->get()[0]->user_id ]);


                     }else{
                         return response()->json(['message'=>'invalid Password.','response'=> false]);

                      }


            }else {

                return response()->json(['message'=>'invalid Username.','response'=> false]);
            }

              }else {

             return response()->json(array('message' => 'Request Unauthorized' , 'response' => false )); 
        }
   
   
    }


    public function verify_admin(Request $request){

         $authorization = $request->header('Authorization');

         if ($authorization == $this->app_key) {


            $username = $request->input('username');
            $password = $request->input('password');

            $user = DB::table('users')->where('user_type', 'admin')->where('username', $request->input('username'));

       

            if ($user->count() > 0 ) {

                $check = password_verify($password, $user->get()[0]->password);

                if ($check) {

                     

                     return response()->json(['message'=>'Success.','response'=> true,'data' => $user->get()[0]->user_id ]);


                     }else{
                         return response()->json(['message'=>'invalid Password.','response'=> false]);

                      }


            }else {

                return response()->json(['message'=>'invalid Username.','response'=> false]);
            }

             }else {

             return response()->json(array('message' => 'Request Unauthorized' , 'response' => false )); 
        }
   
    }

    public function change_code(Request $request){


        $authorization = $request->header('Authorization');

         if ($authorization == $this->app_key) {

        $id =  base64_decode($_GET['id']);
        $new = $request->input('new');
        $old = $request->input('old');

        $key = DB::table('security')->where('us_id', $id);

        if ($key->count() > 0) {

            $verify_code = password_verify($old,$key->get()[0]->security_code); 

            if ($verify_code) {

                $update     = DB::table('security')
                    ->where('us_id', $id)
                    ->update(array('security_code'=> password_hash($new, PASSWORD_DEFAULT) ));


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


         }else {

             return response()->json(array('message' => 'Request Unauthorized' , 'response' => false )); 
        }


    }



}
