<?php
session_start();
require_once '../config.php';
require_once '../classes/Auth.php';
require_once '../vendor/autoload.php';
require_once '../app/core/Router.php';


$url = $_GET['url'] ?? '';


$router = new Router();
$router->dispatch($url);



$auth = new Auth($db);

if (!$auth->check()) {
    header('Location: ../login.php');
    exit;
}


  


?>

  