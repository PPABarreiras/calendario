<?php

namespace Api\Model;

use Api\Database\Database;

class EntityClass
{
  public ?string $id_turma;
  public ?string $id_curso;
  public ?string $descricao;
  public ?string $periodo;

  private static $tableClass = 'class';

  public function __construct($values = null)
  {
    if ($values) {
      foreach ($values as $key => $value) {

        $this->$key = $value;
      }
    }
  }

  /**
   * Método responsável por cadastrar uma turma no banco de dados
   * @return boolean
   */
  public function registerClass()
  {
    $this->id_turma = (new Database(self::$tableClass))->insert([
      'description' => $this->descricao,
      'period'      => $this->periodo,
      'id_course'   => $this->id_curso,
      'created_at'  => date('Y-m-d H:i:s'),
      'updated_at'  => date('Y-m-d H:i:s'),
    ]);

    return true;
  }
}
