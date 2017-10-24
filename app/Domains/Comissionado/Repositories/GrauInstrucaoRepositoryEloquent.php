<?php

namespace App\Domains\Comissionado\Repositories;

Use App\Domains\Comissionado\Models\GrauInstrucao;
use App\Domains\Comissionado\Repositories\Contracts\GrauInstrucaoRepository;
use App\Domains\Comissionado\Validators\GrauInstrucaoValidator;
use App\Core\Repositories\BaseRepository;

class GrauInstrucaoRepositoryEloquent extends BaseRepository implements GrauInstrucaoRepository
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
        return GrauInstrucao::class;
    }

    /**
    * Configure validation
    **/
    public function validator()
    {
        return GrauInstrucaoValidator::class;
    }
}
