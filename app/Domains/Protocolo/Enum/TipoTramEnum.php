<?php
/**
 * Created by PhpStorm.
 * User: 00545841240
 * Date: 08/11/2017
 * Time: 09:49
 */

namespace App\Domains\Protocolo\Enum;

use Greg0ire\Enum\AbstractEnum;

class TipoTramEnum extends AbstractEnum
{
    const C = 'Encaminhou';
    const S = 'Enviou';
    const D = 'Devolveu';
    const R = 'Recebeu';
}