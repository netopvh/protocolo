<?php

namespace App\Domains\Comissionado\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use App\Domains\Comissionado\Models\Traits\TraitServidorRelations;
use App\Domains\Comissionado\Scopes\ServidorScope;

/**
 * Class Servidor
 * @package App\Models
 * @version August 2, 2017, 1:24 pm UTC
 */
class Servidor extends Model implements AuditableContract
{

    use TraitServidorRelations,Auditable;

    public $table = 'servidores';

    public $fillable = [
        'nome',
        'cpf',
        'estcivil',
        'nomeconj',
        'matricula',
        'pai',
        'mae',
        'cedido',
        'sec_origem_id',
        'sec_atual_id',
        'instrucao_id',
        'nomefaculdade',
        'nomecurso',
        'registroclasse',
        'tipocargo_id',
        'comissionado_id',
        'exclusivo_comissao',
        'nomenclatura_id',
        'nomeorgunidade',
        'nomeautoridade',
        'nomeativsuperv',
        'atividades',
        'qtdevaletransp',
        'regime_id',
        'validado',
        'idvalidador'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'nome' => 'string',
        'cpf' => 'string',
        'estcivil' => 'string',
        'nomeconj' => 'string',
        'matricula' => 'integer',
        'pai' => 'string',
        'mae' => 'string',
        'cedido' => 'string',
        'sec_origem_id' => 'integer',
        'sec_atual_id' => 'integer',
        'instrucao_id' => 'integer',
        'nomefaculdade' => 'string',
        'nomecurso' => 'string',
        'registroclasse' => 'string',
        'tipocargo_id' => 'integer',
        'comissionado_id' => 'integer',
        'exclusivo_comissao' => 'string',
        'nomenclatura_id' => 'integer',
        'nomeorgunidade' => 'string',
        'nomeautoridade' => 'string',
        'nomeativsuperv' => 'string',
        'atividades' => 'string',        
        'qtdevaletransp' => 'integer',
        'regime_id' => 'integer',
        'validado' => 'string',
        'idvalidador' => 'integer'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ServidorScope);
    }

    public function setNomeAttribute($value)
    {
         $this->attributes['nome'] = mb_strtoupper($value,"UTF-8");
    }

    public function getNomeAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }

    public function setPaiAttribute($value)
    {
        if(!is_null($value)){
            $this->attributes['pai'] = mb_strtoupper($value,"UTF-8");
        }
    }

    public function getPaiAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }

    public function setMaeAttribute($value)
    {
        $this->attributes['mae'] = mb_strtoupper($value,"UTF-8");
    }

    public function getMaeAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }

    public function setNomefaculdadeAttribute($value)
    {
        if(!is_null($value)){
            $this->attributes['nomefaculdade'] = mb_strtoupper($value,"UTF-8");
        }
    }

    public function getNomefaculdadeAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }

    public function setNomecursoAttribute($value)
    {
        if(!is_null($value)){
            $this->attributes['nomecurso'] = mb_strtoupper($value,"UTF-8");
        }
    }

    public function getNomecursoAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }

    public function setNomeorgunidadeAttribute($value)
    {
        if(!is_null($value)){
            $this->attributes['nomeorgunidade'] = mb_strtoupper($value,"UTF-8");
        }
    }

    public function getNomeorgunidadeAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }

    public function setNomeautoridadeAttribute($value)
    {
        if(!is_null($value)){
            $this->attributes['nomeautoridade'] = mb_strtoupper($value,"UTF-8");
        }
    }

    public function getNomeautoridadeAttribute($value)
    {
        return mb_strtoupper($value, "UTF-8");
    }
}
