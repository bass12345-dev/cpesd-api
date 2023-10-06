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

        'tracking_number'   		=> $this->generate_tracking_number(),
        'document_name'    			=> $request->input('document_name'),
        'u_id'    					=> $request->input('user_id'),
        'offi_id'    				=> $request->input('office_id'),
        'doc_type'    				=> $request->input('document_type'),
        'document_description'    	=> $request->input('description'),
        'created'       	        => date('Y-m-d H:i:s', time()),
    );

    $add = DB::table('documents')->insert($items);

    if ($add) {

            $where = array('document_id' => DB::getPdo()->lastInsertId());
            $row = DB::table('documents')->where($where)->get()[0];

            $info1 = array(
                                't_number'         =>  $row->tracking_number,
                                'typ_id'           =>  $row->doc_type,
                                'user1'            =>  $row->u_id,
                                'office1'          =>  $row->offi_id,
                                'user2'            =>  $row->u_id,
                                'office2'          =>  $row->offi_id,
                                'status'           =>  'received',
                                'received_status'  =>  '1',
                                'received_date'    => date('Y-m-d H:i:s', time()), 
                                'release_status'   =>  '0',
                                'release_date'     => date('Y-m-d H:i:s', time()), 
                );


            $add1 = DB::table('documents')->insert($items);

            if ($add1) {
                
              $data = array('message' => 'Add Successfully' , 'response' => true );

            }else {

              $data = array('message' => 'Something Wrong' , 'response' => false );
            }

            

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
       return response()->json($data);




    }


    function generate_tracking_number(){

        $t_number = mt_rand();
        $check = DB::table('documents')->where('tracking_number', $t_number);

        $t_number = $check->count() < 1 ? $t_number : $t_number = mt_rand();

        return $t_number;

    }

    public function get_my_documents(){

        $rows = DB::table('documents')->where('u_id', $_GET['id'])->leftJoin('document_types', 'document_types.type_id', '=', 'documents.doc_type')->get();
        $data = [];
        foreach ($rows as $value => $key) {

            $delete_button = DB::table('history')->where('t_number', $key->tracking_number)->count() > 1 ? '<button class="btn btn-danger"  ><i class="fas fa-trash"></i></button>' : '';

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'created'           => $key->created,
                    'a'                 => $delete_button
            );
        }


     
       

        return response()->json($data);

    }

}
