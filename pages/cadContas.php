<?php
session_start();
include("../php/verifica_login.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Sistema de Gestão de Vendas e Contas</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  </head>

  <body>
    <!--Scrips Pessoais - Funções -->
    <script src="../js/functions.js" ></script>
    <!--Scrip Bootstrap--->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <!--Scrip para mascara de telefone--->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

    <!--Menu nav Superior-->
    <?php include("../componentes/nav-bar-sup.php");?>

    <div class="row col-12 mt-1">
        
      <!--Menu Lateral-->
      <?php $_SESSION['pg'] = "cadContas"; include("../componentes/nav-lateral.php") ?>

      <!--CORPO DO SITE PRINCIPAL-->
      <div class="col-10" style="background-color: rgb(255, 255, 255); height: 80vh;">
                        
        <div class="container">

          <?php
          if(isset($_SESSION['cad_conta_realizado'])) :
          ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sucesso!</strong> A conta foi cadastrada com sucesso.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          <?php 
            endif;
            unset($_SESSION['cad_conta_realizado']);
          ?>


          <form class="row g-3" action="../php/proc_cadContas.php" method="POST">
            <div class="col-md-6">
              <label for="nomeCliente" class="form-label">Nome Completo</label>
              <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" required>
            </div>
            <div class="col-md-3">
              <label for="cpfCliente" class="form-label">CPF</label>
              <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" required>
              <script type="text/javascript">$("#cpfCliente").mask("000.000.000-09");</script>
            </div>
            <div class="col-md-3">
              <label for="telCliente2" class="form-label">Telefone</label>
              <input type="text" class="form-control" id="telCliente2" name="telCliente2" required>
              <script type="text/javascript">
                    $("#telCliente2").mask("(00) 00009-0000");
              </script>
            </div>
            <div class="col-12">
              <label for="enderecoCliente" class="form-label">Endereço</label>
              <input type="text" class="form-control" id="enderecoCliente" name="enderecoCliente" placeholder="Rua, Número, Bairro" required>
            </div>
            <div class="col-12">
                <label for="descServicos" class="form-label">Descrição dos Produtos/Serviços prestados:</label>
                <textarea class="form-control" id="descServicos" name="descServicos" placeholder="Descrição dos produtos e servições - Valor dos Itens" rows="6"></textarea>
            </div>
            <div class="col-md-2">
              <label for="valorTotal" class="form-label">Valor Total</label>
              <input type="text" class="form-control" id="valorTotal" name="valorTotal" onkeyup="calculaParc()" required>
            </div>
            <div class="col-md-2">
              <label for="parcelamento" class="form-label">Parcelamento</label>
              <input type="number" class="form-control" id="parcelamento" name="parcelamento" onchange="calculaParc()" value="1">
              <label id="xParcelas" class="form-label">x Vezes de R$ 0,00</label>
            </div>
            <div class="col-md-2">
              <label for="diaVencimento" class="form-label">Dia Vencimento</label>
              <input type="text" class="form-control" id="diaVencimento" name="diaVencimento" required>
            </div>
            <div class="col-md-2">
              <label for="valorTotal" class="form-label">Tipo de Pag.</label>
              <select type="text" class="form-select" id="tipoPag" name="tipoPag">
                <option>Crediário</option>
                <option>Cartão</option>
                <option>À Vista</option>
              </select>
            </div>
            <div class="col-md-4 row justify-content-end mt-5">
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
          </form>
        </div>

      </div>
    </div>      

  </body>
</html>