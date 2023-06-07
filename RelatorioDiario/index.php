
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>

</head>
<body>
    <?php
        include('../Cabecalho/Cabecalho.php');
        include('../Conexao.php');

        if(isset($_POST['AcessarBTN'])){
            $_SESSION['Data']=$_POST['DataRelatorio'];
        }

        if(isset($_SESSION['Data'])||!empty($_SESSION['Data'])){

            echo '<div class="Data"><a href="../CadRelatorioDiario/index.php"><img src="Imgs/editar.png"></a><input type="text" value="'.date('d/m/Y',strtotime($_SESSION['Data'])).'" disabled name="DataTXT"> <img src="Imgs/Print.png"></div><br>';

        echo "<a href='index.php'><img class='Parte' src='Imgs/Relatório.png' title='Relatório Principal'></a>";
        echo "<a href='../RelatorioDiarioCautelados/index.php'><img class='Parte' src='Imgs/Fone de ouvido.png ' title='Objetos Cautelados'></a>";
        echo "<a href='../RelatorioDiarioObs/index.php'><img class='Parte' src='Imgs/papel.png' title='Observações'></a>";

        $SQL='SELECT * FROM horimetro';
        $Requisicao=mysqli_query($mysqli,$SQL);

        while($Linha=$Requisicao->fetch_assoc()){
            $QTDDiscrepancias=0;
            $QTDIntervencoes=0;

            $SQL2="SELECT * FROM discrepancias WHERE Data='".date('Y/m/d',strtotime($_SESSION['Data']))."'AND Placa='".$Linha['Placa']."'";
            $Requisicao2=mysqli_query($mysqli,$SQL2);

            while($Requisicao2->fetch_assoc()){
                $QTDDiscrepancias++;
            }

            $SQL3="SELECT * FROM intervencao WHERE Data='".date('Y/m/d',strtotime($_SESSION['Data']))."'AND Placa='".$Linha['Placa']."'";
            $Requisicao3=mysqli_query($mysqli,$SQL3);

            while($Requisicao3->fetch_assoc()){
                $QTDIntervencoes++;
            }

            $StatusImagem;
            $SQLStatus="SELECT * FROM disponibilidade WHERE Data='".date('Y/m/d',strtotime($_SESSION['Data']))."'AND Placa='".$Linha['Placa']."'";
            $RequisicaoStatus=mysqli_query($mysqli,$SQLStatus);

            $Status=$RequisicaoStatus->fetch_assoc();

            if($Status['Status']=='Disponível'){
                $StatusImagem='Imgs/verificado.png';
                $Texto='Disponível';
            } else if($Status['Status']=='Indisponível'){
                $StatusImagem='Imgs/cancelar.png';
                $Texto='Causa: '.$Status['Causa'];
            }else if($Status['Status']=='Disponível/Despachada'){
                $StatusImagem='Imgs/Despachada.png';
                $Texto=$Status['Causa'];
            }

                echo '<table class="Tabela">
                <tr class="Titulo">
                    <td><img src="Imgs/time.png"><label>'.$Linha['HorasAtuais'].'</label></td>
                    <td><label>'.$Linha['Placa'].'</label><img src='.$StatusImagem.' title="'.$Texto.'"></td>
                    <td><label>'.$QTDDiscrepancias.'</label><img src="Imgs/alerta.png" title="Discrepâncias"><label>'.$QTDIntervencoes.'</label><img src="Imgs/manutencao.png" title="Intervenções"></td>
                </tr>
                <tr class="Espaco"></tr>';

            $SQLIntervencao="SELECT * FROM intervencao WHERE Data='".date('Y/m/d',strtotime($_SESSION['Data']))."'AND Placa='".$Linha['Placa']."'";
            $RequisicaoIntervencao=mysqli_query($mysqli,$SQLIntervencao);

            while($Linha2=$RequisicaoIntervencao->fetch_assoc()){
                echo '<tr class="Linha" id="LinhaIntervencao">
                        <td colspan="3"><label style="color: rgb(255, 191, 73);">'.$Linha2['RealizadoPor'].'</label></td>
                    </tr>';
                echo '<tr class="Linha" id="LinhaIntervencao">
                    <td colspan="3"><img src="Imgs/manutencao.png"><label>'.$Linha2['DescIntervencao'].'</label></td>
                </tr>';
                echo '<tr class="Linha" id="LinhaIntervencao">
                <td colspan="3"><img src="Imgs/time.png"><label>'.$Linha2['TempoInter'].'</label></td>
                </tr>';
                echo '<tr class="Espaco"></tr>';
            }

            $SQLDiscrepancias="SELECT * FROM discrepancias WHERE Data='".date('Y/m/d',strtotime($_SESSION['Data']))."'AND Placa='".$Linha['Placa']."'";
            $RequisicaoDiscrepancias=mysqli_query($mysqli,$SQLDiscrepancias);

            while($Linha3=$RequisicaoDiscrepancias->fetch_assoc()){
                echo '<tr class="Linha">
                        <td colspan="3"><img src="Imgs/alerta.png"><label>'.$Linha3['DescDiscrepancias'].'</label></td>
                </tr>';
                echo '<tr class="Espaco"></tr>';
            }
                    echo '</table>';
        }
        }  

    ?>
    
</body>
</html>