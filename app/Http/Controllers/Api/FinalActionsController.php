<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FinalActionsModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class FinalActionsController extends Controller
{

    public $actions;
    public function __construct()
    {
        $this->actions   = new FinalActionsModel;
    }
    //GET
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


        return response()->json($data);

    }



     //POST
    public function add_action(Request $request){

    date_default_timezone_set('Asia/Manila');

    

  
    $items = array(

        'action_name'    => $request->input('type'),
        'created'       =>  Carbon::now()->toDateTimeString(),
    );


    if(!empty($items['action_name'])) {

    $add = DB::table('final_actions')->insert($items);

    if ($add) {

             $data = array('message' => 'Added Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }

    }else {

        $data = array('message' => 'Empty Field' , 'response' => false );

    }
       
       return response()->json($data);


    }


        //Delete
    public function delete_action(Request $request, $id)
    {
        
            $delete =  FinalActionsModel::where('action_id', $id)->delete();

            if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => true);

                }else {
                    $data = array('message' => 'Error', 'response' => false);
                }

        echo json_encode($data);
    }


    public function update_action(Request $request, $id){


    $items = array(

        'action_name'  => $request->input('type'),
      
        
    );

    $update = DB::table('final_actions')
                    ->where('action_id', $id)
                    ->update($items);

      if ($update) {

             $data = array('message' => 'Updated Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong/No Changes Apply' , 'response' => false );


        }
       
       return response()->json($data);

    }
}
