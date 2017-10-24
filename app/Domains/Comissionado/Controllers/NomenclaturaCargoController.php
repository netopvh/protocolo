<?php

namespace App\Domains\Comissionado\Controllers;

use App\Domains\Comissionado\Repositories\Contracts\NomenclaturaCargoRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class NomenclaturaCargoController extends Controller
{
    /** @var  NomenclaturaCargoRepository */
    private $nomenclaturaCargoRepository;

    public function __construct(NomenclaturaCargoRepository $nomenclaturaCargoRepo)
    {
        $this->middleware('auth');
        $this->nomenclaturaCargoRepository = $nomenclaturaCargoRepo;
    }

    /**
     * Display a listing of the NomenclaturaCargo.
     *
     * @param Request $request
     * @return mixed
     */
    public function index()
    {
        return view('nomenclatura_cargos.index')
            ->with('nomenclaturaCargo',$this->nomenclaturaCargoRepository->paginate(8));
    }

    /**
     * Show the form for creating a new NomenclaturaCargo.
     *
     * @return Response
     */
    public function create()
    {
        return view('nomenclatura_cargos.create');
    }

    /**
     * Store a newly created NomenclaturaCargo in storage.
     *
     * @param CreateNomenclaturaCargoRequest $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        try{
            $this->nomenclaturaCargoRepository->create($request->all());
            return redirect()->route('admin.nomenclatura')->with('success','Registro inserido com sucesso!');
        }catch (ValidatorException $e){
            return redirect()->back()->with('errors',$e->getMessageBag());
        }
    }

    /**
     * Display the specified NomenclaturaCargo.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function show($id)
    {
        try {
            return view('nomenclatura_cargos.show')->with('nomenclaturaCargo', $this->nomenclaturaCargoRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.nomenclatura')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Show the form for editing the specified NomenclaturaCargo.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        try {
            return view('nomenclatura_cargos.edit')->with('nomenclaturaCargo', $this->nomenclaturaCargoRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.nomenclatura')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Update the specified NomenclaturaCargo in storage.
     *
     * @param  int              $id
     * @param UpdateNomenclaturaCargoRequest $request
     *
     * @return mixed
     */
    public function update($id, Request $request)
    {
        try {
            $this->nomenclaturaCargoRepository->find($id);

            $this->nomenclaturaCargoRepository->update($request->all(), $id);

            return redirect()->route('admin.nomenclatura')->with('success','Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.nomenclatura')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Remove the specified NomenclaturaCargo from storage.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            $this->nomenclaturaCargoRepository->find($id);

            $this->nomenclaturaCargoRepository->delete($id);

            return redirect()->back()->with('success','Registro removido com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.nomenclatura')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }
}
