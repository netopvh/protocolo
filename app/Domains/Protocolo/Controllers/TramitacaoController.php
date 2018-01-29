<?php

namespace App\Domains\Protocolo\Controllers;

use App\Domains\Protocolo\Enum\TipoTramEnum;
use App\Domains\Protocolo\Events\DocumentoCadastrado;
use App\Domains\Protocolo\Services\TramitacaoService;
use App\Core\Http\Controllers\Controller;
use App\Exceptions\Access\GeneralException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TramitacaoController extends Controller
{

    public $tramitacaoService;

    public function __construct(
        TramitacaoService $service
    )
    {
        $this->middleware('auth');
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
                    return $documento->secretaria->descricao;
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
     * @param DataTables $dataTables
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataEnviados(DataTables $dataTables, Request $request)
    {
        $query = $this->tramitacaoService->builderEnviados();

        return $dataTables->eloquent($query)
            ->editColumn('numero', function ($documento) {
                return $documento->numero . '/' . $documento->ano;
            })
            ->addColumn('tipo', function ($documento) {
                return $documento->tipo_documento->descricao;
            })
            ->addColumn('destino', function ($documento) {
                if($documento->id_tipo_doc == 11 || $documento->id_tipo_doc == 13){
                    $secretarias = [];
                    foreach ($documento->secretarias as $secretaria) {
                        $secretarias[] = $secretaria->descricao;
                    }
                    return implode(', ',$secretarias);
                }else{
                    return $documento->tramitacoes->last()->secretaria_destino->descricao;
                }
            })
            ->addColumn('action', function ($documento) {
                return view('tramitacao.buttons_enviados')->with('documento', $documento);
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
    public function receber(Request $request)
    {
        if ($this->tramitacaoService->recebeDoc($request)) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'Error']);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function devolver(Request $request)
    {
        if ($this->tramitacaoService->devolveDoc($request)) {
            return response()->json(['status' => 'OK']);
        } else {
            return response()->json(['status' => 'Error']);
        }
    }

    /**
     * Show the form for creating a new Servidor.
     *
     * @return \Illuminate\View\View;
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
     * @return \Illuminate\View\View;
     */
    public function arquivarIndex($id)
    {
        return view('tramitacao.arquivar')
            ->with('documento',$this->tramitacaoService->findDocs($id));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function arquivarStore($id, Request $request)
    {
        $this->tramitacaoService->arquivaDoc($id, $request);

        return redirect()->route('admin.tramitacao')->with('success', 'Documento arquivado com sucesso!');
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
        return view('tramitacao.tramite_public')
            ->with('dados',$this->tramitacaoService->getDataCreate());
    }

    public function getDocPublic($id)
    {
        try {
            Carbon::setLocale('pt-BR');

            $movimentos = $this->tramitacaoService->getDocumento($id);

            return view('tramitacao.consulta_publica')
                ->with('documento', $movimentos)
                ->with('tipos', TipoTramEnum::getConstants());
        } catch (GeneralException $e) {
            return redirect()->route('admin.tramitacao')->with('errors', $e->getMessage());
        } catch (\Exception $e) {
            return redirect()->route('admin.tramitacao')->with('errors', $e->getMessage());
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConsultaPublica(Request $request)
    {
        Carbon::setLocale('pt-BR');
        if ($documento = $this->tramitacaoService->getConsultaPublica($request)) {

            $arrAtributes = [];

            foreach ($documento as $doc){
                $arrAtributes[] = [
                    'id' => $doc->id,
                    'numero' => $doc->numero,
                    'ano' => $doc->ano,
                    'data_doc' => $doc->data_doc,
                    'assunto' => $doc->assunto,
                    'tipo_doc' => $doc->tipo_documento->descricao
                ];
            }

            return response()->json(['data' => $arrAtributes]);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDespacho(Request $request)
    {
        $despacho = $this->tramitacaoService->getDespacho($request);

        return response()->json(['data' => $despacho]);
    }
}
