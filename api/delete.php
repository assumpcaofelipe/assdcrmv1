<?php

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'delete') {

    // leitura correta para API  (JSON)
    $input = json_decode(file_get_contents('php://input'), true);

    $id = filter_var($input['id'] ?? null, FILTER_VALIDATE_INT);

    if ($id) {

        $sql = $db->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    } else {
        http_response_code(404);
        $array['error'] = 'ID não enviado';
    }
} else {
    http_response_code(405);
    $array['error'] = 'Método não permitido (Apenas DELETE)';
}

require '../return.php';
