<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type_contract;

class table_type_contracts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_contracts = array(
            array('id' => '1','name' => 'Término Fijo','code' => '1
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '2','name' => 'Término Indefinido','code' => '2
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '3','name' => 'Obra o Labor','code' => '3
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '4','name' => 'Aprendizaje','code' => '4
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '5','name' => 'Practicas','code' => '5
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
          );

        foreach($type_contracts as $row){
            Type_contract::create($row);
        } 
    }
}
