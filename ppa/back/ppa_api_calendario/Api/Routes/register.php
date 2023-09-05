<?php

use Api\Controller\RegisterClass;
use Api\Controller\RegisterUser;
use Api\Http\Response;

// ROTA DE CADASTAR NOVO CURSO
$obRouter->post('/new/course', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, RegisterClass::setNewCourse($request));
  }
]);

// ROTA DE CADASTAR NOVA TURMA
$obRouter->post('/new/class', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, RegisterClass::setNewClass($request));
  }
]);

// ROTA DE CADASTAR NOVA MATÉRIA
$obRouter->post('/new/matter', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, RegisterClass::setNewMatter($request));
  }
]);

// ROTA DE CADASTAR NOVO TIPO DE TRABALHO/ATIVIDADE
$obRouter->post('/new/type/job', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, RegisterClass::setNewTypeJob($request));
  }
]);

// ROTA DE CADASTAR NOVO TRABALHO/ATIVIDADE
$obRouter->post('/new/job', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, RegisterClass::setNewJob($request));
  }
]);

// ROTA DE CADASTAR NOVO ALUNO
$obRouter->post('/new/student', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, RegisterUser::setNewStudent($request));
  }
]);

// ROTA DE CADASTAR NOVO PROFESSOR
$obRouter->post('/new/teacher', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, RegisterUser::setNewTeacher($request));
  }
]);

// ROTA DE CADASTAR NOVO ADMINISTRADOR
$obRouter->post('/new/admin', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, RegisterUser::setNewAdmin($request));
  }
]);
