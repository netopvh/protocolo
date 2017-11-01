<?php

namespace App\Domains\Protocolo\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Departamento extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = ['descricao'];

    public function setDescricaoAttribute($value)
    {
    	$this->attributes['descricao'] = mb_strtoupper($value, "UTF-8");
    }

    public function getDescricaoAttribute($value)
    {
    	return mb_strtoupper($value, "UTF-8");
    }

}
