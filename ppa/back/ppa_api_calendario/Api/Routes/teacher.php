<?php

use Api\Controller\Teacher;
use Api\Http\Response;

// ROTA DE BUSCAR PROFESSORES
$obRouter->get('/teachers', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, Teacher::getTeachers($request));
  }
]);

// ROTA DE BUSCAR UM PROFESSOR, ATRÁVES DE ID OU SIAPE
$obRouter->get('/teacher', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, Teacher::getOneTeacher($request));
  }
]);
