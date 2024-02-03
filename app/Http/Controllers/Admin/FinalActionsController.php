<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FinalActionsModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FinalActionsController extends Controller
{
    public function index(){


        $data['title'] = 'Manage Final Actions';
        $data['actions'] = $this->get_final_actions();
        $data['user_data'] = array('user_id' => '9', 'office_id' => '21' );
        return view('admin.contents.final_actions.final_actions')->with($data);
    }

    public function get_final_actions(){


     

        $items = DB::table('final_actions')->get();

        $data = [];
        foreach ($items as $row) {

            $data[] = array(


                    'type_name' => $row->action_name,
                    'type_id'   => $row->action_id,
                    'created'   => date('M d Y - h:i a', strtotime($row->created))
            );
            // code...
        }

      return $data;

       


       

    }
}
