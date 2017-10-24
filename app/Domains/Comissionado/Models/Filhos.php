<?php

namespace App\Domains\Comissionado\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Filhos
 * @package App\Models
 * @version August 1, 2017, 1:38 pm UTC
 */
class Filhos extends Model
{

    public $table = 'filhos';
    
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
        'idfil' => 'integer',
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
        return $this->belongsTo(Servidor::class, 'idserv', 'idserv');
    }
}
