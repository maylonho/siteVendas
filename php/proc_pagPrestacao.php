<?php
session_start();
include('conexao.php');
$idCompra = $_GET['idCompra'];
$idParcela = $_GET['idParcela'];

$sql = "UPDATE `sgvc`.`prestacoes` SET `statusPag`=b'1' WHERE  `idCompra`='$idCompra' AND `idParcela`='$idParcela' AND `statusPag`=b'0'";
$result = mysqli_query($conexao, $sql);

    if(mysqli_affected_rows($conexao)){
        $_SESSION['prest_paga'] = true;
        header("Location:../pages/listDeve.php");
    }


