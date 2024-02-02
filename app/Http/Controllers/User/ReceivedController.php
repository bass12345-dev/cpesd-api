<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;


class ReceivedController extends Controller
{

	 public function __construct()
    {
        $this->document   = new DocumentModel;
       
    }

    public function index(){

	    $data['title'] = 'Received Documents';
        $data['user_data'] = array('user_id' => '9', 'office_id' => '21' );
	    $data['received_documents'] = $this->get_received_documents();
        $data['users'] = $this->get_users();
        return view('user.contents.received.received')->with($data);

	}


    public function get_users(){

        $items = DB::table('users')->where('user_status', 'active')->get();
        return $items;

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
            ->where('user2', 9)
            ->where('received_status', 1)
            ->where('release_status',NULL )
            ->where('status' , 'received')
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
