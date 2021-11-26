<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\Company_has_user;
use App\Models\Configuration;
use App\Models\Worker;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use stdClass;

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
        

        $configuraciones = Configuration::first();

        $user = auth()->user();
        $role_user = auth()->user()->roles->first()->id;

        if ($role_user <> 1){
            $user_id = $user->id;
            $company_has_user = Company_has_user::where('user_id', $user_id)->first();
            $cantidad_empleados = Worker::where('company_id', $company_has_user->company_id)->count();
            if ($company_has_user == null){
                Auth::logout();
                return redirect('/');
            }
        }else{
            $cantidad_empleados = Worker::count();
        }       
        
        //$response = $this->send_apidian();
        //return $response->json()['ResponseDian']['Envelope']['Body']['GetStatusZipResponse'];

        return view('home', compact('cantidad_usuarios','cantidad_empleados','cantidad_empresas','configuraciones'));
    }


    protected function send_apidian(){
        $objeto = new stdClass();
        $objeto->sendmail= false;
        $objeto->sendmailtome=false;
        $response = Http::accept('application/json')
                            ->withToken('b71b3d1994db7369d5bcfa51a76fb5065f0217b56c99da93264aab131cc504e1')
                            ->post('http://localhost:8084/apidian2021/public/api/ubl2.1/status/zip/6a683254-4a11-41b8-8294-b76c22540efa',
                            json_decode(json_encode($objeto), true));
        return $response;           

    }

}
