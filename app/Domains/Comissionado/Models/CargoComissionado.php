<?php

namespace App\Domains\Comissionado\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class CargoComissionado
 * @package App\Models
 * @version July 27, 2017, 3:16 pm UTC
 */
class CargoComissionado extends Model implements AuditableContract
{

    use Auditable;

    /**
     * @var string table
     */
    public $table = 'cargocomissionado';
    
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
        'id' => 'integer',
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
        return $this->hasMany(Servidor::class,'comissionado_id','id');
    }

    function setDescricaoAttribute($value)
    {
        $this->attributes['descricao'] = mb_strtoupper($value,'UTF-8');
    }

    public function getDescricaoAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }
}
