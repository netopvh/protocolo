<?php

namespace App\Domains\Comissionado\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class ServidorValidator extends LaravelValidator
{

    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'nome' => 'required|unique:servidores',
            'cpf' => 'required|numeric',
            'estcivil' => 'required',
            'matricula' => 'required|numeric',
            'nomeconj' => 'required_if:estcivil,==,U|required_if:estcivil,==,C',
            'pai' => 'required',
            'mae' => 'required',
            'tipocargo_id' => 'required',
            'comissionado_id' => 'required',
            'nomenclatura_id' => 'required_if:exclusivo_comissionado,==,N',
            'atividades' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];

    protected $messages = [
        'required' => 'The :attribute field is required.',
        'numeric' => 'O campo :attribute é permitido apenas números'
    ];

    protected $attributes = [
        'nome' => 'Nome',
        'cpf' => 'CPF',
        'estcivil' => 'Estado Civil',
        'matricula' => 'Matrícula',
        'pai' => 'Pai',
        'mae' => 'Mãe',
        'sec_atual_id' => 'Secretaria Atual',
        'instrucao_id' => 'Grau de Instrução',
        'tipocargo_id' => 'Tipo de Cargo',
        'comissionado_id' => 'Cargo Comissionado',
        'atividades' => 'Descrição das Atividades'
    ];
}
