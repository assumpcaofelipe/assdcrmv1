<?php
session_start();
require_once 'config.php';
require_once 'classes/Usuario.php';


//var_dump($_GET['id']);

if(!empty($_GET['id'])){

  $id = $_GET['id'];

  $usuario = New Usuario($db);
  $usuario->excluir($id);

}

header("Location:usuarios.php");
