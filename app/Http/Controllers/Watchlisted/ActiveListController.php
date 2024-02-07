<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use App\Models\PersonModel;
use App\Models\RecordModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ActiveListController extends Controller
{
    public function index(){
        $data['title'] = 'List';
        $data['list'] = DB::table('persons')->where('status', 'active')->orderBy('first_name', 'asc')->get();
        return view('watchlisted.contents.list.list')->with($data);
    }
}
