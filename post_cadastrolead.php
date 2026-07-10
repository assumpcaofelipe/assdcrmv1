<?php
session_start();
require_once 'config.php';
require_once 'classes/Leads.php';
$leads = new Leads($db);


if($_SERVER['REQUEST_METHOD'] === 'POST') {
  
  $id = $_POST['id'] ?? null;
  $empresa_nome = htmlspecialchars(trim($_POST['empresa_nome']));
  //$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);


  

}