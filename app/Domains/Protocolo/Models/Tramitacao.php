<?php

namespace App\Domains\Protocolo\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class Tramitacao extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
        'data_tram','id_documento','id_origem','id_destino','id_usuario','tipo_tram','despacho','status'
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

}
