<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll_period extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'code',
    ];

    public function workers()
    {
        return $this->hasMany(Worker::class);
    }
}
