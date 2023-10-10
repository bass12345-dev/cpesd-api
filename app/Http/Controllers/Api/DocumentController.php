<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;

class DocumentController extends Controller
{
    public $user;
    public function __construct()
    {
        $this->document   = new DocumentModel;
    }


    public function countmydoc_dash(){

        // echo $_GET['id'];
        $data = array(

                'count_documents'    => DB::table('documents')->where('u_id', $_GET['id'])->count(),
                'incoming'          => DB::table('history')->where('user2', $_GET['id'])->where('received_status', NULL)->where('status', 'torec')->where('release_status',NULL )->count(),
                'received'          => DB::table('history')->where('user2', $_GET['id'])->where('received_status', 1)->where('release_status',NULL )->where('status' , 'received')->count(),
                'forwarded'         => DB::table('history')->where('user1', $_GET['id'])->where('received_status', NULL)->where('status', 'torec')->where('release_status',NULL )->count()
        );

        echo json_encode($data);
    }


        //POST
    public function add_document(Request $request){


    $items = array(

        'tracking_number'   		=> $this->generate_tracking_number(),
        'document_name'    			=> $request->input('document_name'),
        'u_id'    					=> $request->input('user_id'),
        'offi_id'    				=> $request->input('office_id'),
        'doc_type'    				=> $request->input('document_type'),
        'document_description'    	=> $request->input('description'),
        'created'       	        => date('Y-m-d H:i:s', time()),
    );

    $add = DB::table('documents')->insert($items);

    if ($add) {

            $where = array('document_id' => DB::getPdo()->lastInsertId());
            $row = DB::table('documents')->where($where)->get()[0];



            $items1 = array(
                                't_number'         =>  $row->tracking_number,
                                // 'typ_id'           =>  $row->doc_type,
                                'user1'            =>  $row->u_id,
                                'office1'          =>  $row->offi_id,
                                'user2'            =>  $row->u_id,
                                'office2'          =>  $row->offi_id,
                                'status'           =>  'received',
                                'received_status'  =>  '1',
                                'received_date'    => date('Y-m-d H:i:s', time()),
                                'release_date'     => NULL,  
                                'release_status'   => NULL,
                                'release_date'     => NULL, 
                );


            $add1 = DB::table('history')->insert($items1);

            if ($add1) {
                
              $data = array('message' => 'Add Successfully' , 'response' => true );

            }else {

              $data = array('message' => 'Something Wrong' , 'response' => false );
            }

            

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
       return response()->json($data);




    }


    public function get_document_data(){

        $row = DB::table('documents')->where('tracking_number', $_GET['t'])->leftJoin('document_types', 'document_types.type_id', '=', 'documents.doc_type')->leftJoin('users', 'users.user_id', '=', 'documents.u_id')->leftJoin('offices', 'offices.office_id', '=', 'documents.offi_id')->get()[0];

        $data = array(

                    'document_name'     => $row->document_name,
                    'tracking_number'   => $row->tracking_number,
                    'encoded_by'        => $row->first_name .' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                    'office'            => $row->office,
                    'document_type'     => $row->type_name,
                    'description'       => $row->document_description,
                    'is'                =>  DB::table('history')->where('t_number', $row->tracking_number)->where('status','completed')->count() == 1 ? false : true
        );

        return json_encode($data);
    }


    function generate_tracking_number(){

        $t_number = mt_rand();
        $check = DB::table('documents')->where('tracking_number', $t_number);

        $t_number = $check->count() < 1 ? $t_number : $t_number = mt_rand();

        return $t_number;

    }

    public function get_my_documents(){

        $rows = DB::table('documents')->where('u_id', $_GET['id'])->leftJoin('document_types', 'document_types.type_id', '=', 'documents.doc_type')->orderBy('documents.document_id', 'desc')->get();
        $data = [];
        foreach ($rows as $value => $key) {

            $delete_button = DB::table('history')->where('t_number', $key->tracking_number)->count() > 1 ? true : false;

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'created'           => $key->created,
                    'a'                 => $delete_button,
                    'document_id'       => $key->document_id
            );
        }


     
       

        return response()->json($data);

    }

    public function get_received_documents(){


        $data = [];
       $rows = DB::table('history')->where('user2', $_GET['id'])->where('received_status', 1)->where('release_status',NULL )->where('status' , 'received')->leftJoin('documents', 'documents.tracking_number', '=', 'history.t_number')->leftJoin('users', 'users.user_id', '=', 'history.user2')->get();


       foreach ($rows as $value => $key) {

            $type = DB::table('document_types')->where('type_id', $key->doc_type)->get();

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $type[0]->type_name,
                    'received_date'     => $key->received_date,
                    'history_id'        => $key->history_id,
                    'document_id'       => $key->document_id,
                    'a'                 => $key->user_type == 'admin' ? false : true,
                    'remarks'           => $key->remarks,
            );
        }

