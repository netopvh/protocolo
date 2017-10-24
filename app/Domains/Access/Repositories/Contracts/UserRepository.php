<?php

namespace App\Domains\Access\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace App\Domains\Access\Repositories\Contracts;
 */
interface UserRepository extends RepositoryInterface
{
    public function filterUsers($field, $value, $columns = ['*']);
    public function findUser($id);
}
