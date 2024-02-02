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

		$data['title'] = 'Add Document';
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
                    ->orderBy('documents.document_id', 'desc')->limit(10)->get();

        return $rows;

      }




   
}
