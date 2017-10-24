<?php

namespace App\Domains\Comissionado\Repositories;

use App\Domains\Comissionado\Models\Servidor;
use App\Domains\Comissionado\Repositories\Contracts\ServidorRepository;
use App\Core\Repositories\BaseRepository;
use App\Domains\Comissionado\Validators\ServidorValidator;

class ServidorRepositoryEloquent extends BaseRepository implements ServidorRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'matricula',
        'cpf'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Servidor::class;
    }

    public function validator()
    {
        return ServidorValidator::class;
    }
}
