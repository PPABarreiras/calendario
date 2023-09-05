<?php

namespace Api\Controller;

use Api\Database\Pagination;
use Api\Repository\TeacherRepository;

class Teacher
{
    /**
     * Metódo responsável por buscar os dados de todos os professores ainda ativos
     */
    public static function getTeachers($request)
    {
        $queryParams = $request->getQueryParams();
        $currentPage = $queryParams['page'] ?? 1;

        $where = TeacherRepository::whereAllTeachers();
        $students = TeacherRepository::findTeachers('', $where);
        $qtdTotalStudents = count($students);

        //INSTÂNCIA DE PAGINAÇÃO 
        $obPagination = new Pagination($qtdTotalStudents, $currentPage, 10);
        $limit = $obPagination->getLimit();

        return [
            'professores' => TeacherRepository::findTeachers($limit, $where),
            'pagination' => ApiPagination::getPagination($request, $obPagination)
        ];
    }


    /**
     * Metódo responsável por buscar os dados de um professor ainda ativo
     */
    public static function getOneTeacher($request)
    {
        $queryParams = $request->getQueryParams();
        $id_professor = $queryParams['id'];
        $siape = $queryParams['siape'];

        // VERIFICA SE OS PARÂMETROS DE BUSCAR ESTÃO CORRETOS
        if (!$id_professor && !$siape) {
            return [
                "Error" => true,
                "message" => "Parâmetros incorretos! Para buscar professor, insira ?id=algum valor ou ?siape=algum valor"
            ];
        }

        if ($siape) {
            $where = TeacherRepository::whereOneTeacherBySiape($siape);
        } else if ($id_professor) {

            //VALIDA O ID DO PROFESSOR
            if (!is_numeric($id_professor)) {
                throw new \Exception("O ID '" . $id_professor . "' não é de um usuário válido.", 400);
            }

            $where = TeacherRepository::whereOneTeacherByID($id_professor);
        }

        return [
            'professor' => TeacherRepository::findTeachers('', $where)
        ];
    }
}
