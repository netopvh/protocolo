<?php

namespace App\Domains\Comissionado\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Conjuge
 * @package App\Models
 * @version August 1, 2017, 1:35 pm UTC
 */
class Conjuge extends Model
{

    public $table = 'conjuge';
    
    public $timestamps = false;



    public $fillable = [
        'nome',
        'idserv'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idconj' => 'integer',
        'nome' => 'string',
        'idserv' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function servidor()
    {
        return $this->belongsTo(Servidor::class);
    }
}
