<?php

session_start();
require_once 'classes/Auth.php';
require_once 'config.php';
require_once 'classes/Lead.php';






$auth = new Auth($db);

if (!$auth->check()) {
  header('Location: login.php');
  exit;
}


$lead = [
    'id' => '',
    'empresa_nome' => '',
    'empresa_site' => '',
    'empresa_linkedin' => '',
    'decisor_nome' => '',
    'decisor_cargo' => '',
    'decisor_linkedin' => '',
    'telefone' => '',
    'email' => '',
    'observacoes' => '',
    'primeiro_contato' => '',
    'proximo_contato' => '',
    'status' => '',
    'origem' => '',
];






if (!empty($_REQUEST['action'])) {


  try {

    if ($_REQUEST['action'] == 'edit' && !empty($_GET['id'])) {

      $id = (int) $_GET['id'];
      $lead = Lead::find($id);

      //echo '<pre>';
     // var_dump($lead);
       //die();
      //echo '</pre>';
      

    }
  } catch (Exception $e) {
    print $e->getMessage();
  }
} else {
  echo 'ERRO';
}


  

    $statusRotulo = [
    'prospeccao' => 'Prospectado',
    'contato_inicial' => 'Fazer Primeiro Contato',
    'apresentacao_solucao' => 'Reunião Marcada',
    'proposta_enviada' => 'Proposta Enviada',
    'negociando' => 'Negociando',
    'fechado' => 'Fechado',
    'pos_venda' => 'Pós Venda',
    'perdido' => 'Perdido',
];

$option = '';

foreach( $statusRotulo as $chave => $valor){
  if($chave == $lead['status']){
     $option .= "<option value = '{$chave}' selected> $valor </option>";
  }else{
      $option.= "<option value = '{$chave}'>$valor</option>";
  }
}

$legendaOrigem = 
[
  'google' => 'Google',
  'facebook' => 'Facebook',
  'instagram' => 'Instagram',
  'linkedin' => 'Linkedin',
  'indicacao' => 'Indicação'
   
];

 $origem = '';

foreach ($legendaOrigem as $chave => $valor){
   if($chave == $lead['origem']){
       $origem .= "<option value = '{$chave}' selected> $valor </option>";
   } else{
      $origem.= "<option value = '{$chave}'>$valor</option>";
   }
}






$form = file_get_contents('templates/form.html');


$form = str_replace('{id}', $lead['id'] ?? '', $form);
$form = str_replace('{empresa}', $lead['empresa_nome'] ?? '', $form);
$form = str_replace('{email}', $lead['email'] ?? '', $form);
$form = str_replace('{telefone}', $lead['telefone'] ?? '', $form);
$form = str_replace('{site}', $lead['empresa_site'] ?? '', $form);
$form = str_replace('{decisornome}', $lead['decisor_nome'] ?? '', $form);
$form = str_replace('{decisorcargo}', $lead['decisor_cargo'] ?? '', $form);
$form = str_replace('{decisorlinkedin}', $lead['decisor_linkedin'] ?? '', $form);
$form = str_replace('{status}', $option ?? '', $form);
$form = str_replace('{origem}', $origem ?? '', $form);
$form = str_replace('{primeirocontato}', $lead['primeiro_contato'] ?? '', $form);
$form = str_replace('{proximocontato}', $lead['proximo_contato'] ?? '', $form);
$form = str_replace(
    '{notas}',
    htmlspecialchars($lead['observacoes'] ?? '', ENT_QUOTES, 'UTF-8'),
    $form
);



print $form;
