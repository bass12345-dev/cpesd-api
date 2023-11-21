<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DocumentModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Support\Facades\Storage;
 use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DocumentController extends Controller
{
    public $user;
    public $app_key;
    public function __construct()
    {
        $this->document   = new DocumentModel;
        $this->app_key   = config('app.key');
    }


    public function qr(){

        $from = [255, 0, 0];
        $to = [0, 0, 255];


        // return QrCode::size(200)
        // ->format('png')
        // ->merge('/storage/app/peso_logo.png')
        // ->errorCorrection('M')
        // ->style('dot')
        // ->eye('circle')
        // ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
        // ->margin(1)
        // ->generate(
        //     'Hello, World!',
        // );


    $path = '/img/qr-code/';

    // if(!\File::exists(public_path($path))) {
    //     \File::makeDirectory(public_path($path));
    // }


    // $image =    \QrCode::format('png')


    //              // ->merge('/peso_logo.png', 0.1, true)
    //              ->size(200)->errorCorrection('H')
    //              ->generate('A simple example of QR code!');

    $image = QrCode::size(200)
        ->format('png')
        ->merge('/storage/app/peso_logo.png')
        ->errorCorrection('M')
        ->style('dot')
        ->eye('circle')
        ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
        ->margin(1)
        ->generate(
            'Hello, World!',
        );


    $output_file = $path . time() . '.png';
    Storage::disk('local')->put($output_file, $image); 

    // storage/app/public/img/qr-code/img-1557309130.png

    }


    public function countmydoc_dash(){

        $id = base64_decode($_GET['id']);
        $data = array(

                'count_documents'    => DB::table('documents')->where('u_id',$id)->count(),
                'incoming'          => DB::table('history')->where('user2', $id)->where('received_status', NULL)->where('status', 'torec')->where('release_status',NULL )->count(),
                'received'          => DB::table('history')->where('user2', $id)->where('received_status', 1)->where('release_status',NULL )->where('status' , 'received')->count(),
                'forwarded'         => DB::table('history')->where('user1', $id)->where('received_status', NULL)->where('status', 'torec')->where('release_status',NULL )->count()
        );

        echo json_encode($data);
    }

    public function get_transaction_today(){

        $now = new \DateTime();
        $now->setTimezone(new \DateTimezone('Asia/Manila'));
        $id =  base64_decode($_GET['id']);
        $day = $now->format('d');
        $month = $now->format('m');
        $year = $now->format('Y');
         $index = 1;



        $rows = DB::table('documents as documents')
                ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
                ->select('documents.created as d_created','documents.tracking_number as tracking_number', 'documents.document_name as document_name', 'documents.document_id as document_id', 'document_types.type_name')
                ->where('u_id', $id)
                ->whereYear('documents.created', $year)
                ->whereMonth('documents.created', $month)
                ->whereDay('documents.created', $day)
                ->orderBy('documents.document_id', 'desc')
                ->get();

       
        $data = [];
        foreach ($rows as $value => $key) {

            $delete_button = DB::table('history')->where('t_number', $key->tracking_number)->count() > 1 ? true : false;
           
            $data['created_today'][] = array(
                    'index'             => $index++,
                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    
                    
                    
            );
        }



          $rows1 = DB::table('history as history')
            ->leftJoin('documents as documents', 'documents.tracking_number', '=', 'history.t_number')
            ->leftJoin('users as users', 'users.user_id', '=', 'history.user2')
            ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
            ->select('documents.tracking_number as tracking_number','documents.document_name as document_name',
                     'documents.document_id as document_id','users.user_type as user_type',
                     'document_types.type_name as type_name', 'history.received_date as received_date',
                     'history.history_id as history_id','history.remarks as remarks')
            ->where('user2', base64_decode($_GET['id']))
            ->whereYear('received_date', $year)
            ->whereMonth('received_date', $month)
            ->whereDay('received_date', $day)
            ->where('received_status', 1)
            ->where('release_status',NULL )
            ->where('status' , 'received')
            ->orderBy('received_date', 'desc')->get();


       foreach ($rows1 as $value => $key) {

         
            $data['received_today'][] = array(
                    'index'             => $index++,
                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                   
            );
        }


         $rows2 = DB::table('history as history')
            ->leftJoin('documents as documents', 'documents.tracking_number', '=', 'history.t_number')
            ->leftJoin('users as users', 'users.user_id', '=', 'history.user2')
            ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
            ->select('documents.tracking_number as tracking_number','documents.document_name as document_name',
                     'documents.document_id as document_id','users.user_type as user_type',
                     'document_types.type_name as type_name', 'history.received_date as received_date',
                     'history.history_id as history_id','history.remarks as remarks')
            ->where('user1', base64_decode($_GET['id']))
            ->whereYear('release_date', $year)
            ->whereMonth('release_date', $month)
            ->whereDay('release_date', $day)
            ->where('received_status', NULL)
            ->where('status', 'torec')
            ->where('release_status',NULL )
            ->orderBy('release_date', 'desc')->get();




            


       foreach ($rows2 as $value => $key) {

         
            $data['forwarded_today'][] = array(
                    'index'             => $index++,
                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                   
            );
        }



 

       
       

        return response()->json($data);


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

       return response()->json((array('number'=> $l,'y'=> date('Y', time()), 'm' => date('m', time()), 'd' => date('d', time()) )));
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


    private function create_qr_code($tracking_number){


        $from = [255, 0, 0];
        $to = [0, 0, 255];
        $path = '/img/qr-code/';
        $image = QrCode::size(200)
        ->format('png')
        // ->merge('/storage/app/peso_logo.png')
        ->errorCorrection('M')
        // ->style('dot')
        // ->eye('circle')
        // ->gradient($from[0], $from[1], $from[2], $to[0], $to[1], $to[2], 'diagonal')
        // ->margin(0)
        ->generate(
            $tracking_number,
        );


        $output_file = $path .$tracking_number. '.png';
        Storage::disk('local')->put($output_file, $image); 


    }



        //POST
    public function add_document(Request $request){



    $authorization = $request->header('Authorization');

    if ($authorization == $this->app_key) {

     $now = new \DateTime();
    $now->setTimezone(new \DateTimezone('Asia/Manila'));
    $items = array(

        'tracking_number'   		=> $request->input('tracking_number'),
        'document_name'    			=> $request->input('document_name'),
        'u_id'    					=> base64_decode($request->input('user_id')),
        'offi_id'    				=> $request->input('office_id'),
        'doc_type'    				=> $request->input('document_type'),
        'document_description'    	=> $request->input('description'),
        'created'       	        =>  $now->format('Y-m-d H:i:s')
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
                                'received_date'    => $now->format('Y-m-d H:i:s'),
                                'release_date'     => NULL,  
                                'release_status'   => NULL,
                                'release_date'     => NULL, 
                );


            $add1 = DB::table('history')->insert($items1);

            if ($add1) {

                $this->create_qr_code($items['tracking_number']);
                
              $data = array('message' => 'Add Successfully' , 'response' => true );

            }else {

              $data = array('message' => 'Something Wrong' , 'response' => false );
            }

            

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );


        }
       
       }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
    
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
                    'type_id'           => $row->type_id,
                    'description'       => $row->document_description,
                    'qr'                => env('APP_URL').'storage/app/img/qr-code/'.$row->tracking_number.'.png',
                    'is'                =>  DB::table('history')->where('t_number', $row->tracking_number)->where('status','completed')->count() == 1 ? false : true
        );

        return response()->json($data);
    }


    function generate_tracking_number(){

        $t_number = mt_rand();
        $check = DB::table('documents')->where('tracking_number', $t_number);

        $t_number = $check->count() < 1 ? $t_number : $t_number = mt_rand();

        return $t_number;

    }

    public function get_my_documents(){

        $rows = DB::table('documents as documents')->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')->select('documents.created as d_created','documents.tracking_number as tracking_number', 'documents.document_name as document_name', 'documents.document_id as document_id', 'document_types.type_name')->where('u_id', base64_decode($_GET['id']))->orderBy('documents.document_id', 'desc')->get();

       
        $data = [];
        foreach ($rows as $value => $key) {

            $delete_button = DB::table('history')->where('t_number', $key->tracking_number)->count() > 1 ? true : false;

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'created'           => date('M d Y - h:i a', strtotime($key->d_created)),
                    'a'                 => $delete_button,
                    'document_id'       => $key->document_id
            );
        }


     
       

        return response()->json($data);

    }

    public function get_received_documents(){


        $data = [];

        $rows = DB::table('history as history')
            ->leftJoin('documents as documents', 'documents.tracking_number', '=', 'history.t_number')
            ->leftJoin('users as users', 'users.user_id', '=', 'history.user2')
            ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
            ->select('documents.tracking_number as tracking_number','documents.document_name as document_name',
                     'documents.document_id as document_id','users.user_type as user_type',
                     'document_types.type_name as type_name', 'history.received_date as received_date',
                     'history.history_id as history_id','history.remarks as remarks')
            ->where('user2', base64_decode($_GET['id']))
            ->where('received_status', 1)
            ->where('release_status',NULL )
            ->where('status' , 'received')
            ->orderBy('received_date', 'desc')->get();


       // $rows = DB::table('history')->where('user2', base64_decode($_GET['id']))->where('received_status', 1)->where('release_status',NULL )->where('status' , 'received')->leftJoin('documents', 'documents.tracking_number', '=', 'history.t_number')->leftJoin('users', 'users.user_id', '=', 'history.user2')->get();


       foreach ($rows as $value => $key) {

         
            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    't_'                => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'received_date'     => date('M d Y - h:i a', strtotime($key->received_date)) ,
                    'history_id'        => $key->history_id,
                    'document_id'       => $key->document_id,
                    'a'                 => $key->user_type == 'admin' ? false : true,
                    'remarks'           => $key->remarks,
            );
        }

        return response()->json($data); 


    }


     //Delete
    public function delete_my_document(Request $request)
    {
        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {


        $id = $request->input('id');


        if (is_array($id)) {

            foreach ($id as $row) {

                $delete =  DocumentModel::where('document_id', $row);
                $tracking_number =  $delete->get()[0]->tracking_number;

                if($delete->delete()) {
                DB::table('history')->where('t_number', $tracking_number)->delete();
                }

            }

            $data = array('message' => 'Deleted Succesfully' , 'response' => true );
           
        }else {

            $delete =  DocumentModel::where('document_id', $id);
            $tracking_number =  $delete->get()[0]->tracking_number;

            if($delete->delete()) {

                DB::table('history')->where('t_number', $tracking_number)->delete();
                $data = array('message' => 'Deleted Succesfully' , 'response' => true );

            }else {
                
                    $data = array('message' => 'Error', 'response' => false);
            }

            

           
        }

    }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
    }

        return response()->json($data);
    }

    public function forward_document(Request $request){

        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {


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
        
        
      }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
    
        }
       
       return response()->json($data);
    }



     public function get_forward_documents(){


       $data = [];

        $rows = DB::table('history as history')
            ->leftJoin('documents as documents', 'documents.tracking_number', '=', 'history.t_number')
            ->leftJoin('users as users', 'users.user_id', '=', 'history.user2')
            ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
            ->select('documents.tracking_number as tracking_number','documents.document_name as document_name',
                     'documents.document_id as document_id','users.user_type as user_type',
                     'document_types.type_name as type_name', 'history.release_date as release_date',
                     'history.history_id as history_id','history.remarks as remarks',
                     DB::Raw("CONCAT(users.first_name, ' ', users.middle_name , ' ', users.last_name,' ',users.extension) as name"))
            ->where('user1', base64_decode($_GET['id']))
            ->where('received_status', NULL)
            ->where('status', 'torec')
            ->where('release_status',NULL )
            ->orderBy('received_date', 'desc')->get();


       // $rows = DB::table('history')->where('user1', base64_decode($_GET['id']))->where('received_status', NULL)->where('status', 'torec')->where('release_status',NULL )->leftJoin('documents', 'documents.tracking_number', '=', 'history.t_number')->leftJoin('users', 'users.user_id', '=', 'history.user2')->orderBy('history.history_id', 'desc')->get();


       foreach ($rows as $value => $key) {


        

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'released_date'     => date('M d Y - h:i a', strtotime($key->release_date)) ,
                    'forwarded_to'      => $key->name,
                    'document_id'       => $key->document_id,
                    'remarks'           => $key->remarks,
            );
        }

        return response()->json($data); 

       


     }



      public function get_incoming_documents(){

        $data = [];

        $rows = DB::table('history as history')
            ->leftJoin('documents as documents', 'documents.tracking_number', '=', 'history.t_number')
            ->leftJoin('users as users', 'users.user_id', '=', 'history.user1')
            ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
            ->select('documents.tracking_number as tracking_number','documents.document_name as document_name',
                     'documents.document_id as document_id','users.user_type as user_type',
                     'document_types.type_name as type_name', 'history.release_date as release_date',
                     'history.history_id as history_id','history.remarks as remarks',
                     DB::Raw("CONCAT(users.first_name, ' ', users.middle_name , ' ', users.last_name,' ',users.extension) as name"))
            ->where('user2', base64_decode($_GET['id']))
            ->where('received_status', NULL)
            ->where('status', 'torec')
            ->where('release_status',NULL )
            ->orderBy('received_date', 'desc')->get();
       // $rows = DB::table('history')->where('user2', base64_decode($_GET['id']))->where('received_status', NULL)->where('status', 'torec')->where('release_status',NULL )->leftJoin('documents', 'documents.tracking_number', '=', 'history.t_number')->leftJoin('users', 'users.user_id', '=', 'history.user1')->get();


       foreach ($rows as $value => $key) {

          

            $data[] = array(

                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'released_date'     => date('M d Y - h:i a', strtotime($key->release_date)) ,
                    'from'              => $key->name,
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

        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {

         $now = new \DateTime();
        $now->setTimezone(new \DateTimezone('Asia/Manila'));

        $id    = $request->input('id');

        $update_receive     = DB::table('history')
                    ->where('history.history_id', $id)
                    ->update(array('status' => 'received','received_status'=> 1, 'received_date' => $now->format('Y-m-d H:i:s')));

         if($update_receive) {


            $data = array('message' => 'Received Succesfully' , 'response' => true );
                

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );

        }
        
        
        }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
    
        }
       
       return response()->json($data);

      }


      public function complete_document(Request $request){

         $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {

        $id    = $request->input('id');

        $update_receive     = DB::table('history')
                    ->where('history.history_id', $id)
                    ->update(array('status' => 'completed','final_action_taken' => $request->input('final_action_taken'), 'remarks' => $request->input('remarks1') ));

         if($update_receive) {


            $data = array('message' => 'Completed Succesfully' , 'response' => true );
                

        }else {

            $data = array('message' => 'Something Wrong' , 'response' => false );

        }
        
        
        }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
    
        }
       
       return response()->json($data);

      }

      public function get_history(){

        $where = array('t_number' => $_GET['t']);
        $history = DB::table('history')->where($where)->leftJoin('final_actions', 'final_actions.action_id', '=', 'history.final_action_taken');

        $data = [];


        if ($history->count() > 0) {
            // code...
        

        foreach ($history->get() as $value => $row) {

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
                            'office2'           => $row->user2 != 0 ?  $user2[0]->office : ' - ',
                            'tracking_number'   => $row->t_number,
                            'date_released'     => $row->release_date != NULL ? date('M d Y', strtotime($row->release_date)).' - '.date('h:i a', strtotime($row->release_date)) : ' - ',
                            'date_received'     => $row->received_date != NULL ? date('M d Y', strtotime($row->received_date)).' - '.date('h:i a', strtotime($row->received_date)) : ' - ',
                            // 'duration' => $row['received_date'] != '0000-00-00 00:00:00' ?   $this->duration($interval) : ' - ',

 
                            'duration'          => $row->received_date != NULL ?   $display_month.' '.$display_day.' '.$display_hour.' '.$display_min: ' - ',
                            'remarks'           => empty($row->remarks) ? 'no remarks' : $row->remarks,
                            'final_action_taken'=> $row->action_name
                );

        }

        

     }else{

         $data = array('message' => 'Tracking number not found', 'response' => false);

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


         echo json_encode($data);

        }else {

            echo json_encode(['response' => false,'message'=> 'Nothing']);
        }


        
      }




      //Admin


        public function countadmindoc_dash(){

        // echo $_GET['id'];
        $data = array(

                'count_documents'    => DB::table('documents')->count(),
                'count_offices'          => DB::table('offices')->where('office_status', 'active')->count(),
                'count_document_types'          => DB::table('history')->count(),
                'count_users'         => DB::table('users')->where('user_status', 'active')->count()
        );

        echo json_encode($data);
    }

      public function get_all_documents(){

          $rows = DB::table('documents as documents')
                    ->leftJoin('document_types as document_types', 'document_types.type_id', '=', 'documents.doc_type')
                    ->leftJoin('users as users', 'users.user_id', '=', 'documents.u_id')
                    ->select('documents.created as created','documents.tracking_number as tracking_number', 
                             'documents.document_name as   document_name', 'documents.document_id as document_id', 
                             'document_types.type_name',  DB::Raw("CONCAT(users.first_name, ' ', users.middle_name , ' ', users.last_name,' ',users.extension) as name"))
                    ->orderBy('documents.document_id', 'desc')->get();

          // $rows = DB::table('documents')->leftJoin('document_types', 'document_types.type_id', '=', 'documents.doc_type')->leftJoin('users','users.user_id','=','documents.u_id',)->orderBy('documents.document_id', 'desc')->get();
        $data = [];
        $i = 1;
        foreach ($rows as $value => $key) {

            $delete_button = DB::table('history')->where('t_number', $key->tracking_number)->count() > 1 ? true : false;


            $data[] = array(
                    'number'            => $i++,
                    'tracking_number'   => $key->tracking_number,
                    'document_name'     => $key->document_name,
                    'type_name'         => $key->type_name,
                    'created'           => $key->created,
                    'a'                 => $delete_button,
                    'document_id'       => $key->document_id,
                    'created_by'        => $key->name
            );
        }


     
       

        return response()->json($data);
      }



      public function update_document(Request $request, $id){


        $authorization = $request->header('Authorization');

        if ($authorization == $this->app_key) {

        $id    = $request->input('t_number');

        $items = array(

                    'document_name'         => $request->input('document_name'),
                    'doc_type'              => $request->input('document_type'),
                    'document_description'  => $request->input('description'),
        );

        $update     = DB::table('documents')
                    ->where('documents.tracking_number', $id)
                    ->update($items);

         if($update) {


            $data = array('message' => 'updated Succesfully' , 'response' => true );
                

        }else {

            $data = array('message' => 'Something Wrong/No Changes Apply ' , 'response' => false );

        }
        
        
        }else {

        $data = array('message' => 'Request Unauthorized' , 'response' => false );
    
        }
       
       return response()->json($data);

      }
}