        return response()->json($data); 


    }


     //Delete
    public function delete_my_document(Request $request, $id)
    {
       
        $delete =  DocumentModel::where('document_id', $id);
        $tracking_number =  $delete->get()[0]->tracking_number;

                if($delete->delete()) {

                    DB::table('history')->where('t_number', $tracking_number)->delete();

                    $data = array('message' => 'Deleted Succesfully' , 'response' => 'true ');

                }else {
                    $data = array('message' => 'Error', 'response' => 'false');
                }

        echo json_encode($data);
    }

    public function forward_document(Request $request){

 
        //update history release_status to 1
        $id                 = $request->input('history_id');
        $tracking_number    = $request->input('tracking_number');
        $remarks            = $request->input('remarks');
        $forward_to         = $request->input('forward');
        $user_id            = $request->input('id');

        

        $user_row           = DB::table('users')->where('user_id', $user_id)->get();
        $forward_user_row   = DB::table('users')->where('user_id', $forward_to)->get();

        $count = DB::table('history')->where('t_number', $tracking_number)->count();

        // if($count == 1) {

        $update_release     = DB::table('history')
                    ->where('history_id', $id)
                    ->where('received_status', 1)
                    ->update(array('release_status'=> 1));



        // }else {

        
        // $update_release     = DB::table('history')
        //             ->where('history_id', $id)
        //             ->where('received_status', 1)
        //             ->update(array('release_status'=> 1, 'release_date' => date('Y-m-d H:i:s', time())));

        // }

        if($update_release) {


                    $info = array(
                                    't_number'          => $tracking_number,
                                    'user1'             => $user_id,
                                    'office1'           => $user_row[0]->off_id,
                                    'user2'             => $forward_to,
                                    'office2'           => $forward_user_row[0]->off_id,
                                    'status'            => 'torec',
                                    'received_status'   => NULL,
                                    'received_date'     => NULL,
                                    'release_status'    => NULL,
                                    'release_date'      => date('Y-m-d H:i:s', time()),
                                    'remarks'           => $remarks

                    );

                    $add1 = DB::table('history')->insert($info);

                    if ($add1) {
                
                        $data = array('message' => 'Forward Successfully' , 'response' => true );

                    }else {

                      $data = array('message' => 'Something Wrong' , 'response' => false );
                    }

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );

        }
        
        
       return response()->json($data); 
    }



     public function get_forward_documents(){


        $data = [];
       $rows = DB::table('history')->where('user1', $_GET['id'])->where('received_status', NULL)->where('status', 'torec')->where('release_status',NULL )->leftJoin('documents', 'documents.tracking_number', '=', 'history.t_number')->leftJoin('users', 'users.user_id', '=', 'history.user2')->get();


       foreach ($rows as $value => $key) {

            $type               = DB::table('document_types')->where('type_id', $key->doc_type)->get();
        

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $type[0]->type_name,
                    'released_date'     => $key->release_date,
                    'forwarded_to'      => $key->first_name .' '.$key->middle_name.' '.$key->last_name.' '.$key->extension,
                    'document_id'       => $key->document_id,
                    'remarks'           => $key->remarks,
            );
        }

        return response()->json($data); 

       


     }



      public function get_incoming_documents(){

        $data = [];
       $rows = DB::table('history')->where('user2', $_GET['id'])->where('received_status', NULL)->where('status', 'torec')->where('release_status',NULL )->leftJoin('documents', 'documents.tracking_number', '=', 'history.t_number')->leftJoin('users', 'users.user_id', '=', 'history.user1')->get();


       foreach ($rows as $value => $key) {

            $type               = DB::table('document_types')->where('type_id', $key->doc_type)->get();
        

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $type[0]->type_name,
                    'released_date'     => $key->release_date,
                    'from'              => $key->first_name .' '.$key->middle_name.' '.$key->last_name.' '.$key->extension,
                    'document_id'       => $key->document_id,
                    'history_id'        => $key->history_id,
                    'remarks'           => $key->remarks,
                    'a'                 => $key->user_type == 'admin' ? true : false
            );
        }

        return response()->json($data); 

      }


      public function receive_document(Request $request){

        // print_r($request->all());

        $id    = $request->input('id');

        $update_receive     = DB::table('history')
                    ->where('history.history_id', $id)
                    ->update(array('status' => 'received','received_status'=> 1, 'received_date' => date('Y-m-d H:i:s', time())));

         if($update_receive) {


            $data = array('message' => 'Received Succesfully' , 'response' => true );
                

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );

        }
        
        
       return response()->json($data); 

      }


      public function complete_document(Request $request){

        $id    = $request->input('id');

        $update_receive     = DB::table('history')
                    ->where('history.history_id', $id)
                    ->update(array('status' => 'completed'));

         if($update_receive) {


            $data = array('message' => 'Completed Succesfully' , 'response' => true );
                

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );

        }
        
        
       return response()->json($data); 

      }

      public function get_history(){

        $where = array('t_number' => $_GET['t']);
        $history = DB::table('history')->where($where)->get();

        $data = [];


        foreach ($history as $value => $row) {

            $where1 = array('user_id' => $row->user1 );
            $user1  = DB::table('users')->where($where1)->leftJoin('offices', 'offices.office_id', '=', 'users.off_id')->get();

            $where2 = array('user_id' => $row->user2);
            $user2  = DB::table('users')->where($where2)->leftJoin('offices', 'offices.office_id', '=', 'users.off_id')->get();

                $date1 = new DateTime($row->received_date);
                $date2 = $row->release_date  == NULL ? new DateTime($row->received_date) :   new DateTime($row->release_date);
                $interval = $date1->diff($date2);


                
                $min_ext = $interval->i > 1 ? 'minutes' : 'minute';
                $hour_ext = $interval->h > 1 ? 'hours' : 'hour';
                $days_ext = $interval->d > 1 ? 'days' : 'day';
                $month_ext = $interval->m > 1 ? 'months' : 'month';


                $display_month = $interval->m == 0 ? ' ' : $interval->m.' '.$month_ext.', ';
                $display_day = $interval->d == 0 ? ' ' : $interval->d.' '.$days_ext.', ';
                $display_hour = $interval->h == 0 ? ' ' : $interval->h.' '.$hour_ext.', ';
                $display_min = $interval->i == 0 ? ' ' : $interval->i.' '.$min_ext;

                $data[] = array(

                            'user1'             => $row->release_date != NULL ? $user1[0]->first_name.' '.$user1[0]->middle_name.' '.$user1[0]->last_name : ' - ',
                            'office1'           => $user1[0]->office,
                            'user2'             => $row->user2 != 0 ?  $user2[0]->first_name.' '.$user2[0]->middle_name.' '.$user2[0]->last_name : ' - ',
                            'office2'            => $row->user2 != 0 ?  $user2[0]->office : ' - ',
                            'tracking_number'   => $row->t_number,
                            'date_released'     => $row->release_date != NULL ? date('M d Y', strtotime($row->release_date)).' - '.date('h:i a', strtotime($row->release_date)) : ' - ',
                            'date_received'     => $row->received_date != NULL ? date('M d Y', strtotime($row->received_date)).' - '.date('h:i a', strtotime($row->received_date)) : ' - ',
                            // 'duration' => $row['received_date'] != '0000-00-00 00:00:00' ?   $this->duration($interval) : ' - ',

 
                            'duration'          => $row->received_date != NULL ?   $display_month.' '.$display_day.' '.$display_hour.' '.$display_min: ' - ',
                );

        }

         echo json_encode($data);


      }


      public function track_document(){
        $where1 = array('t_number' => trim($_GET['tracking_number']));
        $where2 = array('received_status' => 1);
        $received = DB::table('history')->where($where1)->where($where2);
        $history = '';
        $data = [];
         $user = false;
        if ($received->count() > 0) {
           $history = DB::table('history')
           ->where($where1)
           ->where($where2)
           ->leftJoin('documents', 'documents.tracking_number', '=', 'history.t_number')
           ->leftJoin('offices', 'offices.office_id', '=', 'history.office2')
           ->leftJoin('users', 'users.user_id', '=', 'history.user2')->orderBy('history_id', 'desc')->get();

            $where3 = array('tracking_number' => trim($_GET['tracking_number']));
            $document = DB::table('documents')->where('tracking_number', $_GET['tracking_number'])->get()[0];
            $last_rec  =  DB::table('history')->where($where1)->orderBy('history_id', 'desc')->limit('1')->get()[0];
            foreach ($history as $row) {

                 $str = 'abcdef';
                $shuffled = str_shuffle($str);

                 if ($_GET['id'] === $document->u_id) {

                    $user = true;
                    # code...
                }



                      $data[] = array(
                        'history_id' => $row->history_id,
                        'i' => $shuffled,
                        'department_name' => $row->office,
                        'received_by' =>  $row->first_name .' '.$row->middle_name.' '.$row->last_name.' '.$row->extension,
                        'tracking_code' => $row->tracking_number,
                        'status' => $row->status,
                        'date' =>  date('M d Y', strtotime($row->received_date)).' - '.date('h:i a', strtotime($row->received_date)),
                        // 'color' => ($row['status'] === 'hold') ? 'bg-yellow' : 'bg-green',
                        'remarks' => $row->remarks,
                        'user' => $user,
                        'last_rec' => $last_rec->history_id == $row->history_id ? false : true,
                        'document_name' => $row->document_name


                );



            }


            return response()->json($data);

        }else {

            echo json_encode(['response' => false,'message'=> 'Nothing']);
        }


        
      }
}
