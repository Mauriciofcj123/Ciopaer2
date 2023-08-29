
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" 
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" 
    crossorigin="anonymous" 
    referrerpolicy="no-referrer">
    </script>
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
            $SQLMecanicoDia="SELECT * FROM registrodisp WHERE Data='".$_SESSION['Data']."' LIMIT 1";
            $RequisicaoMecanico=mysqli_query($mysqli,$SQLMecanicoDia);
            $MecanicoDia=$RequisicaoMecanico->fetch_assoc();
            echo '<input id="MecanicoNome" value="'.$MecanicoDia['Mecanico'].'" disabled style="visibility: hidden;"></input>';

            if(isset($_SESSION['Nome'])){
                if($MecanicoDia['Mecanico']==$_SESSION['Nome']){
                    echo '<div class="Data">
                        <form method="post" action="../EditRelatorioDiario/index.php">
                            <button type="submit" name="EditarBTN">
                                <img src="Imgs/editar.png"></img>
                            </button>
                            <input type="date" value="'.date('Y-m-d',strtotime($_SESSION['Data'])).'" name="DataTXT" id="DataTXT" readonly>
                            <button type="button" onclick="CriarImpressao()">
                                <img src="Imgs/Print.png">
                            </button>
                        </form>
                        </div><br>';
                }else{
                    echo '<div class="Data">
                    <form method="post" action="../EditRelatorioDiario/index.php">
                    <input type="date" value="'.date('Y-m-d',strtotime($_SESSION['Data'])).'" disabled id="DataTXT">
                    <button type="button" onclick="CriarImpressao()">
                        <img src="Imgs/Print.png">
                    </button>
                  </form>
                  </div><br>';
                }
            }
            

        echo "<div class=Parte>";
        echo "<a href='index.php'><img src='Imgs/Relatorio.png' title='Relatorio Principal'></a>";
        echo "<a href='../RelatorioDiarioCautelados/index.php'><img src='Imgs/Fone de ouvido.png ' title='Objetos Cautelados'></a>";
        echo "<a href='../RelatorioDiarioObs/index.php'><img src='Imgs/papel.png' title='Observações'></a>";
        echo "</div>";

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
                $Texto='Causa: '.$Status['Causa'].' ('.$Status['TipoCausa'].')';
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
                    <td><label name="'.$Status['Status'].'" id="'.$Texto.'">'.$Aeronaves['Marca'].'</label><img src='.$StatusImagem.' title="'.$Texto.'"></td>
                    <td><label>'.$QTDDiscrepancias.'</label><img src="Imgs/alerta.png" title="Discrepâncias"><label>'.$QTDIntervencoes.'</label><img src="Imgs/manutencao.png" title="Intervenções"></td>
                </tr>
                <tr class="Espaco"></tr>';

            $SQLIntervencao="SELECT * FROM intervencao WHERE Data='".$_SESSION['Data']."'AND Placa='".$Aeronaves['Marca']."'";
            $RequisicaoIntervencao=mysqli_query($mysqli,$SQLIntervencao);

            while($Intervencao=$RequisicaoIntervencao->fetch_assoc()){
                echo '<label name="PlacaInt" style="visibility: hidden;">'.$Aeronaves['Marca'].'</label>';
                echo '<tr class="Linha" id="LinhaIntervencao">
                        <td colspan="3"><label name="ResponsavelInt" style="color: rgb(255, 191, 73);">'.$Intervencao['RealizadoPor'].'</label></td>
                    </tr>';
                echo '<tr class="Linha" id="LinhaIntervencao">
                    <td colspan="3"><img src="Imgs/manutencao.png"><label name="DescricaoInt">'.$Intervencao['DescIntervencao'].'</label></td>
                </tr>';
                echo '<tr class="Linha" id="LinhaIntervencao">
                <td colspan="2"><img src="Imgs/time.png"><label name="TempoInt">'.$Intervencao['TempoInter'].'</label></td>
                <td colspan="1"><label name="TipoInt">Tipo: '.$Intervencao['TipoIntervencao'].'</label></td>
                </tr>';
                echo '<tr class="Espaco"></tr>';
            }

            $SQLDiscrepancias="SELECT * FROM discrepancias WHERE Data='".$_SESSION['Data']."'AND Placa='".$Aeronaves['Marca']."'";
            $RequisicaoDiscrepancias=mysqli_query($mysqli,$SQLDiscrepancias);

            while($Discrepancias=$RequisicaoDiscrepancias->fetch_assoc()){
                echo '<label name="PlacaDisc" style="visibility: hidden;">'.$Aeronaves['Marca'].'</label>';
                echo '<tr class="Linha">
                        <td colspan="3"><img src="Imgs/alerta.png"><label name="DescricaoDisc">'.$Discrepancias['DescDiscrepancias'].'</label></td>
                </tr>';
                if(!empty($Discrepancias['Medida'])){
                    echo '<tr class="Linha" style="color: rgb(83, 83, 83);">
                        <td colspan="3"><label>Medida Tomada: </label><label name="MedidaDisc">'.$Discrepancias['Medida'].'</label></td>
                    </tr>';
                }

                echo '<tr class="Espaco"></tr>';
            }
                    echo '</table>';
        }

        $SQL="SELECT * FROM acessoriodisp WHERE Data='".$_SESSION['Data']."'";
        $Requisicao=mysqli_query($mysqli,$SQL);
        $QTD=$Requisicao->num_rows;

        if($QTD>0){
            while($Acessorios=$Requisicao->fetch_assoc()){
                echo "<label name='NomeAces' style='visibility: hidden;'>".$Acessorios['NomeAcessorio']."</label>";
                echo "<label name='ResponsavelAces' style='visibility: hidden;'>".$Acessorios['Responsável']."</label>";
            }
        }

        $SQL='SELECT * FROM observacoes WHERE Data="'.$_SESSION['Data'].'"';
        $Requisicao=mysqli_query($mysqli,$SQL);
        $QTD=$Requisicao->num_rows;

        if($QTD>0){
            while($Observacoes=$Requisicao->fetch_assoc()){
                echo "<label name='Observacao' style='visibility: hidden;'>".$Observacoes['Observacoes']."</label>";
            }
        }
        }

    ?>

<div class="ImprimirBox" id='Imprimir'>
    <button class="FecharBTN" onclick="FecharModalPrint()">X</button>
    <div class="ImprimirModal">

    <div class="menuprint" id="MenuPrint">
        <button type="button" onclick="ImprimirPDF()"><img src="Imgs/Salvar.png"></button>
    </div>
    <div class='Corpo' id='ImprimirDIV'></div>

    </div>
</div>
    
</body>
</html>