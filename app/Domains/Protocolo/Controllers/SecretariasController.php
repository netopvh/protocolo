<?php

namespace App\Domains\Protocolo\Controllers;

use App\Domains\Protocolo\Repositories\Contracts\SecretariasRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;
use Prettus\Repository\Criteria\RequestCriteria;

class SecretariasController extends Controller
{
    /** @var  SecretariasRepository */
    private $secretariasRepository;

    public function __construct(SecretariasRepository $secretariasRepo)
    {
        $this->middleware('auth');
        $this->secretariasRepository = $secretariasRepo;
    }

    /**
     * Item inicial do Controller
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $this->secretariasRepository->pushCriteria(new RequestCriteria($request));
        return view('secretarias.index')
            ->with('secretarias', $this->secretariasRepository->paginate(5));
    }

    /**
     * Exibe formulário de cadastro
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('secretarias.create');
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
            $this->secretariasRepository->create($request->all());
            return redirect()->route('admin.secretarias')->with('success','Registro inserido com sucesso!');
        }catch (ValidatorException $e){
            return redirect()->back()->with('errors',$e->getMessageBag());
        }
    }

    /**
     * Localiza registro no banco de dados para edição.
     *
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        try {
            return view('secretarias.edit')->with('secretaria', $this->secretariasRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.secretarias')->with('errors','Nenhum registro localizado no banco de dados');
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
            $this->secretariasRepository->find($id);

            $this->secretariasRepository->update($request->all(), $id);

            return redirect()->route('admin.secretarias')->with('success','Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.secretarias')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     *  Remove registro do banco de dados
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $this->secretariasRepository->find($id);

            $this->secretariasRepository->delete($id);

            return redirect()->back()->with('success','Registro removido com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.secretarias')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }
}
