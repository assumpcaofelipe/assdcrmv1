<?php


try {
    $db = new PDO("mysql:dbname=assdpainel;host=localhost", "root", "");
    //echo "Conexão bem-sucedida!";
} catch (PDOException $e) {
    echo "Erro ao conectar: " . $e->getMessage();
}

?>

