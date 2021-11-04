<?php

namespace Database\Seeders;

use App\Models\Type_accrued;
use Illuminate\Database\Seeder;

class table_type_accrueds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_contracts = array(            
            array('name' => 'Hora Extra Diurna','node' => 'HEDs'),
            array('name' => 'Hora Extra Nocturna','node' => 'HENs'),
            array('name' => 'Hora Recargo Nocturno ','node' => 'HRNs'),
            array('name' => 'Hora Extra Diurna Dominical y Festivos','node' => 'HEDDFs'),
            array('name' => 'Hora Recargo Diurno Dominical y Festivos','node' => 'HRDDFs'),
            array('name' => 'Hora Extra Nocturna Dominical y Festivos','node' => 'HENDFs'),
            array('name' => 'Hora Recargo Nocturno Dominical y Festivos','node' => 'HRNDFs'),
            array('name' => 'Vacaciones Comunes','node' => 'common_vacation'),
            array('name' => 'Vacaciones Compensadas','node' => 'paid_vacation'),
            array('name' => 'Prima','node' => 'service_bonus'),
            array('name' => 'Cesantias','node' => 'severance'),
            array('name' => 'Incapacidad','node' => 'work_disabilities'),
            array('name' => 'Licencia de Materinidad','node' => 'maternity_leave'),
            array('name' => 'Licencia Remunerada','node' => 'paid_leave'),
            array('name' => 'Licencia no Remunerada','node' => 'non_paid_leave'),
            array('name' => 'Bonificaciones','node' => 'bonuses'),
            array('name' => 'Auxilios','node' => 'aid'),
            array('name' => 'Huelgas Legales','node' => 'legal_strike'),
            array('name' => 'Otros Devengados','node' => 'other_concepts'),
            array('name' => 'Compensaciones','node' => 'compensations'),
            array('name' => 'Bono EPCTV','node' => 'epctv_bonuses'),
            array('name' => 'Comisiones','node' => 'commissions'),
            array('name' => 'Pagos a Terceros','node' => 'third_party_payments'),
            array('name' => 'Anticipos','node' => 'advances'),
            array('name' => 'Dotacion','node' => 'endowment'),
            array('name' => 'Apoyo a Sostenimiento','node' => 'sustenance_support'),
            array('name' => 'Teletrabajo','node' => 'telecommuting'),
            array('name' => 'Bono de Retiro','node' => 'withdrawal_bonus'),
            array('name' => 'Indemnizacion','node' => 'compensation'),
            array('name' => 'Reintegro','node' => 'refund')
          );

        foreach($type_contracts as $row){
            Type_accrued::create($row);
        }
    }
}
