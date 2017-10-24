<?php

namespace App\Domains\Access\Models;

use Laratrust\LaratrustRole;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Role extends LaratrustRole implements AuditableContract
{
    use Auditable;

    protected $fillable = ['name','display_name','description'];

    public function setDisplayNameAttribute($value)
    {
        $this->attributes['display_name'] = mb_strtoupper($value,'UTF-8');
    }
}
