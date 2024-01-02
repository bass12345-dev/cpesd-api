<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramModel extends Model
{
    use HasFactory;
    protected $table = 'programs';

     protected $fillable = [
        'program_id',
        'program_description',
        'created',
    
        
    ];

    public $timestamps = false;
}
