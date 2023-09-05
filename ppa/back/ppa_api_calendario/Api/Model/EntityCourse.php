<?php

namespace Api\Model;

use Api\Database\Database;

class EntityCourse
{
  public ?string $id_curso;
  public ?string $descricao;

  private static $tableCourse = 'course';

  public function __construct($values = null)
  {
    if ($values) {
      foreach ($values as $key => $value) {

        $this->$key = $value;
      }
    }
  }

  /**
   * Método responsável por cadastrar um curso no banco de dados
   * @return boolean
   */
  public function registerCourse()
  {
    $this->id_curso = (new Database(self::$tableCourse))->insert([
      'description' => $this->descricao,
      'created_at'  => date('Y-m-d H:i:s'),
      'updated_at'  => date('Y-m-d H:i:s')
    ]);

    return true;
  }
}
