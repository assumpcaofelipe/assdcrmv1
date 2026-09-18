<?php
//session_start();


?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/cadastro.css">

  <title>Cadastro</title>

</head>


<body>


  <div class="container">


    <form action="<?= BASE_URL ?>/post_cadastrolead.php" class="validacao-forms" method="post">

    

      <small class="error"></small>

      <fieldset class="step-1">


        <legend>Informações Essenciais - Dados da Empresa</legend>


        <div class="campo">

          <label for="">Nome da Empresa</label>
          <input type="text" name="empresa_nome" class="empresa" id="empresa" rules="required" />

        </div>


        <div class="campo">

          <label for="">E-mail</label>
          <input type="email" name="email" class="email" >

        </div>


        <div class="campo">

          <label for="">Telefone</label>
          <input type="text" name="telefone" class="telefone">

        </div>


        <div class="campo">

          <label for="">Site da Empresa</label>
          <input type="text" name="empresa_site" class="site">

        </div>


      </fieldset>





      <fieldset class="step-2">


        <legend>Responsável pela Decisão</legend>


        <div class="campo">

          <label for="">Nome do Decisor</label>
          <input type="text" name="decisor_nome" class="empresa">

        </div>


        <div class="campo">

          <label for="">Cargo do Decisor</label>
          <input type="text" name="decisor_cargo" class="email">

        </div>


        <div class="campo">

          <label for="">LinkedIn do Decisor</label>
          <input type="text" name="decisor_linkedin" class="telefone">

        </div>


      </fieldset>






      <fieldset class="step-3">


        <legend>Acompanhamento da Negociação</legend>



        <div class="campo">


          <label for="status">Status</label>


          <select name="status" id="status">

            <option value="">Selecione o status</option>

            <option value="prospeccao">
             Prospectado
            </option>

            <option value="contato_inicial">
              Fazer Primeiro Contato
            </option>

            <option value="apresentacao_solucao">
             Reunião Marcada
            </option>

            <option value="proposta_enviada">
              Proposta Enviada
            </option>

            <option value="negociando">
             Negociando
            </option>

            <option value="fechado">
              Fechado
            </option>

            <option value="pos_venda">
             Pós Venda
            </option>

            <option value="perdido">
              Perdido
            </option>


          </select>


        </div>





        <div class="campo">


          <label for="origem">
            Origem do Lead
          </label>


          <select name="origem" id="origem">


            <option value="">
              Selecione
            </option>

            <option value="google">
              Google
            </option>

            <option value="facebook">
              Facebook
            </option>

            <option value="instagram">
              Instagram
            </option>

            <option value="linkedin">
              LinkedIn
            </option>

            <option value="indicacao">
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
            name="primeiro_contato">


        </div>






        <div class="campo">


          <label for="proximo_contato">
            Próximo Contato
          </label>


          <input
            type="datetime-local"
            id="proximo_contato"
            name="proximo_contato">


        </div>






        <div class="campo">


          <label for="notes">
            Notas
          </label>


          <textarea
            name="observacoes"
            id="notes"
            placeholder="Histórico..."></textarea>


        </div>



      </fieldset>



      <div class="acoes">

        <input type="submit" value="Salvar">

      </div>



    </form>



  </div>


  <script src="<?= BASE_URL ?>/assets/js/form-validador.js"></script>

</body>

</html>