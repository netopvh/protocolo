<?php

namespace App\Core\Rules;

use Adldap\Laravel\Validation\Rules\Rule;

class OuRule extends Rule
{
    /**
     * The LDAP user.
     *
     * @var User
     */
    protected $user;
    
    /**
     * The Eloquent model.
     *
     * @var Model|null
     */
    protected $model;
    
    /**
     * Determines if the user is allowed to authenticate.
     *
     * @return bool
     */   
    public function isValid()
    {

        //dd($this->user->getDn());

        $ous = [
            //Unidades Organizacionais CGM
            'OU=CGM,DC=PORTOVELHO,DC=RO,DC=GOV,DC=BR',
        ];
    
        return str_contains($this->user->getDn(), $ous);
    }
}