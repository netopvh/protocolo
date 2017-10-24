<?php

namespace App\Domains\Protocolo\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class TipoDocumento extends Model implements AuditableContract
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
