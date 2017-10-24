<?php

namespace App\Domains\Comissionado\Controllers;

Use App\Domains\Comissionado\Repositories\Contracts\CargoComissionadoRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Validator\Exceptions\ValidatorException;

class CargoComissionadoController extends Controller
{
    /** @var  CargoComissionadoRepository */
    private $cargoComissionadoRepository;

    public function __construct(CargoComissionadoRepository $cargoComissionadoRepo)
    {
        $this->middleware('auth');
        $this->cargoComissionadoRepository = $cargoComissionadoRepo;
    }

    /**
     * Display a listing of the CargoComissionado.
     *
     * @return mixed
     */
    public function index()
    {
        return view('cargo_comissionados.index')
            ->with('cargoComissionado',$this->cargoComissionadoRepository->paginate(7));
    }

    /**
     * Show the form for creating a new CargoComissionado.
     *
     * @return string
     */
    public function create()
    {
        return view('cargo_comissionados.create');
    }

    /**
     * Store a newly created CargoComissionado in storage.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function store(Request $request)
    {
        try{
            $this->cargoComissionadoRepository->create($request->all());
            return redirect()->route('admin.comissionados')->with('success','Registro inserido com sucesso!');
        }catch (ValidatorException $e){
            return redirect()->back()->with('errors',$e->getMessageBag());
        }
    }

    /**
     * Display the specified CargoComissionado.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function show($id)
    {
        try {
            return view('cargo_comissionados.show')->with('cargoComissionado', $this->cargoComissionadoRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.comissionados')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Show the form for editing the specified CargoComissionado.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        try {
            return view('cargo_comissionados.edit')->with('cargoComissionado', $this->cargoComissionadoRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.comissionados')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Update the specified CargoComissionado in storage.
     *
     * @param  int              $id
     * @param Request $request
     *
     * @return mixed
     */
    public function update($id, Request $request)
    {
        try {
            $this->cargoComissionadoRepository->find($id);

            $this->cargoComissionadoRepository->update($request->all(), $id);

            return redirect()->route('admin.comissionados')->with('success','Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.comissionados')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Remove the specified CargoComissionado from storage.
     *
     * @param  int $id
     *
     * @return mixed
     */
    public function destroy($id)
    {
        try {
            $this->cargoComissionadoRepository->find($id);

            $this->cargoComissionadoRepository->delete($id);

            return redirect()->back()->with('success','Registro removido com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.comissionados')->with('errors','Nenhum registro localizado no banco de dados');
        }
    }
}
