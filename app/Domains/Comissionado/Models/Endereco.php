<?php

namespace App\Domains\Comissionado\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Endereco
 * @package App\Models
 * @version July 20, 2017, 12:30 pm UTC
 */
class Endereco extends Model
{

    public $table = 'endereco';
    
    public $timestamps = false;



    public $fillable = [
        'idserv',
        'rua',
        'numero',
        'bairro',
        'cep',
        'complemento'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'idender' => 'integer',
        'idserv' => 'integer',
        'rua' => 'string',
        'numero' => 'string',
        'bairro' => 'string',
        'cep' => 'string',
        'complemento' => 'string'
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
