<?php

namespace App\Domains\Protocolo\Repositories;

use App\Domains\Protocolo\Models\Secretarias;
use App\Domains\Protocolo\Repositories\Contracts\SecretariasRepository;
use App\Domains\Protocolo\Validators\SecretariaValidator;
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
