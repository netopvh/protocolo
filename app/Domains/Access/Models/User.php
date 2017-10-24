<?php

namespace App\Domains\Access\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Auditable;
use OwenIt\Auditing\Contracts\Auditable as AuditableContract;
use OwenIt\Auditing\Contracts\UserResolver;
use Laratrust\Traits\LaratrustUserTrait;
use App\Core\Notifications\ResetPassword;
use Adldap\Laravel\Traits\HasLdapUser;
use App\Domains\Comissionado\Models\Servidor;
use App\Domains\Comissionado\Models\Secretarias;

class User extends Authenticatable implements AuditableContract, UserResolver
{
    use LaratrustUserTrait,HasLdapUser,Notifiable, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password','servidor_id','orgao'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function servidor()
    {
        return $this->belongsTo(Servidor::class);
    }

    public function secretaria()
    {
        return $this->belongsTo(Secretarias::class,'secretaria_id','id');
    }

    /**
     *
     */
    public static function resolveId()
    {
        return auth()->check() ? auth()->user()->getAuthIdentifier() : null;
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = mb_strtoupper($value,'UTF-8');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
