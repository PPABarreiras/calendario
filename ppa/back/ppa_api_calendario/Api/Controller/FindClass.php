<?php

namespace Api\Controller;

use Api\Database\Pagination;
use Api\Repository\ClassRepository;

class FindClass
{
  /**
   * Método responsável por buscar os dados dos cursos
   */
  public static function getCourses($request)
  {
    $queryParams = $request->getQueryParams();
    $currentPage = $queryParams['page'] ?? 1;

    $courses = ClassRepository::findCourses('', '');
    $qtdTotalCourses = count($courses);

    //INSTÂNCIA DE PAGINAÇÃO 
    $obPagination = new Pagination($qtdTotalCourses, $currentPage, 10);
    $limit = $obPagination->getLimit();

    return [
      'cursos'     => ClassRepository::findCourses($limit, ''),
      'pagination' => ApiPagination::getPagination($request, $obPagination)
    ];
  }

  /**
   * Método responsável por buscar os dados de um curso
   */
  public static function getOneCourse($request)
  {
    $queryParams = $request->getQueryParams();
    $id_curso = $queryParams['id'];

    // VERIFICA SE OS PARÂMETROS DE BUSCAR ESTÃO CORRETOS
    if (!$id_curso) {
      return [
        "Error" => true,
        "message" => "Parâmetros incorretos! Para buscar curso, insira ?id=algum valor."
      ];
    }

    //VALIDA O ID DO CURSO
    if (!is_numeric($id_curso)) {
      throw new \Exception("O ID '" . $id_curso . "' não é de um curso válido.", 400);
    }

    // Condição para buscar um curso pelo seu ID
    $where = ClassRepository::whereOneCourseByID($id_curso);

    return [
      'curso' => ClassRepository::findCourses('', $where),
    ];
  }


  /**
   * Método responsável por buscar os dados das turmas
   */
  public static function getClasses($request)
  {
    $queryParams = $request->getQueryParams();
    $currentPage = $queryParams['page'] ?? 1;

    $courses = ClassRepository::findClasses('', '');
    $qtdTotalCourses = count($courses);

    //INSTÂNCIA DE PAGINAÇÃO 
    $obPagination = new Pagination($qtdTotalCourses, $currentPage, 10);
    $limit = $obPagination->getLimit();

    return [
      'turmas'     => ClassRepository::findClasses($limit, ''),
      'pagination' => ApiPagination::getPagination($request, $obPagination)
    ];
  }

  /**
   * Método responsável por buscar os dados de um curso
   */
  public static function getOneClass($request)
  {
    $queryParams = $request->getQueryParams();
    $id_turma = $queryParams['id'];

    // VERIFICA SE OS PARÂMETROS DE BUSCAR ESTÃO CORRETOS
    if (!$id_turma) {
      return [
        "Error" => true,
        "message" => "Parâmetros incorretos! Para buscar turma, insira ?id=algum valor."
      ];
    }

    //VALIDA O ID DA TURMA
    if (!is_numeric($id_turma)) {
      throw new \Exception("O ID '" . $id_turma . "' não é de uma turma válida.", 400);
    }

    // Condição para buscar uma turma
    $where = ClassRepository::whereOneClassByID($id_turma);

    return [
      'turma' => ClassRepository::findClasses('', $where),
    ];
  }
}
