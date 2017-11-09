<?php
/**
 * Created by PhpStorm.
 * User: Neto
 * Date: 05/10/2017
 * Time: 22:45
 */

namespace App\Core\Repositories;

use Prettus\Repository\Eloquent\BaseRepository as PrettusRepository;
use Illuminate\Container\Container as Application;

class BaseRepository extends PrettusRepository implements BaseRepositoryContract
{

    public function __construct(Application $app)
    {
        parent::__construct($app);
    }

    public function model()
    {
        return $this->model;
    }

    public function findWithoutFail($id, $columns = ['*'])
    {
        try {
            return $this->find($id, $columns);
        } catch (\Exception $e) {
            return;
        }
    }

    public function query()
    {
        return $this->model->newQuery();
    }

    public function select(array $colunms = ['*'])
    {
        return $this->model->newQuery()->select($colunms);
    }

}