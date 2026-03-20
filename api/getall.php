<?php

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']); // Padronizando a requisição;

if ($method === 'get') {

    $sql = $db->query("SELECT * FROM usuarios");
    if ($sql->rowCount() > 0) {
        $listaUsuarios = $sql->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listaUsuarios as $usuario) {
            $array['result'][] = [
                'id' => $usuario['id'],
                'nome' => $usuario['nome'],
                'email' => $usuario['email']
            ];
        }
    }
} else {
    http_response_code(405);
    $array['error'] = 'Método não permitido (Apenas GET)';
}



require '../return.php';
