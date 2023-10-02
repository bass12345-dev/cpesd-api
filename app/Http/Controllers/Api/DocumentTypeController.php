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
}
