<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChangeSecurityController extends Controller
{
    public function index(){
        $data['title'] = 'Change Security Code';
        return view('watchlisted.contents.change_code.change_code')->with($data);
    }
}
