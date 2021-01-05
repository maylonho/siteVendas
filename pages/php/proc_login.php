<?php
include("conexao.php");
session_start();

$usuario = mysqli_real_escape_string($conexao ,trim($_POST['login']));
$senha = mysqli_real_escape_string($conexao, trim($_POST['senha']));

$sql = "SELECT COUNT(usuario) FROM login WHERE usuario='$usuario' AND senha='$senha'";
$result = mysqli_query($conexao, $sql);
$row = mysqli_fetch_assoc($result);



if($row['COUNT(usuario)'] == 1){
    $_SESSION['usuario_logado'] = $usuario;
    header('Location:../../index.php');
}else{
    $_SESSION['usuario_invalido'] = true;
    header('Location:../../login.php');
}

?>