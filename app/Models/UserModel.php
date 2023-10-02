<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [ 
        'first_name',
        'middle_name',
        'last_name',
        'extension',
        'contact_number',
        'address',
        'email_address',
        'profile_pic',
        'user_type',
        'user_status',
        'work_status',
        'username',
        'password',
        'user_created',
        
    ];

    public $timestamps = false;
}
