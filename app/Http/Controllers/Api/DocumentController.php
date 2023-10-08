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

            $items1 = array(
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


            $add1 = DB::table('history')->insert($items1);

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

            $delete_button = DB::table('history')->where('t_number', $key->tracking_number)->count() > 1 ? true : false;

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'created'           => $key->created,
                    'a'                 => $delete_button,
                    'document_id'       => $key->document_id
            );
        }


     
       

        return response()->json($data);

    }

    public function get_received_documents(){


        $data = [];
       $rows = DB::table('history')->where('user1', $_GET['id'])->where('received_status', 1)->where('release_status',0)->where('status' , 'received')->leftJoin('documents', 'documents.tracking_number', '=', 'history.t_number')->get();


       foreach ($rows as $value => $key) {

            $type = DB::table('document_types')->where('type_id', $key->doc_type)->get();

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $type[0]->type_name,
                    'created'           => $key->created,
                  
                    'document_id'       => $key->document_id
            );
        }

        return response()->json($data); 


    }


     //Delete
    public function delete_my_document(Request $request, $id)
    {
       
        $delete =  DocumentModel::where('document_id', $id);
        $tracking_number =  $delete->get()[0]->tracking_number;

                if($delete->delete()) {

                    DB::table('history')->where('t_number', $tracking_number)->delete();

                    $data = array('message' => 'Deleted Succesfully' , 'response' => 'true ');

                }else {
                    $data = array('message' => 'Error', 'response' => 'false');
                }

        echo json_encode($data);
    }

    public function forward_document(Request $request){

        print_r($request->all());

        //update history release_status to 1
        // $where1 = array('t_number' =>  $this->input->post('tracking_number'));
        // $where2 = array('received_status' => 1  );
        // $info = array('release_status' => 1);
        // $update_release = $this->UpdateModel->update2($where1,$where2,$info,$this->history_table);
    }

}
