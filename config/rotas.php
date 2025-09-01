<?php

// Definição das rotas da aplicação
return [
    '/' => 'PaginasController@index',
    '/pilares' => 'PilaresController@index',
    '/onboarding/salvar' => 'OnboardingController@salvar',
    // Adicionar outras rotas aqui no futuro
];
