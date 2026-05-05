<?php

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']);

if ($method === 'put') {

    // leitura correta para API  (JSON)
    $input = json_decode(file_get_contents('php://input'), true);

    $id = filter_var($input['id'] ?? null, FILTER_VALIDATE_INT);
    $email = filter_var($input['email'] ?? null, FILTER_VALIDATE_EMAIL);
    $nome = htmlspecialchars(trim($input['nome'] ?? ''));

    if ($id && $email && $nome) {

        $sql = $db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {

            $sql = $db->prepare("UPDATE usuarios SET email = :email, nome = :nome WHERE id = :id");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':email', $email);
            $sql->bindValue(':nome', $nome);
            $sql->execute();

            $array['result'] = [
                'id' => $id,
                'nome' => $nome,
                'email' => $email
            ];

        } else {
            http_response_code(404);
            $array['error'] = 'ID não existe';
        }

    } else {
        http_response_code(400);
        $array['error'] = 'Dados inválidos';
    }

} else {
    http_response_code(405);
    $array['error'] = 'Método não permitido (Apenas PUT)';
}

require '../return.php';