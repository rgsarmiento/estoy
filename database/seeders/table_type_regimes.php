<?php

namespace Database\Seeders;

use App\Models\Type_regime;
use Illuminate\Database\Seeder;

class table_type_regimes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_regimes = array(
            array('id' => '1','name' => 'Responsable de IVA','code' => '48','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-07-01 10:16:18'),
            array('id' => '2','name' => 'No Responsable de IVA','code' => '49','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-07-01 10:16:18')
          );

        foreach($type_regimes as $row){
            Type_regime::create($row);
        }
    }
}
