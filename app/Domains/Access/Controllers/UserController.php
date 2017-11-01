<?php

namespace App\Domains\Access\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Access\Repositories\Contracts\RoleRepository;
use App\Domains\Access\Repositories\Contracts\UserRepository;
use App\Domains\Protocolo\Repositories\Contracts\DepartamentoRepository;
use App\Exceptions\Access\GeneralException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends Controller
{

    /**
     * @var UserRepository
     */
    public $userRepository;
    /**
     * @var RoleRepository
     */
    public $roleRepository;

    public $departamentosRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository, DepartamentoRepository $departamentoRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->departamentosRepository = $departamentoRepository;
    }

    public function index(Request $request)
    {
        $this->userRepository->pushCriteria(new RequestCriteria($request));

        return view('access.users.index')
            ->with('users', $this->userRepository->with('secretaria')->paginate(10));
    }

    public function create()
    {

        return view('access.users.add')
            ->with('roles', $this->roleRepository->all());
    }

    public function store(Request $request)
    {
        try {
            $this->userRepository->create($request->all());
            return redirect()->route('admin.users')->with('success', 'Registro inserido com sucesso!');
        } catch (ValidatorException $e) {
            return redirect()->back()->with('errors', $e->getMessageBag());
        }
    }

    public function edit($id)
    {
        try {
            return view('access.users.edit')
                ->with('user', $this->userRepository->findUser($id))
                ->with('roles', $this->roleRepository->all());
        } catch (GeneralException $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try {
            if ($this->userRepository->update($request->all(), $id)) {
                return redirect()->route('admin.users')->with('success', 'Registro alterado com sucesso!');
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
            return redirect()->back()->with('success', 'Registro removido com sucesso!');
        } catch (GeneralException $e) {
            return redirect()->back()->with('errors', $e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getDepartamento(){
        return view('access.users.departamento')->with('departamentos',$this->departamentosRepository->all());
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postDepartamento(Request $request,$id)
    {
        try {

            $this->userRepository->update($request->all(), $id);

            return redirect()->route('admin.home')->with('success','Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.home')->with('errors',$e->getMessage());
        }
    }

}