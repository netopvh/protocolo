<?php

namespace App\Domains\Comissionado\Repositories;

use App\Domains\Comissionado\Models\RegimeTrab;
use App\Domains\Comissionado\Repositories\Contracts\RegimeTrabRepository;
use App\Domains\Comissionado\Validators\RegimeTrabalhoValidator;
use App\Core\Repositories\BaseRepository;

class RegimeTrabRepositoryEloquent extends BaseRepository implements RegimeTrabRepository
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
        return RegimeTrab::class;
    }

    /**
    * Configure validation
    **/
    public function validator()
    {
        return RegimeTrabalhoValidator::class;
    }
}
