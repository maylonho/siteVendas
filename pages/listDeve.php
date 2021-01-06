<?php
session_start();
include('../php/conexao.php');
include("../php/verifica_login.php");
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

    <div>
      <div class="col-12 row mt-1">

      
      <!--Menu Lateral-->
      <?php $_SESSION['pg'] = "listDeve"; include("../componentes/nav-lateral.php") ?>


            <!--CORPO DO SITE PRINCIPAL-->
            <div class="col-10" style="background-color: rgb(255, 255, 255); height: 80vh;">
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
                    if (!isset($_GET['idCompra'])) {
                      echo "<table class='table'>
                              <thead>
                                <tr>
                                  <th scope='col'>Cliente</th>
                                  <th scope='col'>Info</th>
                                  <th scope='col'>Valor Parcela</th>
                                  <th scope='col'>Vencimento</th>
                                  <th scope='col'>Status</th>
                                </tr>
                              </thead>
                              <tbody>";
                    }
                    
                      if (isset($_GET['data-inicial']) & isset($_GET['data-final'])) {
                        $data_inicial = $_GET['data-inicial'];
                        $data_final = $_GET['data-final'];
                        $sql = "SELECT * FROM prestacoes WHERE vencimento BETWEEN ('$data_inicial') AND ('$data_final') AND statusPag='0'  order by vencimento asc";
                        $result = mysqli_query($conexao, $sql);
                      
                        while($row = mysqli_fetch_assoc($result)){
                          $idCompra = $row['idCompra'];
                          $idParcela = $row['idParcela'];
                          $info = ($row['idParcela'])." de ".($row['qtdParcela']);
                          $status = "";
                          if ($row['statusPag'] == 0) {
                            $status = "Pendente";
                          }else{
                            $status = "Pago";
                          }
                          echo 
                          "
                            <tr onmouseover=setAttribute('id','linhaTabelaon') onmouseout=setAttribute('id','linhaTabelaoff') onclick=location.href='listDeve.php?idCompra=$idCompra&idParcela=$idParcela' style='cursor:pointer'>
                              <th scope='row'>".$row['cpfCliente']."</th>
                              <td>".($info)."</td>
                              <td>"."R$ ".number_format($row['valorParcela'], 2, ',', '.')."</td>
                              <td>".$row['vencimento']."</td>
                              <td>".$status."</td>
                            </tr>
                              
                          ";
                        }


                      }if (isset($_GET['idCompra']) & isset($_GET['idParcela'])) {
                        $idCompra = $_GET['idCompra'];
                        $idParcela = $_GET['idParcela'];

                        $sql = "SELECT *,date_format(`dataCad`,'%d/%m/%Y às %H:%i') as `dataCad_formatada` FROM cadastrarconta WHERE idCompra=$idCompra";
                        $result = mysqli_query($conexao, $sql);
                        $row = mysqli_fetch_assoc($result);

                        $sql2 = "SELECT *,date_format(`vencimento`,'%d/%m/%Y') as `vencimento_formatada` FROM prestacoes WHERE idCompra=$idCompra AND idParcela=$idParcela";
                        $result2 = mysqli_query($conexao, $sql2);
                        $row2 = mysqli_fetch_assoc($result2);

                        ?>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th scope="row" colspan="5" style="text-align:center;">Informações da Compra</th>
                            </tr>
                            <tr>
                              <th scope="col">ID</th>
                              <th scope="col">Cliente</th>
                              <th scope="col">CPF</th>
                              <th scope="col">Data Compra</th>
                              <th scope="col">Telefone</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <th><?php echo $row['idCompra']; ?></th>
                              <td><?php echo $row['nome']; ?></td>
                              <td><?php echo $row['cpf']; ?></td>
                              <td><?php echo $row['dataCad_formatada']; ?></td>
                              <td><?php echo $row['telefone']; ?></td>
                            </tr>
                          </tbody>
                        </table>

                        
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <th scope="row" colspan="4" style="text-align:center;">Informações da Parcela</th>
                            </tr>
                            <tr>
                              <th scope="col">Valor da Compra</th>
                              <th scope="col">Número de Parcela</th>
                              <th scope="col">Valor da Parcela</th>
                              <th scope="col">Vencimento</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php echo "R$ ".number_format($row['valorTotal'], 2, ',', '.'); ?></td>
                              <td><?php echo $row2['idParcela'] . " de " . $row['numParcelas']; ?></td>
                              <td><?php echo "R$ ".number_format($row2['valorParcela'], 2, ',', '.'); ?></td>
                              <td><?php echo $row2['vencimento_formatada']; ?></td>
                            </tr>

                          </tbody>
                        </table>
                        


                      </tbody>
                    </table>

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