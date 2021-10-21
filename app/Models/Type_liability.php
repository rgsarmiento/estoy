<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_liability extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
    ];

    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
