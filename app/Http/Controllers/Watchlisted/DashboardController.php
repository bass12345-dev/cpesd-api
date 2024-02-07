<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
    	$data['title'] = 'Watchlisted Dashboard';
        return view('watchlisted.contents.dashboard.dashboard')->with($data);
    }
}
