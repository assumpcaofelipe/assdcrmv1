<?php

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']); // Padronizando a requisição;

if ($method === 'get') {

    $id = filter_input(INPUT_GET, 'id');

    if ($id) {
        $sql = $db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [
                'id' => $data['id'],
                'nome' => $data['nome'],
                'email' => $data['email']
            ];

        } else {
            $array['error'] = 'ID NÃO EXISTE';
        }
    } else {
        $array['error'] = 'ID NÃO ENVIADO';
    }
} else {
    http_response_code(405);
    $array['error'] = 'Método não permitido (Apenas GET)';
}



require '../return.php';
