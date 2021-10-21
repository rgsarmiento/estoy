<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type_salud_law_deduction;

class table_type_salud_law_deductions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_law_deductions = array(
            array('id' => '1','name' => 'Salud Tarifa (12.5%) Trabajador','code' => '1','percentage' => '4.00','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '2','name' => 'Salud Tarifa (12.5%) Trabajador','code' => '2','percentage' => '8.50','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '3','name' => 'Salud Sal<10SMLV Tarifa (4%) Trabajador ','code' => '3','percentage' => '4.00','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '4','name' => 'Salud Sal<10SMLV Tarifa (4%) Empleador','code' => '4','percentage' => '0.00','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            );

        foreach($type_law_deductions as $row){
            Type_salud_law_deduction::create($row);
        } 
    }
}
