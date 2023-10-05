<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\UserModel;
class AuthController extends Controller
{
    public function verify_code(Request $request){


    	 $key = DB::table('security')->where('security_code', $request->input('code'));
    	 
    	 if ($key->count() > 0) {
    	 	
    	 	$user = $key->get()[0];
    	 	return response()->json(['message'=>'1','response' => true]);
    	 }else {
    	 	return response()->json(['message'=>'Invalid Security Code', 'response' => false]);
    	 }
    	 
    }

    public function verify_user(Request $request){


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
   
    }
}
