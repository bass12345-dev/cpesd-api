<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ViewProfileController extends Controller
{
    public function index(){
        $data['title'] = 'View Profile';
        return view('watchlisted.contents.view_profile.view_profile')->with($data);
    }
}
