<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->decimal('minimum_salary',10,2); //salario minimo
            $table->json('ordinary_time'); //hora ordinaria
            $table->json('night_time'); //hora nocturna
            $table->json('extra_daytime'); //hora extra diurna
            $table->json('overtime_night'); //hora extra nocturna
            $table->json('sunday_extra_daytime'); //hora extra dominical diurna
            $table->json('sunday_night_overtime'); //hora extra dominical nocturna
            $table->decimal('transport_allowance',10,2); //subsidio de transporte
            $table->string('url_server_api'); //url apidian
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
        Schema::dropIfExists('configurations');
    }
}
