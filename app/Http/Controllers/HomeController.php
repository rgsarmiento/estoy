<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Company_has_user;
use App\Models\Configuration;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $cantidad_usuarios = User::count();
        $cantidad_empresas = Company::count();
        $cantidad_empleados = Worker::count();

        $configuraciones = Configuration::first();

        $user = auth()->user();
        $role_user = auth()->user()->roles->first()->id;

        if ($role_user <> 1){
            $user_id = $user->id;
            $company_has_user = Company_has_user::where('user_id', $user_id)->first();
            //dd($company_id);
            if ($company_has_user == null){
                Auth::logout();
                return redirect('/');
            }
        }else{
            //$company_id->company_id;
        }       
        
        return view('home', compact('cantidad_usuarios','cantidad_empleados','cantidad_empresas','configuraciones'));
    }
}
