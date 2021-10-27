<?php

namespace App\Http\Controllers;

use App\Http\Requests\worker\StoreRequest;
use App\Http\Requests\worker\UpdateRequest;
use App\Models\Company_has_user;
use App\Models\Configuration;
use App\Models\Department;
use App\Models\Municipality;
use App\Models\Payment_method;
use App\Models\Payroll;
use App\Models\Payroll_period;
use App\Models\Payroll_type_document_identification;
use App\Models\Sub_type_worker;
use App\Models\Type_contract;
use App\Models\Type_pension_law_deduction;
use App\Models\Type_salud_law_deduction;
use App\Models\Type_worker;
use Illuminate\Http\Request;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:workers.index', ['only' => ['index', 'show']]);
        $this->middleware('permission:workers.crear', ['only' => ['create', 'store']]);
        $this->middleware('permission:workers.editar', ['only' => ['edit', 'update']]);
        $this->middleware('permission:workers.eliminar', ['only' => ['destroy']]);
    }
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

        if ($company_id == 1) {
            $workers = Worker::paginate(5);
        } else {
            $workers = Worker::where('company_id', $company_id)->paginate(5);
        }


        return view('workers.index', compact('workers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipo_documento = Payroll_type_document_identification::orderBy('name', 'asc')->get();

        $municipios = Municipality::join('departments', 'municipalities.department_id', '=', 'departments.id')
            ->select('municipalities.id', DB::raw('CONCAT(municipalities.name, " - (" , departments.name, ")") AS name'))
            ->orderBy('name', 'asc');

        $tipo_contrato = Type_contract::all();
        $tipo_empleado = Type_worker::orderBy('code', 'asc')->get();
        $sub_tipo_empleado = Sub_type_worker::orderBy('code', 'asc')->get();
        $periodo_nomina = Payroll_period::all();
        $eps_deduccion = Type_salud_law_deduction::select('id', DB::raw('CONCAT(name, " - (% Aplicado ", percentage, ")") AS name'))->get();
        $pension_deduccion = Type_pension_law_deduction::select('id', DB::raw('CONCAT(name, " - (% Aplicado ", percentage, ")") AS name'))->get();

        $metodo_pago = Payment_method::orderBy('name', 'asc')->get();

        $configuraciones = Configuration::first();

        return view('workers.crear', compact(
            'tipo_documento',
            'tipo_contrato',
            'tipo_empleado',
            'sub_tipo_empleado',
            'periodo_nomina',
            'eps_deduccion',
            'pension_deduccion',
            'metodo_pago',
            'municipios',
            'configuraciones'
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

        $data = $request->all();

        if ($request->input('high_risk_pension')) {
            $data['high_risk_pension'] = 1;
        } else {
            $data['high_risk_pension'] = 0;
        }

        if ($request->input('integral_salarary')) {
            $data['integral_salarary'] = 1;
        } else {
            $data['integral_salarary'] = 0;
        }

        if ($request->input('transportation_allowance')) {
            $data['transportation_allowance'] = 1;
        } else {
            $data['transportation_allowance'] = 0;
        }

        $decimal = str_replace(",", ".", $request->input('salary'));
        $salario = number_format($decimal, 2, ".", "");

        //Carbon:now('America/Colombia');
        $data['user_id'] = $user->id;
        $data['company_id'] = $company_id;
        $data['salary'] = $salario;

        //Worker::create($request->all());
        $worker = Worker::create($data);

        //crear nomina base
        $configuraciones = Configuration::first();
        $payroll = new Payroll;

        $payroll->company_id = $company_id;
        $payroll->worker_id = $worker->id;

        //Devengados
        $accrued = array();

        $accrued[] = array(
            'type' => 'salario',
            'name' => 'Salario',
            'value' => $worker->salary
        );

        $accrued_total = $worker->salary;

        //if ($worker->integral_salarary == 0 || $worker->salary < $configuraciones->minimum_salary * 2){
        if ($worker->transportation_allowance == 1 ){
            $accrued[] = array(
                'type' => 'subsidio_transporte',
                'name' => 'Subsidio Transporte',
                'value' => $configuraciones->transport_allowance
            );
            $accrued_total += $configuraciones->transport_allowance;
        }
       
        $payroll->accrued = json_encode($accrued);
        $payroll->accrued_total = $accrued_total;

         //Deducciones   
         $deductions = array();
         $deductions[] = array(
             'type' => 'eps',
             'id' => $worker->type_salud_law_deduction->id,
             'name' => $worker->type_salud_law_deduction->name . ' % ' . $worker->type_salud_law_deduction->percentage,
             'value' => $worker->salary * $worker->type_salud_law_deduction->percentage / 100
         );
 
         $deductions_total = $worker->salary * $worker->type_salud_law_deduction->percentage / 100;

         $deductions[] = array(
             'type' => 'pension',
             'id' => $worker->type_pension_law_deduction->id,
             'name' => $worker->type_pension_law_deduction->name . ' % ' . $worker->type_pension_law_deduction->percentage,
             'value' => $worker->salary * $worker->type_pension_law_deduction->percentage / 100
         );
         
         $deductions_total += $worker->salary * $worker->type_pension_law_deduction->percentage / 100;

        $payroll->deductions = json_encode($deductions);
        $payroll->deductions_total = $deductions_total;
        $payroll->payroll_total = $accrued_total - $deductions_total;

        $payroll->save();

        return redirect()->route('workers.index')->with('message', 'El empleado ' . $data['first_name'] . ' ' . $data['surname'] . ' se creo con éxito');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Worker $worker)
    {
        //
        return view('workers.show', compact('worker'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $worker = Worker::find($id);

        $tipo_documento = Payroll_type_document_identification::orderBy('name', 'asc')->get();
        $municipios = Municipality::join('departments', 'municipalities.department_id', '=', 'departments.id')
            ->select('municipalities.id', DB::raw('CONCAT(municipalities.name, " - (" , departments.name, ")") AS name'))
            ->orderBy('name', 'asc');

        $tipo_contrato = Type_contract::all();
        $tipo_empleado = Type_worker::orderBy('code', 'asc')->get();
        $sub_tipo_empleado = Sub_type_worker::orderBy('code', 'asc')->get();
        $periodo_nomina = Payroll_period::all();
        $eps_deduccion = Type_salud_law_deduction::all();
        $pension_deduccion = Type_pension_law_deduction::all();

        $metodo_pago = Payment_method::orderBy('name', 'asc')->get();

        $configuraciones = Configuration::first();

        return view('workers.editar', compact(
            'worker',
            'tipo_documento',
            'tipo_contrato',
            'tipo_empleado',
            'sub_tipo_empleado',
            'periodo_nomina',
            'eps_deduccion',
            'pension_deduccion',
            'metodo_pago',
            'municipios',
            'configuraciones'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Worker $worker)
    {
        $data = $request->all();

        if ($request->input('high_risk_pension')) {
            $data['high_risk_pension'] = 1;
        } else {
            $data['high_risk_pension'] = 0;
        }

        if ($request->input('integral_salarary')) {
            $data['integral_salarary'] = 1;
        } else {
            $data['integral_salarary'] = 0;
        }

        if ($request->input('transportation_allowance')) {
            $data['transportation_allowance'] = 1;
        } else {
            $data['transportation_allowance'] = 0;
        }

        $decimal = str_replace(",", ".", $request->input('salary'));
        $salario = number_format($decimal, 2, ".", "");

        $data['salary'] = $salario;

        $worker->update($data);

         //crear nomina base
         $configuraciones = Configuration::first();
         $payroll = Payroll::where('worker_id', $worker->id)->first();
                 
         //Devengados
         $accrued = array();
 
         $accrued[] = array(
             'type' => 'salario',
             'name' => 'Salario',
             'value' => $worker->salary
         );
 
         $accrued_total = $worker->salary;
 
         //if ($worker->integral_salarary == 0 || $worker->salary < $configuraciones->minimum_salary * 2){
         if ($worker->transportation_allowance == 1 ){
             $accrued[] = array(
                 'type' => 'subsidio_transporte',
                 'name' => 'Subsidio Transporte',
                 'value' => $configuraciones->transport_allowance
             );
             $accrued_total += $configuraciones->transport_allowance;
         }
        
         $payroll->accrued = json_encode($accrued);
         $payroll->accrued_total = $accrued_total;
 
          //Deducciones   
          $deductions = array();
          $deductions[] = array(
              'type' => 'eps',
              'id' => $worker->type_salud_law_deduction->id,
              'name' => $worker->type_salud_law_deduction->name . ' % ' . $worker->type_salud_law_deduction->percentage,
              'value' => $worker->salary * $worker->type_salud_law_deduction->percentage / 100
          );
  
          $deductions_total = $worker->salary * $worker->type_salud_law_deduction->percentage / 100;
 
          $deductions[] = array(
              'type' => 'pension',
              'id' => $worker->type_pension_law_deduction->id,
              'name' => $worker->type_pension_law_deduction->name . ' % ' . $worker->type_pension_law_deduction->percentage,
              'value' => $worker->salary * $worker->type_pension_law_deduction->percentage / 100
          );
          
          $deductions_total += $worker->salary * $worker->type_pension_law_deduction->percentage / 100;
 
         $payroll->deductions = json_encode($deductions);
         $payroll->deductions_total = $deductions_total;
         $payroll->payroll_total = $accrued_total - $deductions_total;
 
         $payroll->update();
        
        return redirect()->route('workers.index')->with('message', 'El empleado' . ' ' . $data['first_name'] . ' ' . $data['surname'] . ' ' . 'se actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Worker $worker)
    {
        $worker->delete();
        return redirect()->route('workers.index')->with('eliminar', 'El empleado' . ' ' . $worker->first_name . ' ' . $worker->surname . ' ' . 'se elimino.');
    }

    public function change_status(Worker $worker)
    {
        //dd($worker);
        if ($worker->status == 'ACTIVO') {
            $worker->update(['status' => 'INACTIVO']);
            return redirect()->back();
        } else {
            $worker->update(['status' => 'ACTIVO']);
            return redirect()->back();
            //return redirect()->route('workers.index');
        }
    }
}
