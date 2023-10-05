<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeModel extends Model
{
    use HasFactory;

    protected $table = 'offices';

    protected $fillable = [
        'office_id',
        'office',
        'office_status',
        'created',
    
        
    ];

    public $timestamps = false;
}

