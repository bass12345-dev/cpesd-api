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
        $user = DB::table('users')->where('user_id', session('_id'))->get()[0];
        $data['user_data'] = array('user_id' => session('_id'), 'office_id' => $user->off_id );
        $data['documents'] = $this->get_all_documents();
        $data['reference_number']  = $this->get_last();
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


  public function get_last(){

        $l = '';
        $verify = DB::table('documents')->count();
        if($verify) {

            if(date('Y', time()) > date('Y', strtotime( DB::table('documents')->orderBy('created', 'desc')->get()[0]->created)))
                {      
                     $l = date('Ymd', time()).'001';

                }else if (date('Y', time()) < date('Y', strtotime( DB::table('documents')->orderBy('created', 'desc')->get()[0]->created))) {

                    $l = DB::table('documents')->whereRaw("YEAR(documents.created) = '".date('Y-m-d', time())."' ")->orderBy('created', 'desc')->get()[0]->tracking_number +  1;
                    // $l = $this->put_zeros($x);
                    
                }else if (date('Y', time()) === date('Y', strtotime( DB::table('documents')->orderBy('created', 'desc')->get()[0]->created))){

                    $x = DB::table('documents')->whereRaw("YEAR(documents.created) = '".date('Y', time())."' ")->orderBy('created', 'desc')->get()[0]->tracking_number +  1;
                    $l = $this->put_zeros($x);
                   
                }
        }else {
             $l = date('Ymd', time()).'001';
        }

    

        return $l;
        // response()->json((array('number'=> $l,'y'=> date('Y', time()), 'm' => date('m', time()), 'd' => date('d', time()) )));
    }

    function l($l){

        $x = $this->addOne();
        $l = $this->put_zeros($x);

        return $l;

    }

    function addOne(){

        return DB::table('documents')->whereRaw("YEAR(documents.created) = '".date('Y', time())."' ")->get()[0]->tracking_number +  1;

    }

     function get_created(){

        return date('Y', strtotime( DB::table('documents')->orderBy('created', 'desc')->get()[0]->created));

    }


    function put_zeros($x){

        $l = '';
           if ($x  < 10) {

                        $l = '00'.$x;
                      
                    }else if($x < 100 ) {

                        $l = '0'.$x;
                       

                    }else {


                         $l = $x;
                        
                    }

                    return $l;

    }




   
}
