<?php

namespace App\Domains\Access\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class PermissionGroup extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['parent_id','name','sort'];

}
