<?php
if(!isset($_SESSION['usuario_logado'])){
    header('Location:../pages/login.php');
}
?>