<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'user_id',
        'parent_id',
        'state_document_id',
        'type_document_id',
        'period_id',
        'date_issue',
        'prefix',
        'consecutive',
        'worker_id',
        'payment_date',
        'worked_days',
        'accrued',
        'accrued_total',
        'deductions',
        'deductions_total',
        'notes',
        'payroll_total',
        'cune',
        'xml',
        'pdf',
        'zip',
        'qrstr'        
    ];

    public function parent()
    {//el padre
        return $this->belongsTo(Document::class);
    }

    public function document_payrolls()
    {//los hijos
        return $this->hasMany(Document::class, 'parent_id');
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
