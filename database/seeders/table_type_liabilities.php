<?php

namespace Database\Seeders;

use App\Models\Type_liability;
use Illuminate\Database\Seeder;

class table_type_liabilities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {        
        $type_liabilities = array(
            array('id' => '7','name' => 'Gran contribuyente','code' => 'O-13','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '9','name' => 'Autorretenedor','code' => 'O-15','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '14','name' => 'Agente de retención en el impuesto sobre las ventas','code' => 'O-23','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '112','name' => 'Régimen Simple de Tributación – SIMPLE','code' => 'O-47','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '117','name' => 'No responsable','code' => 'R-99-PN','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
          );

        foreach($type_liabilities as $row){
            Type_liability::create($row);
        }
    }
}
