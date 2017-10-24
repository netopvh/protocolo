<?php

namespace App\Domains\Comissionado\Controllers;

use App\Domains\Comissionado\Repositories\Contracts\GrauInstrucaoRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class GrauInstrucaoController extends Controller
{
    /** @var  GrauInstrucaoRepository */
    private $grauInstrucaoRepository;

    public function __construct(GrauInstrucaoRepository $grauInstrucaoRepo)
    {
        $this->middleware('auth');
        $this->grauInstrucaoRepository = $grauInstrucaoRepo;
    }

    /**
     * Display a listing of the GrauInstrucao.
     *
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return view('grau_instrucao.index')
            ->with('grauInstrucao',$this->grauInstrucaoRepository->paginate(8));
    }

    /**
     * Show the form for creating a new GrauInstrucao.
     *
     * @return Response
     */
    public function create()
    {
        return view('grau_instrucao.create');
    }

    /**
     * Store a newly created GrauInstrucao in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
       try{
            $this->grauInstrucaoRepository->create($request->all());
            return redirect()->route('admin.instrucao')->with('success','Registro inserido com sucesso!');
        }catch (ValidatorException $e){
            return redirect()->back()->with('errors',$e->getMessageBag());
        }
    }

    /**
     * Display the specified GrauInstrucao.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function show($id)
    {
        try {
            return view('grau_instrucao.show')->with('grauInstrucao', $this->grauInstrucaoRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.instrucao')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Show the form for editing the specified GrauInstrucao.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        try {
            return view('grau_instrucao.edit')->with('grauInstrucao', $this->grauInstrucaoRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.instrucao')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Update the specified GrauInstrucao in storage.
     *
     * @param  int              $id
     * @param UpdateGrauInstrucaoRequest $request
     *
     * @return Response
     */
    public function update($id, Request $request)
    {
        try {
            $this->grauInstrucaoRepository->find($id);

            $this->grauInstrucaoRepository->update($request->all(), $id);

            return redirect()->route('admin.instrucao')->with('success','Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.instrucao')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Remove the specified GrauInstrucao from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        try {
            $this->grauInstrucaoRepository->find($id);

            $this->grauInstrucaoRepository->delete($id);

            return redirect()->back()->with('success','Registro removido com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.instrucao')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }
}
