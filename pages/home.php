<?php
session_start();
include("../php/conexao.php");
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    
    <?php include("../componentes/nav-bar-sup.php");?>
    <div>


    <div class="row mb-5">
      <div class="col-sm-4 col-md-2 mb-3">
        
                
                                  
        <!--Menu Lateral-->
        <?php $_SESSION['pg'] = "home"; include("../componentes/nav-lateral2.php") ?>
            
    
    
      </div>


        <!--CORPO DO SITE PRINCIPAL-->
        <div class="col-sm-8 col-md-10" style="background-color: rgb(255, 255, 255); height: 80vh;">
            <h1 style="text-align: center;">Bem Vindo ao SGVC, nunca mais esqueça suas contas!</h1>
            <?php
            $data = new DateTime();
            $ano = $data->format('Y');
            $mes = $data->format('m');
            $dia = 1;

            $data->setDate($ano, $mes+1, $dia);
            $data_final = $data->format('Y-m-d');

            $data->setDate($ano, $mes, $dia);
            $data_inicial = $data->format('Y-m-d');

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