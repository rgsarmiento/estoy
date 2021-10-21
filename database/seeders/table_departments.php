<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class table_departments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = array(
            array('id' => '1','country_id' => '46','name' => 'Amazonas','code' => '91
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '2','country_id' => '46','name' => 'Antioquia','code' => '05
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '3','country_id' => '46','name' => 'Arauca','code' => '81
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '4','country_id' => '46','name' => 'Atlántico','code' => '08
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '5','country_id' => '46','name' => 'Bogotá','code' => '11
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '6','country_id' => '46','name' => 'Bolívar','code' => '13
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '7','country_id' => '46','name' => 'Boyacá','code' => '15
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '8','country_id' => '46','name' => 'Caldas','code' => '17
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '9','country_id' => '46','name' => 'Caquetá','code' => '18
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '10','country_id' => '46','name' => 'Casanare','code' => '85
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '11','country_id' => '46','name' => 'Cauca','code' => '19
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '12','country_id' => '46','name' => 'Cesar','code' => '20
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '13','country_id' => '46','name' => 'Chocó','code' => '27
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '14','country_id' => '46','name' => 'Córdoba','code' => '23
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '15','country_id' => '46','name' => 'Cundinamarca','code' => '25
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '16','country_id' => '46','name' => 'Guainía','code' => '94
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '17','country_id' => '46','name' => 'Guaviare','code' => '95
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '18','country_id' => '46','name' => 'Huila','code' => '41
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '19','country_id' => '46','name' => 'La Guajira','code' => '44
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '20','country_id' => '46','name' => 'Magdalena','code' => '47
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '21','country_id' => '46','name' => 'Meta','code' => '50
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '22','country_id' => '46','name' => 'Nariño','code' => '52
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '23','country_id' => '46','name' => 'Norte de Santander','code' => '54
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '24','country_id' => '46','name' => 'Putumayo','code' => '86
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '25','country_id' => '46','name' => 'Quindío','code' => '63
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '26','country_id' => '46','name' => 'Risaralda','code' => '66
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '27','country_id' => '46','name' => 'San Andrés y Providencia','code' => '88
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '28','country_id' => '46','name' => 'Santander','code' => '68
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '29','country_id' => '46','name' => 'Sucre','code' => '70
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '30','country_id' => '46','name' => 'Tolima','code' => '73
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '31','country_id' => '46','name' => 'Valle del Cauca','code' => '76
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '32','country_id' => '46','name' => 'Vaupés','code' => '97
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '33','country_id' => '46','name' => 'Vichada','code' => '99
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
          );

          foreach($departments as $row){
            Department::create($row);
        }
    }
}
