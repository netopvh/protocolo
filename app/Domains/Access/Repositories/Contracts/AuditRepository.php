<?php

namespace App\Domains\Access\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface AuditRepository
 * @package namespace App\Domains\Access\Repositories\Contracts;
 */
interface AuditRepository extends RepositoryInterface
{
    public function filterAudits($field, $value, $columns = ['*']);
}
