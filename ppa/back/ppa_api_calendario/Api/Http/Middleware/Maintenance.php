<?php

namespace Api\Http\Middleware;

class Maintenance
{

  /**
   * Método responsável por executar o middleware
   * @param Request $request
   * @param Closure  next
   * @return Response 
   */
  public function handle($request, $next)
  {
    //VERIFICA O ESTADO DE MANUTENCÃO DA ROTA
    if (getenv('MAINTENANCE') == 'true') {
      throw new \Exception("Rota em manutenção. Tente novamente mais tarde.", 200);
    }

    //EXECUTA O PRÓXIMO NíVEL DO MIDDLEWARE
    return $next($request);
  }
}
