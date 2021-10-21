<?php

namespace Database\Seeders;

use App\Models\Type_organization;
use Illuminate\Database\Seeder;

class table_type_organizations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_organizations = array(
            array('id' => '1','name' => 'Persona Jurídica','code' => '1
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '2','name' => 'Persona Natural','code' => '2
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
          );

        foreach($type_organizations as $row){
            Type_organization::create($row);
        }
    }
}
