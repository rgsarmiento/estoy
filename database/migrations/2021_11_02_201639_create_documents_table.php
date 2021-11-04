<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('parent_id')->constrained('documents')->nullable();//relacionado con sigo mismo
            $table->integer('state_document_id')->default(0);
            $table->foreignId('type_document_id')->constrained('type_documents');
            $table->foreignId('period_id')->constrained('periods');
            $table->dateTime('date_issue');
            $table->char('prefix')->nullable();
            $table->integer('consecutive');
            $table->foreignId('worker_id')->constrained('workers');
            $table->integer('worked_days')->default(0);
            $table->json('accrued')->nullable();
            $table->decimal('accrued_total',18,2)->default(0);
            $table->json('deductions')->nullable();
            $table->decimal('deductions_total',18,2)->default(0);
            $table->json('payment_date')->nullable();
            $table->string('notes')->nullable();
            $table->decimal('payroll_total',18,2)->default(0);
            $table->string('cune')->nullable();
            $table->string('xml')->nullable();
            $table->string('pdf')->nullable();
            $table->string('zip')->nullable();
            $table->string('qrstr')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
