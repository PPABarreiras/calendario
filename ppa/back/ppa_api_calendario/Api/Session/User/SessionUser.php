<?php

namespace Api\Session\User;

class SessionUser
{
  /**
   * Método responsável por iniciar a sessão
   */
  private static function init()
  {
    //VERIFICA SE A SESSÃO NÃO ESTÁ ATIVA
    if (session_status() != PHP_SESSION_ACTIVE) {
      session_start();
    }
  }

  /**
   * Método responsável por criar a sessão do usuário
   * @return boolean
   */
  public static function createSession($obUser)
  {
    //INICIA A SESSÃO 
    self::init();

    //DEFINE A SESSÃO DO USUÁRIO
    $_SESSION['usuario'] = $obUser;

    //SUCESSO
    return true;
  }

  /**
   * Método responsável por verificarr se a sessão do usuário foi criada
   * @return boolean
   */
  public static function isCreated()
  {
    //INICIA A SESSÃO 
    self::init();

    //RETORNA A VERIFICAÇÃO
    return isset($_SESSION['usuario']);
  }

  /**
   * Método responsável por destruir a sessão do usuario do usuário
   * @return boolean
   */
  public static function destroySession()
  {
    //INICIA A SESSÃO 
    self::init();

    //DESLOGA O USUÁRIO
    unset($_SESSION['usuario']);

    //SUCESSO
    return true;
  }
}
