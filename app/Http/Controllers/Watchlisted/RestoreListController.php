<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use App\Models\PersonModel;
use App\Models\RecordModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RestoreListController extends Controller
{
    public function index(){
        $data['title'] = 'Restore';
        $data['list'] = DB::table('persons')->where('status', 'inactive')->orderBy('first_name', 'asc')->get();
        return view('watchlisted.contents.restore.restore')->with($data);
    }
}
