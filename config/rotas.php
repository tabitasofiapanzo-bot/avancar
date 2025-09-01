<?php

// Definição das rotas da aplicação
return [
    // Rotas da Aplicação Principal
    '/' => 'PaginasController@index',
    '/pilares' => 'PilaresController@index',

    // Rotas de Autenticação
    '/login' => 'AuthController@login', // Exibir formulário de login
    '/login/processar' => 'AuthController@processarLogin', // Processar POST do login
    '/registo' => 'AuthController@registo', // Exibir formulário de registo
    '/registo/processar' => 'AuthController@processarRegisto', // Processar POST do registo
    '/logout' => 'AuthController@logout',

    // Rota de Onboarding
    '/onboarding/salvar' => 'OnboardingController@salvar',
];
