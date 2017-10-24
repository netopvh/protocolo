<?php

namespace App\Domains\Comissionado\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class RegimeTrab
 * @package App\Models
 * @version July 20, 2017, 3:26 pm UTC
 */
class RegimeTrab extends Model implements AuditableContract
{

    use Auditable;

    public $table = 'regimetrab';
    
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
        return $this->hasMany(Servidor::class,'regime_id','id');
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
