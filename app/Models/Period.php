<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    use HasFactory;
    protected $fillable = [
        'description',
        'month',
        'year',
        'date_from',
        'date_to'
    ];
}
