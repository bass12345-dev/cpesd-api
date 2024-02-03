<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OfficesController extends Controller
{
    public function index(){


        $data['title'] = 'Manage Offices';
        $data['offices'] = $this->offices();
        $data['user_data'] = array('user_id' => '9', 'office_id' => '21' );
        return view('admin.contents.offices.offices')->with($data);
    }


    public function offices(){

        $items = DB::table('offices')->get();

        $data = [];
        foreach ($items as $row) {

            $data[] = array(


                    'office'        => $row->office,
                    'office_id'     => $row->office_id,
                    'created'       => date('M d Y - h:i a', strtotime($row->created))
            );
            // code...
        }


        return $data;

     

    }

}
