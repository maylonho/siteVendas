<?php
session_start();
include("pages/php/conexao.php");

if(!isset($_SESSION['usuario_logado'])){
  header('Location:login.php');
}
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    
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
            <form class="d-flex" action="pages/php/logoff.php">
              <labe>Olá <?php echo $_SESSION['usuario_logado']; ?></label>
              <button class="btn btn-outline-success" type="submit">Sair</button>
            </form>
          </div>
        </div>
      </nav>
    <div>


    <div class="col-12 row mt-1">
        <div class="col-2 border-end">
            <ul class="nav flex-column nav-pills mt-3 mx-3">
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="./pages/cadContas.php">Cadastro de Contas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./pages/listDeve.php">Lista de Contas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./pages/php/testes.php" tabindex="-1" aria-disabled="false">TESTES</a>
                </li>
              </ul>
        </div>


        <!--CORPO DO SITE PRINCIPAL-->
        <div class="col-10" style="background-color: rgb(255, 255, 255); height: 90vh;">
            <h1 style="text-align: center;">Bem Vindo ao SGVC, nunca mais esqueça suas contas!</h1>
            <?php
            $data = new DateTime('+1 month');
            $data_final = $data->format('Y-m-d');
            $data2 = new DateTime();
            $data_inicial = $data2->format('Y-m-d');

            $sql = "SELECT *,date_format(`vencimento`,'%d/%m/%Y') as `vencimento_formatada` FROM prestacoes WHERE vencimento BETWEEN ('$data_inicial') AND ('$data_final') AND statusPag='0' order by vencimento asc";
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
              ""
              ?>
              <div class="alert alert-success alert-dismissible fade show mt-1 mb-0" role="alert">
                Atenção uma conta no valor de <strong>R$ <?php echo number_format($row['valorParcela'], 2, ',', '.');?></strong> vence em: <strong><?php echo $row['vencimento_formatada'];?></strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php

              "";
            }

            ?>
        </div>
        
    </div>
        
        
    </div>
    
</body>
</html>