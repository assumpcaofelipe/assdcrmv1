<?php
session_start();
require_once 'config.php';
require_once 'classes/Usuario.php';
$usuario = new Usuario($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


  $id = $_POST['id'] ?? null;

  $nome = htmlspecialchars(trim($_POST['nome']));
  $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
  $senha = trim($_POST['senha']);

  if (empty($nome) || empty($email) || empty($senha)) {

       $_SESSION['msg']  = "<div class='alert alert-person-danger ' role='alert'>
       Preencha todos os campos: nome, e-mail e senha.
       </div>";
        header("Location: usuarios.php");
        exit;
    }

    if (!empty($id)) {

        // EDITAR
        $usuario->editarUsuario($id, $nome, $email);
        $_SESSION['msg']  = "<div class='alert alert-person-sucess ' role='alert'>
 Usuário atualizado com sucesso!
</div>";


    } else {
        $usuario->criarUsuario($nome, $email, $senha);
        $_SESSION['msg']  = "<div class='alert alert-person-sucess ' role='alert'>
 Usuário cadastrado com sucesso!
</div>";

    }

    header("Location: usuarios.php");
    exit;
}
  

