<?php

namespace Api\Repository;

use Api\Database\Database;
use Api\Model\EntityStudent;

class StudentRepository
{
  /**
   * Condição responsável por buscar todos os alunos ativos
   */
  public static function whereAllStudents()
  {
    return "s.active = 1";
  }

  /**
   * Condição responsável por buscar um aluno ativo atráves do seu ID
   */
  public static function whereOneStudentByID($id_aluno)
  {
    return "s.id_student = ${id_aluno} AND s.active = 1";
  }

  /**
   * Condição responsável por buscar todos os alunos ativos atráves da sua matrícula
   */
  public static function whereOneStudentByRegistration($matricula)
  {
    return "s.registration = '${matricula}' AND s.active = 1";
  }

  /**
   * Método responsável por buscar os alunos no banco
   */
  public static function findStudents($limit, $where)
  {
    //LIMITE DE REGISTROS POR PÁGINA
    $limit = explode(",", $limit);
    $limit = $limit[1] ? "LIMIT $limit[0], $limit[1]" : '';

    //QUERY
    $query = self::getQuery($limit, $where);

    //Cria o PDO de sql que busca os alunos
    $results = (new Database())->execute($query);

    //Transforma a variável em object e o insere no array
    while ($obStudent = $results->fetchObject(EntityStudent::class)) {

      $itens[] = $obStudent;
    }

    //RETORNA OS ITENS
    return $itens;
  }

  /**
   * Método responsável por retornar os dados do aluno do banco através de um select
   */
  public static function getQuery($limit = '', $where)
  {
    return "SELECT s.id_student,
                   s.name,
                   s.email, 
                   s.registration, 
                   s.id_class, 
                   s.created_at, 
                   s.updated_at, 
                   s.active
                   FROM student s WHERE ${where} ${limit}";
  }
}
