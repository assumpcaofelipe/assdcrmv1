<?php
session_start();
require_once 'config.php';
require_once 'classes/Lead.php';
require_once 'classes/CadastroLeads.php';

$cadastroLeads = new CadastroLeads($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $id = $_POST['id'] ?? null;
  $empresa_nome = htmlspecialchars(trim($_POST['empresa_nome'] ?? ''));
  $email = filter_var($_POST['email'] ?? null, FILTER_VALIDATE_EMAIL);
  $telefone = htmlspecialchars(trim($_POST['telefone'] ?? ''));
  $empresa_site = htmlspecialchars(trim($_POST['empresa_site'] ?? ''));
  $decisor_nome = htmlspecialchars(trim($_POST['decisor_nome'] ?? ''));
  $decisor_cargo = htmlspecialchars(trim($_POST['decisor_cargo'] ?? ''));
  $decisor_linkedin = htmlspecialchars(trim($_POST['decisor_linkedin'] ?? ''));
  $status = htmlspecialchars($_POST['status'] ?? '');
  $origem = $_POST['origem'] ? htmlspecialchars($_POST['origem']) : null;

  // Datas
  $primeiro_contato = !empty($_POST['primeiro_contato'])
    ? new DateTime($_POST['primeiro_contato'])
    : null;

  $proximo_contato = !empty($_POST['proximo_contato'])
    ? new DateTime($_POST['proximo_contato'])
    : null;

  $observacoes = htmlspecialchars(trim($_POST['observacoes'] ?? ''));

  // Adicionar

  if (!empty($empresa_nome)) {

    $lead = new Lead($empresa_nome);
    $lead->email = $email;
    $lead->telefone = $telefone;
    $lead->empresa_site = $empresa_site;
    $lead->decisor_nome = $decisor_nome;
    $lead->decisor_cargo = $decisor_cargo;
    $lead->decisor_linkedin = $decisor_linkedin;
    $lead->status = !empty($status) ? $status : 'prospeccao';
    $lead->origem = $origem;
    $lead->primeiro_contato = $primeiro_contato;
    $lead->proximo_contato = $proximo_contato;
    $lead->observacoes = $observacoes;

    
    if ($cadastroLeads->criarLead($lead)) {

        $_SESSION['msg']  = "<div class='assdtec-btn assdtec-btn-success' role='alert'>
        Cadastrado com sucesso!
</div>";
    } else {

      $_SESSION['msg'] = "
        <div class='alert alert-person-danger' role='alert'>
            Já existe um cadastro com o nome dessa empresa.
        </div>";
    }

    header("Location: lista.php");
    exit;
  } else {

    $_SESSION['msg'] = "
    <div class='alert alert-person-danger' role='alert'>
        O nome da empresa é obrigatório.
    </div>";

    header("Location: lista.php");
    exit;
  }
}
