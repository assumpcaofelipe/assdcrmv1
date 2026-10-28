<?php
session_start();
require_once 'classes/Auth.php';
require_once 'config.php';
require_once 'classes/Lead.php';


//Verificação parao usuário está logado:

$auth = new Auth($db);


if (!$auth->check()) {
    header('Location: login.php');
    exit;
}


try {
    if (!empty($_GET['action']) and ($_GET['action']) == 'delete') {

        $id = $_GET['id'];
        Lead::delete($id);
    }

    $leads = Lead::all();
 

} catch (Exception $e) {
    print $e->getMessage();
}


$items = '';


// Legenda de tradução do status que veio do banco.

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




// Leads da página atual


 if($leads) {

   foreach($leads as $lead)
    {
        $item = file_get_contents('templates/item.html');

        $item = str_replace('{id}', $lead['id'], $item); 
        $item = str_replace('{empresa}', $lead['empresa_nome'], $item);
        $item = str_replace('{status}', $statusRotulo[$lead['status']], $item);
        $item = str_replace('{proximocontato}', $lead['proximo_contato'] ?? '', $item);

        // Colocar para exibir a informação de contato

        $items .= $item;
    }
     

 }


$listaContatos = file_get_contents('templates/lista.html');
$listaContatos = str_replace('{items}', $items, $listaContatos);



print $listaContatos;




