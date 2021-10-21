<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResolutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resolutions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->integer('type_document_id');
            $table->char('prefix', 4)->nullable();
            $table->string('resolution')->nullable();
            $table->date('resolution_date')->nullable();
            $table->string('technical_key')->nullable();
            $table->bigInteger('from');
            $table->bigInteger('to');
            $table->integer('nex');
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
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
        Schema::dropIfExists('resolutions');
    }
}
