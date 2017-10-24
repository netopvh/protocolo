<?php
/**
 * Created by PhpStorm.
 * User: Neto
 * Date: 10/10/2017
 * Time: 21:34
 */

namespace App\Domains\Comissionado\Models\Traits;

use App\Domains\Comissionado\Models\Secretarias;
use App\Domains\Comissionado\Models\TipoCargo;
use App\Domains\Comissionado\Models\GrauInstrucao;
use App\Domains\Comissionado\Models\NomenclaturaCargo;
use App\Domains\Comissionado\Models\RegimeTrab;
use App\Domains\Comissionado\Models\CargoComissionado;
use App\Domains\Comissionado\Models\LinhaOnibus;
use App\Domains\Comissionado\Models\Endereco;
use App\Domains\Comissionado\Models\Conjuge;
use App\Domains\Comissionado\Models\Filhos;

trait TraitServidorRelations
{

    //Os ouros parâmetros da classe é para mostrar descrições ao invés dos IDs
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function secretaria()
    {
        return $this->belongsTo(Secretarias::class, 'sec_atual_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function tipocargo()
    {
        return $this->belongsTo(Tipocargo::class, 'tipocargo_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function grauinstrucao()
    {
        return $this->belongsTo(Grauinstrucao::class, 'instrucao_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function nomenclaturacargo()
    {
        return $this->belongsTo(Nomenclaturacargo::class, 'nomenclatura_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function regimetrab()
    {
        return $this->belongsTo(RegimeTrab::class,'regime_id','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function cargocomissionado()
    {
        return $this->belongsTo(Cargocomissionado::class, 'comissionado_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function linhaonibuses()
    {
        return $this->hasMany(LinhaOnibus::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function enderecos()
    {
        return $this->hasMany(Endereco::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function conjuges()
    {
        return $this->hasMany(Conjuge::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function filhos()
    {
        return $this->hasMany(Filhos::class, 'idfil', 'idfil');
    }

}