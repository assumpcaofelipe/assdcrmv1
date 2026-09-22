<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: lista.php");
    exit;
}

require_once 'config.php';
require_once 'classes/Lead.php';
require_once 'classes/CadastroLeads.php';

$editLeads = new CadastroLeads($db);



$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);


if ($id === false || $id === null) {
    $_SESSION['msg'] = "
    <div class='assdtec-notication-error'>
      Erro! Tente novamente.
    </div>";

    header("Location: lista.php");
    exit;
}



$empresa_nome = htmlspecialchars(trim($_POST['empresa_nome'] ?? ''));
$email = trim($_POST['email'] ?? '');
$telefone = htmlspecialchars(trim($_POST['telefone'] ?? ''));
$empresa_site = htmlspecialchars(trim($_POST['empresa_site'] ?? ''));
$decisor_nome = htmlspecialchars(trim($_POST['decisor_nome'] ?? ''));
$decisor_cargo = htmlspecialchars(trim($_POST['decisor_cargo'] ?? ''));
$decisor_linkedin = htmlspecialchars(trim($_POST['decisor_linkedin'] ?? ''));
$status = htmlspecialchars($_POST['status'] ?? '');
$origem = htmlspecialchars($_POST['origem'] ?? '');

// Datas
$primeiro_contato = !empty($_POST['primeiro_contato'])
    ? new DateTime($_POST['primeiro_contato'])
    : null;

$proximo_contato = !empty($_POST['proximo_contato'])
    ? new DateTime($_POST['proximo_contato'])
    : null;


$observacoes = htmlspecialchars(trim($_POST['observacoes'] ?? ''));

$lead = new Lead($empresa_nome);
$lead->id = $id;
$lead->email = $email;
$lead->telefone = $telefone;
$lead->empresa_site = $empresa_site;
$lead->decisor_nome = $decisor_nome;
$lead->decisor_cargo = $decisor_cargo;
$lead->decisor_linkedin = $decisor_linkedin;
$lead->status = !empty($status) ? $status : 'novo';
$lead->origem = $origem;
$lead->primeiro_contato = $primeiro_contato;
$lead->proximo_contato = $proximo_contato;
$lead->observacoes = $observacoes;


$editLeads->EditarLead($lead);

$_SESSION['msg']  = "<div class='assdtec-btn assdtec-btn-success' >
         editado com sucesso!
     </div>";
header("Location: lista.php");
exit;
