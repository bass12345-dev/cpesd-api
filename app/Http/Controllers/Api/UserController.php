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
}
