<?php

namespace Api\Repository;

use Api\Database\Database;
use Api\Model\EntityAdmin;

class AdminRepository
{
  /**
   * Condição responsável por buscar todos os admin ativos
   */
  public static function whereAllAdmins()
  {
    return "a.active = 1";
  }

  /**
   * Condição responsável por buscar um admin ativo atráves do seu ID
   */
  public static function whereOneAdminByID($id_admin)
  {
    return "a.id_admin = ${id_admin} AND a.active = 1";
  }

  /**
   * Condição responsável por buscar todos os admins ativos atráves do seu siape
   */
  public static function whereOneAdminBySiape($siape)
  {
    return "a.siape = '${siape}' AND a.active = 1";
  }

  /**
   * Método responsável por buscar os administradores no banco
   */
  public static function findAdmins($limit, $where)
  {
    //LIMITE DE REGISTROS POR PÁGINA
    $limit = explode(",", $limit);
    $limit = $limit[1] ? "LIMIT $limit[0], $limit[1]" : '';

    //QUERY
    $query = self::getQuery($limit, $where);

    //Cria o PDO de sql que busca os admines
    $results = (new Database())->execute($query);

    //Transforma a variável em object e o insere no array
    while ($obAdmin = $results->fetchObject(EntityAdmin::class)) {

      $itens[] = $obAdmin;
    }

    //RETORNA OS ITENS
    return $itens;
  }

  /**
   * Método responsável por retornar os dados do admin do banco através de um select
   */
  public static function getQuery($limit = '', $where)
  {
    return "SELECT a.id_admin,
                   a.name,
                   a.email, 
                   a.siape, 
                   a.created_at, 
                   a.updated_at, 
                   a.active
                   FROM admin a WHERE ${where} ${limit}";
  }
}
