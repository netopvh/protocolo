<?php

namespace App\Domains\Protocolo\Controllers;

use App\Domains\Protocolo\Repositories\Contracts\TipoDocumentoRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;
use Yajra\DataTables\DataTables;

class TipoDocumentoController extends Controller
{
    /** @var  DepartamentoRepository */
    private $tipoDocumentoRepository;

    public function __construct(TipoDocumentoRepository $tipoDocumentoRepository)
    {
        $this->middleware('auth');
        $this->tipoDocumentoRepository = $tipoDocumentoRepository;
    }

    /**
     * Display a listing of the Servidor.
     *
     * @param Request $request
     * @return
     */
    public function index()
    {
        return view('tipo_documento.index');
    }
    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(DataTables $dataTables)
    {
        $query = $this->tipoDocumentoRepository->query();

        return $dataTables->eloquent($query)
            ->addColumn('action',function($tipo_documento){
                return view('tipo_documento.buttons')->with('tipo_documento',$tipo_documento);
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
        return view('tipo_documento.create');
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
            $this->tipoDocumentoRepository->create($request->all());
            return redirect()->route('admin.tipo_documento')->with('success','Registro inserido com sucesso!');
        }catch (ValidatorException $e){
            return redirect()->route('admin.tipo_documento')->with('errors',$e->getMessageBag());
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
            return view('tipo_documento.edit')->with('tipo_documento', $this->tipoDocumentoRepository->find($id));
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
            $this->tipoDocumentoRepository->find($id);

            $this->tipoDocumentoRepository->update($request->all(), $id);

            return redirect()->route('admin.tipo_documento')->with('success','Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.tipo_documento')->with('errors','Nenhum registro localizado no banco de dados');
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
            $this->tipoDocumentoRepository->find($id);

            $this->tipoDocumentoRepository->delete($id);

            return redirect()->back()->with('success','Registro removido com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.tipo_documento')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }
}
