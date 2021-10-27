<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document_payroll extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'worker_id',
        'user_id',
        'parent_id',
        'state_document_id',
        'type_document_id',
        'prefix',
        'consecutive',
        'xml',
        'pdf',
        'json_env',
        'json_rpta',
        'cune',
        'date_issue',
        'period_id',
        'worked_days',
        'accrued',
        'accrued_total',
        'deductions',
        'deductions_total',
        'payroll_total'
    ];

    public function parent()
    {//el padre
        return $this->belongsTo(Document_payroll::class);
    }

    public function document_payrolls()
    {//los hijos
        return $this->hasMany(Document_payroll::class, 'parent_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function type_document()
    {
        return $this->belongsTo(Type_document::class);
    }

    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
