<?php

namespace App\Http\Controllers;

use App\Http\Requests\company\StoreRequest;
use App\Http\Requests\company\UpdateRequest;
use App\Models\Company;
use App\Models\Configuration;
use App\Models\Municipality;
use App\Models\Resolution;
use App\Models\Type_document_identification;
use App\Models\Type_liability;
use App\Models\Type_organization;
use App\Models\Type_regime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\Http;
use stdClass;

class CompanyController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:companies.index', ['only' => ['index', 'show']]);
        $this->middleware('permission:companies.crear', ['only' => ['create', 'store']]);
        $this->middleware('permission:companies.editar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:companies.eliminar', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd($this->send_api_dian_nomina());
        $datatable = Company::paginate(10);
        return view('companies.index', compact('datatable'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_documento = Type_document_identification::orderBy('name', 'asc')->get();

        $tipo_regimen = Type_regime::all();
        $tipo_organizacion = Type_organization::all();
        $tipo_responsabilidad = Type_liability::select('id', DB::raw('CONCAT(name, " - (" , code, ")") AS name'));

        $municipios = Municipality::join('departments', 'municipalities.department_id', '=', 'departments.id')
            ->select('municipalities.id', DB::raw('CONCAT(municipalities.name, " - (" , departments.name, ")") AS name'))
            ->orderBy('name', 'asc');

        return view('companies.crear', compact(
            'tipo_documento',
            'tipo_regimen',
            'tipo_organizacion',
            'tipo_responsabilidad',
            'municipios'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        $configuraciones = Configuration::first();
        $res_company = $this->send_apidian_company($request->all(), $configuraciones);

        if ($res_company->successful()) {

            $data = $request->all();

            //parametrizar los conceptos q suman a la base de parafiscales
            $concepts = new stdClass();

            $aid = array(
                'name' => 'Auxilios',
                'eps' => 0,
                'pension' => 0
            );
            $HEDs = array(
                'name' => 'Hora Extra Diurna',
                'eps' => 1,
                'pension' => 1
            );
            $HENs = array(
                'name' => 'Hora Extra Nocturna',
                'eps' => 1,
                'pension' => 1
            );
            $HRNs = array(
                'name' => 'Hora Recargo Nocturno',
                'eps' => 1,
                'pension' => 1
            );
            $HEDDFs = array(
                'name' => 'Hora Extra Diurna Dominical y Festivos',
                'eps' => 1,
                'pension' => 1
            );
            $HENDFs = array(
                'name' => 'Hora Extra Nocturna Dominical y Festivos',
                'eps' => 1,
                'pension' => 1
            );
            $HRDDFs = array(
                'name' => 'Hora Recargo Diurno Dominical y Festivos',
                'eps' => 1,
                'pension' => 1
            );
            $HRNDFs = array(
                'name' => 'Hora Recargo Nocturno Dominical y Festivos',
                'eps' => 1,
                'pension' => 1
            );
            $salary = array(
                'name' => 'Salario',
                'eps' => 1,
                'pension' => 1
            );
            $bonuses = array(
                'name' => 'Bonificaciones',
                'eps' => 1,
                'pension' => 1
            );
            $advances = array(
                'name' => 'Anticipos',
                'eps' => 0,
                'pension' => 0
            );
            $endowment = array(
                'name' => 'Dotacion',
                'eps' => 0,
                'pension' => 0
            );
            $severance = array(
                'name' => 'Cesantias',
                'eps' => 0,
                'pension' => 0
            );
            $paid_leave = array(
                'name' => 'Licencia Remunerada',
                'eps' => 0,
                'pension' => 0
            );
            $commissions = array(
                'name' => 'Comisiones',
                'eps' => 1,
                'pension' => 1
            );
            $compensation = array(
                'name' => 'Compensacion',
                'eps' => 0,
                'pension' => 0
            );
            $legal_strike = array(
                'name' => 'Huelgas Legales',
                'eps' => 0,
                'pension' => 0
            );
            $compensations = array(
                'name' => 'Compensaciones',
                'eps' => 0,
                'pension' => 0
            );
            $epctv_bonuses = array(
                'name' => 'Bono EPCTV',
                'eps' => 0,
                'pension' => 0
            );
            $paid_vacation = array(
                'name' => 'Vacaciones Compensadas',
                'eps' => 0,
                'pension' => 0
            );
            $service_bonus = array(
                'name' => 'Prima',
                'eps' => 0,
                'pension' => 0
            );
            $telecommuting = array(
                'name' => 'Teletrabajo',
                'eps' => 0,
                'pension' => 0
            );
            $non_paid_leave = array(
                'name' => 'Licencia no Remunerada',
                'eps' => 0,
                'pension' => 0
            );
            $other_concepts = array(
                'name' => 'Otros Devengados',
                'eps' => 0,
                'pension' => 0
            );
            $common_vacation = array(
                'name' => 'Vacaciones Comunes',
                'eps' => 0,
                'pension' => 0
            );
            $maternity_leave = array(
                'name' => 'Licencia de Materinidad',
                'eps' => 0,
                'pension' => 0
            );
            $withdrawal_bonus = array(
                'name' => 'withdrawal_bonus',
                'eps' => 0,
                'pension' => 0
            );
            $work_disabilities = array(
                'name' => 'Incapacidad',
                'eps' => 0,
                'pension' => 0
            );
            $sustenance_support = array(
                'name' => 'Apoyo a Sostenimiento',
                'eps' => 0,
                'pension' => 0
            );
            $third_party_payments = array(
                'name' => 'Pagos a Terceros',
                'eps' => 0,
                'pension' => 0
            );
            $transportation_allowance = array(
                'name' => 'Auxilio de Transporte',
                'eps' => 0,
                'pension' => 0
            );

            $concepts->concepts = array(
                'salary' => $salary,
                'transportation_allowance' => $transportation_allowance,
                'HEDs' => $HEDs,
                'HENs' => $HENs,
                'HRNs' => $HRNs,
                'HEDDFs' => $HEDDFs,
                'HRDDFs' => $HRDDFs,
                'HENDFs' => $HENDFs,
                'HRNDFs' => $HRNDFs,
                'common_vacation' => $common_vacation,
                'paid_vacation' => $paid_vacation,
                'service_bonus' => $service_bonus,
                'severance' => $severance,
                'work_disabilities' => $work_disabilities,
                'maternity_leave' => $maternity_leave,
                'paid_leave' => $paid_leave,
                'non_paid_leave' => $non_paid_leave,
                'bonuses' => $bonuses,
                'aid' => $aid,
                'legal_strike' => $legal_strike,
                'other_concepts' => $other_concepts,
                'compensations' => $compensations,
                'epctv_bonuses' => $epctv_bonuses,
                'commissions' => $commissions,
                'third_party_payments' => $third_party_payments,
                'advances' => $advances,
                'endowment' => $endowment,
                'sustenance_support' => $sustenance_support,
                'telecommuting' => $telecommuting,
                'withdrawal_bonus' => $withdrawal_bonus,
                'compensation' => $compensation,
            );

            $data['concepts_parafiscal_contributions'] = json_encode($concepts);
            $data['api_token'] = $res_company->json()['token'];

            $company = Company::create($data);

            $this->send_apidian_resolution($data['api_token'], $configuraciones, 'NI', 9);
            $this->send_apidian_resolution($data['api_token'], $configuraciones, 'NA', 10);
            //$this->send_apidian_software($data, $configuraciones);
            $this->send_apidian_softwarepayroll($data, $configuraciones);
            $this->send_apidian_environment($data, $configuraciones);

            $resolution = new Resolution();
            $resolution->company_id = $company->id;
            $resolution->type_document_id = 9;
            $resolution->from = 1;
            $resolution->to = 99999999;
            $resolution->prefix = 'NI';
            $resolution->nex = 1;
            $resolution->save();

            $resolutionNA = new Resolution();
            $resolutionNA->company_id = $company->id;
            $resolutionNA->type_document_id = 10;
            $resolutionNA->from = 1;
            $resolutionNA->to = 99999999;
            $resolutionNA->prefix = 'NA';
            $resolutionNA->nex = 1;
            $resolutionNA->save();

            return redirect()->route('companies.index')->with('message', 'La empresa ' . $request['name'] . ' se creo con éxito');
        } else {
            if (isset($res_company->json()['errors'])) {
                $group = $res_company->json()['errors'];

                foreach ($group as $group_member) {
                    //dd($group_member[0]);
                    return redirect()->back()->with('error', $group_member[0]);
                    break;
                }
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $datatable = Company::find($id);

        $tipo_documento = Type_document_identification::orderBy('name', 'asc')->get();

        $tipo_regimen = Type_regime::all();
        $tipo_organizacion = Type_organization::all();
        $tipo_responsabilidad = Type_liability::all();

        $municipios = Municipality::join('departments', 'municipalities.department_id', '=', 'departments.id')
            ->select('municipalities.id', DB::raw('CONCAT(municipalities.name, " - (" , departments.name, ")") AS name'))
            ->orderBy('name', 'asc');

        return view('companies.editar', compact(
            'tipo_documento',
            'tipo_regimen',
            'tipo_organizacion',
            'tipo_responsabilidad',
            'municipios',
            'datatable'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Company $company)
    {
        $configuraciones = Configuration::first();
        $res_company = $this->send_apidian_company($request->all(), $configuraciones);

        if ($res_company->successful()) {

            $data = $request->all();
            $data['api_token'] = $res_company->json()['token'];

            $company->update($data);

            $this->send_apidian_softwarepayroll($data, $configuraciones);
            $this->send_apidian_environment($data, $configuraciones);

            return redirect()->route('companies.index')->with('message', 'La empresa ' . $request['name'] . ' se actualizo con éxito');
        } else {
            if (isset($res_company->json()['errors'])) {
                $group = $res_company->json()['errors'];

                foreach ($group as $group_member) {
                    //dd($group_member[0]);
                    return redirect()->back()->with('error', $group_member[0]);
                    break;
                }
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index');
    }




    protected function send_apidian_company($data, $configuraciones)
    {

        $objeto = new stdClass();
        $objeto->type_document_identification_id = $data['type_document_identification_id'];
        $objeto->type_organization_id = $data['type_organization_id'];
        $objeto->type_regime_id = $data['type_regime_id'];
        $objeto->type_liability_id = $data['type_liability_id'];
        $objeto->business_name = $data['name'];
        $objeto->merchant_registration = "0000000-00";
        $objeto->municipality_id = $data['municipality_id'];
        $objeto->address = $data['address'];
        $objeto->phone = $data['phone'];
        $objeto->email = $data['email'];

        $response = Http::accept('application/json')
            ->withToken('6db6bff788eb115c68f888a7bc09834bbbe7404803a649b504653b4fd23f4e4e')
            ->post(
                $configuraciones->url_server_api . 'config/' . $data['identification_number'] . '/' . $data['dv'],
                json_decode(json_encode($objeto), true)
            );

        return $response;
    }

    protected function send_apidian_resolution($token, $configuraciones, $prefix, $type_document_id)
    {
        $objeto = new stdClass();
        $objeto->type_document_id = $type_document_id;
        $objeto->from = 1;
        $objeto->to = 99999999;
        $objeto->prefix = $prefix;

        $response = Http::accept('application/json')
            ->withToken($token)
            ->put(
                $configuraciones->url_server_api . 'config/resolution',
                json_decode(json_encode($objeto), true)
            );

        return $response;
    }

    protected function send_apidian_software($data, $configuraciones)
    {
        $objeto = new stdClass();
        $objeto->id = $data['software_id'];
        $objeto->pin = $data['software_pin'];

        $response = Http::accept('application/json')
            ->withToken($data['api_token'])
            ->put(
                $configuraciones->url_server_api . 'config/software',
                json_decode(json_encode($objeto), true)
            );

        return $response;
    }

    protected function send_apidian_softwarepayroll($data, $configuraciones)
    {
        $objeto = new stdClass();
        $objeto->idpayroll = $data['software_id'];
        $objeto->pinpayroll = $data['software_pin'];

        $response = Http::accept('application/json')
            ->withToken($data['api_token'])
            ->put(
                $configuraciones->url_server_api . 'config/softwarepayroll',
                json_decode(json_encode($objeto), true)
            );

        return $response;
    }

    protected function send_apidian_environment($data, $configuraciones)
    {
        $objeto = new stdClass();
        $objeto->type_environment_id = $data['type_environment_id'];
        $objeto->payroll_type_environment_id = $data['type_environment_id'];

        $response = Http::accept('application/json')
            ->withToken($data['api_token'])
            ->put(
                $configuraciones->url_server_api . 'config/environment',
                json_decode(json_encode($objeto), true)
            );

        return $response;
    }
}
