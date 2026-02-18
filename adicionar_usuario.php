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

$_SESSION['msg']  = "Usuário <strong>{$nome}</strong> cadastrado com sucesso!";

 header("Location: usuarios.php");
 exit;

}