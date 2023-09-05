<?php

use Api\Controller\Auth;
use Api\Controller\RegisterUser;
use Api\Http\Response;


// ROTA DE HOME
$obRouter->get('/', [
  function () {
    return new Response(200, "API do PPA - Projeto Calendário");
  }
]);

// ROTA DE AUTÊNTICACÃO DA API
$obRouter->post('/auth', [
  function ($request) {
    return new Response(200, Auth::generateToken($request));
  }
]);

// ROTA DE LOGIN
$obRouter->get('/user/connected', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, RegisterUser::getCurrentUser($request));
  }
]);
