
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

        
        echo '<div class="Partes">';
            echo "<a href='../RelatorioDiario/index.php'><img src='Imgs/Relatorio.png' title='Relatório Principal'></a>";
            echo "<a href='../RelatorioDiarioCautelados/index.php'><img src='Imgs/Fone de ouvido.png' title='Objetos Cautelados'></a>";
            echo "<a href='index.php'><img src='Imgs/papel.png' title='Observações'></a>";
        echo '</div>';

            $SQL="SELECT * FROM acessoriodisp WHERE Data='".$_SESSION['Data']."'";
            $Requisicao=mysqli_query($mysqli,$SQL);
            $QTD=$Requisicao->num_rows;

            
            if($QTD>0){
                echo '<table class="Tabela">';
                echo '<thead style="font-weight: bold; color: black;">
                        <tr>
                        <th>Objeto Cautelado</th>
                        <th>Quem Cautelou</th>
                        </tr>
                    </thead>';
                echo "<tr class='Espaco'></tr>";

                while($Linha=$Requisicao->fetch_assoc()){
                    echo '<tr>
                    <td><img src="Imgs/'.$Linha['NomeAcessorio'].'.png" title="'.$Linha['NomeAcessorio'].'"></td>
                    <td>'.$Linha['Responsável'].'</td>        
                    </tr>';
                }
              echo '</table>';
            }else{
                echo '<h1>Nenhum Objeto Cautelado</h1>';
            }

        


            

    ?>
    
</body>
</html>