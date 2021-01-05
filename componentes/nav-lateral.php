<?php
if ($_SESSION['pg'] == 'home') {
    $pg = "active";
}elseif ($_SESSION['pg'] == 'cadContas') {
    $pg1 = "active";
}elseif ($_SESSION['pg'] == 'listDeve') {
    $pg2 = "active";
}


?>

<div class="col-2 border-end">
    <ul class="nav flex-column nav-pills mt-3 mx-3">
        <li class="nav-item">
            <a class="nav-link <?php echo $pg;?>" href="home.php">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $pg1;?>" href="cadContas.php">Cadastro de Contas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?php echo $pg2;?>" href="listDeve.php">Lista de Contas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="../php/testes.php" tabindex="-1" aria-disabled="false">TESTES</a>
        </li>
    </ul>
</div>