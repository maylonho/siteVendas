<?php
class Contas {
    public $data_inicial = "TESTE";
    public $data_final;

    public function listarPrestacoes(){
        include("../php/conexao.php");
        $sql = "SELECT * FROM prestacoes WHERE statusPag='0' ORDER BY vencimento ASC";
        $result = mysqli_query($conexao, $sql);
        echo "
        <table class='table'>
            <thead>
            <tr>
                <th scope='col'>Cliente</th>
                <th scope='col'>Info</th>
                <th scope='col'>Valor Parcela</th>
                <th scope='col'>Vencimento</th>
                <th scope='col'>Status</th>
            </tr>
            </thead>
            <tbody>";
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
            "
                <tr onmouseover=setAttribute('id','linhaTabelaon') onmouseout=setAttribute('id','linhaTabelaoff') onclick=location.href='listDeve.php?idCompra=$idCompra&idParcela=$idParcela' style='cursor:pointer'>
                    <th scope='row'>".$row['cpfCliente']."</th>
                    <td>".($info)."</td>
                    <td>"."R$ ".number_format($row['valorParcela'], 2, ',', '.')."</td>
                    <td>".$row['vencimento']."</td>
                    <td>".$status."</td>
                </tr>
            
            ";
        }
        echo "</tbody>
        </table>";
    }

    public function listarContaPorData(){
        include("../php/conexao.php");
        $data_inicial = $_GET['data-inicial'];
        $data_final = $_GET['data-final'];
        $sql = "SELECT * FROM prestacoes WHERE vencimento BETWEEN ('$data_inicial') AND ('$data_final') AND statusPag='0'  order by vencimento asc";
        $result = mysqli_query($conexao, $sql);
        echo "
        <table class='table'>
            <thead>
            <tr>
                <th scope='col'>Cliente</th>
                <th scope='col'>Info</th>
                <th scope='col'>Valor Parcela</th>
                <th scope='col'>Vencimento</th>
                <th scope='col'>Status</th>
            </tr>
            </thead>
            <tbody>";
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
            "
            <tr onmouseover=setAttribute('id','linhaTabelaon') onmouseout=setAttribute('id','linhaTabelaoff') onclick=location.href='listDeve.php?idCompra=$idCompra&idParcela=$idParcela' style='cursor:pointer'>
                <th scope='row'>".$row['cpfCliente']."</th>
                <td>".($info)."</td>
                <td>"."R$ ".number_format($row['valorParcela'], 2, ',', '.')."</td>
                <td>".$row['vencimento']."</td>
                <td>".$status."</td>
            </tr>
                
            ";
        }
        echo "</tbody>
        </table>";
    }

    public function mostrarDadosConta($idC, $idP){
        include("../php/conexao.php");
        $idCompra = $idC;
        $idParcela = $idP;

        $sql = "SELECT *,date_format(`dataCad`,'%d/%m/%Y às %H:%i') as `dataCad_formatada` FROM cadastrarconta WHERE idCompra=$idCompra";
        $result = mysqli_query($conexao, $sql);
        $row = mysqli_fetch_assoc($result);

        $sql2 = "SELECT *,date_format(`vencimento`,'%d/%m/%Y') as `vencimento_formatada` FROM prestacoes WHERE idCompra=$idCompra AND idParcela=$idParcela";
        $result2 = mysqli_query($conexao, $sql2);
        $row2 = mysqli_fetch_assoc($result2);

        ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="row" colspan="5" style="text-align:center;">Informações da Compra</th>
            </tr>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">CPF</th>
                <th scope="col">Data Compra</th>
                <th scope="col">Telefone</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th><?php echo $row['idCompra']; ?></th>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo $row['cpf']; ?></td>
                <td><?php echo $row['dataCad_formatada']; ?></td>
                <td><?php echo $row['telefone']; ?></td>
            </tr>
            </tbody>
        </table>

        
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="row" colspan="4" style="text-align:center;">Informações da Parcela</th>
            </tr>
            <tr>
                <th scope="col">Valor da Compra</th>
                <th scope="col">Número de Parcela</th>
                <th scope="col">Valor da Parcela</th>
                <th scope="col">Vencimento</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><?php echo "R$ ".number_format($row['valorTotal'], 2, ',', '.'); ?></td>
                <td><?php echo $row2['idParcela'] . " de " . $row['numParcelas']; ?></td>
                <td><?php echo "R$ ".number_format($row2['valorParcela'], 2, ',', '.'); ?></td>
                <td><?php echo $row2['vencimento_formatada']; ?></td>
            </tr>

            </tbody>
        </table>
        
        <?php
    }
    


}

?>