<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll_period_progress extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'period_id',
        'payment_date',
        'state_payroll_period_progress_id'              
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
