<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    
    public function index(){
        $data['title'] = 'Search';
        return view('watchlisted.contents.search.search')->with($data);
    }
}
