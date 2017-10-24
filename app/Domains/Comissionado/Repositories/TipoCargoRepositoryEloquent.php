<?php

namespace App\Domains\Comissionado\Repositories;

use App\Domains\Comissionado\Models\TipoCargo;
use App\Domains\Comissionado\Repositories\Contracts\TipoCargoRepository;
use App\Domains\Comissionado\Validators\TipoCargoValidator;
use Prettus\Repository\Eloquent\BaseRepository;

class TipoCargoRepositoryEloquent extends BaseRepository implements TipoCargoRepository
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
        return TipoCargo::class;
    }

    /**
    * Configure validation
    **/
    public function validator()
    {
        return TipoCargoValidator::class;
    }
}
