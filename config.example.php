<?php
// config.example.php
// Copie este arquivo para config.php e preencha com seus dados

// Definição da URL base
const BASE_URL = '/';

// Array padrão para respostas
$array = [
    'error'  => '',
    'result' => []
];

// Configurações do banco de dados
try {
    $db = new PDO(
        "mysql:dbname=NOME_DO_BANCO;host=localhost",
        "USUARIO_DO_BANCO",
        "SENHA_DO_BANCO"
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    $array['error']  = $e->getMessage();
    $array['result'] = [];
    require 'return.php';
    exit;
}
?>
