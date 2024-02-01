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
    	return view('user.contents.add_document.add_document')->with($data);

	}




   
}
