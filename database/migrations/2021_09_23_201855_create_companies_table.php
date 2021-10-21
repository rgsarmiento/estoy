<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->integer('identification_number')->unique();
            $table->integer('dv');
            $table->integer('type_environment_id');
            $table->foreignId('type_document_identification_id')->constrained();
            $table->string('name',200);
            $table->string('address',150);
            $table->string('phone',50);
            $table->foreignId('municipality_id')->constrained();
            $table->string('email')->unique();
            $table->foreignId('type_organization_id')->constrained();
            $table->foreignId('type_regime_id')->constrained();
            $table->foreignId('type_liability_id')->constrained();
            $table->string('api_token', 100)->unique();
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
        Schema::dropIfExists('companies');
    }
}
