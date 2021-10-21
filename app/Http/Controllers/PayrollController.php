<?php

namespace App\Http\Controllers;

use App\Models\Company_has_user;
use App\Models\Payroll;
use App\Models\Payroll_period;
use App\Models\Period;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $company_id = 1;

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

        if ($company_id == 0) {
            $payrolls = Payroll::with('worker')->where('status', 'ACTIVO')->paginate(20);
        } else {
            $payrolls = Payroll::with('worker')->where('status', 'ACTIVO')->where('company_id', $company_id)->paginate(20);
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


    public function send_apidian_payroll(Payroll $payroll)
    {


        //return $payroll->worker->admision_date;
        
        $objeto_nomina = new stdClass();
        $objeto_nomina->type_document_id= 9;//nomina individual
        $objeto_nomina->establishment_name= $payroll->company->name;
        $objeto_nomina->establishment_address= $payroll->company->address;
        $objeto_nomina->establishment_phone= $payroll->company->phone;
        $objeto_nomina->establishment_municipality= $payroll->company->municipality_id;
        $objeto_nomina->establishment_email= $payroll->company->email;
        $objeto_nomina->head_note= "PRUEBA TEXTO CABEZA";
        $objeto_nomina->foot_note= "PRUEBA TEXTO PIE";

        $objeto_nomina->novelty = array('novelty' => false,
                                        'uuidnov' => "");

        //e debe indicar la Fecha de Ingreso del trabajador a la empresa, en formato AAAA‐MM‐DD
        $objeto_nomina->period = array('admision_date' => $payroll->worker->admision_date,
        //Se debe indicar la Fecha de Inicio del Periodo de liquidación del documento, en formato AAAA‐MM‐D
                                       'settlement_start_date' => "2021-07-01", 
        //Se debe indicar la Fecha de Fin del Periodo de liquidación del documento, en formato AAAA‐MM‐DD
                                       'settlement_end_date' => "2021-07-15",
        //Cantidad de Tiempo que lleva laborando el Trabajador en la empresa
                                       'worked_time' => "30.00",
        //echa de emisión: Fecha de emisión del documento
                                       'issue_date' => "2021-07-28",);

        $objeto_nomina->worker_code = strval($payroll->worker->identification_number);
        $objeto_nomina->prefix = "NE";
        $objeto_nomina->consecutive = 1;
        $objeto_nomina->payroll_period_id= 4;
        $objeto_nomina->notes = "NOMINA ELECTRONICA";

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
        
        $objeto_nomina->payment_dates = array(array('payment_date' => "2021-03-10"));
               
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
        $objeto_nomina->accrued = array('worked_days' => $payroll->worked_days,
                                        'salary' => $salario,
                                        'transportation_allowance' => $subsidio_transporte,
                                        'accrued_total' => $payroll->accrued_total);
                    
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
        
           
        return json_encode($objeto_nomina);
    }

}
