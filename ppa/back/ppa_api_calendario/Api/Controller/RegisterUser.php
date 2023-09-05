<?php

namespace Api\Controller;

use Api\Model\EntityAdmin;
use Api\Model\EntityStudent;
use Api\Model\EntityTeacher;
use Api\Repository\AdminRepository;
use Api\Repository\StudentRepository;
use Api\Repository\TeacherRepository;

class RegisterUser
{
  /**
   * Método responsável por cadastrar um novo aluno
   */
  public static function setNewStudent($request)
  {
    //POST VARS
    $postVars = $request->getPostVars();

    // Busca um aluno
    $where = StudentRepository::whereOneStudentByRegistration($postVars['registration']);
    $obStudent = StudentRepository::findStudents('', $where);

    // VERIFICA SE O ALUNO JÁ EXISTE
    if ($obStudent) {
      return [
        "Error" => true,
        "message" => "Já existe um aluno cadastrado com esse número de matrícula!"
      ];
    }

    // VERIFICA SE O EMAIL CADASTRADO JÁ TA CADASTRADO PARA UM ALUNO 
    if ($obStudent[0]->email === $postVars['email']) {
      return [
        "Error" => true,
        "message" => "Email já utilizado por outro aluno!"
      ];
    }

    //NOVA INSTÂNCIA DE ALUNO
    $obStudent               = new EntityStudent;
    $obStudent->name         = $postVars['name'];
    $obStudent->email        = $postVars['email'];
    $obStudent->password     = password_hash($postVars['password'], PASSWORD_DEFAULT);
    $obStudent->registration = $postVars['registration'];
    $obStudent->id_class     = $postVars['id_class'];
    $obStudent->ids_matters  = [$postVars['ids_matters']];
    $obStudent->registerStudent();

    return [
      "success" => true,
      "message" => "Aluno cadastrado com sucesso!"
    ];
  }

  /**
   * Método responsável por cadastrar um novo professor
   */
  public static function setNewTeacher($request)
  {
    //POST VARS
    $postVars = $request->getPostVars();

    // Busca um professor
    $where = TeacherRepository::whereOneTeacherBySiape($postVars['siape']);
    $obTeacher = TeacherRepository::findTeachers('', $where);

    // VERIFICA SE O PROFESSOR JÁ EXISTE
    if ($obTeacher) {
      return [
        "Error" => true,
        "message" => "Já existe um professor cadastrado com esse número siape!"
      ];
    }

    // VERIFICA SE O EMAIL CADASTRADO JÁ TA CADASTRADO PARA UM PROFESSOR 
    if ($obTeacher[0]->email === $postVars['email']) {
      return [
        "Error" => true,
        "message" => "Email já utilizado por outro professor!"
      ];
    }

    //NOVA INSTÂNCIA DE PROFESSOR
    $obTeacher            = new EntityTeacher;
    $obTeacher->name      = $postVars['name'];
    $obTeacher->email     = $postVars['email'];
    $obTeacher->password  = password_hash($postVars['password'], PASSWORD_DEFAULT);
    $obTeacher->siape     = $postVars['siape'];
    $obTeacher->registerTeacher();

    return [
      "success" => true,
      "message" => "Professor cadastrado com sucesso!"
    ];
  }

  /**
   * Método responsável por cadastrar um novo adminstrador
   */
  public static function setNewAdmin($request)
  {
    //POST VARS
    $postVars = $request->getPostVars();

    // Busca um professor
    $where = AdminRepository::whereOneAdminBySiape($postVars['siape']);
    $obAdmin = AdminRepository::findAdmins('', $where);

    // VERIFICA SE O ADMIN JÁ EXISTE
    if ($obAdmin) {
      return [
        "Error" => true,
        "message" => "Já existe um admin cadastrado com esse número siape!"
      ];
    }

    // VERIFICA SE O EMAIL CADASTRADO JÁ TA CADASTRADO PARA UM ADMIN 
    if ($obAdmin[0]->email === $postVars['email']) {
      return [
        "Error" => true,
        "message" => "Email já utilizado por outro admin!"
      ];
    }

    //NOVA INSTÂNCIA DE ADMIN
    $obAdmin            = new EntityAdmin;
    $obAdmin->name      = $postVars['name'];
    $obAdmin->email     = $postVars['email'];
    $obAdmin->password  = password_hash($postVars['password'], PASSWORD_DEFAULT);
    $obAdmin->siape     = $postVars['siape'];
    $obAdmin->registerAdmin();

    return [
      "success" => true,
      "message" => "Administrador cadastrado com sucesso!"
    ];
  }


  /**
   * Método responsável por retornar o usuário atualmente conectado
   * @param Request $request
   * @return array
   */
  public static function getCurrentUser($request)
  {
    //USUÁRIO ATUAL
    $obUser = $request->user;

    if ($obUser->id_student) {
      $indiceID = 'id_student';
      $id = $obUser->id_student;
      $indiceIdentify = 'registration';
      $identify = $obUser->registration;
    } else if ($obUser->id_teacher) {
      $indiceID = 'id_teacher';
      $id = $obUser->id_teacher;
      $indiceIdentify = 'siape';
      $identify = $obUser->siape;
    }

    //RETORNA OS DETALHES DO USUÁRIO
    return [
      $indiceID       => (int)$id,
      'name'          => $obUser->name,
      'email'         => $obUser->email,
      $indiceIdentify => $identify
    ];
  }
}
