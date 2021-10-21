<?php

namespace Database\Seeders;

use App\Models\Configuration;
use Illuminate\Database\Seeder;

class table_configurations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configurations = array(
            array('minimum_salary' => 908526.00,
                  'ordinary_time' => '{ "value" : 3785.53, "from" : 6, "to" : 21 }',
                  'night_time' => '{ "value" : 5110.46, "from" : 21, "to" : 6 }',
                  'extra_daytime' => '{ "value" : 4731.91, "from" : 6, "to" : 21 }',
                  'overtime_night' => '{ "value" : 6624.67, "from" : 21, "to" : 6 }',
                  'sunday_extra_daytime' => '{ "value" : 7571.05, "from" : 6, "to" : 21 }',
                  'sunday_night_overtime' => '{ "value" : 9463.81, "from" : 21, "to" : 6 }',
                  'transport_allowance' => 106454.00,
                  'url_server_api' => 'http://localhost:8084/apidian2021/public/api/ubl2.1/')           
          );

          foreach($configurations as $row){
            Configuration::create($row);
        } 
    }
}
