<?php

namespace App\Http\Controllers\Receiver;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;


class DashboardController extends Controller
{
    public function index(){
        $data['title'] = 'Dashboard';
        $data['count'] = $this->countmydoc_dash();
        return view('receiver.contents.dashboard.dashboard')->with($data);
    }


public function countmydoc_dash(){

        $id = session('_id');
        $data = array(

                'count_documents'    => DB::table('documents')->count(),
                'incoming'          => DB::table('history')->where('user2', $id)->where('received_status', NULL)->where('status', 'torec')->where('release_status',NULL )->where('to_receiver','yes')->count(),
                'received'          => DB::table('history')->where('user2', $id)->where('received_status', 1)->where('release_status',NULL )->where('status' , 'received')->where('to_receiver','yes')->count(),
                
        );

        return $data;
    }
}
