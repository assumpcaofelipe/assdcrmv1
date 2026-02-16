<?php


try {
    $db = new PDO("mysql:dbname=assdpainel;host=localhost", "root", "");
    //echo "Conexão bem-sucedida!";
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro ao conectar: " . $e->getMessage();
}

?>

