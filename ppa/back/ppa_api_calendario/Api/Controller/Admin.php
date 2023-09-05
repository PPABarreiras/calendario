<?php

namespace Api\Controller;

use Api\Database\Pagination;
use Api\Repository\AdminRepository;

class Admin
{
    /**
     * Metódo responsável por buscar os dados de todos os admins ainda ativos
     */
    public static function getAdmins($request)
    {
        $queryParams = $request->getQueryParams();
        $currentPage = $queryParams['page'] ?? 1;

        $where = AdminRepository::whereAllAdmins();
        $students = AdminRepository::findAdmins('', $where);
        $qtdTotalStudents = count($students);

        //INSTÂNCIA DE PAGINAÇÃO 
        $obPagination = new Pagination($qtdTotalStudents, $currentPage, 10);
        $limit = $obPagination->getLimit();

        return [
            'admins' => AdminRepository::findAdmins($limit, $where),
            'pagination' => ApiPagination::getPagination($request, $obPagination)
        ];
    }


    /**
     * Metódo responsável por buscar os dados de um admin ainda ativo
     */
    public static function getOneAdmin($request)
    {
        $queryParams = $request->getQueryParams();
        $id_admin = $queryParams['id'];
        $siape = $queryParams['siape'];

        // VERIFICA SE OS PARÂMETROS DE BUSCAR ESTÃO CORRETOS
        if (!$id_admin && !$siape) {
            return [
                "Error" => true,
                "message" => "Parâmetros incorretos! Para buscar admin, insira ?id=algum valor ou ?siape=algum valor"
            ];
        }

        // VALIDA O SIAPE DO ADMIN
        if ($siape) {
            $where = AdminRepository::whereOneAdminBySiape($siape);
        } else if ($id_admin) {

            //VALIDA O ID DO ADMIN
            if (!is_numeric($id_admin)) {
                throw new \Exception("O ID '" . $id_admin . "' não é de um usuário válido.", 400);
            }

            $where = AdminRepository::whereOneAdminByID($id_admin);
        }

        return [
            'admin' => AdminRepository::findAdmins('', $where)
        ];
    }
}
