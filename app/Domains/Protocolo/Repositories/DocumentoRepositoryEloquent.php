<?php

namespace App\Domains\Protocolo\Repositories;

use App\Core\Repositories\BaseRepository;
use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Domains\Protocolo\Repositories\Contracts\DocumentoRepository;
use App\Domains\Protocolo\Models\Documento;
use App\Domains\Protocolo\Validators\DocumentoValidator;

/**
 * Class DocumentoRepositoryEloquent
 * @package namespace App\Domains\Protocolo\Repositories;
 */
class DocumentoRepositoryEloquent extends BaseRepository implements DocumentoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Documento::class;
    }

    /**
    * Configure validation
    **/
    public function validator()
    {
        return DocumentoValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
