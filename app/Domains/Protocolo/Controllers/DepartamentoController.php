<?php

namespace App\Domains\Protocolo\Controllers;

use App\Domains\Protocolo\Repositories\Contracts\DepartamentoRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;
use Yajra\DataTables\DataTables;

class DepartamentoController extends Controller
{
    /** @var  DepartamentoRepository */
    private $departamentoRepository;

    /**
     * DepartamentoController constructor.
     * @param DepartamentoRepository $departamentoRepository
     */
    public function __construct(DepartamentoRepository $departamentoRepository)
    {
        $this->middleware('auth');
        $this->departamentoRepository = $departamentoRepository;
    }

    /**
     * Item inicial do Controller
     *
     * @param Request $request
     * @return
     */
    public function index()
    {
        return view('departamento.index');
    }
    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(DataTables $dataTables)
    {
        $query = $this->departamentoRepository->query();

        return $dataTables->eloquent($query)
            ->addColumn('action',function($departamento){
                return view('departamento.buttons')->with('departamento',$departamento);
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
        return view('departamento.create');
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
            $this->departamentoRepository->create($request->all());
            return redirect()->route('admin.departamento')->with('success','Registro inserido com sucesso!');
        }catch (ValidatorException $e){
            return redirect()->route('admin.departamento')->with('errors',$e->getMessageBag());
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
            return view('departamento.edit')->with('departamento', $this->departamentoRepository->find($id));
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
            $this->departamentoRepository->find($id);

            $this->departamentoRepository->update($request->all(), $id);

            return redirect()->route('admin.departamento')->with('success','Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.departamento')->with('errors','Nenhum registro localizado no banco de dados');
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
            $this->departamentoRepository->find($id);

            $this->departamentoRepository->delete($id);

            return redirect()->back()->with('success','Registro removido com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.departamento')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }
}
