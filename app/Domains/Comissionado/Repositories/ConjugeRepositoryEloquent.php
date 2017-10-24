<?php

namespace App\Repositories;

use App\Domains\Comissionado\Models\Conjuge;
use App\Domains\Comissionado\Repositories\Contracts\ConjugeRepository;
use Prettus\Repository\Eloquent\BaseRepository;

class ConjugeRepositoryEloquent extends BaseRepository implements ConjugeRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nome',
        'servidor_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Conjuge::class;
    }
}
