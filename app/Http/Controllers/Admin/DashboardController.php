<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;

class DashboardController extends Controller
{
    public function index(Request $request){

        $data['title'] = 'Admin Dashboard';
        $data['count'] = $this->countadmindoc_dash();


        return view('admin.contents.dashboard.dashboard')->with($data);
    }


    public function countadmindoc_dash(){

        $data = array(

                'count_documents'    => DB::table('documents')->count(),
                'count_offices'          => DB::table('offices')->where('office_status', 'active')->count(),
                'count_document_types'          => DB::table('history')->count(),
                'count_users'         => DB::table('users')->where('user_status', 'active')->count()
        );

        return $data;
    }
}
