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

$statusRotulo = [
    'prospeccao' => 'Prospectado',
    'contato_inicial' => 'Fazer Primeiro Contato',
    'apresentacao_solucao' => 'Reunião Marcada',
    'proposta_enviada' => 'Proposta Enviada',
    'negociando' => 'Negociando',
    'fechado' => 'Fechado',
    'pos_venda' => 'Pós Venda',
    'perdido' => 'Perdido',
];

$cadastroLeads = new CadastroLeads($db);

// Paginação;


$limite = 5;

$pg = filter_input(INPUT_GET, 'p', FILTER_VALIDATE_INT);

if ($pg === false || $pg === null || $pg < 1) {
    $pg = 1;
}

$offset = ($pg - 1) * $limite;

// Total de leads
$total = $cadastroLeads->contarLeads();

// Total de páginas
$paginas = ceil($total / $limite);

// Leads da página atual
$lista = $cadastroLeads->retornarListaLeadsPaginados($limite, $offset);



// Filtro

$situacao = filter_input(INPUT_POST, 'status');

if (isset($situacao) && $_SERVER['REQUEST_METHOD'] === 'POST') {

    $lista = $cadastroLeads->buscarLeadporStatus($situacao);
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS do Bootstrap -->
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/lista.css">
    <title>Leads</title>
</head>

<body>


    <div class="container">


        <div class="header-top">

            <div class="search">
                <form action="" method="get">
                    <input type="search" name="" id="" placeholder="Pesquisar Contato...">
                </form>
            </div>

            <div class="filter">
                <form class="form-filter" action="" method="post">
                    <select name="status" id="status">

                        <?php foreach ($statusRotulo as $valor => $rotulo): ?>

                            <option
                                value="<?= $valor ?>"
                                <?= $situacao === $valor ? 'selected' : '' ?>>
                                <?= $rotulo ?>
                            </option>

                        <?php endforeach; ?>

                    </select>

                    <input type="submit" value="Buscar">
                </form>
            </div>

            <div class="title">
                <?php if (!empty($_SESSION['msg'])) {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            </div>

            <div>
                <a href="cadastro.php"> <button class="assdtec-btn">Adicionar</button></a>
            </div>






        </div><br><br>


        <table class="table responsive table-hover">
            <thead>
                <tr>
                    <th scope="col">Empresa</th>
                    <th scope="col">Status</th>
                    <th scope="col">Próximo Contato</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <?php foreach ($lista as $lead): ?>
                <tr>
                    <td><?= $lead['empresa_nome']; ?></td>
                    <td>
                        <?= match ($lead['status']) {
                            'prospeccao' => 'Prospectado',
                            'contato_inicial' => 'Fazer Primeiro Contato',
                            'apresentacao_solucao' => 'Reunião Marcada',
                            'proposta_enviada' => 'Proposta Enviada',
                            'negociando' => 'Negociando',
                            'fechado' => 'Fechado',
                            'pos_venda' => 'Pós Venda',
                            'perdido' => 'Perdido',
                            default => 'Prospectado'
                        } ?>
                    </td>
                    <td><?= $lead['proximo_contato']; ?></td>
                    <td>
                        <a href="editar_lead.php?id=<?= $lead['id']; ?>">
                            <button class="edit">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </a>

                        <a href="excluir_lead.php?id=<?= $lead['id']; ?>"
                            onclick="return confirm(' Essa ação é irreversível. Deseja continuar?')">
                            <button
                                title="Excluir Usuário"
                                class="delete"> <i class="bi bi-trash3"></i> </button>
                        </a>


                    </td>
                </tr>

            <?php endforeach; ?>
        </table><br><br>


        <nav aria-label="Navegação de página">

            <ul class="pagination justify-content-center">

                <?php for ($q = 1; $q <= $paginas; $q++): ?>

                    <li class="page-item <?= $q == $pg ? 'active' : ''; ?>">

                        <a
                            class="page-link"
                            href="lista.php?p=<?= $q; ?>">
                            <?= $q; ?>
                        </a>

                    </li>

                <?php endfor; ?>

            </ul>

        </nav>


    </div><!--Container-->





</body>

</html>