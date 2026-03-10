<?php
session_start();

require_once 'classes/Auth.php';
require_once 'classes/Usuario.php';
require_once 'config.php';

$usuario = New Usuario($db);



//var_dump($usuario);

$auth = new Auth($db);

if (!$auth->check()) {
    header('Location: login.php');
    exit;
}

?>

  