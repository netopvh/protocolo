<?php

namespace App\Domains\Protocolo\Repositories;

use App\Core\Repositories\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Domains\Protocolo\Repositories\Contracts\TramitacaoRepository;
use App\Domains\Protocolo\Models\Tramitacao;
use App\Domains\Protocolo\Validators\TramitacaoValidator;

/**
 * Class TramitacaoRepositoryEloquent
 * @package namespace App\Domains\Protocolo\Repositories;
 */
class TramitacaoRepositoryEloquent extends BaseRepository implements TramitacaoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tramitacao::class;
    }

    public function validator()
    {
        return TramitacaoValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
