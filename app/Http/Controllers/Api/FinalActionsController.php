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
    public $app_key;
    public function __construct()
    {
        $this->actions   = new FinalActionsModel;
        $this->app_key   = config('app.key');
    }
    //GET
    public function get_final_actions(Request $request){


     

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

    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {

    $now = new \DateTime();
    $now->setTimezone(new \DateTimezone('Asia/Manila'));
    
    $items = array(

        'action_name'    => $request->input('type'),
        'created'       =>  $now->format('Y-m-d H:i:s')
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


    }else {

             $data = array('message' => 'Request Unauthorized' , 'response' => false );
        }
       
       return response()->json($data);


    }


        //Delete
    public function delete_action(Request $request, $id)
    {

        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {


        $check = DB::table('history')->where('final_action_taken', $id)->count();

        if ($check > 0) {
            
             $data = array('message' => 'This action is used in other operation' , 'response' => false);

        }else {
        
            $delete =  FinalActionsModel::where('action_id', $id)->delete();

            if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => true);

                }else {
                    $data = array('message' => 'Error', 'response' => false);
                }

            }


         }else {

             $data = array('message' => 'Request Unauthorized' , 'response' => false );
        }

        echo json_encode($data);
    }


    public function update_action(Request $request, $id){


    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {


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


         }else {

             $data = array('message' => 'Request Unauthorized' , 'response' => false );
        }
       
       return response()->json($data);

    }
}
