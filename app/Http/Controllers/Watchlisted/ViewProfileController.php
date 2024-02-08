<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use App\Models\PersonModel;
use App\Models\RecordModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class ViewProfileController extends Controller
{
    public function index(){
        $data['title'] = 'View Profile';
        $data['person_data'] = $this->person_info();
        $data['programs'] = $this->get_programs();
        $data['person_programs'] = $this->get_person_programs($data['programs']);   
        $data['records'] = $this->get_records();
        return view('watchlisted.contents.view_profile.view_profile')->with($data);
    }

    private function person_info(){


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

        return $data;

    
   

    }


    function get_person_programs($data){

        $item = [];

        foreach ($data as $row) {
            
            if ($row['x'] == true) {
                
                array_push($item,$row['program']);
            }
        }

        return $item;

    }

     public function get_programs(){



        $items = DB::table('programs')->orderBy('program', 'asc')->get();
        $person_id = $_GET['id'];

        $data = [];
        foreach ($items as $row) {

            $program_id = $row->program_id;
            $x = DB::table('program_block')->where('person_id',$person_id)->where('program_id',$program_id)->count();



            $data[] = array(

                    'program' => $row->program,
                    'program_id'   => $row->program_id,
                    'x' => $x == 1 ? true : null
            );
        }


        return $data;


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
      return $data;
    }

}
