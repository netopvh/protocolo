<?php

namespace App\Domains\Comissionado\Repositories;

use App\Domains\Comissionado\Models\Secretarias;
use App\Domains\Comissionado\Repositories\Contracts\SecretariasRepository;
use App\Domains\Comissionado\Validators\SecretariaValidator;
use App\Core\Repositories\BaseRepository;

class SecretariasRepositoryEloquent extends BaseRepository implements SecretariasRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descricao' => 'like'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Secretarias::class;
    }

    /**
    * Configure validation
    **/
    public function validator()
    {
        return SecretariaValidator::class;
    }
}
