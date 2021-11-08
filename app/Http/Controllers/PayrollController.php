<?php

namespace App\Http\Controllers;

use App\Http\Requests\payroll\SendRequest;
use App\Http\Requests\payroll\UpdateRequest;
use App\Models\Company;
use App\Models\Company_has_user;
use App\Models\Configuration;
use App\Models\Document;
use App\Models\Payroll;
use App\Models\Payroll_period;
use App\Models\Period;
use App\Models\Resolution;
use App\Models\Type_accrued;
use App\Models\Type_deduction;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use phpDocumentor\Reflection\Types\Boolean;
use stdClass;

class PayrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $configuraciones = Configuration::first();
        // $respuesta = $this->status_zip_apidian_payroll($configuraciones);

        // if ($respuesta->successful()) {
        //     $jsonRespuesta = json_decode($respuesta, true);
        //     dd($jsonRespuesta['ResponseDian']['Envelope']['Body']);
        // }


        //pruebas arriba 
        $user = auth()->user();
        $role_user = auth()->user()->roles->first()->id;
        $company_id = 0;

        if ($role_user <> 1) {
            $user_id = $user->id;
            $company_has_user = Company_has_user::where('user_id', $user_id)->first();
            //dd($company_id);
            if ($company_has_user == null) {
                Auth::logout();
                return redirect('/');
            } else {
                $company_id = $company_has_user->company_id;
            }
        }
        //dd($company_id);
        if ($company_id == 0) {
            $payrolls = Payroll::whereHas('worker', function ($query) {
                return $query->where('status', 'ACTIVO');
            });
        } else {

            $payrolls = Payroll::whereHas('worker', function ($query) {
                return $query->where('status', 'ACTIVO');
            })->where('company_id', $company_id);
        }

        $payrolls = $payrolls->orderBy('updated_at', 'desc')->paginate(10);

        $periodo_nomina = Period::where('year', date('Y'))->where('month', '>=', date('m') - 1)->take(2)->get();

        return view('payrolls.index', compact('payrolls', 'periodo_nomina'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function show(Payroll $payroll)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function edit(Payroll $payroll)
    {
        $configuraciones = Configuration::first();
        $type_deductions = Type_deduction::where('status_type_deduction', '1')->get();
        $type_accrueds = Type_accrued::where('status_type_accrued', '1')->get();
        return view('payrolls.editar', compact('payroll', 'type_deductions', 'type_accrueds', 'configuraciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Payroll $payroll)
    {
        $data = $request->all();

        $payroll->update([
            'worked_days' => $data['worked_days'],
            'accrued' => $data['accrued'],
            'accrued_total' => $data['accrued_total'],
            'deductions' => $data['deductions'],
            'deductions_total' => $data['deductions_total'],
            'notes' => $data['notes'],
            'payroll_total' => $data['payroll_total']
        ]);

        return redirect()->route('payrolls.index')->with('message', 'La Nomina del empleado ' . ' ' . $payroll->worker->first_name . ' ' . $payroll->worker->surname . ' ' . 'se actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payroll $payroll)
    {
        //
    }


    public function send_payroll(Payroll $payroll, SendRequest $request)
    {
        $periodo_id = $request->periodo_ni;
        $fecha_pago = $request->fecha_pago_ni;

        $periodo = Period::find($periodo_id);
        $company = Company::find($payroll->company_id);

        $configuraciones = Configuration::first();
        $resolution = Resolution::where('company_id', $payroll->company_id)->first();

        $objeto_nomina = new stdClass();
        $objeto_nomina->type_document_id = 9; //nomina individual
        $objeto_nomina->establishment_name = $payroll->company->name;
        $objeto_nomina->establishment_address = $payroll->company->address;
        $objeto_nomina->establishment_phone = $payroll->company->phone;
        $objeto_nomina->establishment_municipality = $payroll->company->municipality_id;
        $objeto_nomina->establishment_email = $payroll->company->email;
        //$objeto_nomina->head_note= "PRUEBA TEXTO CABEZA";
        //$objeto_nomina->foot_note= "PRUEBA TEXTO PIE";

        $objeto_nomina->novelty = array(
            'novelty' => false,
            'uuidnov' => ""
        );

        $fechaHora = Carbon::now();
        //e debe indicar la Fecha de Ingreso del trabajador a la empresa, en formato AAAA‐MM‐DD
        $objeto_nomina->period = array(
            'admision_date' => $payroll->worker->admision_date,
            //Se debe indicar la Fecha de Inicio del Periodo de liquidación del documento, en formato AAAA‐MM‐D
            'settlement_start_date' => $periodo->date_from,
            //Se debe indicar la Fecha de Fin del Periodo de liquidación del documento, en formato AAAA‐MM‐DD
            'settlement_end_date' => $periodo->date_to,
            //Cantidad de Tiempo que lleva laborando el Trabajador en la empresa
            'worked_time' => strval(Carbon::parse($payroll->worker->admision_date)->diffInDays($periodo->date_to)),
            //fecha de emisión: Fecha de emisión del documento
            'issue_date' => $fechaHora->format('Y-m-d'),
        );
        //date("Y-m-d H:i:s");

        $objeto_nomina->worker_code = strval($payroll->worker->identification_number);
        $objeto_nomina->prefix = $resolution->prefix;
        $objeto_nomina->consecutive = $resolution->nex;
        $objeto_nomina->payroll_period_id = 4;
        $objeto_nomina->notes = $payroll->notes;

        $objeto_nomina->worker = array(
            'type_worker_id' => $payroll->worker->type_worker_id,
            'sub_type_worker_id' => $payroll->worker->sub_type_worker_id,
            'payroll_type_document_identification_id' => $payroll->worker->payroll_type_document_identification_id,
            'municipality_id' => $payroll->worker->municipality_id,
            'type_contract_id' => $payroll->worker->type_contract_id,
            'high_risk_pension' => boolval($payroll->worker->high_risk_pension),
            'identification_number' => strval($payroll->worker->identification_number),
            'surname' => $payroll->worker->surname,
            'second_surname' => is_null($payroll->worker->second_surname) ? '' : $payroll->worker->second_surname,
            'first_name' => $payroll->worker->first_name,
            'address' => $payroll->worker->address,
            'integral_salarary' => boolval($payroll->worker->integral_salarary),
            'salary' => str_replace(',', '', number_format($payroll->worker->salary, 2))
        );

        $objeto_nomina->payment = array(
            'payment_method_id' => $payroll->worker->payment_method_id,
            'bank_name' => $payroll->worker->bank_name,
            'account_type' => $payroll->worker->account_type,
            'account_number' => $payroll->worker->account_number
        );

        $objeto_nomina->payment_dates = array(array('payment_date' => $fecha_pago));


        //Devengados

        $devengados_json = json_decode($payroll->accrued, true);

        $salario = $devengados_json['devengados']['salary']['value'];
        $common_vacation = $devengados_json['devengados']['common_vacation'];
        $paid_vacation = $devengados_json['devengados']['paid_vacation'];
        $maternity_leave = $devengados_json['devengados']['maternity_leave'];
        $paid_leave = $devengados_json['devengados']['paid_leave'];
        $legal_strike = $devengados_json['devengados']['legal_strike'];

        $accrued = array(
            'worked_days' => $payroll->worked_days,
            'salary' => str_replace(',', '', number_format($salario, 2))
        );

        if (count($devengados_json['devengados']['transportation_allowance']) > 0) {
            $subsidio_transporte = $devengados_json['devengados']['transportation_allowance']['value'];
            $accrued['transportation_allowance'] = str_replace(',', '', number_format($subsidio_transporte, 2));
        }

        if (count($common_vacation) > 0) {
            $accrued['common_vacation'] = array();
            foreach ($common_vacation as $key) {
                $common_vacation = array(
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'quantity' => $key['quantity'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['common_vacation'], $common_vacation);
            }
        }

        if (count($paid_vacation) > 0) {
            $accrued['paid_vacation'] = array();
            foreach ($paid_vacation as $key) {
                $paid_vacation = array(
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'quantity' => $key['quantity'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['paid_vacation'], $paid_vacation);
            }
        }

        if (count($maternity_leave) > 0) {
            $accrued['maternity_leave'] = array();
            foreach ($maternity_leave as $key) {
                $maternity_leave = array(
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'quantity' => $key['quantity'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['maternity_leave'], $maternity_leave);
            }
        }

        if (count($paid_leave) > 0) {
            $accrued['paid_leave'] = array();
            foreach ($paid_leave as $key) {
                $paid_leave = array(
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'quantity' => $key['quantity'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['paid_leave'], $paid_leave);
            }
        }

        if (count($legal_strike) > 0) {
            $accrued['legal_strike'] = array();
            foreach ($legal_strike as $key) {
                $legal_strike = array(
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'quantity' => $key['quantity'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['legal_strike'], $legal_strike);
            }
        }



        $accrued["accrued_total"] = $payroll->accrued_total;

        $objeto_nomina->accrued = $accrued;

        //Deducciones

        $deducciones_json = json_decode($payroll->deductions, true);

        $deduction_eps_id = $deducciones_json['deducciones']['eps_type_law_deduction']['id'];
        $deduction_eps = $deducciones_json['deducciones']['eps_type_law_deduction']['value'];
        $deduction_pension_id = $deducciones_json['deducciones']['pension_type_law_deductions']['id'];
        $deduction_pension = $deducciones_json['deducciones']['pension_type_law_deductions']['value'];

        $other_deductions = $deducciones_json['deducciones']['other_deductions'];

        $deductions = array(
            'eps_type_law_deductions_id' => $deduction_eps_id,
            'eps_deduction' => str_replace(',', '', number_format($deduction_eps, 2)),
            'pension_type_law_deductions_id' => $deduction_pension_id,
            'pension_deduction' =>  str_replace(',', '', number_format($deduction_pension, 2)),
            'deductions_total' => $payroll->deductions_total
        );

        if (count($other_deductions) > 0) {
            $deductions['other_deductions'] = array();
            foreach ($other_deductions as $key) {
                $other_deduction = array(
                    'other_deduction' => str_replace(',', '', number_format($key['value'], 2))
                );
                array_push($deductions['other_deductions'], $other_deduction);
            }
        }

        $objeto_nomina->deductions = $deductions;


        $this->save_file("app/public/json/" . $payroll->company->id, $objeto_nomina, "Env-" . $payroll->worker->identification_number . "-" . $resolution->prefix . "-" . $resolution->nex . ".json");
        $response =  $this->send_apidian_payroll($company, $configuraciones, $objeto_nomina);
        $this->save_file("app/public/json/" . $payroll->company->id, json_decode($response), "Rpta-" . $payroll->worker->identification_number . "-" . $resolution->prefix . "-" . $resolution->nex . ".json");




        if ($response->successful()) {

            $isValid = ($response['ResponseDian']['Envelope']['Body']['SendNominaSyncResponse']['SendNominaSyncResult']['IsValid'] === 'true') ? true : false;
            if ($isValid) {
                $this->store_documents($payroll->id, $periodo_id, $objeto_nomina, $response, 1, $fechaHora);
                $resolution->increment('nex');
            } else {
                $this->store_documents($payroll->id, $periodo_id, $objeto_nomina, $response, 0, $fechaHora);
            }
        }

        return json_decode($response);
    }

    protected function send_apidian_payroll($company, $configuraciones, $objeto_nomina)
    { //55ed1dc8-1806-4325-9083-8bbb789f4454   

        $response = Http::accept('application/json')
            ->withToken($company->api_token)
            ->post(
                $configuraciones->url_server_api . 'payroll',
                json_decode(json_encode($objeto_nomina), true)
            );
        return $response;
    }



    protected function save_file($guardaren, $data, $file_name)
    {

        if (!is_dir(storage_path($guardaren)))
            mkdir(storage_path($guardaren));

        $file = fopen(storage_path($guardaren . "/" . $file_name), "w");
        fwrite($file, json_encode($data));
        fclose($file);
    }



    public function change_status(Payroll $payroll)
    {
        if ($payroll->payroll_status == 1) {
            $payroll->update(['payroll_status' => 0]);
            return redirect()->back();
        } else {
            $payroll->update(['payroll_status' => 1]);
            return redirect()->back();
            //return redirect()->route('workers.index');
        }
    }


    protected function status_zip_apidian_payroll($configuraciones)
    {
        $objeto = new stdClass();
        $objeto->sendmail = false;
        $objeto->sendmailtome = false;

        $response = Http::accept('application/json')
            ->withToken('b71b3d1994db7369d5bcfa51a76fb5065f0217b56c99da93264aab131cc504e1')
            ->post(
                $configuraciones->url_server_api . 'status/zip/7547a172-dae7-46fb-a612-8d320d9a2744',
                json_decode(json_encode($objeto), true)
            );
        return $response;
    }

    protected function store_documents($payroll_id, $period_id, $objeto_nomina, $respuesta, $state_document_id, $fechaHora)
    {

        $payroll = Payroll::find($payroll_id);

        $user = auth()->user();

        $document = new Document();
        $document->user_id = $user->id;
        $document->company_id = $payroll->company_id;
        $document->worker_id = $payroll->worker_id;
        $document->worked_days = $payroll->worked_days;
        $document->accrued = $payroll->accrued;
        $document->accrued_total = $payroll->accrued_total;
        $document->deductions = $payroll->deductions;
        $document->deductions_total = $payroll->deductions_total;
        $document->notes = $payroll->notes;
        $document->payroll_total = $payroll->payroll_total;
        $document->state_document_id = $state_document_id;
        $document->type_document_id = 9;
        $document->period_id = $period_id;
        $document->date_issue = $fechaHora->format('Y-m-d H:i:s');
        $document->prefix = $objeto_nomina->prefix;
        $document->consecutive = $objeto_nomina->consecutive;
        $document->payment_date = json_encode($objeto_nomina->payment_dates);
        $document->xml = $respuesta['urlpayrollxml'];
        $document->pdf = $respuesta['urlpayrollpdf'];
        $document->cune = $respuesta['cune'];
        $document->qrstr = $respuesta['QRStr'];

        $document->save();
    }
}
