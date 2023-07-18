
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

        echo '<div class="Data"><a href="../CadRelatorioDiario/index.php"><img src="Imgs/editar.png"></a><input type="text" value="'.date('d/m/Y',strtotime($_SESSION['Data'])).'" disabled name="DataTXT"> <img src="Imgs/Print.png"></div><br>';

        
        echo "<a href='../RelatorioDiario/index.php'><img class='Parte' src='Imgs/Relatorio.png' title='Relatório Principal'></a>";
        echo "<a href='index.php'><img class='Parte' src='Imgs/Fone de ouvido.png' title='Objetos Cautelados'></a>";
        echo "<a href='../RelatorioDiarioObs/index.php'><img class='Parte' src='Imgs/papel.png' title='Observações'></a>";

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