<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ProgramModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class ProgramController extends Controller
{
    public $app_key;
    public function __construct()
    {
        $this->app_key   = config('app.key');
    }


        //POST
    public function add_program(Request $request){


    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {

    $now = new \DateTime();
    $now->setTimezone(new \DateTimezone('Asia/Manila'));

    $items = array(

        'program'    => $request->input('program'),
        'program_description'    => $request->input('program_description'),
        'created'       =>  $now->format('Y-m-d H:i:s')
    );

    if(!empty($items['program'])) {

    $add = DB::table('programs')->insert($items);

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
    public function delete_program(Request $request, $id)
    {
        
        $authorization = $request->header('Authorization');

         if ($authorization == $this->app_key) {

        // $check = DB::table('programs')->where('program_id', $id)->count();

        // if ($check > 0) {
        //      $data = array('message' => 'This type of document is used in other operation' , 'response' => false);
        // }else {

            $delete =  ProgramModel::where('program_id', $id)->delete();

            if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => true);

                }else {
                    $data = array('message' => 'Error', 'response' => false);
                }

        // }

         }else {

             $data = array('message' => 'Request Unauthorized' , 'response' => false );
        }

     

        echo json_encode($data);
    }


        //GET
    public function get_programs(){

        $items = DB::table('programs')->get();

        $data = [];
        foreach ($items as $row) {

            $data[] = array(


                    'program' => $row->program,
                    'program_description' => $row->program_description,
                    'program_id'   => $row->program_id,
                    'created'   => date('M d Y - h:i a', strtotime($row->created))
            );
            
        }


        return response()->json($data);

    }



    public function update_program(Request $request, $id){

    $authorization = $request->header('Authorization');


    if ($authorization == $this->app_key) {


    $items = array(

        'program'               => $request->input('program'),
        'program_description'   => $request->input('program_description'),
      
        
    );

    $update = DB::table('programs')
                    ->where('program_id', $id)
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
