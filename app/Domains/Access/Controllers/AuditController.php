<?php

namespace App\Domains\Access\Controllers;

use App\Core\Http\Controllers\Controller;
use App\Domains\Access\Repositories\Contracts\AuditRepository;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;

class AuditController extends Controller
{

    public $auditRepository;

    public function __construct(AuditRepository $auditRepository)
    {
        $this->middleware('auth');
        $this->auditRepository = $auditRepository;
    }

    public function index(Request $request)
    {
        $this->auditRepository->pushCriteria(new RequestCriteria($request));

        return view('access.auditor.index')->with('auditors',$this->auditRepository->all());
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