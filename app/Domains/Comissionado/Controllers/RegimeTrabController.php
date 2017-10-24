<?php

namespace App\Domains\Comissionado\Controllers;

use App\Domains\Comissionado\Repositories\Contracts\RegimeTrabRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class RegimeTrabController extends Controller
{
    /** @var  RegimeTrabRepository */
    private $regimeTrabRepository;

    public function __construct(RegimeTrabRepository $regimeTrabRepo)
    {
        $this->middleware('auth');
        $this->regimeTrabRepository = $regimeTrabRepo;
    }

    /**
     * Display a listing of the RegimeTrab.
     *
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return view('regime_trabalho.index')
            ->with('regimeTrab',$this->regimeTrabRepository->paginate(10));
    }

    /**
     * Show the form for creating a new RegimeTrab.
     *
     * @return mixed
     */
    public function create()
    {
        return view('regime_trabalho.create');
    }

    /**
     * Store a newly created RegimeTrab in storage.
     *
     * @param CreateRegimeTrabRequest $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        try{
            $this->regimeTrabRepository->create($request->all());
            return redirect()->route('admin.regime')->with('success','Registro inserido com sucesso!');
        }catch (ValidatorException $e){
            return redirect()->back()->with('errors',$e->getMessageBag());
        }
    }

    /**
     * Display the specified RegimeTrab.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function show($id)
    {
        try {
            return view('regime_trabalho.show')->with('regimeTrab', $this->regimeTrabRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.regime')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Show the form for editing the specified RegimeTrab.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        try {
            return view('regime_trabalho.edit')->with('regimeTrab', $this->regimeTrabRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.regime')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Update the specified RegimeTrab in storage.
     *
     * @param  int              $id
     * @param UpdateRegimeTrabRequest $request
     *
     * @return mixed
     */
    public function update($id, Request $request)
    {
        try {
            $this->regimeTrabRepository->find($id);

            $this->regimeTrabRepository->update($request->all(), $id);

            return redirect()->route('admin.regime')->with('success','Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.regime')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Remove the specified RegimeTrab from storage.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            $this->regimeTrabRepository->find($id);

            $this->regimeTrabRepository->delete($id);

            return redirect()->back()->with('success','Registro removido com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.regime')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }
}
