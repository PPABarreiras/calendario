<?php

namespace Api\Model;

use Api\Database\Database;

class EntityAdmin
{
  public ?string $id_admin;
  public ?string $name;
  public ?string $email;
  public ?string $siape;
  public ?string $admin;
  public ?string $password;

  private static $tableAdmin = 'admin';

  public function __construct($values = null)
  {
    if ($values) {
      foreach ($values as $key => $value) {

        $this->$key = $value;
      }
    }
  }

  /**
   * Método responsável por cadastrar um admin no banco de dados
   * @return boolean
   */
  public function registerAdmin()
  {
    $this->id_admin = (new Database(self::$tableAdmin))->insert([
      'name'         => $this->name,
      'email'        => $this->email,
      'password'     => $this->password,
      'siape'        => $this->siape,
      'created_at'   => date('Y-m-d H:i:s'),
      'updated_at'   => date('Y-m-d H:i:s'),
      'admin'        => 1,
      'active'       => '1'
    ]);

    return true;
  }


  /**
   * Método responsável por retornar um admin com base no seu siape
   * @param string $siape
   * @return EntityAdmin
   */
  public static function getAdminBySiape($siape)
  {
    return (new Database(self::$tableAdmin))->select("siape = '${siape}'")->fetchObject(self::class);
  }


  /**
   * Método responsável por atualizar os dados de um admin no banco
   * @return boolean
   */
  public function updateAdmin()
  {
    $id_admin = $this->id_admin;

    // CRIA A CONEXÃO COM O BANCO
    $db = new Database(self::$tableAdmin);

    $where = "id_admin = '${id_admin}'";
    $data = [
      'name'       => $this->name,
      'siape'      => $this->siape,
      'email'      => $this->email,
      'password'   => $this->password,
      'active'     => $this->ativo,
      'admin'      => $this->admin,
      'updated_at' => date('Y-m-d H:i:s')
    ];

    // ATUALIZA OS DADOS DE UM PROFESSOR NO BANCO DE DADOS  
    $db->update($where, $data);

    return 'Dados do admin atualizados com sucesso!';
  }
}
