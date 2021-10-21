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
        $this->middleware('permission:companies.index', ['only'=>['index','show']]);
        $this->middleware('permission:companies.crear', ['only'=>['create','store']]);
        $this->middleware('permission:companies.editar', ['only'=>['edit','update']]);
        $this->middleware('permission:companies.eliminar', ['only'=>['destroy']]);
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

        return view('companies.crear', compact('tipo_documento', 'tipo_regimen', 'tipo_organizacion', 'tipo_responsabilidad',
                                             'municipios'));
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

        if ($res_company->successful()){

            $data = $request->all();
            $data['api_token'] = $res_company->json()['token'];
            
           $company = Company::create($data);

           $this->send_apidian_resolution($data['api_token'], $configuraciones);
           
            $resolution = new Resolution();
            $resolution->company_id = $company->id;
            $resolution->type_document_id = 9;
            $resolution->from = 1;
            $resolution->to = 99999999;
            $resolution->prefix = 'NI';
            $resolution->nex = 1;
            
           $resolution->save();
           
            return redirect()->route('companies.index')->with('message', 'La empresa '.$request['name'].' se creo con éxito');

        }else{
            if(isset($res_company->json()['errors'])){
                $group = $res_company->json()['errors'];
               
                foreach($group as $group_member){
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

        return view('companies.editar', compact('tipo_documento', 'tipo_regimen', 'tipo_organizacion', 'tipo_responsabilidad',
                                             'municipios', 'datatable'));
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
        $res_company = $this->send_api_dian($request->all());

        if ($res_company->successful()){

            $data = $request->all();
            $data['api_token'] = $res_company->json()['token'];
            
            $company->update($data);

            return redirect()->route('companies.index')->with('message', 'La empresa '.$request['name'].' se actualizo con éxito');

        }else{
            if(isset($res_company->json()['errors'])){
                $group = $res_company->json()['errors'];
               
                foreach($group as $group_member){
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
                            ->post($configuraciones->url_server_api.'config/'.$data['identification_number'].'/'.$data['dv'],
                            json_decode(json_encode($objeto), true));

        return $response;

    }

    protected function send_apidian_resolution($token, $configuraciones)
    {       
        $objeto = new stdClass();
        $objeto->type_document_id = 9;
        $objeto->from = 1;
        $objeto->to = 99999999;
        $objeto->prefix = 'NI';
        
        $response = Http::accept('application/json')
                            ->withToken($token)
                            ->put($configuraciones->url_server_api.'config/resolution',
                            json_decode(json_encode($objeto), true));
                            
        return $response;

    }

    
}
 