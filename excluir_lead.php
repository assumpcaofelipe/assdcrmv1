<?php
session_start();
require_once 'config.php';
require_once 'classes/CadastroLeads.php';

if(!empty($_GET['id'])){

   $id = $_GET['id'];

   $excluirLead = new CadastroLeads($db);
   $excluirLead->excluirLead($id);

}

header("Location:lista.php");