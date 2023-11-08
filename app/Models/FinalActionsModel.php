<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalActionsModel extends Model
{
    use HasFactory;

    protected $table = 'final_actions';

     protected $fillable = [
        'action_id',
        'action_name',
        'created',
    
        
    ];

    public $timestamps = false;
}
