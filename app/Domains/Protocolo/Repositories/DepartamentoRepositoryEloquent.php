<?php

namespace App\Domains\Protocolo\Repositories;

use App\Core\Repositories\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Domains\Protocolo\Repositories\Contracts\DepartamentoRepository;
use App\Domains\Protocolo\Models\Departamento;
use App\Domains\Protocolo\Validators\DepartamentoValidator;

/**
 * Class DepartamentoRepositoryEloquent
 * @package namespace App\Domains\Protocolo\Repositories;
 */
class DepartamentoRepositoryEloquent extends BaseRepository implements DepartamentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Departamento::class;
    }
    
    /**
    * Configure validation
    **/
    public function validator()
    {
        return DepartamentoValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
