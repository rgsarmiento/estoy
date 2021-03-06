<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment_method;

class table_payment_methods extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payment_methods = array(
            array('id' => '1','name' => 'Instrumento no definido','code' => '1
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '2','name' => 'Crédito ACH','code' => '2
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '3','name' => 'Débito ACH','code' => '3
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '4','name' => 'Reversión débito de demanda ACH','code' => '4
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '5','name' => 'Reversión crédito de demanda ACH ','code' => '5
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '6','name' => 'Crédito de demanda ACH','code' => '6
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '7','name' => 'Débito de demanda ACH','code' => '7
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '8','name' => 'Mantener','code' => '8
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '9','name' => 'Clearing Nacional o Regional','code' => '9
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '10','name' => 'Efectivo','code' => '10
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '11','name' => 'Reversión Crédito Ahorro','code' => '11
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '12','name' => 'Reversión Débito Ahorro','code' => '12
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '13','name' => 'Crédito Ahorro','code' => '13
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '14','name' => 'Débito Ahorro','code' => '14
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '15','name' => 'Bookentry Crédito','code' => '15
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '16','name' => 'Bookentry Débito','code' => '16
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '17','name' => 'Concentración de la demanda en efectivo /Desembolso Crédito (CCD)','code' => '17
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '18','name' => 'Concentración de la demanda en efectivo / Desembolso (CCD) débito','code' => '18
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '19','name' => 'Crédito Pago negocio corporativo (CTP)','code' => '19
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '20','name' => 'Cheque','code' => '20
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '21','name' => 'Poyecto bancario','code' => '21
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '22','name' => 'Proyecto bancario certificado','code' => '22
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '23','name' => 'Cheque bancario','code' => '23
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '24','name' => 'Nota cambiaria esperando aceptación','code' => '24
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '25','name' => 'Cheque certificado','code' => '25
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '26','name' => 'Cheque Local','code' => '26
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '27','name' => 'Débito Pago Neogcio Corporativo (CTP)','code' => '27
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '28','name' => 'Crédito Negocio Intercambio Corporativo (CTX)','code' => '28
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '29','name' => 'Débito Negocio Intercambio Corporativo (CTX)','code' => '29
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '30','name' => 'Transferecia Crédito','code' => '30
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '31','name' => 'Transferencia Débito','code' => '31
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '32','name' => 'Concentración Efectivo / Desembolso Crédito plus (CCD+)','code' => '32
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '33','name' => 'Concentración Efectivo / Desembolso Débito plus (CCD+)','code' => '33
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '34','name' => 'Pago y depósito pre acordado (PPD)','code' => '34
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '35','name' => 'Concentración efectivo ahorros / Desembolso Crédito (CCD)','code' => '35
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '36','name' => 'Concentración efectivo ahorros / Desembolso Drédito (CCD)','code' => '36
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '37','name' => 'Pago Negocio Corporativo Ahorros Crédito (CTP)','code' => '37
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '38','name' => 'Pago Neogcio Corporativo Ahorros Débito (CTP)','code' => '38
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '39','name' => 'Crédito Negocio Intercambio Corporativo (CTX)','code' => '39
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '40','name' => 'Débito Negocio Intercambio Corporativo (CTX)','code' => '40
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '41','name' => 'Concentración efectivo/Desembolso Crédito plus (CCD+) ','code' => '41
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '42','name' => 'Consiganción bancaria','code' => '42
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '43','name' => 'Concentración efectivo / Desembolso Débito plus (CCD+)','code' => '43
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '44','name' => 'Nota cambiaria','code' => '44
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '45','name' => 'Transferencia Crédito Bancario','code' => '45
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '46','name' => 'Transferencia Débito Interbancario','code' => '46
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '47','name' => 'Transferencia Débito Bancaria','code' => '47
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '48','name' => 'Tarjeta Crédito','code' => '48
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '49','name' => 'Tarjeta Débito','code' => '49
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '50','name' => 'Postgiro','code' => '50
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '51','name' => 'Telex estándar bancario francés','code' => '51
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '52','name' => 'Pago comercial urgente','code' => '52
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '53','name' => 'Pago Tesorería Urgente','code' => '53
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '54','name' => 'Nota promisoria','code' => '60
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '55','name' => 'Nota promisoria firmada por el acreedor','code' => '61
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '56','name' => 'Nota promisoria firmada por el acreedor, avalada por el banco','code' => '62
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '57','name' => 'Nota promisoria firmada por el acreedor, avalada por un tercero','code' => '63
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '58','name' => 'Nota promisoria firmada pro el banco','code' => '64
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '59','name' => 'Nota promisoria firmada por un banco avalada por otro banco','code' => '65
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '60','name' => 'Nota promisoria firmada ','code' => '66
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '61','name' => 'Nota promisoria firmada por un tercero avalada por un banco','code' => '67
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '62','name' => 'Retiro de nota por el por el acreedor','code' => '70
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '63','name' => 'Retiro de nota por el por el acreedor sobre un banco','code' => '74
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '64','name' => 'Retiro de nota por el acreedor, avalada por otro banco','code' => '75
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '65','name' => 'Retiro de nota por el acreedor, sobre un banco avalada por un tercero','code' => '76
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '66','name' => 'Retiro de una nota por el acreedor sobre un tercero','code' => '77
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '67','name' => 'Retiro de una nota por el acreedor sobre un tercero avalada por un banco','code' => '78
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '68','name' => 'Nota bancaria tranferible','code' => '91
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '69','name' => 'Cheque local traferible','code' => '92
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '70','name' => 'Giro referenciado','code' => '93
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '71','name' => 'Giro urgente','code' => '94
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '72','name' => 'Giro formato abierto','code' => '95
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '73','name' => 'Método de pago solicitado no usuado','code' => '96
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '74','name' => 'Clearing entre partners','code' => '97
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23'),
            array('id' => '75','name' => 'Acuerdo mutuo','code' => 'ZZZ
          ','created_at' => '2021-05-27 21:19:23','updated_at' => '2021-05-27 21:19:23')
          );

          foreach($payment_methods as $row){
            Payment_method::create($row);
        } 
    }
}
