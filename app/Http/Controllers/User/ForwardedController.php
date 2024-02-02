<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;

class ForwardedController extends Controller
{
    
    public function index(){

	    $data['title'] = 'Forwarded Documents';
	    $data['forwarded_documents'] = $this->get_forward_documents();
        return view('user.contents.forwarded.forwarded')->with($data);

	}



	public function get_forward_documents(){


       $data = [];

        $rows = DB::table('history as history')
            ->leftJoin('documents as documents', 'documents.tracking_number', '=', 'history.t_number')
            ->leftJoin('users as users', 'users.user_id', '=', 'history.user2')
            ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
            ->select('documents.tracking_number as tracking_number','documents.document_name as document_name',
                     'documents.document_id as document_id','users.user_type as user_type',
                     'document_types.type_name as type_name', 'history.release_date as release_date',
                     'history.history_id as history_id','history.remarks as remarks','users.first_name as first_name', 'users.middle_name as middle_name', 'users.last_name as last_name', 'users.extension as extension',
                     DB::Raw("CONCAT(users.first_name, ' ', users.middle_name , ' ', users.last_name,' ',users.extension) as name"))
            ->where('user1', 9)
            ->where('received_status', NULL)
            ->where('status', 'torec')
            ->where('release_status',NULL )
            ->orderBy('received_date', 'desc')->get();

       foreach ($rows as $value => $key) {

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'released_date'     => date('M d Y - h:i a', strtotime($key->release_date)) ,
                    'forwarded_to'              => $key->first_name.' '.$key->middle_name.' '.$key->last_name.' '.$key->extension,
                    'document_id'       => $key->document_id,
                    'remarks'           => $key->remarks,
            );
        }

       return $data; 

     }
}
