<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AddDocumentController extends Controller
{

	public $type;
    public $app_key;
    public function __construct()
    {
        $this->type   = new TypeModel;
        $this->app_key   = config('app.key');
    }

	
	public function index(){

		$data['title'] = 'User Dashboard';
		$data['document_types'] = DB::table('document_types')->get();
        $data['user_data'] = array('user_id' => '9', 'office_id' => '21' );
        $data['documents'] = $this->get_all_documents();
    	return view('user.contents.add_document.add_document')->with($data);

	}


    function get_all_documents(){

          $rows = DB::table('documents as documents')
                    ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
                    ->leftJoin('users as users', 'users.user_id', '=', 'documents.u_id')
                    ->select('documents.created as created','documents.tracking_number as tracking_number', 
                             'documents.document_name as   document_name', 'documents.document_id as document_id', 
                             'document_types.type_name', 'users.first_name as first_name', 'users.middle_name as middle_name', 'users.last_name as last_name', 'users.extension as extension', DB::Raw("CONCAT(users.first_name, ' ', users.middle_name , ' ', users.last_name,' ',users.extension) as name"))
                    ->orderBy('documents.document_id', 'desc')->get();

        return $rows;

        //   // $rows = DB::table('documents')->leftJoin('document_types', 'document_types.type_id', '=', 'documents.doc_type')->leftJoin('users','users.user_id','=','documents.u_id',)->orderBy('documents.document_id', 'desc')->get();
        // $data = [];
        // $i = 1;
        // foreach ($rows as $value => $key) {

        //     $delete_button = DB::table('history')->where('t_number', $key->tracking_number)->count() > 1 ? true : false;
        //     $status         = (DB::table('history')->where('t_number', $key->tracking_number)->where('status', 'completed')->count() == 1) ? 'Completed' : 'Pending';
 


        //     $data[] = array(
        //             'number'            => $i++,
        //             'tracking_number'   => $key->tracking_number,
        //             'document_name'     => $key->document_name,
        //             'type_name'         => $key->type_name,
        //             'created'           => $key->created,
        //             'a'                 => $delete_button,
        //             'document_id'       => $key->document_id,
        //             'created_by'        => $key->first_name.' '.$key->middle_name.' '.$key->last_name.' '.$key->extension,
        //             'is'                => $status
        //     );
        // }


     
       

        // return response()->json($data);
      }




   
}
