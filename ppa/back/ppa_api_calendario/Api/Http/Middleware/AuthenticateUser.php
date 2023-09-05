<?php

namespace Api\Http\Middleware;

class AuthenticateUser
{
  /**
   * Método responsável por autenticar usuário e colocar ele dentro da sessão
   * @param  Request $request
   * @param  Closure next
   * @return Response
   */
  public function handle($request, $next)
  {
    session_start();
    $user = $_SESSION['usuario'];
    $request->user = $user;

    return $next($request);
  }
}
