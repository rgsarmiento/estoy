<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('payroll_type_document_identification_id')->constrained('payroll_type_document_identifications');
            $table->integer('identification_number')->unique();
            $table->string('surname',50);
            $table->string('second_surname',50)->nullable();
            $table->string('first_name',50);
            $table->string('second_name',50)->nullable();
            $table->string('address',200);
            $table->string('telephone',50)->nullable();
            $table->string('email')->unique();
            $table->foreignId('municipality_id')->constrained('municipalities');
             //Informacion laboral
            $table->foreignId('type_contract_id')->constrained('type_contracts');
            $table->date('admision_date');
            $table->foreignId('type_worker_id')->constrained('type_workers');
            $table->foreignId('sub_type_worker_id')->constrained('sub_type_workers');
            $table->foreignId('payroll_period_id')->constrained('payroll_periods');
            $table->boolean('high_risk_pension')->default(false);
            $table->foreignId('type_salud_law_deduction_id')->constrained('type_salud_law_deductions');
            $table->foreignId('type_pension_law_deduction_id')->constrained('type_pension_law_deductions');
            //informacion salarial
            $table->boolean('integral_salarary')->default(false);
            $table->decimal('salary',12,2);
            $table->boolean('transportation_allowance')->default(false);
            $table->foreignId('payment_method_id')->constrained();
            $table->string('bank_name',100)->nullable();
            $table->string('account_type',50)->nullable();
            $table->string('account_number',50)->nullable();
            $table->enum('status', ['ACTIVO', 'INACTIVO'])->default('ACTIVO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('workers');
    }
}
