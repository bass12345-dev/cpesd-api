<?php

namespace App\Http\Controllers\Web;

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

    public function index(){

          return view('auth.login');
    }

    public function logout(Request $request){
        $request->session()->flush();
         return redirect('/dts');
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

                     

                     $request->session()->put(array(
                        'name' => $user->get()[0]->first_name,
                        '_id' => $user->get()[0]->user_id,
                        'isLoggedIn' => true,
                        'user_type' =>$user->get()[0]->user_type, 
                        'is_receiver' => $user->get()[0]->is_receiver  ));

                     return response()->json(['message'=>'Success.','response'=> true]);


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



    public function verify_code(Request $request){

         $authorization = $request->header('Authorization');

         if ($authorization == $this->app_key) {

       $key = DB::table('security')->where('us_id', 8);
       
       if ($key->count() > 0) {
            
         $verify_code = password_verify($request->input('code'),$key->get()[0]->security_code); 

                if ($verify_code) {

            $user = $key->get()[0];
              $request->session()->put(array(
                       
                        'watch_id' => $user->us_id,
                        'isLoggedInWatch' => true,
                        'name' => 'Administrator',
                        
                      ));
            return response()->json(['message'=>$user->us_id,'mes' => 'Success','response' => true]);
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

}
