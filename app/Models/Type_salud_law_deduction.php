<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type_salud_law_deduction extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
        'percentage',
    ];

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
