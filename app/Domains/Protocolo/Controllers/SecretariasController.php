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
     * Display a listing of the Secretarias.
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
     * Show the form for creating a new Secretarias.
     *
     * @return Response
     */
    public function create()
    {
        return view('secretarias.create');
    }

    /**
     * Store a newly created Secretarias in storage.
     *
     * @param CreateSecretariasRequest $request
     *
     * @return Response
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
     * Display the specified Secretarias.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        try {
            return view('secretarias.show')->with('secretaria', $this->secretariasRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.secretarias')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Show the form for editing the specified Secretarias.
     *
     * @param  int $id
     *
     * @return Response
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
     * Update the specified Secretarias in storage.
     *
     * @param  int              $id
     * @param UpdateSecretariasRequest $request
     *
     * @return Response
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
     * Remove the specified Secretarias from storage.
     *
     * @param  int $id
     *
     * @return Response
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
