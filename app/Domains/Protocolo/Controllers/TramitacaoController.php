<?php

namespace App\Domains\Protocolo\Controllers;

use App\Domains\Protocolo\Enum\TipoTramEnum;
use App\Domains\Protocolo\Services\TramitacaoService;
use App\Core\Http\Controllers\Controller;
use App\Exceptions\Access\GeneralException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Prettus\Validator\Exceptions\ValidatorException;
use Yajra\DataTables\DataTables;

class TramitacaoController extends Controller
{

    public $tramitacaoService;

    public function __construct(
        TramitacaoService $service
    )
    {
        //$this->middleware('auth');
        $this->tramitacaoService = $service;
    }

    /**
     * Display a listing of the Servidor.
     *
     * @param Request $request
     * @return
     */
    public function index()
    {
        //dd($this->tramitacaoService->builder());
        return view('tramitacao.index')
            ->with('tipo_documentos', $this->tramitacaoService->getAllDocumentsType());
    }

    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(DataTables $dataTables, Request $request)
    {
        $query = $this->tramitacaoService->builder();

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
                return view('tramitacao.buttons_setor')->with('documento', $documento);
            })
            ->filter(function ($documento) use ($request) {
                if ($request->has('numero')) {
                    $documento->where('numero', 'like', "%{$request->get('numero')}%");
                }
                if ($request->has('ano')) {
                    $documento->where('ano', $request->get('ano'));
                }
                if ($request->has('id_tipo_doc') && !empty($request->get('id_tipo_doc'))) {
                    $documento->where('id_tipo_doc', $request->get('id_tipo_doc'));
                }
            })
            ->make(true);
    }

    /**
     * @param DataTables $dataTables
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataPendentes(DataTables $dataTables, Request $request)
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
                return view('tramitacao.buttons_pendentes')->with('documento', $documento);
            })
            ->filter(function ($documento) use ($request) {
                if ($request->has('numero')) {
                    $documento->where('numero', 'like', "%{$request->get('numero')}%");
                }
                if ($request->has('ano')) {
                    $documento->where('ano', $request->get('ano'));
                }
            })
            ->toJson();
    }

    /**
     * @param DataTables $dataTables
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataArquivados(DataTables $dataTables, Request $request)
    {
        $query = $this->tramitacaoService->builderArquivados();

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
                return view('tramitacao.buttons_arquivados')->with('documento', $documento);
            })
            ->filter(function ($documento) use ($request) {
                if ($request->has('numero')) {
                    $documento->where('numero', 'like', "%{$request->get('numero')}%");
                }
                if ($request->has('ano')) {
                    $documento->where('ano', $request->get('ano'));
                }
            })
            ->toJson();
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function counters()
    {
        return response()->json($this->tramitacaoService->getDocumentsCounter());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function action(Request $request)
    {
        if ($request->action == 'R') {
            if ($this->tramitacaoService->recebeDoc($request)) {
                return response()->json(['status' => 'OK']);
            } else {
                return response()->json(['status' => 'Error']);
            }
        } else if ($request->action == 'D') {
            if ($this->tramitacaoService->devolveDoc($request)) {
                return response()->json(['status' => 'OK']);
            } else {
                return response()->json(['status' => 'Error']);
            }
        }else if($request->action == 'A'){
            if ($this->tramitacaoService->arquivaDoc($request)) {
                return response()->json(['status' => 'OK']);
            } else {
                return response()->json(['status' => 'Error']);
            }
        }
    }

    /**
     * Show the form for creating a new Servidor.
     *
     * @return mixed
     */
    public function create()
    {
        return view('tramitacao.create')
            ->with('dados', $this->tramitacaoService->getDataCreate());
    }

    /**
     * Store a newly created Servidor in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {

        $this->tramitacaoService->createAndUpload($request);

        return redirect()->route('admin.tramitacao')->with('success', 'Registro inserido com sucesso!');
    }

    /**
     * Show the form for editing the specified Servidor.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        try {
            return view('documento.edit')->with('documento', $this->tramitacaoService->find($id));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Update the specified Servidor in storage.
     *
     * @param  int $id
     * @param Request $request
     *
     * @return mixed
     */
    public function update($id, Request $request)
    {
        try {
            $this->tramitacaoService->find($id);

            $this->tramitacaoService->update($request->all(), $id);

            return redirect()->route('admin.documento')->with('success', 'Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.documento')->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * @param $id
     * @return $this
     */
    public function movimentarIndex($id)
    {
        //dd($this->tramitacaoService->findDocMovimentacao($id));
        return view('tramitacao.movimentar')
            ->with('documento', $this->tramitacaoService->findDocMovimentacao($id))
            ->with('dados', $this->tramitacaoService->getDataCreate());
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function movimentarStore(Request $request)
    {
        $this->tramitacaoService->createTramitacao($request);

        return redirect()->route('admin.tramitacao')->with('success', 'Registro inserido com sucesso!');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getMovimentos($id)
    {
        try {
            Carbon::setLocale('pt-BR');

            $movimentos = $this->tramitacaoService->findDocMovimentacao($id);

            return view('tramitacao.tramite')
                ->with('documento', $movimentos)
                ->with('tipos', TipoTramEnum::getConstants());
        } catch (GeneralException $e) {
            return redirect()->route('admin.tramitacao')->with('errors', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('admin.tramitacao')->with('errors', $e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showDocPublic()
    {
        return view('tramitacao.tramite_public');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConsultaPublica(Request $request)
    {
        Carbon::setLocale('pt-BR');
        if ($documento = $this->tramitacaoService->getConsultaPublica($request)) {

            $arrTram = [];
            foreach ($documento->tramitacoes as $tramitacao) {
                $action = "";
                if ($documento->int_ext == 'I' && $tramitacao->tipo_tram == 'S') {
                    $action = ' Criou o Documento Nº ' . $documento->numero . ' e enviou para o <span class="text-bold">' . $tramitacao->departamento_destino->descricao . '</span>';
                } else if ($documento->int_ext == 'I' && $tramitacao->tipo_tram == 'D') {
                    $action = ' Devolveu o Documento Nº ' . $documento->numero . ' para o Departamento <span class="text-bold">' . $tramitacao->departamento_destino->descricao . '</span>';
                }else if ($documento->int_ext == 'E' && $tramitacao->tipo_tram == 'D') {
                    $action = ' Devolveu o Documento Nº ' . $documento->numero . ' para o Departamento <span class="text-bold">' . $tramitacao->departamento_destino->descricao . '</span>';
                }else if ($documento->int_ext == 'E' && $tramitacao->tipo_tram == 'P') {
                    $action = ' Enviou o Documento Nº ' . $documento->numero . ' para o Departamento <span class="text-bold">' . $tramitacao->departamento_destino->descricao . '</span>';
                } else if ($documento->int_ext == 'E' && $tramitacao->tipo_tram == 'C') {
                    $action = ' Encaminhou o Documento Nº ' . $documento->numero . ' para <span class="text-bold">' . $tramitacao->departamento_destino->descricao . '</span> protocolado por <span  class="text-bold">' . $tramitacao->secretaria_origem->descricao . '</span>';
                }else if($tramitacao->tipo_tram=='R'){
                    $action = ' Recebeu o Documento Nº '.$documento->numero;
                }else if($tramitacao->tipo_tram == 'A'){
                    $action = ' Arquivou o Documento Nº '.$documento->numero;
                }

                $arrTram[] = [
                    'data_tram' => $tramitacao->data_tram . ' - ' . $tramitacao->created_at->diffForHumans(),
                    'usuario' => $tramitacao->usuario->name,
                    'departamento' => $tramitacao->usuario->departamento->descricao,
                    'tipo_tram' => $tramitacao->tipo_tram,
                    'acao' => $action
                ];
            }

            return response()->json([
                'numero' => $documento->numero,
                'ano' => $documento->ano,
                'data_doc' => $documento->data_doc,
                'assunto' => $documento->assunto,
                'tipo_doc' => $documento->tipo_documento->descricao,
                'procedencia' => $documento->int_ext,
                'tramitacoes' => $arrTram
            ]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    /**
     * Display the specified Servidor.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function showDoc($id)
    {
        return view('tramitacao.show')->with('documento', $this->tramitacaoService->findDocs($id));
    }
}
