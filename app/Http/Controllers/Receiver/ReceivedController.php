<?php

namespace App\Http\Controllers\Receiver;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;


class ReceivedController extends Controller
{
    public function index(){
        $data['title'] = 'Received Documents';
        $user = DB::table('users')->where('user_id', session('_id'))->get()[0];
        $data['user_data'] = array('user_id' => session('_id'), 'office_id' => $user->off_id );
        $data['received_documents'] = $this->get_received_documents();
        $data['users'] = $this->get_users();
        $data['final_actions'] = $this->get_final_actions();
        return view('receiver.contents.received.received')->with($data);
    }

    function get_receiver(){
        $items = DB::table('users')->where('user_status', 'active')->where('is_receiver','yes')->get()[0];
         return $items->user_id;
    }

    public function get_users(){

        $items = DB::table('users')->where('user_status', 'active')->get();
        return $items;

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

      return $data;

       


       

    }


    public function get_received_documents(){


        $data = [];

        $rows = DB::table('history as history')
            ->leftJoin('documents as documents', 'documents.tracking_number', '=', 'history.t_number')
            ->leftJoin('users as users', 'users.user_id', '=', 'history.user2')
            ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
            ->select('documents.tracking_number as tracking_number','documents.document_name as document_name',
                     'documents.document_id as document_id','users.user_type as user_type',
                     'document_types.type_name as type_name', 'history.received_date as received_date',
                     'history.history_id as history_id','history.remarks as remarks')
            ->where('user2', session('_id'))
            ->where('received_status', 1)
            ->where('release_status',NULL )
            ->where('status' , 'received')
            ->where('to_receiver','yes')
            // ->where('documents.destination_type', 'simple')
            ->orderBy('received_date', 'desc')->get();

       foreach ($rows as $value => $key) {

         
            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    't_'                => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'received_date'     => date('M d Y - h:i a', strtotime($key->received_date)) ,
                    'history_id'        => $key->history_id,
                    'document_id'       => $key->document_id,
                    'a'                 => $key->user_type == 'admin' ? false : true,
                    'remarks'           => $key->remarks,
            );
        }

        return $data;


    }
}
