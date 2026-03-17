<?php

//  $array SEMPRE criado antes do try

$array = [
    'error'  => false,  // sem erro por padrão
    'result' => []      // resultado vazio por padrão
];

try {
    $db = new PDO(
        "mysql:dbname=assdpainel;host=localhost",
        "root",
        ""
    );
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    $array['error']  = $e->getMessage();
    $array['result'] = [];

    //  para tudo e retorna o erro!
    require '../return.php';
    exit;
}