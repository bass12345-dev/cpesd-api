<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
    use HasFactory;

    protected $table = 'document_types';

     protected $fillable = [
        'type_id',
        'type_name',
        'created',
    
        
    ];

    public $timestamps = false;
}
