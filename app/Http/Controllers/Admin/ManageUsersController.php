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
        $data['users'] = $this->get_users();
       
        return view('admin.contents.manage_users.manage_users')->with($data);
    }


    public function get_users(){

            $items = DB::table('users')->where('user_type','user')->get();       
            return $items;

    }

}
