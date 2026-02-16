<?php
require_once 'config.php';
require_once 'classes/Usuario.php';
$usuario = new Usuario($db);
$lista = $usuario->retornarListaUsuarios();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS do Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="assets/css/usuarios.css">
    <title>Usuários</title>
</head>

<body>


    <div class="container">

       

        <h2>Usuários</h2>
        <button>Adcionar</button>

        <table class="table responsive table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nome</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <?php foreach ($lista as $usuario): ?>
                <tr>
                    <td><?= $usuario['id']; ?></td>
                    <td><?= $usuario['nome']; ?></td>
                    <td><?= $usuario['email']; ?></td>
                    <td>
                        <a href="editar.php?id=<?= $usuario['id']; ?>">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <a href="excluir.php?id=<?= $usuario['id']; ?>"
                            onclick="return confirm(' Essa ação é irreversível. Deseja continuar?')">
                            <i class="bi bi-trash3"></i>
                        </a>


                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div><!--Container-->





</body>

</html>