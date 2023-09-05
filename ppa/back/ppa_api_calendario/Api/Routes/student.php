<?php

use Api\Controller\Student;
use Api\Http\Response;

// ROTA DE BUSCAR ALUNOS
$obRouter->get('/students', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, Student::getStudents($request));
  }
]);

// ROTA DE BUSCAR UM ALUNO, ATRÁVES DE ID OU MATRICULA
$obRouter->get('/student', [
  'middlewares' => [
    'jwt-auth'
  ],
  function ($request) {
    return new Response(200, Student::getOneStudent($request));
  }
]);
