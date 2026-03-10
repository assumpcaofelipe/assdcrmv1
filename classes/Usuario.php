<?php

class Usuario
{

  private $pdo;

  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }


  private function existeEmail($email)
  {
    $sql = "SELECT 1 FROM usuarios WHERE email = :email LIMIT 1";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':email', $email);
    $sql->execute();

    if ($sql->rowCount() > 0) {
      return true;
    } else {
      return false;
    }
  }

  public function criarUsuario(string $nome, string $email, string $senha)
  {
    $senhaHash = password_hash($senha, PASSWORD_BCRYPT); // senha criprotogrfada;

    if ($this->existeEmail($email) === false) {
      $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)";
      $sql = $this->pdo->prepare($sql);
      $sql->bindValue(':nome', $nome);
      $sql->bindValue(':email', $email);
      $sql->bindValue(':senha', $senhaHash);
      $sql->execute();

      return true;
    } else {
      return false;
    }
  }



  public function retornarListaUsuarios(): array
  {
    $sql = "SELECT * FROM usuarios";
    $sql = $this->pdo->query($sql);

    if ($sql->rowCount() > 0) {
      return $sql->fetchAll(PDO::FETCH_ASSOC);
    } else {
      return array();
    }
  }


  public function editarUsuario($id, $nome, $email,)
  {
    

    $sql = "UPDATE usuarios set  nome = :nome, email = :email WHERE id = :id";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':nome', $nome);
    $sql->bindValue(':email', $email);
    $sql->bindValue(':id', $id);
    $sql->execute();
    return true;
  }




  public function excluir($id)
  {
    $sql = "DELETE FROM usuarios WHERE id = :id";
    $sql = $this->pdo->prepare($sql);
    $sql->bindValue(':id', $id);
    $sql->execute();
  }
}
