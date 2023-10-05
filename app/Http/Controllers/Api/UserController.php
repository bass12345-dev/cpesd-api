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

   

        $row = DB::table('users')->where('user_id', $_GET['id'])->get();

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
}
