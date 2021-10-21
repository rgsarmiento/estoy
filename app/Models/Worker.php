<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'user_id',
        'payroll_type_document_identification_id',
        'identification_number',
        'surname',
        'second_surname',
        'first_name',
        'second_name',
        'address',
        'telephone',
        'email',
        'municipality_id',
            //Informacion laboral
        'type_contract_id',
        'admision_date',
        'type_worker_id',
        'sub_type_worker_id',
        'payroll_period_id',
        'high_risk_pension',
        'type_salud_law_deduction_id',
        'type_pension_law_deduction_id',
        //informacion salarial
        'integral_salarary',
        'salary',
        'transportation_allowance',
        'payment_method_id',
        'bank_name',
        'status',
        'account_type',
        'account_number'];

        public function payroll_type_document_identification()
        {
            return $this->belongsTo(Payroll_type_document_identification::class);
        }

        public function user()
        {
            return $this->belongsTo(User::class);
        }

        public function company()
        {
            return $this->belongsTo(Company::class);
        }

        public function municipality()
        {
            return $this->belongsTo(Municipality::class);
        }

        public function type_contract()
        {
            return $this->belongsTo(Type_contract::class);
        }

        public function type_worker()
        {
            return $this->belongsTo(Type_worker::class);
        }

        public function sub_type_worker()
        {
            return $this->belongsTo(Sub_type_worker::class);
        }

        public function payroll_period()
        {
            return $this->belongsTo(Payroll_period::class);
        }

        public function type_salud_law_deduction()
        {
            return $this->belongsTo(Type_salud_law_deduction::class);
        }

        public function type_pension_law_deduction()
        {
            return $this->belongsTo(Type_pension_law_deduction::class);
        }

        public function payment_method()
        {
            return $this->belongsTo(Payment_method::class);
        }

       
}
