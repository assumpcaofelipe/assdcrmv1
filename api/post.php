<?php

require '../config.php';

$method = strtolower($_SERVER['REQUEST_METHOD']); // Padronizando a requisição;

if ($method === 'post') {

    
   $body = json_decode(file_get_contents('php://input'), true) ?? $_POST;

    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $senha = trim($_POST['senha']);


    if (!empty($nome) && !empty($email) && !empty($senha)) {

        $senhaHash = password_hash($senha, PASSWORD_BCRYPT);

        $sql = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
        $sql->bindValue(':nome', $nome);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':senha', $senhaHash);
        $sql->execute();

        //Retorno da requisição para o cliente.

        $id = $db->lastInsertId();

        $array['result'] = [
            'id' => $id,
            'nome' => $nome,
            'email' => $email
        ];

        
    } else {
        $array['error'] = 'Preencha todos os campos: nome, e-mail e senha';
    }
} else {
    http_response_code(405);
    $array['error'] = 'Método não permitido (Apenas POST)';
}



require '../return.php';
