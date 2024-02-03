<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MyDocumentsController extends Controller
{

    public $type;
    public $app_key;
    public function __construct()
    {
        $this->type   = new TypeModel;
        $this->app_key   = config('app.key');
    }


    public function index(){


        $data['title'] = 'My Document';
        $data['document_types'] = DB::table('document_types')->get();
        $data['user_data'] = array('user_id' => '9', 'office_id' => '21' );
        $data['documents'] = $this->get_all_documents();


        return view('user.contents.my_documents.my_documents')->with($data);
    }




    public function get_all_documents(){

         $rows = DB::table('documents as documents')->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')->select('documents.created as d_created','documents.tracking_number as tracking_number', 'documents.document_name as document_name', 'documents.document_id as document_id', 'document_types.type_name')->where('u_id', 9)->orderBy('documents.document_id', 'desc')->get();

       
        $data = [];
        $i = 1;
        foreach ($rows as $value => $key) {

            $delete_button  = DB::table('history')->where('t_number', $key->tracking_number)->count() > 1 ? true : false;
            $status         = (DB::table('history')->where('t_number', $key->tracking_number)->where('status', 'completed')->count() == 1) ? 'Completed' : 'Pending';
            $data[] = array(
                     'number'            => $i++,
                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'created'           => date('M d Y - h:i a', strtotime($key->d_created)),
                    'a'                 => $delete_button,
                    'document_id'       => $key->document_id,
                    'is'                => $status
            );
        }


     
       

       return $data;

      }

      
}
