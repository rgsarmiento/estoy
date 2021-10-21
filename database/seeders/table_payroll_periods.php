<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payroll_period;

class table_payroll_periods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payroll_periods = array(
            array('id' => '1','name' => 'Semanal','code' => '1
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '2','name' => 'Decenal','code' => '2
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '3','name' => 'Catorcenal','code' => '3
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '4','name' => 'Quincenal','code' => '4
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '5','name' => 'Mensual','code' => '5
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
          );

         foreach($payroll_periods as $row){
            Payroll_period::create($row);
        } 
    }
}
