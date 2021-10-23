<?php

use App\Http\Controllers\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\CompanyHasUserController;
use App\Http\Controllers\PayrollController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RolController::class);

    Route::resource('usuarios', UsuarioController::class);

    Route::resource('workers', WorkerController::class);
    Route::put('/workers/change_status/{worker}', [App\Http\Controllers\WorkerController::class, 'change_status'])->name('workers.change_status');    

    Route::resource('companies', CompanyController::class);

    Route::resource('company_has_user', CompanyHasUserController::class);

    Route::resource('payrolls', PayrollController::class);
    Route::get('/payrolls/send_apidian_payroll/{payroll}', [App\Http\Controllers\PayrollController::class, 'send_apidian_payroll'])->name('payrolls.send_apidian_payroll');    
    Route::put('/payrolls/change_status/{payroll}', [App\Http\Controllers\PayrollController::class, 'change_status'])->name('payrolls.change_status');    



});


//Route::view('selects','selects')