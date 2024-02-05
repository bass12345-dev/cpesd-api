<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;


class IncomingController extends Controller
{
    
     public function index(){

	    $data['title'] = 'Incoming Documents';
		$data['incoming_documents']	= $this->get_incoming_documents();
        return view('user.contents.incoming.incoming')->with($data);

	}


	public function get_incoming_documents(){

        $data = [];

        $rows = DB::table('history as history')
            ->leftJoin('documents as documents', 'documents.tracking_number', '=', 'history.t_number')
            ->leftJoin('users as users', 'users.user_id', '=', 'history.user1')
            ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
            ->select('documents.tracking_number as tracking_number','documents.document_name as document_name',
                     'documents.document_id as document_id','users.user_type as user_type',
                     'document_types.type_name as type_name', 'history.release_date as release_date',
                     'history.history_id as history_id','history.remarks as remarks', 'users.first_name as first_name', 'users.middle_name as middle_name', 'users.last_name as last_name', 'users.extension as extension',
                     DB::Raw("CONCAT(users.first_name, ' ', users.middle_name , ' ', users.last_name,' ',users.extension) as name"))
            ->where('user2', session('_id'))
            ->where('received_status', NULL)
            ->where('status', 'torec')
            ->where('to_receiver', 'no')
            ->where('release_status',NULL )
            ->orderBy('received_date', 'desc')->get();
   
       foreach ($rows as $value => $key) {

          

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'released_date'     => date('M d Y - h:i a', strtotime($key->release_date)) ,
                    'from'              => $key->first_name.' '.$key->middle_name.' '.$key->last_name.' '.$key->extension,
                    'document_id'       => $key->document_id,
                    'history_id'        => $key->history_id,
                    'remarks'           => $key->remarks,
                    'a'                 => $key->user_type == 'admin' ? true : false
            );
        }

        return $data;
      }
}
