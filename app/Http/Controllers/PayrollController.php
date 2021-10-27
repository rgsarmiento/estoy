<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Company_has_user;
use App\Models\Configuration;
use App\Models\Payroll;
use App\Models\Payroll_period;
use App\Models\Period;
use App\Models\Resolution;
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
        $user = auth()->user();
        $role_user = auth()->user()->roles->first()->id;
        $company_id=0;

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
            })->paginate(20);
        } else {
           
            $payrolls = Payroll::whereHas('worker', function ($query) {
                return $query->where('status', 'ACTIVO');
            })->where('company_id', $company_id)->paginate(20);
        
        }
              
        $periodo_nomina = Period::where('year', date('Y'))->where('month', '>=', date('m')-1)->take(2)->get();
                
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payroll  $payroll
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payroll $payroll)
    {
        //
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


    public function send_payroll(Payroll $payroll, Request $request)
    {
        $periodo_id = $request->periodo_ni;
        $fecha_pago = $request->fecha_pago_ni;

        $periodo = Period::find($periodo_id);
        $company = Company::find($payroll->company_id);
        $configuraciones = Configuration::first();
        $resolution = Resolution::where('company_id', $payroll->company_id)->first();
        
        $objeto_nomina = new stdClass();
        $objeto_nomina->type_document_id= 9;//nomina individual
        $objeto_nomina->establishment_name= $payroll->company->name;
        $objeto_nomina->establishment_address= $payroll->company->address;
        $objeto_nomina->establishment_phone= $payroll->company->phone;
        $objeto_nomina->establishment_municipality= $payroll->company->municipality_id;
        $objeto_nomina->establishment_email= $payroll->company->email;
        //$objeto_nomina->head_note= "PRUEBA TEXTO CABEZA";
        //$objeto_nomina->foot_note= "PRUEBA TEXTO PIE";

        $objeto_nomina->novelty = array('novelty' => false,
                                        'uuidnov' => "");

        //e debe indicar la Fecha de Ingreso del trabajador a la empresa, en formato AAAA‐MM‐DD
        $objeto_nomina->period = array('admision_date' => $payroll->worker->admision_date,
        //Se debe indicar la Fecha de Inicio del Periodo de liquidación del documento, en formato AAAA‐MM‐D
                                       'settlement_start_date' => $periodo->date_from, 
        //Se debe indicar la Fecha de Fin del Periodo de liquidación del documento, en formato AAAA‐MM‐DD
                                       'settlement_end_date' => $periodo->date_to,
        //Cantidad de Tiempo que lleva laborando el Trabajador en la empresa
                                       'worked_time' => strval(Carbon::parse($payroll->worker->admision_date)->diffInDays($periodo->date_to)),
        //fecha de emisión: Fecha de emisión del documento
                                       'issue_date' => Carbon::now()->format('Y-m-d'),);

        $objeto_nomina->worker_code = strval($payroll->worker->identification_number);
        $objeto_nomina->prefix = $resolution->prefix;
        $objeto_nomina->consecutive = $resolution->nex;
        $objeto_nomina->payroll_period_id= 4;
        $objeto_nomina->notes = "NOMINA ELECTRONICA ".$periodo->description;

        $objeto_nomina->worker = array('type_worker_id' => $payroll->worker->type_worker_id,
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
                                       'salary' => $payroll->worker->salary);
 
        $objeto_nomina->payment = array('payment_method_id' => $payroll->worker->payment_method_id,
                                        'bank_name' => $payroll->worker->bank_name,
                                        'account_type' => $payroll->worker->account_type,
                                        'account_number' => $payroll->worker->account_number);
        
        $objeto_nomina->payment_dates = array(array('payment_date' => $fecha_pago));
               
        $subsidio_transporte = null;
        foreach (json_decode($payroll->accrued, true) as $value){

            switch ($value['type']) {
                case 'salario':
                    $salario = $value['value'];
                    break;
                case 'subsidio_transporte':
                    $subsidio_transporte = $value['value'];
                    break;
            }            
        }

        $accrued = array('worked_days' => $payroll->worked_days,
                            'salary' => $salario);

        if($subsidio_transporte)
            $accrued['transportation_allowance'] = $subsidio_transporte;

        $accrued["accrued_total"] = $payroll->accrued_total;

        $objeto_nomina->accrued = $accrued;
                    
        foreach (json_decode($payroll->deductions, true) as $value){
            switch ($value['type']) {
                case 'eps':
                    $deduction_eps_id = $value['id'];
                    $deduction_eps = $value['value'];
                    break;
                case 'pension':
                    $deduction_pension_id = $value['id'];
                    $deduction_pension = $value['value'];
                    break;
            }   
        }   
        
        
        $objeto_nomina->deductions = array('eps_type_law_deductions_id' => $deduction_eps_id,
                                            'eps_deduction' => $deduction_eps,
                                            'pension_type_law_deductions_id' => $deduction_pension_id,
                                            'pension_deduction' =>  $deduction_pension,
                                            'deductions_total' => $payroll->deductions_total);
        
         
       
        $this->save_file("app/public/json/".$payroll->company->id, $objeto_nomina, "Env-".$payroll->worker->identification_number."-".$resolution->prefix."-".$resolution->nex.".json");
        
        //55ed1dc8-1806-4325-9083-8bbb789f4454     
                 
        $response =  $this->send_apidian_payroll($company, $configuraciones, $objeto_nomina);
       
        $this->save_file("app/public/json/".$payroll->company->id, json_decode($response), "Rpta-".$payroll->worker->identification_number."-".$resolution->prefix."-".$resolution->nex.".json");
        
        if ($response->successful()){

            $resolution->increment('nex');

        }
        
        return json_decode($response);
    }
    
    protected function send_apidian_payroll($company, $configuraciones, $objeto_nomina){
        $response = Http::accept('application/json')
                            ->withToken($company->api_token)
                            ->post($configuraciones->url_server_api.'payroll',
                            json_decode(json_encode($objeto_nomina), true));
        return $response;           

    }



    protected function save_file($guardaren, $data, $file_name){

        if (!is_dir(storage_path($guardaren)))
            mkdir(storage_path($guardaren));

        $file = fopen(storage_path($guardaren."/".$file_name), "w");
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

}
