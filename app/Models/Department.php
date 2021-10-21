<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_id',
        'name',
        'code',
    ];
    
    public function municipalities()
    {
        return $this->hasMany(Municipalitie::class);
    }
}
