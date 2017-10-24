<?php

namespace App\Domains\Protocolo\Controllers;

use App\Domains\Protocolo\Repositories\Contracts\DocumentoRepository;
use App\Domains\Protocolo\Repositories\Contracts\TipoDocumentoRepository;
use App\Domains\Protocolo\Repositories\Contracts\SecretariasRepository;
use App\Domains\Protocolo\Repositories\Contracts\DepartamentoRepository;
use App\Domains\Protocolo\Repositories\Contracts\DocumentoAnexoRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;
use Yajra\DataTables\DataTables;

class DocumentoController extends Controller
{
    /** @var  DocumentoRepository */
    private $documentoRepository;

     /** @var  TipoDocumentoRepository */
    private $tipoDocumentoRepository;

     /** @var  SecretariasRepository */
    private $secretariaRepository;

     /** @var  DepartamentoRepository */
    private $departamentoRepository;

     /** @var  DepartamentoRepository */
    private $documentoAnexoRepository;

    public function __construct(
        DocumentoRepository $documentoRepository,
        TipoDocumentoRepository $tipoDocumentoRepository,
        SecretariasRepository $secretariaRepository,
        DepartamentoRepository $departamentoRepository,
        DocumentoAnexoRepository $documentoAnexoRepository
    )
    {
        $this->middleware('auth');
        $this->documentoRepository = $documentoRepository;
        $this->tipoDocumentoRepository = $tipoDocumentoRepository;
        $this->secretariaRepository = $secretariaRepository;
        $this->departamentoRepository = $departamentoRepository;
        $this->documentoAnexoRepository = $documentoAnexoRepository;
    }

    /**
     * Display a listing of the Servidor.
     *
     * @param Request $request
     * @return
     */
    public function index()
    {
        return view('documento.index')->with('tipo_documentos',$this->tipoDocumentoRepository->all());
    }
    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(DataTables $dataTables, Request $request)
    {
        $query = $this->documentoRepository
            ->with('tipo_documento')
            ->query();

        return $dataTables->eloquent($query)
            ->addColumn('tipo', function ($documento) {
                return $documento->tipo_documento->descricao;
            })
            ->addColumn('action',function($documento){
                return view('documento.buttons')->with('documento',$documento);
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
     * Show the form for creating a new Servidor.
     *
     * @return Response
     */
    public function create()
    {
        $years=[];
        for ($i=2014; $i<=2025 ; $i++) { 
            $years[] = $i;
        }
        return view('documento.create')
        ->with('years', $years)
        ->with('tipo_documentos',$this->tipoDocumentoRepository->all())
        ->with('secretarias',$this->secretariaRepository->all())
        ->with('departamentos',$this->departamentoRepository->all());
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
        try{
            $documento = $this->documentoRepository->create($request->all());
            foreach ($request->documentos as $doc) {
                $filename = $doc->store('protocolo','public');
                $this->documentoAnexoRepository->create([
                    'id_documento' => $documento->id,
                    'filename' => $filename
                ]);
            }
            return redirect()->route('admin.documento')->with('success','Registro inserido com sucesso!');
        }catch (ValidatorException $e){
            return redirect()->back()->with('errors',$e->getMessageBag());
        }
    }

    /**
     * Display the specified Servidor.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function show($id)
    {
        try {
            return view('documento.show')->with('documento', $this->documentoRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Show the form for editing the specified Servidor.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
         try {
            return view('documento.edit')->with('documento', $this->documentoRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->back()->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Update the specified Servidor in storage.
     *
     * @param  int              $id
     * @param UpdateServidorRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
       try {
            $this->documentoRepository->find($id);

            $this->documentoRepository->update($request->all(), $id);

            return redirect()->route('admin.documento')->with('success','Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.documento')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Remove the specified Servidor from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->documentoRepository->find($id);

            $this->documentoRepository->delete($id);

            return redirect()->back()->with('success','Registro removido com sucesso');
        } catch (\Exception $e) {
            return redirect()->back()->with('errors','Nenhum registro localizado no banco de dados');
        }
    }
}
