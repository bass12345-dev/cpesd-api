<?php

namespace App\Http\Controllers\Watchlisted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\ProgramController;

class ManageProgramController extends Controller
{
    public function index(){
        $data['title'] = 'Manage Programs';
        $data['programs'] = ProgramController::get_programs()->original;
        return view('watchlisted.contents.manage_program.manage_program')->with($data);
    }
}
