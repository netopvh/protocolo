<?php

namespace App\Domains\Comissionado\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LinhaOnibus
 * @package App\Models
 * @version July 20, 2017, 12:32 pm UTC
 */
class LinhaOnibus extends Model
{

    public $table = 'linhaonibus';
    
    public $timestamps = false;



    public $fillable = [
        'idserv',
        'linha1',
        'linha2',
        'linha3',
        'linha4',
        'linha5',
        'linha6',
        'linha7',
        'linha8',
        'trajeto'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idlinonb' => 'integer',
        'idserv' => 'integer',
        'linha1' => 'string',
        'linha2' => 'string',
        'linha3' => 'string',
        'linha4' => 'string',
        'linha5' => 'string',
        'linha6' => 'string',
        'linha7' => 'string',
        'linha8' => 'string',
        'trajeto' => 'string'
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
