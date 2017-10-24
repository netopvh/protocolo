<?php

namespace App\Domains\Access\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Access\Repositories\Contracts\RoleRepository;
use App\Domains\Access\Repositories\Contracts\UserRepository;
use App\Exceptions\Access\GeneralException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Exceptions\ValidatorException;

class UserController extends Controller
{

    public $userRepository;
    public $roleRepository;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->middleware('auth');
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
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

}