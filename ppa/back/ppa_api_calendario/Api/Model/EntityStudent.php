<?php

namespace Api\Model;

use Api\Database\Database;
use Api\Repository\ClassRepository;

class EntityStudent
{
  public ?string $id_aluno;
  public ?string $id_class;
  public ?string $id_course;
  public ?string $name;
  public ?string $email;
  public ?string $registration;
  public ?string $password;
  public ?string $curso;

  private static $tableStudent = 'student';

  public function __construct($values = null)
  {
    if ($values) {
      foreach ($values as $key => $value) {

        $this->$key = $value;
      }
    }

    // $this->getClassOfStudent();
    // $this->getCourseOfStudent();
  }

  /**
   * Método responsável por cadastrar um aluno no banco de dados
   * @return boolean
   */
  public function registerStudent()
  {
    $this->id_student = (new Database(self::$tableStudent))->insert([
      'name'         => $this->name,
      'email'        => $this->email,
      'password'     => $this->password,
      'registration' => $this->registration,
      'id_class'     => $this->id_class,
      'created_at'   => date('Y-m-d H:i:s'),
      'updated_at'   => date('Y-m-d H:i:s'),
      'active'       => '1'
    ]);

    $obMatter = new EntityMatter;

    foreach ($this->ids_matters as $id_matter) {
      $obMatter->registerStudentMatter($this->id_student, $id_matter);
    }

    return true;
  }


  /**
   * Método responsável por retornar um aluno com base na sua matrícula
   * @param string $registration
   * @return EntityStudent
   */
  public static function getStudentByRegistration($registration)
  {
    return (new Database(self::$tableStudent))->select("registration = '${registration}'")->fetchObject(self::class);
  }

  /**
   * Método responsável por retornar um curso de um aluno
   */
  public function getCourseOfStudent()
  {
    $where = ClassRepository::whereOneCourseByID($this->class->id_course);

    $this->course = ClassRepository::findCourses('', $where);
  }

  /**
   * Método responsável por retornar uma turma de um aluno
   */
  public function getClassOfStudent()
  {

    $this->class = ClassRepository::findClassByID($this->id_class);
  }

  /**
   * Método responsável por atualizar os dados de um aluno no banco
   * @return boolean
   */
  public function updateStudent()
  {
    $id_aluno = $this->id_aluno;

    // CRIA A CONEXÃO COM O BANCO
    $db = new Database(self::$tableStudent);

    $where = "id_student = '${id_aluno}'";
    $data = [
      'name'          => $this->name,
      'email'         => $this->email,
      'registration'  => $this->registration,
      'id_class'      => $this->id_class,
      'password'      => $this->password,
      'active'        => $this->ativo,
      'updated_at'    => date('Y-m-d H:i:s')
    ];

    // ATUALIZA OS DADOS DE UM ALUNO NO BANCO DE DADOS  
    $db->update($where, $data);

    return 'Dados do aluno atualizados com sucesso!';
  }
}
