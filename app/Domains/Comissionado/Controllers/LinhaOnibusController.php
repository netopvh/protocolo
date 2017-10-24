<?php

namespace App\Domains\Comissionado\Controllers;

use App\Domains\Comissionado\Repositories\Contracts\LinhaOnibusRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;

class LinhaOnibusController extends Controller
{
    /** @var  LinhaOnibusRepository */
    private $linhaOnibusRepository;

    public function __construct(LinhaOnibusRepository $linhaOnibusRepo)
    {
        $this->middleware('auth');
        $this->linhaOnibusRepository = $linhaOnibusRepo;
    }

    /**
     * Display a listing of the LinhaOnibus.
     *
     * @param Request $request
     * @return
     */
    public function index()
    {

        return view('linha_onibus.index')
            ->with('linha_onibus',$this->linhaOnibusRepository->paginate(10));
    }

    /**
     * Show the form for creating a new LinhaOnibus.
     *
     * @return Response
     */
    public function create()
    {
        return view('linha_onibuses.create');
    }

    /**
     * Store a newly created LinhaOnibus in storage.
     *
     * @param CreateLinhaOnibusRequest $request
     *
     * @return Response
     */
    public function store(CreateLinhaOnibusRequest $request)
    {
        $input = $request->all();

        $linhaOnibus = $this->linhaOnibusRepository->create($input);

        Flash::success('Linha Onibus saved successfully.');

        return redirect(route('linhaOnibuses.index'));
    }

    /**
     * Display the specified LinhaOnibus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $linhaOnibus = $this->linhaOnibusRepository->findWithoutFail($id);

        if (empty($linhaOnibus)) {
            Flash::error('Linha Onibus not found');

            return redirect(route('linhaOnibuses.index'));
        }

        return view('linha_onibuses.show')->with('linhaOnibus', $linhaOnibus);
    }

    /**
     * Show the form for editing the specified LinhaOnibus.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $linhaOnibus = $this->linhaOnibusRepository->findWithoutFail($id);

        if (empty($linhaOnibus)) {
            Flash::error('Linha Onibus not found');

            return redirect(route('linhaOnibuses.index'));
        }

        return view('linha_onibuses.edit')->with('linhaOnibus', $linhaOnibus);
    }

    /**
     * Update the specified LinhaOnibus in storage.
     *
     * @param  int              $id
     * @param UpdateLinhaOnibusRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateLinhaOnibusRequest $request)
    {
        $linhaOnibus = $this->linhaOnibusRepository->findWithoutFail($id);

        if (empty($linhaOnibus)) {
            Flash::error('Linha Onibus not found');

            return redirect(route('linhaOnibuses.index'));
        }

        $linhaOnibus = $this->linhaOnibusRepository->update($request->all(), $id);

        Flash::success('Linha Onibus updated successfully.');

        return redirect(route('linhaOnibuses.index'));
    }

    /**
     * Remove the specified LinhaOnibus from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $linhaOnibus = $this->linhaOnibusRepository->findWithoutFail($id);

        if (empty($linhaOnibus)) {
            Flash::error('Linha Onibus not found');

            return redirect(route('linhaOnibuses.index'));
        }

        $this->linhaOnibusRepository->delete($id);

        Flash::success('Linha Onibus deleted successfully.');

        return redirect(route('linhaOnibuses.index'));
    }
}
