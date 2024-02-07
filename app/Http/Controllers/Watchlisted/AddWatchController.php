<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddWatchController extends Controller
{
     public function index(){
        $data['title'] = 'Add';
        $data['barangay']   = config('app.barangay');
        return view('watchlisted.contents.add.add')->with($data);
    }
}
