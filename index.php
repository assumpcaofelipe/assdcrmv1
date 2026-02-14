<?php
session_start();

require_once 'classes/Auth.php';
require_once 'classes/Usuario.php';
require_once 'config.php';

$usuario = New Usuario($db);
$search = $usuario->retornaNome('assumpcaodesenvolvimento@gmail.com');
echo 'Resultado da Pesquisa: '. $search;


//var_dump($usuario);

//$auth = new Auth($db);

//if (!$auth->check()) {
  //  header('Location: login.php');
    //exit;
//}


?>

  