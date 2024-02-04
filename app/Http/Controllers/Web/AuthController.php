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

                     

                     $request->session()->put(array('user_id', $user->get()[0]->user_id,'isLoggedIn' => true));

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
}
