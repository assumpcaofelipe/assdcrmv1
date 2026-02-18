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
        
        if($sql->rowCount() > 0){
           return true;  
        } else{
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

    public function retornaNome($email): string
    {
       $sql = "SELECT nome FROM usuarios WHERE email = :email";
       $sql = $this->pdo->prepare($sql);
       $sql->bindValue(':email', $email);
       $sql->execute();

       if($sql->rowCount() > 0){
         $info = $sql->fetch(PDO::FETCH_ASSOC);
         return $info['nome'];
       } else{
         return '';
       }
    }

    public function retornarListaUsuarios():array
    {
       $sql = "SELECT * FROM usuarios";
       $sql = $this->pdo->query($sql);

       if($sql->rowCount() > 0){
         return $sql->fetchAll(PDO::FETCH_ASSOC);
       } else {
         return array();
       }
    }

    public function editarSenha($senha, $email)
    {
           $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

           if($this->existeEmail($email)){
              $sql = "UPDATE usuarios set senha = :senha WHERE email = :email";
              $sql = $this->pdo->prepare($sql);           
              $sql->bindValue(':senha', $senhaHash);
              $sql->bindValue(':email', $email);
              $sql->execute();
              return true;
              
              } else{
                return false;
              }

    }
   

    public function excluir($id)
    {
          $sql = "DELETE FROM usuarios WHERE  id = :id";     
          $sql = $this->pdo->prepare($sql);
          $sql->bindValue(':id', $id);
          $sql->execute();
       
    }

}
