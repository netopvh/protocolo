<?php

namespace App\Domains\Protocolo\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use Carbon\Carbon;

class Documento extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
    	'numero','ano','data_doc','assunto','id_tipo_doc','int_ext','id_departamento','id_secretaria'
    ];


    public function tipo_documento()
    {
    	return $this->belongsTo(TipoDocumento::class,'id_tipo_doc','id');
    }

	public function departamento()
    {
    	return $this->belongsTo(Departamento::class,'id_departamento','id');
    } 

    public function documentos()
    {
        return $this->hasMany(DocumentoAnexo::class,'id_documento','id');
    }

    public function tramitacoes()
    {
        return $this->hasMany(Tramitacao::class,'id_documento','id');
    }

    public function setAssuntoAttribute($value)
    {
        $this->attributes['assunto'] = mb_strtoupper($value, "UTF-8");
    }

    public function getAssuntoAttribute($value)
    {
        return mb_strtoupper($value,"UTF-8");
    }

    public function setDataDocAttribute($value)
    {
        $this->attributes['data_doc'] = Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function getDataDocAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y');
    }

}
