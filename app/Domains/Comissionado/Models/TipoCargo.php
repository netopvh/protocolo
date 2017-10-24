<?php

namespace App\Domains\Comissionado\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class TipoCargo
 * @package App\Models
 * @version July 20, 2017, 12:33 pm UTC
 */
class TipoCargo extends Model implements AuditableContract
{

    use Auditable;

    public $table = 'tipocargo';
    
    public $timestamps = false;



    public $fillable = [
        'descricao'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idtpc' => 'integer',
        'descricao' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function servidores()
    {
        return $this->hasMany(Servidor::class,'tipocargo_id','id');
    }

    public function setDescricaoAttribute($value)
    {
        $this->attributes['descricao'] = mb_strtoupper($value, "UTF-8");
    }

    public function getDescricaoAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }
}
