<?php

use Api\Database\Database;
use Api\DotEnv\Environment;
use Api\Http\Middleware\Queue as MiddlewareQueue;

require dirname(__DIR__) . '/vendor/autoload.php';

//CARREGA VARIÁVEIS DE AMBIENTE
Environment::load(__DIR__ . '/../');

//DEFINE AS CONFIGURAÇÕES DE BANCO DE DADOS
Database::config(
    getenv('DB_HOST'),
    getenv('DB_NAME'),
    getenv('DB_USER'),
    getenv('DB_PASSWORD'),
    getenv('DB_PORT')
);

//DEFINE A CONSTANTE DE URL 
define('URL', getenv('URL'));

//DEFINE O MAPEAMENTO DE MIDDLEWARES
MiddlewareQueue::setMap([
    'maintenance'            => \Api\Http\Middleware\Maintenance::class,
    'api'                    => \Api\Http\Middleware\Api::class,
    'jwt-auth'               => \Api\Http\Middleware\JWTAuth::class,
    'authenticateUser'       => \Api\Http\Middleware\AuthenticateUser::class,
    'required-session-admin' => \Api\Http\Middleware\RequireSessionAdmin::class,

]);

//DEFINE O MAPEAMENTO DE MIDDLEWARES PADRÕES (EXECUTADOS EM TODAS AS ROTAS)
MiddlewareQueue::setDefault([
    'authenticateUser',
    'maintenance',
    'api'
]);
