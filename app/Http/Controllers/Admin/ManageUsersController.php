<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ManageUsersController extends Controller
{
    
    public $user;
    public $app_key;
    public function __construct()
    {
        $this->user   = new UserModel;
        $this->app_key   = config('app.key');
    }

     public function index(){


        $data['title'] = 'Manage Users';
        $data['active_users'] = $this->get_users_active();
        $data['user_data'] = array('user_id' => '9', 'office_id' => '21' );
        return view('admin.contents.manage_users.manage_users')->with($data);
    }


    public function get_users_active(){

            $items = DB::table('users')->where('user_status', 'active')->get();       
            return $items;

    }

}
