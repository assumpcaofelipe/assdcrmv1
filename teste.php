<?php

require_once 'config.php';
require_once 'classes/Lead.php';
require_once 'classes/CadastroLeads.php';

$lead = new Lead("Manamel Doces");

$lead->id = 8;
$lead->decisor_nome = "Roberval";
$lead->observacoes = "Conversamos por mensagem pediu para entra em contato dia 10/08 
";

$cadastro = new CadastroLeads($db);

$retorno = $cadastro->EditarLead($lead);

 //var_dump($retorno);


if ($retorno) {
    echo "Lead atualizado com sucesso!";
} else {
    echo "Erro ao atualizar Lead.";
}