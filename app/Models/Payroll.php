<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'worker_id',
        'worked_days',
        'accrued',
        'accrued_total',
        'deductions',
        'deductions_total',
        'notes',
        'payroll_total',
        'payroll_status'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

}
