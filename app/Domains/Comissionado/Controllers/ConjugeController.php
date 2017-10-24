<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateConjugeRequest;
use App\Http\Requests\UpdateConjugeRequest;
use App\Repositories\ConjugeRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ConjugeController extends AppBaseController
{
    /** @var  ConjugeRepository */
    private $conjugeRepository;

    public function __construct(ConjugeRepository $conjugeRepo)
    {
        $this->conjugeRepository = $conjugeRepo;
    }

    /**
     * Display a listing of the Conjuge.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->conjugeRepository->pushCriteria(new RequestCriteria($request));
        $conjuges = $this->conjugeRepository->all();

        return view('conjuges.index')
            ->with('conjuges', $conjuges);
    }

    /**
     * Show the form for creating a new Conjuge.
     *
     * @return Response
     */
    public function create()
    {
        return view('conjuges.create');
    }

    /**
     * Store a newly created Conjuge in storage.
     *
     * @param CreateConjugeRequest $request
     *
     * @return Response
     */
    public function store(CreateConjugeRequest $request)
    {
        $input = $request->all();

        $conjuge = $this->conjugeRepository->create($input);

        Flash::success('Conjuge saved successfully.');

        return redirect(route('conjuges.index'));
    }

    /**
     * Display the specified Conjuge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $conjuge = $this->conjugeRepository->findWithoutFail($id);

        if (empty($conjuge)) {
            Flash::error('Conjuge not found');

            return redirect(route('conjuges.index'));
        }

        return view('conjuges.show')->with('conjuge', $conjuge);
    }

    /**
     * Show the form for editing the specified Conjuge.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $conjuge = $this->conjugeRepository->findWithoutFail($id);

        if (empty($conjuge)) {
            Flash::error('Conjuge not found');

            return redirect(route('conjuges.index'));
        }

        return view('conjuges.edit')->with('conjuge', $conjuge);
    }

    /**
     * Update the specified Conjuge in storage.
     *
     * @param  int              $id
     * @param UpdateConjugeRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConjugeRequest $request)
    {
        $conjuge = $this->conjugeRepository->findWithoutFail($id);

        if (empty($conjuge)) {
            Flash::error('Conjuge not found');

            return redirect(route('conjuges.index'));
        }

        $conjuge = $this->conjugeRepository->update($request->all(), $id);

        Flash::success('Conjuge updated successfully.');

        return redirect(route('conjuges.index'));
    }

    /**
     * Remove the specified Conjuge from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $conjuge = $this->conjugeRepository->findWithoutFail($id);

        if (empty($conjuge)) {
            Flash::error('Conjuge not found');

            return redirect(route('conjuges.index'));
        }

        $this->conjugeRepository->delete($id);

        Flash::success('Conjuge deleted successfully.');

        return redirect(route('conjuges.index'));
    }
}
