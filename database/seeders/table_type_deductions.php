<?php

namespace Database\Seeders;

use App\Models\Type_deduction;
use Illuminate\Database\Seeder;

class table_type_deductions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_contracts = array(            
            array('name' => 'Ahorro Fomentado a la Construcción','node' => 'afc'),
            array('name' => 'Embargo Fiscal','node' => 'tax_liens'),
            array('name' => 'Deuda','node' => 'debt'),
            array('name' => 'Pensión Voluntaria','node' => 'voluntary_pension'),
            array('name' => 'Plan Complementarios','node' => 'supplementary_plan'),
            array('name' => 'Educación','node' => 'education'),
            array('name' => 'Cooperativa','node' => 'cooperative'),
            array('name' => 'Reintegro','node' => 'refund'),
            array('name' => 'Retención Fuente','node' => 'withholding_at_source'),
            array('name' => 'Anticipos','node' => 'advances'),
            array('name' => 'Fondo Sp'),
            array('name' => 'Libranzas','node' => 'orders'),
            array('name' => 'Otras Deducciones','node' => 'other_deductions'),
            array('name' => 'Pagos a Terceros','node' => 'third_party_payments'),
            array('name' => 'Sanciones','node' => 'sanctions'),
            array('name' => 'Sindicato','node' => 'labor_union')
          );

        foreach($type_contracts as $row){
            Type_deduction::create($row);
        }
    }
}
