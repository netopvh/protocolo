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

class User extends Authenticatable implements AuditableContract, UserResolver
{
    use LaratrustUserTrait;
    use Notifiable, Auditable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','username', 'email', 'password','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

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
