<?php
session_start();
include('php/conexao.php');
include("php/verifica_login.php");
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Gestão de Vendas e Contas</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet" />

  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    
    <nav class="navbar navbar-expand-lg navbar-light bg-light mx-2">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">SGVC</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dropdown
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>

    <div>
      <div class="col-12 row mt-1">

      <!-- Menu Lateral -->
        <div class="col-2 border-end">
          <ul class="nav flex-column nav-pills mt-3 mx-3">
            <li class="nav-item">
              <a class="nav-link" href="../index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link " href="cadContas.php">Cadastro de Contas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="listDeve.html">Lista de Contas</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=".php/testes.php" tabindex="-1" aria-disabled="false">TESTES</a>
            </li>
          </ul>
        </div>


            <!--CORPO DO SITE PRINCIPAL-->
            <div class="col-10" style="background-color: rgb(255, 255, 255); height: 90vh;">
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
                    <script>
                        var linkPag = "Padrao";
                      function definirDadosModal(titulo, desc, link){
                        document.getElementById("exampleModalLabel").innerHTML = titulo;
                        document.getElementById("modal-body").innerHTML = desc;
                        linkPag = link;
                        
                      }

                      function linkAtual(){
                        return linkPag;
                      }
                    </script>

                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="definirDadosModal('Confimação', 'Tem certeza que deseja quitar a dívida?', 'php/proc_pagPrestacao.php?idCompra=<?php echo $idCompra; ?>&idParcela=<?php echo $idParcela; ?>')">
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
            <script>
            </script>
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