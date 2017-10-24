<?php

namespace App\Domains\Access\Controllers;

use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Domains\Access\Repositories\Contracts\PermissionRepository;

class PermissionController extends Controller
{

    public $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        return view('access.permissions.index')
            ->with('permissions', $this->permissionRepository->all());
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function edit($id)
    {

    }

    public function update($id, Request $request)
    {

    }

    public function destroy($id)
    {

    }

}