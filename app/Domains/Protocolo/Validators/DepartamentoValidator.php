<?php

namespace App\Domains\Protocolo\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DepartamentoValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'descricao' => 'required|unique:departamentos'
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'descricao' => 'required'
        ],
   ];

   protected $messages = [
   		'required' => 'O campo :attribute é obrigatório',
   		'unique' => ':attribute já consta no banco de dados'
   ];

   protected $attributes = [
   		'descricao' => 'Descrição'
   ];
}
