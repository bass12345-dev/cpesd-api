<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use App\Models\PersonModel;
use App\Models\RecordModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\PersonController;


class DashboardController extends Controller
{
    public function index(){
    	$data['title'] = 'Watchlisted Dashboard';
        $data['count_active'] = PersonController::count_all();
        return view('watchlisted.contents.dashboard.dashboard')->with($data);
    }





}
