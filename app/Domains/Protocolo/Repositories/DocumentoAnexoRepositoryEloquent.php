<?php

namespace App\Domains\Protocolo\Repositories;

use App\Core\Repositories\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Domains\Protocolo\Repositories\Contracts\DocumentoAnexoRepository;
use App\Domains\Protocolo\Models\DocumentoAnexo;
use App\Domains\Protocolo\Validators\DocumentoAnexoValidator;

/**
 * Class DocumentoRepositoryEloquent
 * @package namespace App\Domains\Protocolo\Repositories;
 */
class DocumentoAnexoRepositoryEloquent extends BaseRepository implements DocumentoAnexoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DocumentoAnexo::class;
    }

    /**
    * Configure validation
    **/
    public function validator()
    {
        return DocumentoAnexoValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
