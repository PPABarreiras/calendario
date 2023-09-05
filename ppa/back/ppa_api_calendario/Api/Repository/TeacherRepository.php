<?php

namespace Api\Repository;

use Api\Database\Database;
use Api\Model\EntityTeacher;

class TeacherRepository
{
  /**
   * Condição responsável por buscar todos os professores ativos
   */
  public static function whereAllTeachers()
  {
    return "t.active = 1";
  }

  /**
   * Condição responsável por buscar um professor ativo atráves do seu ID
   */
  public static function whereOneTeacherByID($id_professor)
  {
    return "t.id_teacher = ${id_professor} AND t.active = 1";
  }

  /**
   * Condição responsável por buscar todos os professores ativos atráves do seu siape
   */
  public static function whereOneTeacherBySiape($siape)
  {
    return "t.siape = '${siape}' AND t.active = 1";
  }

  /**
   * Método responsável por buscar os professores no banco
   */
  public static function findTeachers($limit, $where)
  {
    //LIMITE DE REGISTROS POR PÁGINA
    $limit = explode(",", $limit);
    $limit = $limit[1] ? "LIMIT $limit[0], $limit[1]" : '';

    //QUERY
    $query = self::getQuery($limit, $where);

    //Cria o PDO de sql que busca os professores
    $results = (new Database())->execute($query);

    //Transforma a variável em object e o insere no array
    while ($obTeacher = $results->fetchObject(EntityTeacher::class)) {

      $itens[] = $obTeacher;
    }

    //RETORNA OS ITENS
    return $itens;
  }

  /**
   * Método responsável por retornar os dados do professor do banco através de um select
   */
  public static function getQuery($limit = '', $where)
  {
    return "SELECT t.id_teacher,
                   t.name,
                   t.email, 
                   t.siape, 
                   t.created_at, 
                   t.updated_at, 
                   t.active
                   FROM teacher t WHERE ${where} ${limit}";
  }
}
