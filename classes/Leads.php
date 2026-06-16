<?php


class Leads
{
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }


  private function leadVerificado(string $empresa_nome, string $email)
  {
      $sql = "SELECT 1 FROM leads WHERE email = :email AND empresa_nome = :empresa_nome LIMIT 1";
      $sql = $this->pdo->prepare($sql);
      $sql->bindValue(':email', $email);
      $sql->bindValue(':empresa_nome', $empresa_nome);
      $sql->execute();

      if($sql->rowCount() > 0 ){
         return true;      
        } else{
            return false;
        }
      
  }

  public function criarLead(string $empresa_nome, string $email)
  {

     if($this->leadVerificado($empresa_nome, $email) === false) {
        $sql = "INSERT INTO leads (empresa_nome, email) VALUES (:empresa_nome, :email)";
        $sql = $this->pdo->prepare($sql);
        $sql->bindValue(':empresa_nome', $empresa_nome);
        $sql->bindValue(':email', $email);
        $sql->execute();

        return true;
     } else{
        return false;
     }

  }



}

require_once '../config.php';
