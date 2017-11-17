<?php
/**
 * Created by PhpStorm.
 * User: 00545841240
 * Date: 17/11/2017
 * Time: 11:33
 */

namespace App\Domains\Protocolo\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DepartamentoScope
{

    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        if(! in_admin_group()){
            $builder->where('id_departamento', auth()->user()->id_departamento);
        }
    }

}