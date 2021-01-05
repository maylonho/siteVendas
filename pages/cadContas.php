<?php
session_start();
include("php/verifica_login.php");
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
            <form class="d-flex">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    <div>
      

    <div class="row col-12 mt-1">
        <div class="col-2">
            <ul class="nav flex-column nav-pills mt-3 mx-3">
                <li class="nav-item">
                  <a class="nav-link" href="../index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" aria-current="page" href="cadContas.html">Cadastro de Contas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="listDeve.php">Lista de Contas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./php/testes.php" tabindex="-1" aria-disabled="false">TESTES</a>
                </li>
              </ul>
        </div>


        <!--CORPO DO SITE PRINCIPAL-->
        <div class="col-10">
                        
<!--Scrip para mascara de telefone--->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

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


    <form class="row g-3" action="./php/proc_cadContas.php" method="POST">

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


        
        <!--CIDADE, ESTADO, CEP

        <div class="col-md-6">
          <label for="cidadeCliente" class="form-label">Cidade</label>
          <input type="text" class="form-control" id="cidadeCliente">
        </div>
        <div class="col-md-4">
          <label for="estadoCliente" class="form-label">Estado</label>
          <select id="estadoCliente" class="form-select">
            <option selected>Selecione...</option>
            <option>Acre (AC)</option>
            <option>Alagoas (AL)</option>
            <option>Amapá (AP)</option>
            <option>Amazonas (AM)</option>
            <option>Bahia (BA)</option>
            <option>Ceará (CE)</option>
            <option>Distrito Federal (DF)</option>
            <option>Espírito Santo (ES)</option>
            <option>Goiás (GO)</option>
            <option>Maranhão (MA)</option>
            <option>Mato Grosso (MT)</option>
            <option>Mato Grosso do Sul (MS)</option>
            <option>Minas Gerais (MG)</option>
            <option>Pará (PA)</option>
            <option>Paraíba (PB)</option>
            <option>Paraná (PR)</option>
            <option>Pernambuco (PE)</option>
            <option>Piauí (PI)</option>
            <option>Rio de Janeiro (RJ)</option>
            <option>Rio Grande do Norte (RN)</option>
            <option>Rio Grande do Sul (RS)</option>
            <option>Rondônia (RO)</option>
            <option>Roraima (RR)</option>
            <option>Santa Catarina (SC)</option>
            <option>São Paulo (SP)</option>
            <option>Sergipe (SE)</option>
            <option>Tocantins (TO)</option>
          </select>
        </div>
        <div class="col-md-2">
          <label for="cepCliente" class="form-label">CEP</label>
          <input type="text" class="form-control" id="cepCliente">
        </div>

        -->

        <div class="col-12">
            <label for="descServicos" class="form-label">Descrição dos Produtos/Serviços prestados:</label>
            <textarea class="form-control" id="descServicos" name="descServicos" placeholder="Produtos:
Produto ou Item 1 - Valor R$100,00
Produto ou Item 1 - Valor R$100,00

Mão de Obra:
Serviço prestado 1 - Valor R$100,00
Serviço prestado 1 - Valor R$100,00
            
            " rows="6"></textarea>
          </div>

          <script>
            function calculaParc(){
                var valorTotal = 0;
                var qtdParcelas = 0;
                
                valorTotal = parseFloat(document.getElementById("valorTotal").value);

                qtdParcelas = parseInt(document.getElementById("parcelamento").value);

                var teste = document.getElementById("telCliente2").value;

                var valorParcela = (valorTotal/qtdParcelas).toFixed(2);

                if (qtdParcelas>0 && valorTotal>0) {
                    document.getElementById("xParcelas").innerHTML = 'x Vezes de R$ ' + valorParcela;
                }else{
                    document.getElementById("xParcelas").innerHTML = 'x Vezes de R$ 0,00';
                }

            }

        </script>


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
        
        
    </div>
    
    


    




</body>
</html>