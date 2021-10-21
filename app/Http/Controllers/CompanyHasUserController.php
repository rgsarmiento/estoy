<?php

namespace App\Http\Controllers;

use App\Http\Requests\company_has_user\StoreRequest;
use App\Models\Company;
use App\Models\Company_has_user;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Http;

class CompanyHasUserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:company_has_users.index', ['only'=>['index', 'show']]);
        $this->middleware('permission:company_has_users.crear', ['only'=>['create','store']]);
        $this->middleware('permission:company_has_users.editar', ['only'=>['edit','update']]);
        $this->middleware('permission:company_has_users.eliminar', ['only'=>['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company_has_users = Company_has_user::orderBy('company_id', 'asc')->paginate(10);
        return view('company_has_users.index', compact('company_has_users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $companies = Company::select('id', DB::raw('CONCAT(name, " - (" , identification_number, ")") AS name'));
        $users = User::all();

        return view('company_has_users.crear', compact('companies','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        Company_has_user::create($request->all());
        return redirect()->route('company_has_user.index')->with('message', 'La relacion se creo con éxito');;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company_has_user  $company_has_user
     * @return \Illuminate\Http\Response
     */
    public function show(Company_has_user $company_has_user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company_has_user  $company_has_user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $company_has_user = Company_has_user::find($id);

        $companies = Company::select('id', DB::raw('CONCAT(name, " - (" , identification_number, ")") AS name'));
        $users = User::all();

        return view('company_has_users.crear', compact('companies','users','company_has_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company_has_user  $company_has_user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company_has_user $company_has_user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company_has_user  $company_has_user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company_has_user $company_has_user)
    {        
        $company_has_user->delete();
        return redirect()->route('company_has_user.index')->with('eliminar', 'La relacion se ha eliminado');
    }
}
