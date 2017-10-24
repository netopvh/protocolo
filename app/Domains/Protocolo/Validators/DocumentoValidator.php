<?php

namespace App\Domains\Protocolo\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class DocumentoValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
        	'numero' => 'required',
        	'ano' => 'required',
        	'assunto' => 'required',
        	'id_tipo_doc' => 'required',
        	'int_ext' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
        	'numero' => 'required',
        	'ano' => 'required',
        	'assunto' => 'required',
        	'id_tipo_doc' => 'required',
        	'int_ext' => 'required',
        ],
   ];

   protected $message = [
   		'required' => ':attribute é obrigatório'
   ];

   protected $attributes = [
   		'numero' => 'Número',
   		'ano' => 'Ano',
   		'assunto' => 'Assunto',
   		'id_tipo_doc' => 'Tipo de Documento',
   		'int_ext' => 'Interno/Externo'
   ];
}
