<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payroll_type_document_identification;

class table_payroll_type_document_identifications extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payroll_type_document_identifications = array(
            array('id' => '1','name' => 'Cedula de ciudadanía','code' => '1'),
            array('id' => '2','name' => 'Cedula de extranjería','code' => '2'),
            array('id' => '3','name' => 'Tarjeta de identidad','code' => '3'),
            array('id' => '4','name' => 'Pasaporte','code' => '4')
          );

        foreach($payroll_type_document_identifications as $row){
            Payroll_type_document_identification::create($row);
        } 
    }
}
