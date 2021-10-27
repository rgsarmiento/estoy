<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentPayrollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_payrolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('worker_id')->constrained('workers');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('parent_id')->constrained('document_payrolls')->nullable();
            $table->integer('state_document_id')->default(0);
            $table->foreignId('type_document_id')->constrained('type_documents');
            $table->char('prefix')->nullable();
            $table->integer('consecutive');
            $table->string('xml')->nullable();
            $table->string('pdf')->nullable();
            $table->string('json_env')->nullable();
            $table->string('json_rpta')->nullable();
            $table->string('cune')->nullable();
            $table->dateTime('date_issue');
            $table->foreignId('period_id')->constrained('periods');
            $table->integer('worked_days')->default(0);
            $table->json('accrued')->nullable();
            $table->decimal('accrued_total',18,2)->default(0);
            $table->json('deductions')->nullable();
            $table->decimal('deductions_total',18,2)->default(0);
            $table->decimal('payroll_total',18,2)->default(0);
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
        Schema::dropIfExists('document_payrolls');
    }
}
