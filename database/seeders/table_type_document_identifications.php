<?php

namespace Database\Seeders;

use App\Models\Type_document_identification;
use Illuminate\Database\Seeder;

class table_type_document_identifications extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_document_identifications = array(
            array('id' => '1','name' => 'Registro civil','code' => '11
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '2','name' => 'Tarjeta de identidad','code' => '12
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '3','name' => 'Cédula de ciudadanía','code' => '13
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '4','name' => 'Tarjeta de extranjería','code' => '21
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '5','name' => 'Cédula de extranjería','code' => '22
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '6','name' => 'NIT','code' => '31
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '7','name' => 'Pasaporte','code' => '41
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '8','name' => 'Documento de identificación extranjero','code' => '42
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '9','name' => 'NIT de otro país','code' => '50
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '10','name' => 'NUIP *','code' => '91
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
          );

        foreach($type_document_identifications as $row){
            Type_document_identification::create($row);
        }
    }
}
