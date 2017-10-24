<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFilhosRequest;
use App\Http\Requests\UpdateFilhosRequest;
use App\Repositories\FilhosRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class FilhosController extends AppBaseController
{
    /** @var  FilhosRepository */
    private $filhosRepository;

    public function __construct(FilhosRepository $filhosRepo)
    {
        $this->filhosRepository = $filhosRepo;
    }

    /**
     * Display a listing of the Filhos.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->filhosRepository->pushCriteria(new RequestCriteria($request));
        $filhos = $this->filhosRepository->all();

        return view('filhos.index')
            ->with('filhos', $filhos);
    }

    /**
     * Show the form for creating a new Filhos.
     *
     * @return Response
     */
    public function create()
    {
        return view('filhos.create');
    }

    /**
     * Store a newly created Filhos in storage.
     *
     * @param CreateFilhosRequest $request
     *
     * @return Response
     */
    public function store(CreateFilhosRequest $request)
    {
        $input = $request->all();

        $filhos = $this->filhosRepository->create($input);

        Flash::success('Filhos saved successfully.');

        return redirect(route('filhos.index'));
    }

    /**
     * Display the specified Filhos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $filhos = $this->filhosRepository->findWithoutFail($id);

        if (empty($filhos)) {
            Flash::error('Filhos not found');

            return redirect(route('filhos.index'));
        }

        return view('filhos.show')->with('filhos', $filhos);
    }

    /**
     * Show the form for editing the specified Filhos.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $filhos = $this->filhosRepository->findWithoutFail($id);

        if (empty($filhos)) {
            Flash::error('Filhos not found');

            return redirect(route('filhos.index'));
        }

        return view('filhos.edit')->with('filhos', $filhos);
    }

    /**
     * Update the specified Filhos in storage.
     *
     * @param  int              $id
     * @param UpdateFilhosRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFilhosRequest $request)
    {
        $filhos = $this->filhosRepository->findWithoutFail($id);

        if (empty($filhos)) {
            Flash::error('Filhos not found');

            return redirect(route('filhos.index'));
        }

        $filhos = $this->filhosRepository->update($request->all(), $id);

        Flash::success('Filhos updated successfully.');

        return redirect(route('filhos.index'));
    }

    /**
     * Remove the specified Filhos from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $filhos = $this->filhosRepository->findWithoutFail($id);

        if (empty($filhos)) {
            Flash::error('Filhos not found');

            return redirect(route('filhos.index'));
        }

        $this->filhosRepository->delete($id);

        Flash::success('Filhos deleted successfully.');

        return redirect(route('filhos.index'));
    }
}
