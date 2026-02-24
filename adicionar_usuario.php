<?php
session_start();
require_once 'config.php';
require_once 'classes/Usuario.php';
$usuario = new Usuario($db);


if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha'])) {

 $nome = htmlspecialchars(trim($_POST['nome']));
 $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
 $senha = trim($_POST['senha']);

 $nome = ucwords(strtolower($nome));
 $usuario->criarUsuario($nome, $email, $senha);

$_SESSION['msg']  = "<div class='alert alert-person-sucess ' role='alert'>
 Usuário cadastrado com sucesso!
</div>";

 header("Location: usuarios.php");
 exit;

} else{
  $_SESSION['msg']  = "<div class='alert alert-person-danger ' role='alert'>
  Preencha todos os campos:nome, e-mail e senha.
</div>";
 header("Location: usuarios.php");
 exit;
}
