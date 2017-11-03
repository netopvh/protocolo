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
use App\Domains\Protocolo\Models\Departamento;

class User extends Authenticatable implements AuditableContract, UserResolver
{
    use LaratrustUserTrait,HasLdapUser,Notifiable, Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password','is_protocolo','id_departamento'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    public function departamento()
    {
        return $this->belongsTo(Departamento::class,'id_departamento','id');
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
