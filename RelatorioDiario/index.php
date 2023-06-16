
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src="script.js" defer></script>
    <script src="../Cabecalho/script.js" defer></script>

</head>
<body>
    <?php
        include('../Cabecalho/Cabecalho.php');
        include('../Conexao.php');

        if(isset($_POST['AcessarBTN'])){
            $_SESSION['Data']=$_POST['DataRelatorio'];
        }

        if(isset($_SESSION['Data'])||!empty($_SESSION['Data'])){

            echo '<div class="Data"><form method="post" action="../EditRelatorioDiario/index.php">
              <button type="submit"><img src="Imgs/editar.png" name="EditarBTN"></img></button>
              <input type="text" value="'.date('d/m/Y',strtotime($_SESSION['Data'])).'" disabled name="DataTXT"><button type="button"><img src="Imgs/Print.png"></button>
            </form></div><br>';

        echo "<a href='index.php'><img class='Parte' src='Imgs/Relatório.png' title='Relatório Principal'></a>";
        echo "<a href='../RelatorioDiarioCautelados/index.php'><img class='Parte' src='Imgs/Fone de ouvido.png ' title='Objetos Cautelados'></a>";
        echo "<a href='../RelatorioDiarioObs/index.php'><img class='Parte' src='Imgs/papel.png' title='Observações'></a>";

        $SQL='SELECT * FROM aeronavescadastradas';
        $Requisicao=mysqli_query($mysqli,$SQL);

        while($Aeronaves=$Requisicao->fetch_assoc()){
            $QTDDiscrepancias=0;
            $QTDIntervencoes=0;

            $SQL2="SELECT * FROM discrepancias WHERE Data='".$_SESSION['Data']."'AND Placa='".$Aeronaves['Marca']."'";
            $Requisicao2=mysqli_query($mysqli,$SQL2);

            while($Requisicao2->fetch_assoc()){
                $QTDDiscrepancias++;
            }

            $SQL3="SELECT * FROM intervencao WHERE Data='".$_SESSION['Data']."'AND Placa='".$Aeronaves['Marca']."'";
            $Requisicao3=mysqli_query($mysqli,$SQL3);

            while($Requisicao3->fetch_assoc()){
                $QTDIntervencoes++;
            }

            $StatusImagem;
            $SQLStatus="SELECT * FROM disponibilidade WHERE Data='".$_SESSION['Data']."'AND Placa='".$Aeronaves['Marca']."'";
            $RequisicaoStatus=mysqli_query($mysqli,$SQLStatus);
            $Status=$RequisicaoStatus->fetch_assoc();

            if($Status['Status']=='Disponível'){
                $StatusImagem='Imgs/verificado.png';
                $Texto='Disponível';
            } else if($Status['Status']=='Indisponível'){
                $StatusImagem='Imgs/cancelar.png';
                $Texto='Causa: '.$Status['Causa'];
            }else if($Status['Status']=='Despachada'){
                $StatusImagem='Imgs/Despachada.png';
                $Texto=$Status['Causa'];
            }

            $SQLHorimetro="SELECT * FROM horimetro WHERE Placa='".$Aeronaves['Marca']."'";
            $RequisicaoHorimetro=mysqli_query($mysqli,$SQLHorimetro);
            $Horimetro=$RequisicaoHorimetro->fetch_assoc();
            

                echo '<table class="Tabela">
                <tr class="Titulo">
                    <td><img src="Imgs/time.png"><label>'.$Horimetro['HorasAtuais'].'</label></td>
                    <td><label>'.$Aeronaves['Marca'].'</label><img src='.$StatusImagem.' title="'.$Texto.'"></td>
                    <td><label>'.$QTDDiscrepancias.'</label><img src="Imgs/alerta.png" title="Discrepâncias"><label>'.$QTDIntervencoes.'</label><img src="Imgs/manutencao.png" title="Intervenções"></td>
                </tr>
                <tr class="Espaco"></tr>';

            $SQLIntervencao="SELECT * FROM intervencao WHERE Data='".$_SESSION['Data']."'AND Placa='".$Aeronaves['Marca']."'";
            $RequisicaoIntervencao=mysqli_query($mysqli,$SQLIntervencao);

            while($Intervencao=$RequisicaoIntervencao->fetch_assoc()){
                echo '<tr class="Linha" id="LinhaIntervencao">
                        <td colspan="3"><label style="color: rgb(255, 191, 73);">'.$Intervencao['RealizadoPor'].'</label></td>
                    </tr>';
                echo '<tr class="Linha" id="LinhaIntervencao">
                    <td colspan="3"><img src="Imgs/manutencao.png"><label>'.$Intervencao['DescIntervencao'].'</label></td>
                </tr>';
                echo '<tr class="Linha" id="LinhaIntervencao">
                <td colspan="2"><img src="Imgs/time.png"><label>'.$Intervencao['TempoInter'].'</label></td>
                <td colspan="1"><label>Tipo: '.$Intervencao['TipoIntervencao'].'</label></td>
                </tr>';
                echo '<tr class="Espaco"></tr>';
            }

            $SQLDiscrepancias="SELECT * FROM discrepancias WHERE Data='".$_SESSION['Data']."'AND Placa='".$Aeronaves['Marca']."'";
            $RequisicaoDiscrepancias=mysqli_query($mysqli,$SQLDiscrepancias);

            while($Discrepancias=$RequisicaoDiscrepancias->fetch_assoc()){
                echo '<tr class="Linha">
                        <td colspan="3"><img src="Imgs/alerta.png"><label>'.$Discrepancias['DescDiscrepancias'].'</label></td>
                </tr>';
                echo '<tr class="Espaco"></tr>';
            }
                    echo '</table>';
        }
        }  

    ?>
    
</body>
</html>