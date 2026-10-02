<?php
session_start();
require_once 'classes/Auth.php';
require_once 'config.php';
require_once 'classes/Lead.php';
require_once 'classes/CadastroLeads.php';

//Verificação parao usuário está logado:

$auth = new Auth($db);


if (!$auth->check()) {
    header('Location: login.php');
    exit;
}


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

$cadastroLeads = new CadastroLeads($db);

// Paginação;


/*$limite = 5;

$pg = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT);

if ($pg === false || $pg === null || $pg < 1) {
    $pg = 1;
}

$offset = ($pg - 1) * $limite;

// Total de leads
$total = $cadastroLeads->contarLeads();

// Total de páginas
$paginas = ceil($total / $limite); */

$items = '';

// Leads da página atual

 $contatos = $cadastroLeads->retornarListaLeads();

       
   foreach($contatos as $contato)
    {
        $item = file_get_contents('templates/item.html');

        $item = str_replace('{empresa}', $contato['empresa_nome'], $item);
        $item = str_replace('{status}', $statusRotulo[$contato['status']], $item);
        $item = str_replace('{proximocontato}', $contato['proximo_contato'] ?? '', $item);


        // Colocar para exibir a informação de contato

        $items.= $item;
    }
     
    

$listaContatos = file_get_contents('templates/lista.html');
$listaContatos = str_replace('{items}', $items, $listaContatos);



print $listaContatos;


// Filtro

/*$situacao = filter_input(INPUT_POST, 'status');

if (isset($situacao) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $lista = $cadastroLeads->buscarLeadporStatus($situacao);
}
*/


