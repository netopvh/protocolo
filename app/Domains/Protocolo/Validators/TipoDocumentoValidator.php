<?php

namespace App\Domains\Protocolo\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class TipoDocumentoValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'descricao' => 'required|unique:tipo_documentos'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'descricao' => 'required|unique:tipo_documentos'
        ],
   ];

    protected $messages = [
        'required' => ':attribute é requerido',
        'unique' => ':attribute já consta em nosso banco de dados'
    ];

    protected $attributes = [
        'descricao' => 'Descrição'
    ];
}
