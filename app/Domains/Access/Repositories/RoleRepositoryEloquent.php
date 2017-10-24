<?php

namespace App\Domains\Access\Repositories;

use App\Exceptions\Access\GeneralException;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Domains\Access\Repositories\Contracts\RoleRepository;
use App\Domains\Access\Models\Role;
use App\Domains\Access\Validators\RoleValidator;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;

/**
 * Class RoleRepositoryEloquent
 * @package namespace App\Domains\Access\Repositories;
 */
class RoleRepositoryEloquent extends BaseRepository implements RoleRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Role::class;
    }

    public function validator()
    {
        return RoleValidator::class;
    }
    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Save a new entity in repository
     *
     * @throws GeneralException
     *
     * @param array $attributes
     *
     * @return mixed
     */
    public function create(array $attributes)
    {

        //Verifica se existe usuário no banco de dados
        $result = $this->model->newQuery()
            ->where('name', $attributes['name'])
            ->get();

        if (empty($result)){
            throw new GeneralException('Usuário já consta em nosso banco de dados');
        }

        $attributes['display_name'] = $attributes['name'];

        $model = $this->model->newInstance($attributes);
        if($model->save()){
            $model->permissions()->sync($attributes['permissions']);
        }
        $this->resetModel();

        event(new RepositoryEntityCreated($this, $model));

        return $this->parserResult($model);
    }

    /**
     * @Override
     *
     * @throws GeneralException
     *
     * @param array $attributes
     * @param       $id
     *
     * @return mixed
     */
    public function update(array $attributes, $id)
    {
        $this->applyScope();

        $temporarySkipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $attributes['name'] = mb_strtolower(str_slug($attributes['display_name']));

        $model = $this->model->findOrFail($id);
        $model->fill($attributes);
        if($model->save()){
            $model->permissions()->sync($attributes['permissions']);
        }

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }

    /**
     * @param $id
     * @return mixed
     * @throws GeneralException
     */
    public function findRole($id)
    {
        $result = $this->model->newQuery()->where('id', $id)->get()->first();
        if (is_null($result)){
            throw new GeneralException("Não foi localizado nenhum registro no banco de dados");
        }

        return $result;
    }

}
