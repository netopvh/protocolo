<?php

return [
    'role_structure' => [
        'superadministrador' => [
            'administração' => 'r',
            'usuário' => 'c,u,d',
            'perfil' => 'c,u,d',
        ],
        'administrador' => [
            'administração' => 'r',
            'usuário' => 'c,u,d',
            'perfil' => 'c,u',
        ],
        'usuário' => [
            '' => ''
        ],
    ],
    'permission_structure' => [
        'cru_user' => [
            'profile' => 'c,r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'criar',
        'r' => 'ver',
        'u' => 'atualizar',
        'd' => 'remover'
    ]
];
