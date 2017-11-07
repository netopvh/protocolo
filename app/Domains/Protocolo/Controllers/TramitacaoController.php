<?php

namespace App\Domains\Protocolo\Controllers;

use App\Domains\Protocolo\Services\TramitacaoService;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
            ->addColumn('tipo', function ($documento) {
                return $documento->tipo_documento->descricao;
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

    public function dataPendentes(DataTables $dataTables, Request $request)
    {
        $query = $this->tramitacaoService->builderPendents();

        return $dataTables->eloquent($query)
            ->addColumn('tipo', function ($documento) {
                return $documento->tipo_documento->descricao;
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
        if ($this->tramitacaoService->recebeDoc($request)){
            return response()->json(['status' => 'OK']);
        }else{
            return response()->json(['status' => 'Error']);
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

    public function movimentarIndex($id)
    {
        //dd($this->tramitacaoService->findDocMovimentacao($id));
        return view('tramitacao.movimentar')
            ->with('documento',$this->tramitacaoService->findDocMovimentacao($id))
            ->with('dados',$this->tramitacaoService->getDataCreate());
    }

    public function movimentarStore(Request $request)
    {
        $this->tramitacaoService->createTramitacao($request->all());

        return redirect()->route('admin.tramitacao')->with('success', 'Registro inserido com sucesso!');
    }

    public function getMovimentos($id)
    {
        return view('tramitacao.tramite')->with('documento', $this->tramitacaoService->findDocMovimentacao($id));
    }
}
