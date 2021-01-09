<?php
session_start();
include("conexao.php");

$nome = mysqli_real_escape_string($conexao, trim($_POST['nomeCliente']));
$cpf = mysqli_real_escape_string($conexao, trim($_POST['cpfCliente']));
$telefone = mysqli_real_escape_string($conexao, trim($_POST['telCliente2']));
$endereco = mysqli_real_escape_string($conexao, trim($_POST['enderecoCliente']));
$descricaoProduto = mysqli_real_escape_string($conexao, trim($_POST['descServicos']));
$valorTotal = mysqli_real_escape_string($conexao, trim($_POST['valorTotal']));
$numParcelas = mysqli_real_escape_string($conexao, trim($_POST['parcelamento']));
$diaVencimento = mysqli_real_escape_string($conexao, trim($_POST['diaVencimento']));
$tipoPagamento = mysqli_real_escape_string($conexao, trim($_POST['tipoPag']));

$valorParcela = $valorTotal/$numParcelas;





$sql = "INSERT INTO cadastrarconta (dataCad, nome, cpf, telefone, endereco, descricaoProdutos, valorTotal, numParcelas, tipoPagamento) VALUES (NOW(), '$nome', '$cpf', '$telefone', '$endereco', '$descricaoProduto', '$valorTotal', '$numParcelas', '$tipoPagamento')";
if($conexao->query($sql) === TRUE) {
    $_SESSION['cad_conta_realizado'] = true;
} 

$sqlID = "SELECT MAX(idCompra) FROM cadastrarconta";
$result = mysqli_query($conexao, $sqlID);
$row = mysqli_fetch_assoc($result);

$ultimoID = $row['MAX(idCompra)'];

$qtdMes = $numParcelas;

for ($i=0; $i < $qtdMes; $i++) { 
    $data = new DateTime();
    $ano = $data->format('Y');
    $mes = $data->format('m');
    $dia = $data->format('d');
    $data->setDate($ano, ($mes+1)+$i, $diaVencimento);
    $dataNova = $data->format('Y-m-d');

    $idParcela = ($i +1);
    
    

    $sql2 = "INSERT INTO prestacoes (idCompra, cpfCliente, valorParcela, vencimento, idParcela, qtdParcela) VALUES ('$ultimoID', '$cpf', '$valorParcela', '$dataNova', '$idParcela', '$qtdMes')";
    if($conexao->query($sql2) === TRUE) {
        $_SESSION['cad_prestacoes_realizado'] = true;
    } 
}




$conexao->close();

header('Location:../pages/cadContas.php');
exit;

?>