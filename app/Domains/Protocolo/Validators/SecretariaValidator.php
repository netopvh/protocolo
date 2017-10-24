<?php

namespace App\Domains\Protocolo\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class SecretariaValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'descricao' => 'required|unique:secretarias'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'descricao' => 'required'
        ],
   ];

    protected $messages = [
        'required' => 'O campo :attribute é requerido.',
        'unique' => 'O :attribute já consta em nosso banco de dados.',
    ];
}
