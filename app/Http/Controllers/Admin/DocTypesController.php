<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TypeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DocTypesController extends Controller
{


    public $type;
    public $app_key;
    public function __construct()
    {
        $this->type   = new TypeModel;
        $this->app_key   = config('app.key');
    }
    
    public function index(){


        $data['title'] = 'Manage Document Types';
        $data['user_data'] = array('user_id' => '9', 'office_id' => '21' );
        $data['types'] = $this->get_document_types();
        return view('admin.contents.doc_types.doc_types')->with($data);
    }


     //GET
    public function get_document_types(){

        $items = DB::table('document_types')->get();

        $data = [];
        foreach ($items as $row) {

            $data[] = array(


                    'type_name' => $row->type_name,
                    'type_id'   => $row->type_id,
                    'created'   => date('M d Y - h:i a', strtotime($row->created))
            );
           
        }


      return $data;

    }



}
