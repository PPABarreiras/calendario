<?php

namespace Api\Model;

use Api\Database\Database;

class EntityJob
{
  public ?string $id_materia;
  public ?string $id_tipo;
  public ?string $id_trabalho;
  public ?string $descricao;
  public ?string $titulo;
  public ?string $prazo;

  //Tabelas usadas
  private static $tableJob = 'job';
  private static $tableJobMatter = 'job_matter';
  private static $tableType = 'type';

  public function __construct($values = null)
  {
    if ($values) {
      foreach ($values as $key => $value) {

        $this->$key = $value;
      }
    }
  }

  /**
   * Método responsável por cadastrar uma matéria no banco de dados
   * @return boolean
   */
  public function registerJob()
  {
    $this->id_trabalho = (new Database(self::$tableJob))->insert([
      'title'       => $this->titulo,
      'description' => $this->descricao,
      'deadline'    => $this->prazo,
      'id_type'     => $this->id_tipo,
      'created_at'  => date('Y-m-d H:i:s'),
      'updated_at'  => date('Y-m-d H:i:s')
    ]);    

    return true;
  }

  /**
   * Método responsável por cadastrar um trabalho/atividade vinculada a uma matéria no banco de dados
   * @return boolean
   */
  public function registerJobMatter()
  {
    $this->id_aluno_materia = (new Database(self::$tableJobMatter))->insert([
      'id_job'    => $this->id_trabalho,
      'id_matter' => $this->id_materia
    ]);

    return true;
  }

  /**
   * Método responsável por cadastrar o tipo de trabalho/atividade no banco de dados
   * @return boolean
   */
  public function registerType()
  {
    $this->id_tipo = (new Database(self::$tableType))->insert([
      'description' => $this->descricao
    ]);

    return true;
  }
}
