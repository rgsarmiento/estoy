<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Sub_type_worker;

class table_sub_type_workers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sub_type_workers = array(
            array('id' => '1','name' => 'No Aplica','code' => '00
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '2','name' => 'Dependiente pensionado por vejez activo','code' => '01
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '3','name' => 'Independiente pensionado por vejez activo','code' => '02
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '4','name' => 'Cotizante no obligado a cotizar a pensión por edad','code' => '03
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '5','name' => 'Cotizante con requisitos cumplidos para pensión','code' => '04
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '6','name' => 'Cotizante a quien se le ha reconocido indemnización sustitutiva o devolución de saldos','code' => '12
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '7','name' => 'Cotizante perteneciente a un régimen de exceptuado de pensiones a entidades autorizadas para recibir aportes exclusivamente de un grupo de sus propios trabajadores','code' => '16
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '8','name' => 'Cotizante pensionado con mesada superior a 25 smlmv','code' => '18
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '9','name' => 'Residente en el exterior afiliado voluntario al sistema general de pensiones y/o afiliado','code' => '19
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '10','name' => 'Conductores del servicio público de transporte terrestre automotor individual de pasajeros en vehículos taxi decreto 1047 de 2014','code' => '20
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '11','name' => 'Conductores servicio taxi no aporte pensión dec. 1047','code' => '21
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
          );

        foreach($sub_type_workers as $row){
            Sub_type_worker::create($row);
        } 
    }
}
