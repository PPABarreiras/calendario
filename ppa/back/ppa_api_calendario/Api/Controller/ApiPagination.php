<?php

namespace Api\Controller;

class ApiPagination
{
  /**
   * Método responsável por retornar os detalhes da paginação
   * @param Request $request
   * @param Pagination $obPagination
   * @return array
   */
  public static function getPagination($request, $obPagination)
  {
    //QUERY PARAMS
    $queryParams = $request->getQueryParams();

    //PÁGINAS
    $pages = $obPagination->getPages();

    //RETORNO
    return  [
      'current_page'  => isset($queryParams['page']) ? (int)$queryParams['page'] : 1,
      'pages'         => !empty($pages) ? count($pages) : 1
    ];
  }
}
