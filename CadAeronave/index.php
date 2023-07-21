<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aeronave</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    include_once('../Conexao.php');


    if(isset($_POST['PesquisarTXT'])){
        $PlacaTXT=str_replace("-","",mysqli_real_escape_string($mysqli,$_POST['PesquisarTXT'])) ;
        $SQL="SELECT * FROM aeronaves WHERE MARCA = '$PlacaTXT' LIMIT 1";
        $Requisicao=mysqli_query($mysqli,$SQL);
        $QTD=$Requisicao->num_rows;
    }
    ?>
    <form action="" method="post">
        <div class='PesquisarDIV'>
            <input type="text" name="PesquisarTXT" id="" placeholder="Placa"><br>
            <input type="submit" value="Pesquisar" style='width:10%;color:white;background-color:rgb(43, 255, 0);border-radius:10px;border:none;'>
        </div><br>

        <?php
        
        if(isset($QTD)){
            if($QTD>0){
                echo '<div class="InformacoesDIV">';
                $Linha=$Requisicao->fetch_assoc();
                echo '<form method="post" action="">';
            
                echo "<label>Horimetro Atual</label><input type='number' value='' name='HorimetroTXT'></input><br>";
                echo "<label>Nome</label><input type='text' value='' name='NomeTXT'></input><br>";

                echo "<label>Prefixo:</label><input value='".$Linha['MARCA']."' readonly></input><br>";
                echo "<label>Proprietário Atual:</label><input value='".$Linha['PROPRIETARIO']."' readonly></input><br>";
                echo "<label>Estado:</label><input value='".$Linha['SG_UF']."' readonly></input><br>";
                echo "<label>Modelo:</label><input value='".$Linha['DS_MODELO']."' readonly></input><br>";
                echo "<label>Numero de Série:</label><input value='".$Linha['NR_SERIE']."' readonly></input><br>";
                echo "<label>Fabricante:</label><input value='".$Linha['NM_FABRICANTE']."' readonly></input><br>";
                echo "<label>Tripulação Min.:</label><input value='".$Linha['NR_TRIPULACAO_MIN']."' readonly></input><br>";
                echo "<label>Tripulação MAX.:</label><input value='".$Linha['NR_PASSAGEIROS_MAX']."' readonly></input><br>";
                echo "<label>Fabricação.:</label><input value='".$Linha['NR_ANO_FABRICACAO']."' readonly></input><br>";
                echo "<label>Val. C.V.A.:</label><input type='text' value='".$Linha['DT_VALIDADE_CVA']."' readonly></input><br>";
                echo "<label>Data Mat.:</label><input value='".$Linha['DT_MATRICULA']."' readonly></input><br>";
                echo "<div>";

                echo '</form>';
            }else{
                echo '<div class="InformacoesDIV">';
                $Linha=$Requisicao->fetch_assoc();
                echo '<form method="post" action="">';
            
                echo "<label>Horimetro Atual</label><input type='number' value='' name='HorimetroTXT'></input><br>";

                echo "<label>Prefixo:</label><input value='' readonly></input><br>";
                echo "<label>Proprietário Atual:</label><input value='' readonly></input><br>";
                echo "<label>Estado:</label><input value='' readonly></input><br>";
                echo "<label>Modelo:</label><input value='' readonly></input><br>";
                echo "<label>Numero de Série:</label><input value='' readonly></input><br>";
                echo "<label>Fabricante:</label><input value='' readonly></input><br>";
                echo "<label>Tripulação Min.:</label><input value='' readonly></input><br>";
                echo "<label>Tripulação MAX.:</label><input value='' readonly></input><br>";
                echo "<label>Fabricação.:</label><input value='' readonly></input><br>";
                echo "<label>Val. C.V.A.:</label><input type='text' value='' readonly></input><br>";
                echo "<label>Data Mat.:</label><input value='' readonly></input><br>";
                echo "<p>Aeronave não encontrada.</p>";
                echo "<div>";

                echo '</form>';
            }
        }else{
            echo '<div class="InformacoesDIV">';
            echo '<form method="post" action="">';
        
            echo "<label>Horimetro Atual</label><input type='number' value='' name='HorimetroTXT'></input><br>";

            echo "<label>Prefixo:</label><input value='' readonly></input><br>";
            echo "<label>Proprietário Atual:</label><input value='' readonly></input><br>";
            echo "<label>Estado:</label><input value='' readonly></input><br>";
            echo "<label>Modelo:</label><input value='' readonly></input><br>";
            echo "<label>Numero de Série:</label><input value='' readonly></input><br>";
            echo "<label>Fabricante:</label><input value='' readonly></input><br>";
            echo "<label>Tripulação Min.:</label><input value='' readonly></input><br>";
            echo "<label>Tripulação MAX.:</label><input value='' readonly></input><br>";
            echo "<label>Fabricação.:</label><input value='' readonly></input><br>";
            echo "<label>Val. C.V.A.:</label><input type='text' value='' readonly></input><br>";
            echo "<label>Data Mat.:</label><input value='' readonly></input><br>";
            echo "<p>Aeronave não encontrada.</p>";
            echo "<div>";

            echo '</form>';
        }
        ?>
    </form>
    

</body>
</html>