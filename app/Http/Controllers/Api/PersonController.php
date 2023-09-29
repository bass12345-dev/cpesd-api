<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PersonModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $person;

    public function __construct()
    {
        $this->person   = new PersonModel;
        
    }

    public function index()
    {
        // $items = PersonModel::all();
        // return json_encode($items);
         // $items = DB::table('persons')->where('status', 'active')->get();
         // return response()->json($items);
        $items = [];

        if ($_GET['type'] == 'active') {
            $items = DB::table('persons')->where('status', 'active')->get();
        }else if($_GET['type'] == 'inactive'){
            $items = DB::table('persons')->where('status', 'inactive')->get();
        }

        return response()->json($items);
    }


    public function get_records(){

         $items = [];
        $items = DB::table('records')->where('p_id', $_GET['id'])->get();
        return response()->json($items);

    }

    public function count_all(){
        $data = [];

        $active = DB::table('persons')->where('status', 'active')->count();
        $inactive = DB::table('persons')->where('status', 'inactive')->count();
        $data[] = array('active' => $active , 'inactive' => $active);

         return response()->json($data);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
      

     $items = array(

        'first_name'                 => $request->input('firstName'),
        'middle_name'                => $request->input('middleName'),
        'last_name'                  => $request->input('lastName'),
        'extension'                  => $request->input('extension'),
        'phone_number'               => $request->input('phoneNumber'),
        'address'                    => $request->input('address'),
        'email_address'              => $request->input('email_address'),
        'created_at'                 => '2023-06-19 13:35:39',
        'status'                     => 'active'
    );

     $add = DB::table('persons')->insert($items);

      if ($add) {

             $data = array('message' => 'Add Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
       return response()->json($data);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PersoModel  $persoModel
     * @return \Illuminate\Http\Response
     */
    public function show(PersoModel $persoModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PersoModel  $persoModel
     * @return \Illuminate\Http\Response
     */
    public function edit(PersoModel $persoModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PersoModel  $persoModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        echo $id;
    }


     public function remove(Request $request, $id)
    {

        $update = DB::table('persons')
                    ->where('person_id', $id)
                    ->update(array('status'=> 'inactive'));

        if ($update) {

             $data = array('message' => 'Updated Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong/Data is not updated' , 'response' => false );


        }
       
       return response()->json($data);
    }


         public function set_active(Request $request, $id)
    {

        $update = DB::table('persons')
                    ->where('person_id', $id)
                    ->update(array('status'=> 'active'));

        if ($update) {

             $data = array('message' => 'Updated Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong/Data is not updated' , 'response' => false );


        }
       
       return response()->json($data);
    }


    public function delete(Request $request, $id)
    {
        
        $delete =  PersonModel::where('person_id', $id)->delete();
                if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => 'true ');

                }else {
                    $data = array('message' => 'Error', 'response' => 'false');
                }

        echo json_encode($data);
    }

    public function person_info(){

        $person_data = DB::table('persons')->where('person_id', $_GET['id'])->first();

        return response()->json($person_data);

    
    }


    public function add_record(Request $request, $id){


    $items = array(

        'record_description'  => $request->input('record_description'),
        'p_id'                => $id,
        'created_at'          => '2023-06-19 13:35:39',
        
    );

     $add = DB::table('records')->insert($items);

      if ($add) {

             $data = array('message' => 'Add Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
       return response()->json($data);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PersoModel  $persoModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersoModel $persoModel)
    {
        //
    }
}
