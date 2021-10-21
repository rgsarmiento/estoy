<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $fillable = [
       'minimum_salary',
       'ordinary_time',
       'night_time',
       'extra_daytime',
       'overtime_night',
       'sunday_extra_daytime',
       'sunday_night_overtime',
       'transport_allowance',
       'url_server_api'
    ];
}
