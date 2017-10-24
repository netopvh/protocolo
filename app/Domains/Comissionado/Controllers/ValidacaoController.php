<?php

namespace App\Domains\Comissionado\Controllers;

use App\Domains\Comissionado\Repositories\Contracts\ServidorRepository;
use App\Domains\Access\Repositories\Contracts\UserRepository;
use App\Core\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Validator\Exceptions\ValidatorException;
use Yajra\DataTables\DataTables;

class ValidacaoController extends Controller
{
    /** @var  ServidorRepository */
    private $servidorRepository;
    /** @var  userRepository */
    private $userRepository;

    public function __construct(ServidorRepository $servidorRepo,UserRepository $userRepo)
    {
        $this->middleware('auth');
        $this->servidorRepository = $servidorRepo;
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the Servidor.
     *
     * @param Request $request
     * @return
     */
    public function index()
    {
        return view('validacao.index');
    }

    /**
     * Process dataTable ajax response.
     *
     * @param \Yajra\Datatables\Datatables $datatables
     * @return \Illuminate\Http\JsonResponse
     */
    public function data(DataTables $dataTables, Request $request)
    {
        $query = $this->servidorRepository->with(['secretaria', 'tipocargo', 'cargocomissionado'])->query();

        return $dataTables->eloquent($query)
            ->addColumn('lotacao', function ($servidor) {
                return $servidor->secretaria->descricao;
            })
            ->addColumn('tipo', function ($servidor) {
                return $servidor->tipocargo->descricao;
            })
            ->addColumn('cargo', function ($servidor) {
                return $servidor->cargocomissionado->descricao;
            })
            ->addColumn('validado', function ($servidor) {
                switch ($servidor->validado) {
                    case 'N':
                        return '<span class="label label-warning">Não Validado</span>';
                        break;
                    case 'S':
                        return '<span class="label label-success">Validado</span>';
                        break;
                    case 'P':
                        return '<span class="label label-danger">Pendente</span>';
                        break;
                }
            })
            ->addColumn('action', function ($servidor) {
                return view('validacao.buttons.action')->with('servidor', $servidor);
            })
            ->rawColumns(['validado', 'action'])
            ->filter(function ($servidor) use ($request) {
                if ($request->has('nome')) {
                    $servidor->where('nome', 'like', "%{$request->get('nome')}%");
                }
                if ($request->has('validado')) {
                    $servidor->where('validado', $request->get('validado'));
                }
            })
            ->toJson();
    }

    /**
     * Show the form for creating a new Servidor.
     *
     * @return mixed
     */
    public function getServidor($id)
    {
        try {
            return view('validacao.show')->with('servidor', $this->servidorRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.validacao')->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Update the specified Servidor in storage.
     *
     * @param  int $id
     * @param Request $request
     *
     * @return mixed
     */
    public function postValidacao($id, Request $request)
    {
        try {
            $this->servidorRepository->find($id);

            $this->servidorRepository->update($request->all(), $id);

            return redirect()->route('admin.validacao')->with('success', 'Registro atualizado com sucesso');
        } catch (\Exception $e) {
            return redirect()->route('admin.validacao')->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Show the form for creating a new Servidor.
     *
     * @return mixed
     */
    public function getRevalidar($id)
    {
        try {
            return view('validacao.show')->with('servidor', $this->servidorRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.validacao')->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }

    /**
     * Show the form for creating a new Servidor.
     *
     * @return mixed
     */
    public function getRevalidadores($id)
    {
        try {
            return view('validacao.show')->with('servidor', $this->servidorRepository->find($id));
        } catch (\Exception $e) {
            return redirect()->route('admin.validacao')->with('errors', 'Nenhum registro localizado no banco de dados');
        }
    }
}
