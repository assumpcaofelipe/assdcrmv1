<?php
session_start();
require_once 'classes/Auth.php';
require_once 'config.php';
require_once 'classes/Lead.php';
require_once 'classes/CadastroLeads.php';

//Verificação parao usuário está logado:

$auth = new Auth($db);

if (!$auth->check()) {
    header('Location: login.php');
    exit;
}

// Retornar lista de Leads
$CadastroLeads = new CadastroLeads($db);
$lista = $CadastroLeads->retornarListaLeads();

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
    <link rel="stylesheet" href="assets/css/lista.css">
    <title>Leads</title>
</head>

<body>


    <div class="container">

        <div class="title">
            <?php if (!empty($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>

             <form action="" method="post">
                <input type="search" name="" id="" placeholder="Pesquisar Contato...">
             </form>
            <a href="cadastrolead"> <button class="add">Adicionar</button></a>

        </div><br><br>


        <table class="table responsive table-hover">
            <thead>
                <tr>
                    <th scope="col">Empresa</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <?php foreach ($lista as $lead): ?>
                <tr>
                    <td><?= $lead['empresa_nome']; ?></td>
                    <td><?= $lead['email']; ?></td>
                    <td><?= $lead['status']; ?></td>
                    <td>
                        <a href="editar_lead.php?id=<?= $lead['id']; ?>">
                          <button class="edit">
                            <i class="bi bi-pencil"></i>
                        </button>
                        </a>
                       
                        <a href="excluir.php?id=<?= $lead['id']; ?>"
                            onclick="return confirm(' Essa ação é irreversível. Deseja continuar?')">
                            <button
                                title="Excluir Usuário"
                                class="delete"> <i class="bi bi-trash3"></i> </button>
                        </a>


                    </td>
                </tr>
            <?php endforeach; ?>
        </table>

    </div><!--Container-->





</body>

</html>