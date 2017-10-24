<?php
namespace App\Domains\Access\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Access\Repositories\Contracts\PermissionRepository;
use App\Exceptions\Access\GeneralException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Domains\Access\Repositories\Contracts\RoleRepository;

class RoleController extends Controller
{

    public $roleRepository;

    public $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->middleware('auth');

        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        return view('access.roles.index')
            ->with('roles', $this->roleRepository->all());
    }

    public function create()
    {
        return view('access.roles.add')
            ->with('permissions',$this->permissionRepository->all());
    }

    public function store(Request $request)
    {
        try{
            $this->roleRepository->create($request->all());
            return redirect()->route('admin.roles')->with('success','Registro inserido com sucesso!');
        }catch (GeneralException $e){
            return redirect()->back()->with('errors',$e->getMessage());
        }
    }

    public function edit($id)
    {
        try{
            return view('access.roles.edit')
                ->with('role',$this->roleRepository->findRole($id))
                ->with('permissions',$this->permissionRepository->all());
        }catch (GeneralException $e){
            return redirect()->back()->with('errors',$e->getMessage());
        }
    }

    public function update($id, Request $request)
    {
        try{
            if ($this->roleRepository->update($request->all(), $id)){
                return redirect()->route('admin.roles')->with('success','Registro alterado com sucesso!');
            }
        }catch (ModelNotFoundException $e){
            return redirect()->back()->with('errors',$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            $this->roleRepository->delete($id);
            return redirect()->route('admin.roles')->with('success','Registro removido com sucesso!');
        }catch (GeneralException $e){
            return redirect()->back()->with('errors',$e->getMessage());
        }
    }

}