<?php

// Definição das rotas da aplicação
// O objeto $roteador é instanciado em core/App.php e passado para este arquivo.

$roteador->get('/', 'PaginasController@index');
$roteador->get('/pilares', 'PilaresController@index');

// --- Autenticação ---
$roteador->get('/login', 'AuthController@login');
$roteador->post('/login/processar', 'AuthController@processarLogin');
$roteador->get('/registo', 'AuthController@registo');
$roteador->post('/registo/processar', 'AuthController@processarRegisto');
$roteador->get('/logout', 'AuthController@logout');

// --- Onboarding ---
$roteador->get('/onboarding', 'OnboardingController@index'); // Exibir página de onboarding
$roteador->post('/onboarding/salvar', 'OnboardingController@salvar'); // Processar dados do onboarding
