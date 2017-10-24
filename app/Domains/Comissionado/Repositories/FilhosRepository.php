<?php

namespace App\Repositories;

use App\Models\Filhos;
use InfyOm\Generator\Common\BaseRepository;

class FilhosRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'idserv'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Filhos::class;
    }
}
