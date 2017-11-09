<?php

namespace App\Domains\Protocolo\Models;

use App\Domains\Access\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Tramitacao extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
        'data_tram','id_documento','id_departamento_origem','id_secretaria_origem','id_departamento_destino','id_secretaria_destino','id_usuario','tipo_tram','despacho','status'
    ];

    public function setDataTramAttribute($value)
    {
        $this->attributes['data_tram'] = Carbon::createFromFormat('d/m/Y',$value)->format('Y-m-d');
    }

    public function getDataTramAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d',$value)->format('d/m/Y');
    }

    public function documentos()
    {
        return $this->belongsTo(Documento::class,'id_documento','id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class,'id_usuario','id');
    }

    public function secretaria_origem()
    {
        return $this->belongsTo(Secretarias::class,'id_secretaria_origem','id');
    }

    public function secretaria_destino()
    {
        return $this->belongsTo(Secretarias::class,'id_secretaria_destino','id');
    }

    public function departamento_origem()
    {
        return $this->belongsTo(Departamento::class,'id_departamento_origem','id');
    }

    public function departamento_destino()
    {
        return $this->belongsTo(Departamento::class,'id_departamento_destino','id');
    }

}
