<?php

namespace App\Domains\Access\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface RoleRepository
 * @package namespace App\Domains\Access\Repositories\Contracts;
 */
interface RoleRepository extends RepositoryInterface
{
    public function findRole($id);
}
