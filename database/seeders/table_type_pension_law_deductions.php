<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type_pension_law_deduction;

class table_type_pension_law_deductions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_law_deductions = array(
            array('id' => '5','name' => 'Pension Tarifa (16%) Trabajador','code' => '5','percentage' => '4.00','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '6','name' => 'Pension Tarifa (16%) Empleador','code' => '6','percentage' => '12.00','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '7','name' => 'Pension Alto Riesgo Tarifa (26%) Trabajador','code' => '7','percentage' => '4.00','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '8','name' => 'Pension Alto Riesgo Tarifa (26%) Empleador','code' => '8','percentage' => '22.00','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '9','name' => 'Fondo de Solidaridad Empleado','code' => '9','percentage' => '1.00','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
);

        foreach($type_law_deductions as $row){
            Type_pension_law_deduction::create($row);
        } 
    }
}
