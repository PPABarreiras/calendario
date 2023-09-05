<?php

namespace Api\Http\Middleware;

use Api\Model\EntityStudent;
use Api\Model\EntityTeacher;
use Firebase\JWT\JWT;

class JWTAuth
{
  /**
   * Método responsável por retorna uma instância de usuário autenticado
   * @param  Request $request
   * @return User
   */
  private function getJWTAuthUser($request)
  {
    //HEADERS
    $headers = $request->getHeaders();

    //TOKEN PURO EM JWT
    $jwt = isset($headers['Authorization']) ? str_replace('Bearer ', '', $headers['Authorization']) : '';

    try {

      //DECODE
      $decode = (array)JWT::decode($jwt, getenv('JWT_KEY'), ['HS256']);
    } catch (\Exception $e) {
      throw new \Exception("Token inválido", 403);
    }

    if ($decode['registration']) {

      // BUSCA UM ALUNO PELA MATRÍCULA
      $obUser = EntityStudent::getStudentByRegistration($decode['registration']);

      // RETORNA O ALUNO
      return $obUser instanceof EntityStudent ? $obUser : false;
    } else if ($decode['siape']) {
      // BUSCA UM PROFESSOR PELO SIAPE
      $obUser = EntityTeacher::getTeacherBySiape($decode['siape']);

      // RETORNA O PROFESSOR
      return $obUser instanceof EntityTeacher ? $obUser : false;
    }
  }

  /**
   * Método responsável por validar o acesso via JWT
   * @param Request $request
   */
  private function auth($request)
  {
    //VERIFICA O USUÁRIO RECEBIDO
    if ($obUser = $this->getJWTAuthUser($request)) {

      return true;
    }
    //EMITE O ERRO DE SENHA INVÁLIDA
    throw new \Exception("Acesso negado", 403);
  }

  /**
   * Método responsável por executar o middleware
   * @param  Request  $request
   * @param  Closure  next
   * @return Response 
   */
  public function handle($request, $next)
  {
    //REALIZA A VALIDAÇÃO DO ACESSO VIA JWT
    $this->auth($request);

    //EXECUTA O PRÓXIMO NíVEL DO MIDDLEWARE
    return $next($request);
  }
}
