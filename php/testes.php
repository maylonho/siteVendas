<?php
include("conexao.php");


for ($i=0; $i < 24; $i++) { 
    
$data = new DateTime();
$ano = $data->format('Y');
$mes = $data->format('m');
$dia = '28';
$data->setDate($ano, $mes+$i, $dia);
$data = $data->format('Y-m-d');
echo $data;
echo "<br>";
}



?>