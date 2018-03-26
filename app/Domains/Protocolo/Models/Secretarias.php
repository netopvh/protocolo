<?php

namespace App\Domains\Protocolo\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

/**
 * Class Secretarias
 * @package App\Models
 * @version July 20, 2017, 12:33 pm UTC
 */
class Secretarias extends Model implements AuditableContract
{

    use Auditable;

    public $table = 'secretarias';
    
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
        return $this->hasMany(Servidor::class,'sec_atual_id','id');
    }

    public function setDescricaoAttribute($value)
    {
        $this->attributes['descricao'] = mb_strtoupper($value, "UTF-8");
    }

    public function getDescricaoAttribute($value)
    {
        $var = explode(' - ',$value);
        if(count($var) >= 2){
            return mb_strtoupper($var[1], "UTF-8");
        }else{
            return mb_strtoupper($value, "UTF-8");
        }

    }
}
