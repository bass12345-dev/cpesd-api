<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\PersonController;


class DashboardController extends Controller
{
    public function index(){
    	$data['title'] = 'Watchlisted Dashboard';
        $data['count_active'] = PersonController::count_all();
        return view('watchlisted.contents.dashboard.dashboard')->with($data);
    }


    public function count_all(){
        $data = [];
        $active = DB::table('persons')->where('status', 'active')->count();
        $inactive = DB::table('persons')->where('status', 'inactive')->count();
        $data[] = array('active' => $active , 'inactive' => $inactive);

        return $data;

    }
}
