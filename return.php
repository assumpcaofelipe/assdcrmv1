<?php

header("Access-Control-Allow-Origin: *"); // Permiti todo os sites a fazer a requisição para sua api
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
header('Content-Type: application/json; charset=UTF-8'); // Permitir suporta caractéres especiais
header("Content-Type: application/json"); // Tipo de resposta

echo json_encode($array);
exit;