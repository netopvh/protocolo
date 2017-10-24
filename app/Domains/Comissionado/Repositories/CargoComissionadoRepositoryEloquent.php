<?php

namespace App\Domains\Comissionado\Repositories;

use App\Domains\Comissionado\Models\CargoComissionado;
use App\Domains\Comissionado\Repositories\Contracts\CargoComissionadoRepository;
use App\Domains\Comissionado\Validators\CargoComissionadoValidator;
use App\Core\Repositories\BaseRepository;

class CargoComissionadoRepositoryEloquent extends BaseRepository implements CargoComissionadoRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descricao'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return CargoComissionado::class;
    }

    /**
    * Configure validation
    **/
    public function validator()
    {
        return CargoComissionadoValidator::class;
    }
}
