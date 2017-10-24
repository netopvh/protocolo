<?php

namespace App\Domains\Protocolo\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;

class DocumentoAnexo extends Model implements AuditableContract
{
    use Auditable;

    protected $fillable = [
    	'id_documento','filename'
    ];
}
