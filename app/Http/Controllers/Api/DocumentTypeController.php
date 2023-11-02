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

   	$items = array(

        'type_name'    => $request->input('type'),
        'created'       => '2023-06-19 13:35:39',
    );

    $add = DB::table('document_types')->insert($items);

    if ($add) {

             $data = array('message' => 'Add Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
       return response()->json($data);


    }

    //GET
    public function get_document_types(){

    	$items = DB::table('document_types')->get();
    	return response()->json($items);

    }

    //Delete
    public function delete_type(Request $request, $id)
    {
        
        $delete =  TypeModel::where('type_id', $id)->delete();

                if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => 'true ');

                }else {
                    $data = array('message' => 'Error', 'response' => 'false');
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
