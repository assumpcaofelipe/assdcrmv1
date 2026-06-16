<?php
//session_start();
require_once '../vendor/autoload.php';
require_once '../app/core/Router.php';


$url = $_GET['url'] ?? '';


$router = new Router();
$router->dispatch($url);


//require_once '../config.php';
//require_once '../classes/Auth.php';
//require_once '../classes/Usuario.php';


//$usuario = New Usuario($db);



//var_dump($usuario);

//$auth = new Auth($db);

//if (!$auth->check()) {
   // header('Location: ../login.php');
    //exit;
//}

    //echo 'Index.php';

  


?>

  