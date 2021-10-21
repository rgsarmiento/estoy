<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resolution extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'type_document_id',
        'prefix',
        'resolution',
        'resolution_date',
        'technical_key',
        'from',
        'to',
        'date_from',
        'date_to',
        'nex'        
    ];
}
