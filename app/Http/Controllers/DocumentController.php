<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Company_has_user;
use App\Models\Configuration;
use App\Models\Document;
use App\Models\Period;
use App\Models\Resolution;
use App\Models\Type_accrued;
use App\Models\Type_deduction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use stdClass;
use Exception;

class DocumentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:documents.index', ['only' => ['index', 'show']]);
        $this->middleware('permission:documents.download', ['only' => ['download_apidian_payroll']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = auth()->user();
        $role_user = auth()->user()->roles->first()->id;
        $company_id = 0;

        if ($role_user <> 1) {
            $user_id = $user->id;
            $company_has_user = Company_has_user::where('user_id', $user_id)->first();

            if ($company_has_user == null) {
                Auth::logout();
                return redirect('/');
            } else {
                $company_id = $company_has_user->company_id;
            }
        }

        $documentosAgrupados = Document::where('company_id', $company_id)->where('state_document_id', 1)
            ->select(DB::raw('count(id) as nworkers'), 'period_id', DB::raw('sum(accrued_total) as accrued_total'), DB::raw('sum(deductions_total) as deductions_total'), DB::raw('sum(payroll_total) as payroll_total'))
            ->groupBy('period_id')
            ->orderBy('period_id', 'desc');

        $totalNominas = $documentosAgrupados->get()->sum('payroll_total');
        $nRegistros = count($documentosAgrupados->get());

        $documentosAgrupados = $documentosAgrupados->paginate(10);

        return view('documents.index', compact('documentosAgrupados', 'totalNominas', 'nRegistros'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $busqueda = strval(trim($request->get('busqueda'))); //para filtrar busqueda
        $period_id = $request->get('period_id');

        $user = auth()->user();
        $role_user = auth()->user()->roles->first()->id;
        $company_id = 0;

        if ($role_user <> 1) {
            $user_id = $user->id;
            $company_has_user = Company_has_user::where('user_id', $user_id)->first();

            if ($company_has_user == null) {
                Auth::logout();
                return redirect('/');
            } else {
                $company_id = $company_has_user->company_id;
            }
        }


        if ($company_id == 0) {
            $documents = Document::where('period_id', $period_id)->where('state_document_id', 1);
        } else {
            $documents = Document::where('company_id', $company_id)->where('period_id', $period_id)->where('state_document_id', 1);
        }


        if ($busqueda != "") {

            $documents = $documents->whereHas('worker', function ($query) use ($busqueda) {
                return $query->where('first_name', 'LIKE', '%' . $busqueda . '%')
                    ->orWhere('surname', 'LIKE', '%' . $busqueda . '%')
                    ->orWhere('identification_number', $busqueda);
            })->orWhere('consecutive', $busqueda);
        }


        $totalNomina = $documents->sum('payroll_total');
        $nRegistros = count($documents->get());

        $documents = $documents->orderBy('consecutive', 'asc')->paginate(10);

        return view('documents.show', compact('documents', 'period_id', 'totalNomina', 'nRegistros'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        $configuraciones = Configuration::first();
        $type_deductions = Type_deduction::where('status_type_deduction', '1')->get();
        $type_accrueds = Type_accrued::where('status_type_accrued', '1')->get();
        return view('documents.editar', compact('document', 'type_deductions', 'type_accrueds', 'configuraciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        $data = $request->all();
        $this->send_payroll_adjust_note($document,  $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function download_apidian_payroll(Document $document, $type)
    {
        $configuraciones = Configuration::first();

        switch ($type) {
            case 'pdf':
                $nameFile = $document->pdf;
                break;
            case 'xml':
                $nameFile = $document->xml;
                break;
        }

        $nitCompani = $document->company->identification_number;

        $response = Http::accept('application/json')
            ->get(
                str_replace('ubl2.1/', '', $configuraciones->url_server_api) . 'invoice/' . $nitCompani . '/' . $nameFile
            );

        header('Content-type: ' . 'application/octet-stream');
        header('Content-Disposition: ' . 'attachment; filename=' . $nameFile);

        return $response;
    }


    public function send_payroll_adjust_note(Document $document, $data_na)
    {

        $periodo_id = $document->period_id;
        $fecha_pago = $document->payment_date;

        $periodo = Period::find($periodo_id);
        $company = Company::find($document->company_id);

        $configuraciones = Configuration::first();
        $resolution = Resolution::where('company_id', $document->company_id)->where('type_document_id', 10)->first();

        $objeto_nomina = new stdClass();
        $objeto_nomina->type_document_id = 10; //nomina individual de ajuste
        $objeto_nomina->type_note = 1;
        //$objeto_nomina->establishment_name = $payroll->company->name;
        //$objeto_nomina->establishment_address = $payroll->company->address;
        //$objeto_nomina->establishment_phone = $payroll->company->phone;
        //$objeto_nomina->establishment_municipality = $payroll->company->municipality_id;
        //$objeto_nomina->establishment_email = $payroll->company->email;
        //$objeto_nomina->head_note= "PRUEBA TEXTO CABEZA";
        //$objeto_nomina->foot_note= "PRUEBA TEXTO PIE";

        $objeto_nomina->predecessor = array(
            'predecessor_number' => $document->consecutive,
            'predecessor_cune' => $document->cune,
            'predecessor_issue_date' => substr($document->date_issue, 0, 10)
        );


        $fechaHora = Carbon::now();
        //e debe indicar la Fecha de Ingreso del trabajador a la empresa, en formato AAAA‐MM‐DD
        $objeto_nomina->period = array(
            'admision_date' => $document->worker->admision_date,
            //Se debe indicar la Fecha de Inicio del Periodo de liquidación del documento, en formato AAAA‐MM‐D
            'settlement_start_date' => $periodo->date_from,
            //Se debe indicar la Fecha de Fin del Periodo de liquidación del documento, en formato AAAA‐MM‐DD
            'settlement_end_date' => $periodo->date_to,
            //Cantidad de Tiempo que lleva laborando el Trabajador en la empresa
            'worked_time' => strval(Carbon::parse($document->worker->admision_date)->diffInDays($periodo->date_to)),
            //fecha de emisión: Fecha de emisión del documento
            'issue_date' => $fechaHora->format('Y-m-d'),
        );
        //date("Y-m-d H:i:s");

        $objeto_nomina->worker_code = strval($document->worker->identification_number);
        $objeto_nomina->prefix = $resolution->prefix;
        $objeto_nomina->consecutive = $resolution->nex;
        $objeto_nomina->payroll_period_id = 4;
        $objeto_nomina->notes = $document->notes;

        $objeto_nomina->worker = array(
            'type_worker_id' => $document->worker->type_worker_id,
            'sub_type_worker_id' => $document->worker->sub_type_worker_id,
            'payroll_type_document_identification_id' => $document->worker->payroll_type_document_identification_id,
            'municipality_id' => $document->worker->municipality_id,
            'type_contract_id' => $document->worker->type_contract_id,
            'high_risk_pension' => boolval($document->worker->high_risk_pension),
            'identification_number' => (int)$document->worker->identification_number,
            'surname' => $document->worker->surname,
            'second_surname' => is_null($document->worker->second_surname) ? '' : $document->worker->second_surname,
            'first_name' => $document->worker->first_name,
            'address' => $document->worker->address,
            'integral_salarary' => boolval($document->worker->integral_salarary),
            'salary' => str_replace(',', '', number_format($document->worker->salary, 2))
        );

        $objeto_nomina->payment = array(
            'payment_method_id' => $document->worker->payment_method_id,
            'bank_name' => $document->worker->bank_name,
            'account_type' => $document->worker->account_type,
            'account_number' => $document->worker->account_number
        );

        $objeto_nomina->payment_dates = json_decode($fecha_pago, true);


        //Devengados

        $devengados_json = json_decode($data_na['accrued'], true);

        $salario = $devengados_json['devengados']['salary']['value'];
        $common_vacation = $devengados_json['devengados']['common_vacation'];
        $paid_vacation = $devengados_json['devengados']['paid_vacation'];
        $maternity_leave = $devengados_json['devengados']['maternity_leave'];
        $paid_leave = $devengados_json['devengados']['paid_leave'];
        $non_paid_leave = $devengados_json['devengados']['non_paid_leave'];
        $legal_strike = $devengados_json['devengados']['legal_strike'];

        $HEDs = $devengados_json['devengados']['HEDs'];
        $HENs = $devengados_json['devengados']['HENs'];
        $HRNs = $devengados_json['devengados']['HRNs'];
        $HEDDFs = $devengados_json['devengados']['HEDDFs'];
        $HRDDFs = $devengados_json['devengados']['HRDDFs'];
        $HENDFs = $devengados_json['devengados']['HENDFs'];
        $HRNDFs = $devengados_json['devengados']['HRNDFs'];

        $work_disabilities = $devengados_json['devengados']['work_disabilities'];
        $service_bonus = $devengados_json['devengados']['service_bonus'];
        $severance = $devengados_json['devengados']['severance'];
        $other_concepts = $devengados_json['devengados']['other_concepts'];
        $compensations = $devengados_json['devengados']['compensations'];

        $accrued = array(
            'worked_days' => $data_na['worked_days'],
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
                    //'start_date' => $key['start_date'],
                    //'end_date' => $key['end_date'],
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

        if (count($non_paid_leave) > 0) {
            $accrued['non_paid_leave'] = array();
            foreach ($non_paid_leave as $key) {
                $non_paid_leave = array(
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'quantity' => $key['quantity']
                );
                array_push($accrued['non_paid_leave'], $non_paid_leave);
            }
        }

        if (count($legal_strike) > 0) {
            $accrued['legal_strike'] = array();
            foreach ($legal_strike as $key) {
                $legal_strike = array(
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'quantity' => $key['quantity']
                );
                array_push($accrued['legal_strike'], $legal_strike);
            }
        }

        if (count($HEDs) > 0) {
            $accrued['HEDs'] = array();
            foreach ($HEDs as $key) {
                $HEDs = array(
                    'start_time' => $key['start_time'] . ':00',
                    'end_time' => $key['end_time'] . ':00',
                    'quantity' => $key['quantity'],
                    'percentage' => $key['percentage'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['HEDs'], $HEDs);
            }
        }

        if (count($HENs) > 0) {
            $accrued['HENs'] = array();
            foreach ($HENs as $key) {
                $HENs = array(
                    'start_time' => $key['start_time'] . ':00',
                    'end_time' => $key['end_time'] . ':00',
                    'quantity' => $key['quantity'],
                    'percentage' => $key['percentage'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['HENs'], $HENs);
            }
        }

        if (count($HRNs) > 0) {
            $accrued['HRNs'] = array();
            foreach ($HRNs as $key) {
                $HRNs = array(
                    'start_time' => $key['start_time'] . ':00',
                    'end_time' => $key['end_time'] . ':00',
                    'quantity' => $key['quantity'],
                    'percentage' => $key['percentage'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['HRNs'], $HRNs);
            }
        }

        if (count($HEDDFs) > 0) {
            $accrued['HEDDFs'] = array();
            foreach ($HEDDFs as $key) {
                $HEDDFs = array(
                    'start_time' => $key['start_time'] . ':00',
                    'end_time' => $key['end_time'] . ':00',
                    'quantity' => $key['quantity'],
                    'percentage' => $key['percentage'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['HEDDFs'], $HEDDFs);
            }
        }

        if (count($HRDDFs) > 0) {
            $accrued['HRDDFs'] = array();
            foreach ($HRDDFs as $key) {
                $HRDDFs = array(
                    'start_time' => $key['start_time'] . ':00',
                    'end_time' => $key['end_time'] . ':00',
                    'quantity' => $key['quantity'],
                    'percentage' => $key['percentage'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['HRDDFs'], $HRDDFs);
            }
        }

        if (count($HENDFs) > 0) {
            $accrued['HENDFs'] = array();
            foreach ($HENDFs as $key) {
                $HENDFs = array(
                    'start_time' => $key['start_time'] . ':00',
                    'end_time' => $key['end_time'] . ':00',
                    'quantity' => $key['quantity'],
                    'percentage' => $key['percentage'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['HENDFs'], $HENDFs);
            }
        }

        if (count($HRNDFs) > 0) {
            $accrued['HRNDFs'] = array();
            foreach ($HRNDFs as $key) {
                $HRNDFs = array(
                    'start_time' => $key['start_time'] . ':00',
                    'end_time' => $key['end_time'] . ':00',
                    'quantity' => $key['quantity'],
                    'percentage' => $key['percentage'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['HRNDFs'], $HRNDFs);
            }
        }

        if (count($work_disabilities) > 0) {
            $accrued['work_disabilities'] = array();
            foreach ($work_disabilities as $key) {
                $work_disabilities = array(
                    'start_date' => $key['start_date'],
                    'end_date' => $key['end_date'],
                    'type' => $key['type'],
                    'quantity' => $key['quantity'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['work_disabilities'], $work_disabilities);
            }
        }

        if (count($service_bonus) > 0) {
            $accrued['service_bonus'] = array();
            foreach ($service_bonus as $key) {
                $service_bonus = array(
                    'quantity' => $key['quantity'],
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['service_bonus'], $service_bonus);
            }
        }

        if (count($severance) > 0) {
            $accrued['severance'] = array();
            foreach ($severance as $key) {
                $severance = array(
                    'percentage' => strval($key['percentage']),
                    'interest_payment' => str_replace(',', '', number_format($key['interest_payment'], 2)),
                    'payment' => str_replace(',', '', number_format($key['payment'], 2))
                );
                array_push($accrued['severance'], $severance);
            }
        }

        if (count($compensations) > 0) {
            $accrued['compensations'] = array();
            foreach ($compensations as $key) {
                $compensations = array(
                    'ordinary_compensation' => str_replace(',', '', number_format($key['ordinary_compensation'], 2)),
                    'extraordinary_compensation' => str_replace(',', '', number_format($key['extraordinary_compensation'], 2))                    
                );
                array_push($accrued['compensations'], $compensations);
            }
        }

        if (count($other_concepts) > 0) {
            $accrued['other_concepts'] = array();
            foreach ($other_concepts as $key) {
               
                    $other_concepts = array(
                        'salary_concept' => str_replace(',', '', number_format($key['salary_concept'], 2)),
                        'description_concept' => $key['description_concept']                    
                    );
                               
                array_push($accrued['other_concepts'], $other_concepts);
            }
        }


        $accrued["accrued_total"] = str_replace(',', '', number_format($data_na['accrued_total'], 2));

        $objeto_nomina->accrued = $accrued;

        //Deducciones

        $deducciones_json = json_decode($data_na['deductions'], true);

        $other_deductions = $deducciones_json['deducciones']['other_deductions'];

        $debt = $deducciones_json['deducciones']['debt'];
        $voluntary_pension = $deducciones_json['deducciones']['voluntary_pension'];
        $withholding_at_source = $deducciones_json['deducciones']['withholding_at_source'];
        $afc = $deducciones_json['deducciones']['afc'];
        $cooperative = $deducciones_json['deducciones']['cooperative'];
        $tax_liens = $deducciones_json['deducciones']['tax_liens'];
        $supplementary_plan = $deducciones_json['deducciones']['supplementary_plan'];
        $education = $deducciones_json['deducciones']['education'];
        $refund = $deducciones_json['deducciones']['refund'];

        $deductions = array(
            'deductions_total' => str_replace(',', '', number_format($data_na['deductions_total'], 2))
        );


        if ($deducciones_json['deducciones']['eps_type_law_deduction']) {
            $deduction_eps_id = $deducciones_json['deducciones']['eps_type_law_deduction']['id'];
            $deduction_eps = $deducciones_json['deducciones']['eps_type_law_deduction']['value'];
            $deductions['eps_type_law_deductions_id'] = $deduction_eps_id;
            $deductions['eps_deduction'] = str_replace(',', '', number_format($deduction_eps, 2));
        }

        if ($deducciones_json['deducciones']['pension_type_law_deductions']) {
            $deduction_pension_id = $deducciones_json['deducciones']['pension_type_law_deductions']['id'];
            $deduction_pension = $deducciones_json['deducciones']['pension_type_law_deductions']['value'];
            $deductions['pension_type_law_deductions_id'] = $deduction_pension_id;
            $deductions['pension_deduction'] = str_replace(',', '', number_format($deduction_pension, 2));
        }

        if (count($other_deductions) > 0) {
            $deductions['other_deductions'] = array();
            foreach ($other_deductions as $key) {
                $other_deduction = array(
                    'other_deduction' => str_replace(',', '', number_format($key['value'], 2))
                );
                array_push($deductions['other_deductions'], $other_deduction);
            }
        }


        if ($deducciones_json['deducciones']['voluntary_pension']) {
            $voluntary_pension = $deducciones_json['deducciones']['voluntary_pension']['value'];
            $deductions['voluntary_pension'] = str_replace(',', '', number_format($voluntary_pension, 2));
        }

        if ($deducciones_json['deducciones']['debt']) {
            $debt = $deducciones_json['deducciones']['debt']['value'];
            $deductions['debt'] = str_replace(',', '', number_format($debt, 2));
        }

        if ($deducciones_json['deducciones']['refund']) {
            $refund = $deducciones_json['deducciones']['refund']['value'];
            $deductions['refund'] = str_replace(',', '', number_format($refund, 2));
        }

        if ($deducciones_json['deducciones']['education']) {
            $education = $deducciones_json['deducciones']['education']['value'];
            $deductions['education'] = str_replace(',', '', number_format($education, 2));
        }

        if ($deducciones_json['deducciones']['supplementary_plan']) {
            $supplementary_plan = $deducciones_json['deducciones']['supplementary_plan']['value'];
            $deductions['supplementary_plan'] = str_replace(',', '', number_format($supplementary_plan, 2));
        }

        if ($deducciones_json['deducciones']['tax_liens']) {
            $tax_liens = $deducciones_json['deducciones']['tax_liens']['value'];
            $deductions['tax_liens'] = str_replace(',', '', number_format($tax_liens, 2));
        }

        if ($deducciones_json['deducciones']['cooperative']) {
            $cooperative = $deducciones_json['deducciones']['cooperative']['value'];
            $deductions['cooperative'] = str_replace(',', '', number_format($cooperative, 2));
        }

        if ($deducciones_json['deducciones']['afc']) {
            $afc = $deducciones_json['deducciones']['afc']['value'];
            $deductions['afc'] = str_replace(',', '', number_format($afc, 2));
        }

        if ($deducciones_json['deducciones']['withholding_at_source']) {
            $withholding_at_source = $deducciones_json['deducciones']['withholding_at_source']['value'];
            $deductions['withholding_at_source'] = str_replace(',', '', number_format($withholding_at_source, 2));
        }

        if ($deducciones_json['deducciones']['fondosp']) {
            $fondosp_deduction_SP = $deducciones_json['deducciones']['fondosp']['fondosp_deduction_SP'];
            $fondosp_deduction_sub = $deducciones_json['deducciones']['fondosp']['fondosp_deduction_sub'];
            $deductions['fondossp_type_law_deductions_id'] = 9;
            $deductions['fondosp_deduction_SP'] = str_replace(',', '', number_format($fondosp_deduction_SP, 2));
            $deductions['fondossp_sub_type_law_deductions_id'] = 9;
            $deductions['fondosp_deduction_sub'] = str_replace(',', '', number_format($fondosp_deduction_sub, 2));            
        }


        $objeto_nomina->deductions = $deductions;


        $this->save_file("app/public/json/" . $document->company->id, $objeto_nomina, "Env-" . $document->worker->identification_number . "-" . $resolution->prefix . "-" . $resolution->nex . ".json");
        $response =  $this->send_apidian_payroll_adjust_note($company, $configuraciones, $objeto_nomina);
        $this->save_file("app/public/json/" . $document->company->id, json_decode($response), "Rpta-" . $document->worker->identification_number . "-" . $resolution->prefix . "-" . $resolution->nex . ".json");



        try {
         
            if ($response->successful()) {

                
                $isValid = ($response['ResponseDian']['Envelope']['Body']['SendNominaSyncResponse']['SendNominaSyncResult']['IsValid'] === 'true') ? true : false;
                $StatusCode = $response['ResponseDian']['Envelope']['Body']['SendNominaSyncResponse']['SendNominaSyncResult']['StatusCode'];
                $StatusMessage = $response['ResponseDian']['Envelope']['Body']['SendNominaSyncResponse']['SendNominaSyncResult']['StatusMessage'];

                if ($isValid || $StatusCode == "299" || str_ends_with($StatusMessage, "ha sido autorizada.")) {
                    $this->store_documents($document, $data_na, $periodo_id, $objeto_nomina, $response, 1, $fechaHora);
                    //aumentar prefijo
                    $resolution->increment('nex');
                    return redirect()->route('documents.index')->with('message', 'La Nomina de Ajuste del empleado ' . ' ' . $document->worker->first_name . ' ' . $document->worker->surname . ' ' . 'se envio con éxito a la DIAN con codigo de estado: ' . $StatusCode);
                } else {
                    
                    $this->store_documents($document, $data_na, $periodo_id, $objeto_nomina, $response, 0, $fechaHora);
                    //$ErrorMessage = $response['ResponseDian']['Envelope']['Body']['SendNominaSyncResponse']['SendNominaSyncResult']['ErrorMessage']['string'];
                    
                    return redirect()->route('documents.index')->with('error', 'La Nomina de Ajuste del empleado ' . ' ' . $document->worker->first_name . ' ' . $document->worker->surname . ' ' . 'No se pudo enviar.');
                }
            }

        } catch (Exception $e) {
            return $e->getMessage();
        }
        return json_decode($response);
    }

    protected function send_apidian_payroll_adjust_note($company, $configuraciones, $objeto_nomina)
    { //55ed1dc8-1806-4325-9083-8bbb789f4454   

        $response = Http::accept('application/json')
            ->withToken($company->api_token)
            ->post(
                $configuraciones->url_server_api . 'payroll-adjust-note',
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


    protected function store_documents($document_, $data_na, $period_id, $objeto_nomina, $respuesta, $state_document_id, $fechaHora)
    {

        $user = auth()->user();

        $document = new Document();
        $document->user_id = $user->id;
        $document->company_id = $document_->company_id;
        $document->worker_id = $document_->worker_id;
        $document->parent_id = $document_->id;
        $document->worked_days = $data_na['worked_days'];
        $document->accrued = $data_na['accrued'];
        $document->accrued_total = $data_na['accrued_total'];
        $document->deductions = $data_na['deductions'];
        $document->deductions_total = $data_na['deductions_total'];
        $document->notes = $data_na['notes'];
        $document->payroll_total = $data_na['payroll_total'];
        $document->state_document_id = $state_document_id;
        $document->type_document_id = 10;
        $document->period_id = $period_id;
        $document->date_issue = $fechaHora->format('Y-m-d H:i:s');
        $document->prefix = $objeto_nomina->prefix;
        $document->consecutive = $objeto_nomina->consecutive;
        $document->payment_date = json_encode($objeto_nomina->payment_dates);
        $document->xml = $respuesta['urlpayrollxml'];
        $document->pdf = $respuesta['urlpayrollpdf'];
        $document->cune = $respuesta['cune'];
        
        $document->save();

        $document_->update(['parent_id' => $document->id, 'state_document_id' => 2]);
    }
}
