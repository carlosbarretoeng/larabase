<?php

return [
    'models' => [
        'user' => [
            'id' => 'Id',
            'name' => 'Nome',
            'username' => 'Usuário',
            'password' => 'Senha',
            'email' => 'E-mail',
            'roles' => 'Acessos',
            'empresa' => 'empresa'
        ],
        'empresa' => [
            'id' => 'ID',
            'name' => 'Nome',
            'usuarios_por_empresa' => '# Usuários'
        ],
        'motivosdeparada' => [
            'id' => 'Id',
            'name' => 'Nome'
        ],
        'departamentos' => [
            'id' => 'Id',
            'empresa' => 'Empresa',
            'name' => 'Nome'
        ]
    ]
];
