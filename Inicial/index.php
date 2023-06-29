
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src="script.js"></script>
    <script src="../Cabecalho/script.js" defer></script>

</head>
<body>

    <?php
        include('../Cabecalho/Cabecalho.php');
        include('../Conexao.php');
        if(isset($_SESSION['Nome'])){
            if($_SESSION['Nome']!=""){
    
                echo '<div class="Quadro">';
                    echo '<div class="CardBox" style="background-color:rgb(176, 255, 202);">';
                    echo '<label class="Titulo">Tarefas Gerais</label>';

                    $SQLGeral="SELECT * FROM tarefas WHERE Destinatario='Todos' AND Status!='Completo'";
                    $RequisicaoGeral=mysqli_query($mysqli,$SQLGeral);

                    while($Tarefas=$RequisicaoGeral->fetch_assoc()){
                        echo "<div class='CartaoTarefa'>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Texto']."</label><br>
                            <button class='Resolvido'><img src='Imgs/Confirmar.png'></button>
                        </div>";
                    }
                    echo '</div>';
                    echo '<button class="AddTarefa" style="background-color: rgb(30, 255, 0);box-shadow: -2px 2px 3px rgba(30, 255, 0, 0.5);">+</button>';

                    echo '<div class="CardBox" style="background-color:rgb(255, 233, 163);">';
                    echo '<label class="Titulo">Minhas Tarefas</label>';

                    $SQLMinhas="SELECT * FROM tarefas WHERE Destinatario='".$_SESSION['Nome']."' AND Status!='Completo'";
                    $RequisicaoMinhas=mysqli_query($mysqli,$SQLMinhas);

                    while($Tarefas=$RequisicaoMinhas->fetch_assoc()){
                        echo "<div class='CartaoTarefa'>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Texto']."</label><br>
                            <button class='Resolvido'><img src='Imgs/Confirmar.png'></button>
                        </div>";
                    }
                    echo '</div>';
                    echo '<button class="AddTarefa" style="background-color: rgb(255, 166, 0);">+</button>';

                    echo '<div class="CardBox" style="background-color:rgb(255, 172, 172);box-shadow: -2px 2px 3px rgba(255, 184, 52, 0.5);">';
                    echo '<label class="Titulo">Observações das Aeronaves</label>';

                    $SQLData="SELECT * FROM observacoes ORDER BY Data ASC LIMIT 1";
                    $RequisicaoData=mysqli_query($mysqli,$SQLData);
                    $UltimaData=$RequisicaoData->fetch_assoc()['Data'];

                    $SQLOBS="SELECT * FROM observacoes WHERE Data='$UltimaData'";
                    $RequisicaoOBS=mysqli_query($mysqli,$SQLOBS);

                    while($OBS=$RequisicaoOBS->fetch_assoc()){
                        echo "<div class='CartaoOBS'>
                            <label name='OBSTXT'>".$OBS['Observacoes']."</label>
                        </div>";
                    }
                    echo '</div>';

                echo '</div>';
            }
        }
    ?>

    
    
</body>
</html>