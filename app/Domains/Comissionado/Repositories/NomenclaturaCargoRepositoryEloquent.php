<?php

namespace App\Domains\Comissionado\Repositories;

use App\Domains\Comissionado\Models\NomenclaturaCargo;
use App\Domains\Comissionado\Repositories\Contracts\NomenclaturaCargoRepository;
use App\Domains\Comissionado\Validators\NomenclaturaCargoValidator;
use App\Core\Repositories\BaseRepository;

class NomenclaturaCargoRepositoryEloquent extends BaseRepository implements NomenclaturaCargoRepository
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
        return NomenclaturaCargo::class;
    }

    /**
    * Configure validation
    **/
    public function validator()
    {
        return NomenclaturaCargoValidator::class;
    }
}
