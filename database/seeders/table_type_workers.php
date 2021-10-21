<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Type_worker;

class table_type_workers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $type_workers = array(
            array('id' => '1','name' => 'Dependiente','code' => '01
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '2','name' => 'Servicio domestico','code' => '02
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '3','name' => 'Independiente','code' => '03
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '4','name' => 'Madre comunitaria','code' => '04
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '5','name' => 'Aprendices del Sena en etapa lectiva','code' => '12
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '6','name' => 'Independiente agremiado o asociado','code' => '16
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '7','name' => 'Funcionarios públicos sin tope máximo de ibc','code' => '18
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '8','name' => 'Aprendices del SENA en etapa productiva','code' => '19
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '9','name' => 'Estudiantes (régimen especial ley 789 de 2002)','code' => '20
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '10','name' => 'Estudiantes de postgrado en salud','code' => '21
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '11','name' => 'Profesor de establecimiento particular','code' => '22
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '12','name' => 'Estudiantes aportes solo riesgos laborales','code' => '23
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '13','name' => 'Dependiente entidades o universidades públicas con régimen especial en salud','code' => '30
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '14','name' => 'Cooperados o pre cooperativas de trabajo asociado','code' => '31
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '15','name' => 'Cotizante miembro de la carrera diplomática o consular de un país extranjero o funcionario de organismo multilateral','code' => '32
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '16','name' => 'Beneficiario del fondo de solidaridad pensional','code' => '33
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '17','name' => 'Concejal municipal o distrital o edil de junta administrativa local que percibe honorarios amparado por póliza de salud','code' => '34
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '18','name' => 'Concejal municipal o distrital que percibe honorarios no amparado con póliza de salud','code' => '35
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '19','name' => 'Concejal municipal o distrital que percibe honorarios no amparado con póliza de salud beneficiario del fondo de solidaridad pensional.','code' => '36
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '20','name' => 'Beneficiario upc adicional','code' => '40
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '21','name' => 'Beneficiario sin ingresos con pago por tercero','code' => '41
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '22','name' => 'Cotizante pago solo salud articulo 2 ley 1250 de 2008 (independientes de bajos ingresos)','code' => '42
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '23','name' => 'Cotizante voluntario a pensiones con pago por tercero','code' => '43
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '24','name' => 'Cotizante dependiente de empleo de emergencia con duración mayor o igual a un mes','code' => '44
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '25','name' => 'Cotizante dependiente de empleo de emergencia con duración menor a un mes','code' => '45
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '26','name' => 'Trabajador dependiente de entidad beneficiaria del sistema general de participaciones - aportes patronales','code' => '47
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '27','name' => 'Trabajador de tiempo parcial','code' => '51
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '28','name' => 'Beneficiario del mecanismo de protección al cesante','code' => '52
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '29','name' => 'Afiliado participe','code' => '53
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '30','name' => 'Pre pensionado de entidad en liquidación.','code' => '54
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '31','name' => 'Afiliado participe - dependiente','code' => '55
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '32','name' => 'Pre pensionado con aporte voluntario a salud','code' => '56
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '33','name' => 'Independiente voluntario al sistema de riesgos laborales','code' => '57
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '34','name' => 'Estudiantes de prácticas laborales en el sector público','code' => '58
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '35','name' => 'Independiente con contrato de prestación de servicios superior a 1 mes','code' => '59
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '36','name' => 'Beneficiario programa de reincorporación','code' => '61
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
          );

        foreach($type_workers as $row){
            Type_worker::create($row);
        } 
    }
}
