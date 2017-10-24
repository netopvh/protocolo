<?php

namespace App\Domains\Access\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Domains\Access\Repositories\Contracts\PermissionGroupRepository;
use App\Domains\Access\Models\PermissionGroup;
use App\Domains\Access\Validators\PermissionGroupValidator;

/**
 * Class PermissionGroupRepositoryEloquent
 * @package namespace App\Domains\Access\Repositories;
 */
class PermissionGroupRepositoryEloquent extends BaseRepository implements PermissionGroupRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PermissionGroup::class;
    }

    public function validator()
    {
        return PermissionGroupValidator::class;
    }
    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
