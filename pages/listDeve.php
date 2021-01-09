<?php
session_start();
include("../classes/class-contas.php");
include("../php/verifica_login.php");
$contas = new Contas();
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Vendas e Contas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="../css/estilos.css" rel="stylesheet" />

  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!--Scrips Pessoais - Funções -->
    <script src="../js/functions.js" ></script>

    <?php include("../componentes/nav-bar-sup.php");?>

    <div class="row mb-5">
          
      <div class="col-sm-4 col-md-2 mb-3">
      
              
                                
              <!--Menu Lateral-->
              <?php $_SESSION['pg'] = "listDeve"; include("../componentes/nav-lateral2.php") ?>
                  
          
          
      </div>
            
      <div class="col-sm-8 col-md-10">
      
              
          <div class="container mt-3">
            <form class="row g-3" action="listDeve.php" method="GET">
          
              <div class="col-md-3">
                <label for="data-inicial" class="form-label">Data Inicial</label>
                <input type="date" class="form-control" id="data-inicial" name="data-inicial">
              </div>
              <div class="col-md-3">
                <label for="data-final" class="form-label">Data Final</label>
                <input type="date" class="form-control" id="data-final" name="data-final">
              </div>
              <div class="col-md-4 row justify-content-end mt-5">
                  <div class="col-auto">
                      <button type="submit" class="btn btn-primary">Pesquisar</button>
                  </div>
              </div>
            </form>

              <div class="col-12 row">

              <?php
                  if(isset($_SESSION['prest_paga'])):
              ?>
                  <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
                    <strong>Feito!</strong> A Prestação foi paga com sucesso!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
              <?php
                  endif;
                  unset($_SESSION['prest_paga']);
              ?>
                  <h1>...</h1>
              <!--TABELA-->
          
              <?php

                if(!isset($_GET['data-inicial']) & !isset($_GET['idCompra']) ){
                  $contas->listarPrestacoes();
                }
              
              
                if (isset($_GET['data-inicial']) & isset($_GET['data-final'])  & !isset($_GET['idCompra'])) {
                  $contas->listarContaPorData();


                }
                if (isset($_GET['idCompra']) & isset($_GET['idParcela'])) {
                  $idCompra = $_GET['idCompra'];
                  $idParcela = $_GET['idParcela'];
                  $contas->mostrarDadosConta($idCompra, $idParcela);
                  

                ?>
                  

              <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="definirDadosModal('Confimação', 'Tem certeza que deseja quitar a dívida?', '../php/proc_pagPrestacao.php?idCompra=<?php echo $idCompra; ?>&idParcela=<?php echo $idParcela; ?>')">
                Efetuar Pagamento
              </button>

                
              <?php 
                } 
              ?>
               
      </div>
                
                </div>
            
            </div>
          </div>

    

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="modal-body">
            ...
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary" onclick=location.href=linkAtual()>Continuar</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">
      $(window).on('load',function(){
        //$('#exampleModal').modal('show');
      });
    </script>
  </body>
</html>