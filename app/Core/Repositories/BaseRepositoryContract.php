<?php

namespace App\Core\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

interface BaseRepositoryContract extends RepositoryInterface
{
	public function findWithoutFail($id, $columns = ['*']);
	public function query();
	public function select(array $colunms = ['*']);
}