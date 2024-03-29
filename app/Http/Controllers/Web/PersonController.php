<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\PersonModel;
use App\Models\RecordModel;
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
    public $record;
    public $app_key;
    public function __construct()
    {
        $this->person   = new PersonModel;
        $this->record   = new RecordModel;
        $this->app_key   = config('app.key');
    }

    public function index()
    {


        // $authorization = $request->header('Authorization');

        // if ($authorization == $this->app_key) {


        $items = [];

        if ($_GET['type'] == 'active') {
            $items = DB::table('persons')->where('status', 'active')->get();
        }else if($_GET['type'] == 'inactive'){
            $items = DB::table('persons')->where('status', 'inactive')->get();
        }

        return response()->json(base64_encode($items));
    }

    public function data_per_barangay(){


        $active     = array();
        $barangay   = config('app.barangay');

        foreach ($barangay as $row) {

            $count = DB::table('persons')->where('status', 'active')->where('address', $row)->count();
            array_push($active, $count);

        }


        $data['label'] = $barangay;
        $data['active'] = $active;

        return response()->json($data);
    }

    public function data_per_year(){

        $year =  $_GET['year'];

        $months = array();
        $active = array();

        for ($m = 1; $m <= 12; $m++) {

             $count = DB::table('persons')
             ->whereMonth('created_at', $m)
             ->whereYear('created_at', $year)
             ->where('status', 'active')
             ->count();
            array_push($active, $count);


             $month =  date('M', mktime(0, 0, 0, $m, 1));
            array_push($months, $month);

        }


         $data['label'] = $months;
         $data['active'] = $active;

         return response()->json($data);
    }


    public function get_records(){

        $data = [];
        $items = DB::table('records')->where('p_id', $_GET['id'])->get();
        foreach ($items as $row) {
            
            $data[] = array(

                    'created_at'            => date('M d Y - h:i a', strtotime($row->created_at)),
                    'record_description'    => $row->record_description,
                    'p_id'                  => $row->p_id,
                    'record_id'             => $row->record_id

            );
        }
        return response()->json($data);

    }

    public function count_all(){
        $data = [];
        $active = DB::table('persons')->where('status', 'active')->count();
        $inactive = DB::table('persons')->where('status', 'inactive')->count();
        $data[] = array('active' => $active , 'inactive' => $inactive);

         return response()->json($data);

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
      
    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {

    $now = new \DateTime();
    $now->setTimezone(new \DateTimezone('Asia/Manila'));
        
     $items = array(

        'first_name'                 => $request->input('firstName'),
        'middle_name'                => $request->input('middleName'),
        'last_name'                  => $request->input('lastName'),
        'extension'                  => $request->input('extension'),
        'phone_number'               => $request->input('phoneNumber'),
        'address'                    => $request->input('address'),
        'email_address'              => $request->input('emailAddress'),
        'created_at'                 => $now->format('Y-m-d H:i:s'),
        'status'                     => 'active',
        'age'                        => $request->input('age')
    );

     $add = DB::table('persons')->insert($items);

      if ($add) {

             $data = array('id' => DB::getPdo()->lastInsertId() ,'message' => 'Added Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }

    }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
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


     public function remove(Request $request)
    {

    

    $id         = $request->input('id');
    $status     = $request->input('status');


            if (is_array($id)) {
                foreach ($id as $row) {

                $update = DB::table('persons')
                        ->where('persons.person_id', $row)
                        ->update(array('status'=> $status));
                }

                $data = array('message' => 'Removed Successfully' , 'response' => true );
            }else {

                $update = DB::table('persons')
                        ->where('persons.person_id', $id)
                        ->update(array('status'=> $status));
            if ($update) {

                 $data = array('message' => 'Removed Successfully' , 'response' => true );

            }else {

                $data = array('message' => 'Something Wrong/Data is not updated' , 'response' => false );
            }
        }

  
 
       return response()->json($data);
    }


         public function set_active(Request $request)
    {

        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {

        $id = $request->input('id');
        $status     = $request->input('status');

        if (is_array($id)) {

             foreach ($id as $row) {

                $update = DB::table('persons')
                            ->where('person_id', $row)
                            ->update(array('status'=> $status));

                }

                if ($update) {

                     $data = array('message' => 'Set Successfully' , 'response' => true );

                }else {

                    $data = array('message' => 'Something Wrong/Data is not updated' , 'response' => false );


            }
        }else {

            $data = array('message' => 'Error' , 'response' => false );
        }
       
        }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );

        }
       
       return response()->json($data);
    }


    public function delete(Request $request)
    {



            $id = $request->input('id');

            if (is_array($id)) {

                foreach ($id as $row) {

                $delete =  PersonModel::where('person_id', $row)->delete();
                if($delete) {
                    RecordModel::where('p_id', $row)->delete();
                    }

                }

                $data = array('message' => 'Deleted Succesfully' , 'response' => true);

            }else{
                 $data = array('message' => 'Error' , 'response' => false );
            }

        
        

        
       
       return response()->json($data);
    }


    public function delete_record(Request $request, $id)
    {

    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {
        
        $delete =  RecordModel::where('record_id', $id)->delete();
                if($delete) {

                    $data = array('message' => 'Deleted Succesfully' , 'response' => 'true ');

                }else {
                    $data = array('message' => 'Error', 'response' => 'false');
                }

         }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
        }
       
       return response()->json($data);
    }

    public function person_info(){

        $person_data = DB::table('persons')->where('person_id', $_GET['id'])->first();

        $data = array(

                        'address'           => $person_data->address,
                        'created_at'        => date('M d Y - h:i a', strtotime($person_data->created_at)) ,
                        'email_address'     => $person_data->email_address,
                        'first_name'        => $person_data->first_name,
                        'middle_name'       => $person_data->middle_name,
                        'last_name'         => $person_data->last_name,
                        'extension'         => $person_data->extension,
                        'person_id'         => $person_data->person_id,
                        'phone_number'      => $person_data->phone_number,
                        'status'            => $person_data->status,
                        'age'               => $person_data->age
        );

        return json_encode($data);

    
    }


    public function add_record(Request $request, $id){



    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {

    $now = new \DateTime();
    $now->setTimezone(new \DateTimezone('Asia/Manila'));


    $items = array(

        'record_description'  => $request->input('record_description'),
        'p_id'                => $id,
        'created_at'          => $now->format('Y-m-d H:i:s')
        
    );

     $add = DB::table('records')->insert($items);

      if ($add) {

             $data = array('message' => 'Added Successfully' , 'response' => true );

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
    }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
    }
       
       return response()->json($data);

    }


    public function update_record(Request $request, $id){


    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {

    $items = array(

        'record_description'  => $request->input('record_description'),
      
        
    );

    $update = DB::table('records')
                    ->where('record_id', $id)
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


    public function update_person_info(Request $request, $id){

     $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {

     $items = array(

        'first_name'                 => $request->input('firstName'),
        'middle_name'                => $request->input('middleName'),
        'last_name'                  => $request->input('lastName'),
        'extension'                  => $request->input('extension'),
        'phone_number'               => $request->input('phoneNumber'),
        'address'                    => $request->input('address'),
        'email_address'              => $request->input('emailAddress'),
        'age'                        => $request->input('age'),
    );

     $update = DB::table('persons')
                    ->where('person_id', $id)
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

    public function check_person(){
      
        $check = DB::table('persons')->where('person_id', $_GET['id'])->count();
         return response()->json($check);

    }


        public function search_query(Request $request)
    {
      

    

    $search = $request->input('first_name').' '.$request->input('last_name');

     $users = PersonModel::select("person_id", "first_name", "last_name", "middle_name", "address", "email_address", "phone_number", "age","extension")
                       ->where(DB::raw("concat(first_name, ' ', last_name)"), 'LIKE', "%".$search."%")
                       ->get();
    return response()->json($users);



    }
}
