<?php

namespace Api\Controller;

use Api\Model\EntityClass;
use Api\Model\EntityCourse;
use Api\Model\EntityJob;
use Api\Model\EntityMatter;
use Api\Repository\ClassRepository;

class RegisterClass
{
  /**
   * Método responsável por cadastrar um novo curso
   */
  public static function setNewCourse($request)
  {
    //POST VARS
    $postVars = $request->getPostVars();

    // BUSCA UM CURSO
    $obCourse = ClassRepository::findCourseByDescription($postVars['description']);

    // VERIFICA SE UM CURSO JÁ FOI CADASTRADO
    if ($obCourse) {
      return [
        "Error" => true,
        "message" => "Já existe um curso cadastrado com essa descrição!"
      ];
    }

    //NOVA INSTÂNCIA DE CURSO
    $obUser             = new EntityCourse();
    $obUser->descricao  = $postVars['description'];
    $obUser->registerCourse();

    return [
      "success" => true,
      "message" => "Curso cadastrado com sucesso!"
    ];
  }


  /**
   * Método responsável por cadastrar uma nova turma
   */
  public static function setNewClass($request)
  {
    //POST VARS
    $postVars = $request->getPostVars();

    //NOVA INSTÂNCIA DE TURMA
    $obUser             = new EntityClass();
    $obUser->descricao  = $postVars['description'];
    $obUser->periodo    = $postVars['period'];
    $obUser->id_curso   = $postVars['id_course'];
    $obUser->registerClass();

    return [
      "success" => true,
      "message" => "Turma cadastrada com sucesso!"
    ];
  }

  /**
   * Método responsável por cadastrar uma nova matéria
   */
  public static function setNewMatter($request)
  {
    //POST VARS
    $postVars = $request->getPostVars();

    //NOVA INSTÂNCIA DE MATÉRIA
    $obMatter             = new EntityMatter();
    $obMatter->descricao  = $postVars['description'];
    $obMatter->id_turma   = $postVars['id_class'];
    $obMatter->registerMatter();

    return [
      "success" => true,
      "message" => "Matéria cadastrada com sucesso!"
    ];
  }

  /**
   * Método responsável por cadastrar um novo tipo de trabalho/atividade
   */
  public static function setNewTypeJob($request)
  {
    //POST VARS
    $postVars = $request->getPostVars();


    $obTypeJob = ClassRepository::getTypeJobByDescription($postVars['description']);

    // VERIFICA SE UM TIPO JÁ FOI CADASTRADO
    if ($obTypeJob) {
      return [
        "Error" => true,
        "message" => "Já existe um tipo cadastrado com essa descrição!"
      ];
    }

    //NOVA INSTÂNCIA DE MATÉRIA
    $obJob            = new EntityJob();
    $obJob->descricao = $postVars['description'];
    $obJob->registerType();

    return [
      "success" => true,
      "message" => "Tipo de trabalho/atividade cadastrado com sucesso!"
    ];
  }

  /**
   * Método responsável por cadastrar um novo trabalho/atividade
   */
  public static function setNewJob($request)
  {
    //POST VARS
    $postVars = $request->getPostVars();

    //NOVA INSTÂNCIA DE MATÉRIA
    $obJob            = new EntityJob();
    $obJob->titulo    = $postVars['title'];
    $obJob->descricao = $postVars['description'];
    $obJob->prazo     = $postVars['deadline'];
    $obJob->id_tipo   = $postVars['id_type'];
    $obJob->registerJob();

    return [
      "success" => true,
      "message" => "Trabalho/Atividade cadastrado(a) com sucesso!"
    ];
  }
}
