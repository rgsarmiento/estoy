<?php

namespace App\Http\Controllers;

use App\Models\Company_has_user;
use App\Models\Configuration;
use App\Models\Document;
use App\Models\Period;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use stdClass;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $busqueda = strval(trim($request->get('busqueda'))); //para filtrar busqueda

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
            $ultimoPriodo = Document::where('state_document_id', 1)->get()->last();
            $documents = Document::where('state_document_id', 1)->where('period_id', $ultimoPriodo->period_id);
        } else {
            $ultimoPriodo = Document::where('state_document_id', 1)->where('company_id', $company_id)->get()->last();
            $documents = Document::where('state_document_id', 1)->where('company_id', $company_id);
        }

        //dd($busqueda);

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

        $periodo_nomina = Period::get();

        return view('documents.index', compact('documents', 'periodo_nomina', 'totalNomina', 'nRegistros'));
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
        header('Content-Disposition: ' . 'attachment; filename='.$nameFile);

        return $response;
    }
}
