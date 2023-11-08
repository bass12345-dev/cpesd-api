<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DocumentTypeController extends Controller
{
    
    public $type;
    public function __construct()
    {
        $this->type   = new TypeModel;
    }

    //POST
    public function add_document_type(Request $request){

    date_default_timezone_set('Asia/Manila');

    
    
  
   	$items = array(

        'type_name'    => $request->input('type'),
        'created'       =>  Carbon::now()->toDateTimeString(),
    );

    if(!empty($items['type_name'])) {

    $add = DB::table('document_types')->insert($items);

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

    //GET
    public function get_document_types(){

    	$items = DB::table('document_types')->get();

        $data = [];
        foreach ($items as $row) {

            $data[] = array(


                    'type_name' => $row->type_name,
                    'type_id'   => $row->type_id,
                    'created'   => date('M d Y - h:i a', strtotime($row->created))
            );
            // code...
        }


    	return response()->json($data);

    }

    //Delete
    public function delete_type(Request $request, $id)
    {
        
      

        $check = DB::table('documents')->where('doc_type', $id)->count();

        if ($check > 0) {
             $data = array('message' => 'This type of document is used in other operation' , 'response' => false);
        }else {

            $delete =  TypeModel::where('type_id', $id)->delete();

            if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => true);

                }else {
                    $data = array('message' => 'Error', 'response' => false);
                }



        }

     

        echo json_encode($data);
    }



    public function update_type(Request $request, $id){


    $items = array(

        'type_name'  => $request->input('type'),
      
        
    );

    $update = DB::table('document_types')
                    ->where('type_id', $id)
                    ->update($items);

      if ($update) {

             $data = array('message' => 'Updated Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong/No Changes Apply' , 'response' => false );


        }
       
       return response()->json($data);

    }
}
