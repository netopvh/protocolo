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


    /**
     * DocumentoController constructor.
     * @param DocumentoRepository $documentoRepository
     * @param TipoDocumentoRepository $tipoDocumentoRepository
     * @param SecretariasRepository $secretariaRepository
     * @param DepartamentoRepository $departamentoRepository
     * @param DocumentoAnexoRepository $documentoAnexoRepository
     */
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
     * Item inicial do Controller
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
     * Exibe formulário de cadastro
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * Armazena registro no banco de dados
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
     * Localiza registro no banco de dados para edição.
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
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
     * Atualiza informações no banco de dados
     *
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
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
     * Remove registro do banco de dados
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
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
