<?php

namespace Api\Controller;

use Api\Database\Pagination;
use Api\Repository\StudentRepository;

class Student
{
    /**
     * Metódo responsável por buscar os dados de todos os alunos ainda ativos
     */
    public static function getStudents($request)
    {
        $queryParams = $request->getQueryParams();
        $currentPage = $queryParams['page'] ?? 1;

        $where = StudentRepository::whereAllStudents();
        $students = StudentRepository::findStudents('', $where);
        $qtdTotalStudents = count($students);

        //INSTÂNCIA DE PAGINAÇÃO 
        $obPagination = new Pagination($qtdTotalStudents, $currentPage, 10);
        $limit = $obPagination->getLimit();

        return [
            'alunos'     => StudentRepository::findStudents($limit, $where),
            'pagination' => ApiPagination::getPagination($request, $obPagination)
        ];
    }


    /**
     * Metódo responsável por buscar os dados de um aluno ainda ativo
     */
    public static function getOneStudent($request)
    {
        $queryParams = $request->getQueryParams();
        $id_aluno = $queryParams['id'];
        $matricula = $queryParams['registration'];

        // VERIFICA SE OS PARÂMETROS DE BUSCAR ESTÃO CORRETOS
        if (!$id_aluno && !$matricula) {
            return [
                "Error" => true,
                "message" => "Parâmetros incorretos! Para buscar aluno, insira ?id=algum valor ou ?registration=algum valor"
            ];
        }

        if ($matricula) {
            $where = StudentRepository::whereOneStudentByRegistration($matricula);
        } else if ($id_aluno) {

            //VALIDA O ID DO ALUNO
            if (!is_numeric($id_aluno)) {
                throw new \Exception("O ID '" . $id_aluno . "' não é de um usuário válido.", 400);
            }

            $where = StudentRepository::whereOneStudentByID($id_aluno);
        }

        return [
            'aluno' => StudentRepository::findStudents('', $where)
        ];
    }
}
