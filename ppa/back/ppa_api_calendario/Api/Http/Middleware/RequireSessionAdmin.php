<?php

namespace Api\Http\Middleware;

class RequireSessionAdmin
{
  /**
   * Método responsável por executar o middleware
   * @param  Request $request
   * @param  Closure next
   * @return Response
   */
  public function handle($request, $next)
  {

    echo '<pre>';
    print_r($request->user);
    echo '</pre>';
    exit;
     

    //VALIDA SE O USUÁRIO É UM ADMINISTRADOR  
    if ($request->user->permissao == 'admin') {

      return $next($request);
    } else {
      echo 'URL não encontrada';
    }
  }
}
