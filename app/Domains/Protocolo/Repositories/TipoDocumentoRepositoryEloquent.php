<?php

namespace App\Domains\Protocolo\Repositories;

use App\Core\Repositories\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Domains\Protocolo\Repositories\Contracts\TipoDocumentoRepository;
use App\Domains\Protocolo\Models\TipoDocumento;
use App\Domains\Protocolo\Validators\TipoDocumentoValidator;

/**
 * Class TipoDocumentoRepositoryEloquent
 * @package namespace App\Domains\Protocolo\Repositories;
 */
class TipoDocumentoRepositoryEloquent extends BaseRepository implements TipoDocumentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TipoDocumento::class;
    }

    /**
    * Configure validation
    **/
    public function validator()
    {
        return TipoDocumentoValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
