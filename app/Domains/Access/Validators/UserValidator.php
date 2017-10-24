<?php

namespace App\Domains\Access\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'name' => 'required|unique:users',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users|email',
            'password' => 'required',
            'role_id' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'role_id' => 'required'
        ],
   ];

    protected $messages = [
        'name.required' => 'Campo Nome é obrigatório.',
        'name.unique' => 'O :attribute já consta em nosso banco de dados.',
        'username.required' => 'Campo Usuário é obrigatório.',
        'username.unique' => 'A :attribute já consta em nosso banco de dados.',
        'password.required' => 'Campo Senha é obrigatório.',
        'email.required' => 'Campo Email é obrigatório.',
        'email.unique' => 'O :attribute já consta em nosso banco de dados.',
        'role_id.required' => 'Campo Perfil é obrigatório.'
    ];
}
