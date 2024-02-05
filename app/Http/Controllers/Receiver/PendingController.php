<?php

namespace App\Http\Controllers\Receiver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PendingController extends Controller
{
    public function index(){
        $data['title'] = 'Pending Documents';
        return view('receiver.contents.pending.pending')->with($data);
    }
}
