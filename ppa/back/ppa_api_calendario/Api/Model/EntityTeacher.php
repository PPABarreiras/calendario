<?php

namespace Api\Model;

use Api\Database\Database;

class EntityTeacher
{
  public ?string $id_teacher;
  public ?string $name;
  public ?string $email;
  public ?string $siape;
  public ?string $password;

  private static $tableTeacher = 'teacher';

  public function __construct($values = null)
  {
    if ($values) {
      foreach ($values as $key => $value) {

        $this->$key = $value;
      }
    }
  }

  /**
   * Método responsável por cadastrar um professor no banco de dados
   * @return boolean
   */
  public function registerTeacher()
  {
    $this->id_teacher = (new Database(self::$tableTeacher))->insert([
      'name'         => $this->name,
      'email'        => $this->email,
      'password'     => $this->password,
      'siape'        => $this->siape,
      'created_at'   => date('Y-m-d H:i:s'),
      'updated_at'   => date('Y-m-d H:i:s'),
      'active'       => '1'
    ]);

    return true;
  }


  /**
   * Método responsável por retornar um professor com base no seu siape
   * @param string $siape
   * @return EntityTeacher
   */
  public static function getTeacherBySiape($siape)
  {
    return (new Database(self::$tableTeacher))->select("siape = '${siape}'")->fetchObject(self::class);
  }


  /**
   * Método responsável por atualizar os dados de um professor no banco
   * @return boolean
   */
  public function updateTeacher()
  {
    $id_professor = $this->id_teacher;

    // CRIA A CONEXÃO COM O BANCO
    $db = new Database(self::$tableTeacher);

    $where = "id_teacher = '${id_professor}'";
    $data = [
      'name'       => $this->name,
      'siape'      => $this->siape,
      'email'      => $this->email,
      'password'   => $this->password,
      'active'     => $this->ativo,
      'updated_at' => date('Y-m-d H:i:s')
    ];

    // ATUALIZA OS DADOS DE UM PROFESSOR NO BANCO DE DADOS  
    $db->update($where, $data);

    return 'Dados do professor atualizados com sucesso!';
  }
}
