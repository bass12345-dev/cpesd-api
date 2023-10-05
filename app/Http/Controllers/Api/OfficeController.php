<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OfficeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{
    
    //POST
    public function add_office(Request $request){

   	$items = array(

        'office'    	=> $request->input('office'),
        'office_status' => 'active', 
        'created'       => '2023-06-19 13:35:39',
    );

    $add = DB::table('offices')->insert($items);

    if ($add) {

             $data = array('message' => 'Add Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
       return response()->json($data);


    }


     public function delete_office(Request $request, $id)
    {
        
        $delete =  OfficeModel::where('office_id', $id)->delete();

                if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => 'true ');

                }else {
                    $data = array('message' => 'Error', 'response' => 'false');
                }

        echo json_encode($data);
    }

    public function offices(){

    	return response()->json(OfficeModel::all());

    }
}
