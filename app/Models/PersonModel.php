<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonModel extends Model
{
    use HasFactory;

     protected $table = 'persons';

     protected $fillable = [ 
        'first_name',
        'middle_name',
        'last_name',
        'extension',
        'phone_number',
        'address',
        'email_address',
        'status',
        'created_at',
        
    ];

    public $timestamps = false;
}
