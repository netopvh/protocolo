<?php

namespace App\Domains\Access\Repositories;

use App\Domains\Access\Validators\RoleValidator;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Domains\Access\Repositories\Contracts\PermissionRepository;
use App\Domains\Access\Models\Permission;
use App\Domains\Access\Validators\PermissionValidator;

/**
 * Class PermissionRepositoryEloquent
 * @package namespace App\Domains\Access\Repositories;
 */
class PermissionRepositoryEloquent extends BaseRepository implements PermissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Permission::class;
    }

    public function validator()
    {
        return PermissionValidator::class;
    }
    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
