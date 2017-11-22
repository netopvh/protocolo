<?php

namespace App\Domains\Dashboard\Controllers;

use Illuminate\Http\Request;
use App\Core\Http\Controllers\Controller;
use Jenssegers\Date\Date;
use Yajra\DataTables\DataTables;
use App\Domains\Protocolo\Services\TramitacaoService;

class HomeController extends Controller
{

    private $tramitacaoService;

    private $servidorRepo;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TramitacaoService $tramitacaoService)
    {
        $this->middleware('auth');
        $this->tramitacaoService = $tramitacaoService;
    }

    public function data(DataTables $dataTables)
    {
        $query = $this->tramitacaoService->builderPendents();

        return $dataTables->eloquent($query)
            ->editColumn('numero', function ($documento) {
                return $documento->numero . '/' . $documento->ano;
            })
            ->addColumn('tipo', function ($documento) {
                return $documento->tipo_documento->descricao;
            })
            ->addColumn('origem', function ($documento) {
                if ($documento->int_ext == 'I') {
                    return $documento->tramitacoes->last()->departamento_origem->descricao;
                } else {
                    return $documento->tramitacoes->last()->secretaria_origem->descricao;
                }
            })
            ->addColumn('action', function ($documento) {
                return view('buttons')->with('documento', $documento);
            })
            ->toJson();
    }
    
    /**
     * Show the application dashboard.
     *
     * @return mixed
     */
    public function index()
    {
        Date::setLocale(config('app.locale'));

        if(is_null(auth()->user()->id_departamento)){
            return redirect()->route('admin.users.departamento');
        }else{
            return view('home')
                ->with('data',Date::now()->format('l j F Y H:i:s'));
        }
    }
}
