<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->document   = new DocumentModel;
    }


        //POST
    public function add_document(Request $request){


    $items = array(

        'tracking_number'   		=> '123',
        'document_name'    			=> $request->input('document_name'),
        'u_id'    					=> 9,
        'offi_id'    				=> 1,
        'doc_type'    				=> $request->input('doc_type'),
        'document_description'    	=> $request->input('document_description'),
        'document_created'       	=> '2023-06-19 13:35:39',
    );

    $add = DB::table('documents')->insert($items);

    if ($add) {

             $data = array('message' => 'Add Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
       return response()->json($data);




    }

}
