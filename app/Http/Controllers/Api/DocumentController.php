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
        'u_id'    					=> $request->input('user_id'),
        'offi_id'    				=> $request->input('office_id'),
        'doc_type'    				=> $request->input('document_type'),
        'document_description'    	=> $request->input('description'),
        'created'       	=> '2023-06-19 13:35:39',
    );

    $add = DB::table('documents')->insert($items);

    if ($add) {

             $data = array('message' => 'Add Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
       return response()->json($data);




    }


    public function get_my_documents(){

        echo $_GET['id'];
    }

}
