<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OfficeModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class OfficeController extends Controller
{

    public $app_key;

    public function __construct()
    {
        $this->app_key   = config('app.key');
    }
    
    //POST
    public function add_office(Request $request){

        $authorization = $request->header('Authorization');

        $now = new \DateTime();
        $now->setTimezone(new \DateTimezone('Asia/Manila'));

        if ($authorization == $this->app_key) {


            $items = array(

                'office'        => $request->input('office'),
                'office_status' => 'active', 
                'created'       =>  $now->format('Y-m-d H:i:s')

            );

            if(!empty($items['office'])) {

                $add = DB::table('offices')->insert($items);

                if ($add) {

                         $data = array('message' => 'Add Successfully' , 'response' => true );

                    }else {

                        $data = array('message' => 'Something Wrong' , 'response' => false );


                    }

                }else {

                    $data = array('message' => 'Empty Field' , 'response' => false );
                }
       
            return response()->json($data);
           
        }else {

             $data = array('message' => 'Request Unauthorized' , 'response' => false );
        }

          return response()->json($data);

    }


     public function delete_office(Request $request, $id)
    {

        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {


        $check = DB::table('documents')->where('offi_id', $id)->count();

        if ($check > 0) {
             $data = array('message' => 'This type of document is used in other operation' , 'response' => false);

        }else {


            $delete =  OfficeModel::where('office_id', $id)->delete();

                if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => true );

                }else {
                    $data = array('message' => 'Error', 'response' => false);
                }
        }

    }else {

         $data = array('message' => 'Request Unauthorized' , 'response' => false );

    }

        echo json_encode($data);
    }

    public function offices(){

        $items = DB::table('offices')->get();

        $data = [];
        foreach ($items as $row) {

            $data[] = array(


                    'office'        => $row->office,
                    'office_id'     => $row->office_id,
                    'created'       => date('M d Y - h:i a', strtotime($row->created))
            );
            // code...
        }


        return response()->json($data);

    	// return response()->json(OfficeModel::all());

    }


    public function update_office(Request $request, $id){

    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {


    $items = array(

        'office'  => $request->input('office'),
      
        
    );

    $update = DB::table('offices')
                    ->where('office_id', $id)
                    ->update($items);

      if ($update) {

             $data = array('message' => 'Updated Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong/No Changes Apply' , 'response' => false );


        }

        }else {

         $data = array('message' => 'Request Unauthorized' , 'response' => false );

    }
       
       return response()->json($data);

    }
}
