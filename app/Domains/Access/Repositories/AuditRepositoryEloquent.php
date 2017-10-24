<?php

namespace App\Domains\Access\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Domains\Access\Repositories\Contracts\AuditRepository;
use App\Domains\Access\Models\Audit;

/**
 * Class AuditRepositoryEloquent
 * @package namespace App\Domains\Access\Repositories;
 */
class AuditRepositoryEloquent extends BaseRepository implements AuditRepository
{

    protected $fieldSearchable = [
        'event' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Audit::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * {@inheritdoc}
     */
    public function all($columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->newQuery()
            ->join('users', 'audits.user_id', '=', 'users.id')
            ->select(
                'audits.id',
                'users.name',
                'audits.auditable_type AS item',
                'audits.ip_address AS ip',
                'audits.created_at',
                DB::raw("CASE 
                            WHEN audits.event = 'created' THEN 'Novo' 
                            WHEN audits.event = 'updated' THEN 'Atualização' 
                            WHEN audits.event = 'deleted' THEN 'Remoção' END as event")
            )
            ->paginate(10);


        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($results);
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function filterAudits($field, $value, $columns = ['*'])
    {
        $this->applyCriteria();
        $this->applyScope();

        $results = $this->model->newQuery()
            ->join('users', 'audits.user_id', '=', 'users.id')
            ->select(
                'audits.id',
                'users.name',
                'audits.auditable_type AS item',
                'audits.ip_address AS ip',
                'audits.created_at',
                DB::raw("CASE 
                            WHEN audits.event = 'created' THEN 'Novo' 
                            WHEN audits.event = 'updated' THEN 'Atualização' 
                            WHEN audits.event = 'deleted' THEN 'emoção' END as event")
            )
            ->where($field,'like','%'. $value .'%')
            ->paginate(10);


        $this->resetModel();
        $this->resetScope();

        return $this->parserResult($results);
    }
}
