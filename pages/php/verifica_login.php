<?php
if(!isset($_SESSION['usuario_logado'])){
    header('Location:../login.php');
}
?>