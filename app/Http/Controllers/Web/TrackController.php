<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Models\UserModel;

class TrackController extends Controller
{
    public $app_key;
    public function __construct()
    {
        $this->app_key   = config('app.key');
    }

    public function index(){

          return view('auth.tracker');
    }
}
