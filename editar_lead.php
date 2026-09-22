<?php

session_start();
require_once 'classes/Auth.php';
require_once 'config.php';
require_once 'classes/Lead.php';
require_once 'classes/CadastroLeads.php';



$auth = new Auth($db);

if (!$auth->check()) {
  header('Location: login.php');
  exit;
}


$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if ($id === false || $id === null) {
  header('Location: lista.php');
  exit;
}


// Retornar Lead por id
$CadastroLeads = new CadastroLeads($db);
$lead = $CadastroLeads->buscarLeadPorId($id);

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/cadastro.css">

  <title>Editar</title>

</head>


<body>


  <div class="container">



    <form action="post_editarlead.php" class="validacao-forms" method="post">

      <input type="hidden" name="id" value="<?= $lead->id ?>">

      <small class="error"></small>

      <fieldset class="step-1">


        <legend>Informações Essenciais - Dados da Empresa</legend>


        <div class="campo">

          <label for="">Nome da Empresa</label>
          <input type="text" name="empresa_nome" class="empresa" id="empresa" rules="required" value="<?= $lead->empresa_nome ?>" />

        </div>


        <div class="campo">

          <label for="">E-mail</label>
          <input type="email" name="email" class="email" value="<?= $lead->email ?>">

        </div>


        <div class="campo">

          <label for="">Telefone</label>
          <input type="text" name="telefone" class="telefone" value="<?= $lead->telefone ?>">

        </div>


        <div class="campo">

          <label for="">Site da Empresa</label>
          <input type="text" name="empresa_site" class="site" value="<?= $lead->empresa_site ?>">

        </div>


      </fieldset>





      <fieldset class="step-2">


        <legend>Responsável pela Decisão</legend>


        <div class="campo">

          <label for="">Nome do Decisor</label>
          <input type="text" name="decisor_nome" class="empresa" value="<?= $lead->decisor_nome ?>">

        </div>


        <div class="campo">

          <label for="">Cargo do Decisor</label>
          <input type="text" name="decisor_cargo" class="cargo" value="<?= $lead->decisor_cargo ?>">

        </div>


        <div class="campo">

          <label for="">LinkedIn do Decisor</label>
          <input type="text" name="decisor_linkedin" class="linkedin_decisor" value="<?= $lead->decisor_linkedin ?>">

        </div>


      </fieldset>






      <fieldset class="step-3">


        <legend>Acompanhamento da Negociação</legend>



        <div class="campo">


          <label for="status">Estágio do Lead</label>


          <select name="status" id="status" value="<?= $lead->status ?>">

            <option value="">Selecione o status</option>

            <option value="prospeccao" <?= $lead->status === 'prospeccao' ? 'selected' : ''  ?>>
             Prospectado
            </option>

            <option value="contato_inicial" <?= $lead->status === 'contato_inicial' ? 'selected' : ''  ?>>
              Fazer Primeiro Contato
            </option>

            <option value="apresentacao_solucao" <?= $lead->status === 'apresentacao_solucao' ? 'selected' : ''  ?>>
             Reunião Marcada
            </option>

            <option value="proposta_enviada" <?= $lead->status === 'proposta_enviada' ? 'selected' : ''  ?>>
              Proposta Enviada
            </option>

            <option value="negociando" <?= $lead->status === 'negociando' ? 'selected' : ''  ?>>
              Negociação
            </option>

            <option value="fechado" <?= $lead->status === 'fechado' ? 'selected' : ''  ?>>
              Fechado
            </option>

            <option value="pos_venda" <?= $lead->status === 'pos_venda' ? 'selected' : ''  ?>>
              Pós Venda
            </option>

            <option value="perdido" <?= $lead->status === 'perdido' ? 'selected' : ''  ?>>
              Perdido
            </option>


          </select>


        </div>





        <div class="campo">


          <label for="origem">
            Origem do Lead
          </label>


          <select name="origem" id="origem" value="<?= $lead->origem ?>">


            <option value="">
              Selecione
            </option>

            <option value="google" <?= $lead->origem === 'google' ? 'selected' : ''  ?>>
              Google
            </option>

            <option value="facebook" <?= $lead->origem === 'facebook' ? 'selected' : ''  ?>>
              Facebook
            </option>

            <option value="instagram" <?= $lead->origem === 'instagram' ? 'selected' : ''  ?>>
              Instagram
            </option>

            <option value="linkedin" <?= $lead->origem === 'linkedin' ? 'selected' : ''  ?>>
              Linkedin
            </option>

            <option value="indicacao" <?= $lead->origem === 'indicacao' ? 'selected' : ''  ?>>
              Indicação
            </option>


          </select>


        </div>





        <div class="campo">


          <label for="primeiro_contato">
            Primeiro Contato
          </label>


          <input
            type="datetime-local"
            id="primeiro_contato"
            name="primeiro_contato"
            value="<?= $lead->primeiro_contato?->format('Y-m-d\TH:i') ?>">


        </div>






        <div class="campo">


          <label for="proximo_contato">
            Próximo Contato
          </label>


          <input
            type="datetime-local"
            id="proximo_contato"
            name="proximo_contato"
            value="<?= $lead->proximo_contato?->format('Y-m-d\TH:i') ?>">


        </div>






        <div class="campo">


          <label for="notes">
            Notas
          </label>


          <textarea name="observacoes"><?= htmlspecialchars($lead->observacoes ?? '') ?></textarea>


        </div>



      </fieldset>



      <div class="acoes">

        <input type="submit" value="Atualizar">

      </div>



    </form>



  </div>


  <script src="<?= BASE_URL ?>/assets/js/form-validador.js"></script>

</body>

</html>