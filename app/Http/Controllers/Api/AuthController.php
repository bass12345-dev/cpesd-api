<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
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
}
