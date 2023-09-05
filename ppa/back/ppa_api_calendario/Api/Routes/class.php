<?php

use Api\Controller\FindClass;
use Api\Http\Response;

// ROTA DE BUSCAR CURSOS
$obRouter->get('/courses', [
  'middlewares' => [
    'jwt-auth',
    'required-session-admin'
  ],
  function ($request) {
    return new Response(200, FindClass::getCourses($request));
  }
]);

// ROTA DE BUSCAR UM CURSO, ATRÁVES DE ID
$obRouter->get('/course', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, FindClass::getOneCourse($request));
  }
]);

// ROTA DE BUSCAR TURMAS
$obRouter->get('/classes', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, FindClass::getClasses($request));
  }
]);

// ROTA DE BUSCAR UMA TURMA, ATRÁVES DE ID
$obRouter->get('/class', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, FindClass::getOneClass($request));
  }
]);
