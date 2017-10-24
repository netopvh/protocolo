<?php

namespace App\Domains\Comissionado\Repositories;

use App\Domains\Comissionado\Models\LinhaOnibus;
use App\Domains\Comissionado\Repositories\Contracts\LinhaOnibusRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class LinhaOnibusRepositoryEloquent extends BaseRepository implements LinhaOnibusRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'idserv',
        'linha1',
        'linha2',
        'linha3',
        'linha4',
        'linha5',
        'linha6',
        'linha7',
        'linha8',
        'trajeto'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return LinhaOnibus::class;
    }
}
