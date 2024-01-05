<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentModel extends Model
{
    use HasFactory;

    protected $table = 'documents';

    protected $fillable = [
        'document_id ',
        'tracking_number',
        'document_name',
        'u_id',
        'offi_id',
        'doc_type',
        'document_description',
        'doc_status',
        'created'
    
        
    ];

    public $timestamps = false;
}
