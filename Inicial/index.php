
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src="script.js" defer></script>
    <script src="../Cabecalho/script.js" defer></script>

</head>
<body>

    <?php
        include('../Cabecalho/Cabecalho.php');
        include('../Conexao.php');
        if(isset($_SESSION['Nome'])){
            if($_SESSION['Nome']!=""){

                if(isset($_POST['EnviarBTN'])){

                    $Destinatario=$_POST['Destinatario'];

                    $Titulo=$_POST['Titulo'];
                    $Tarefa=$_POST['Tarefa'];
                    $Remetente=$_SESSION['Nome'];
                    $Status='Pendente';

                    if(isset($_POST['Data'])){
                        $Data=$_POST['Data'];
                        $SQLTarefa="INSERT INTO tarefas(Remetente,Destinatario,Tarefa,Titulo,Status,DataLimite) VALUES ('$Remetente','$Destinatario','$Tarefa','$Titulo','$Status','$Data')";
                    }else{
                        $SQLTarefa="INSERT INTO tarefas(Remetente,Destinatario,Tarefa,Titulo,Status) VALUES ('$Remetente','$Destinatario','$Tarefa','$Titulo','$Status')";
                    }
                    $RequisicaoTarefa=mysqli_query($mysqli,$SQLTarefa);
                }
    
                echo '<div class="Quadro">';
                    echo '<div class="CardBox" style="background-color:rgb(176, 255, 202);">';
                    echo '<label class="Titulo">Tarefas Gerais</label>';

                    $SQLGeral="SELECT * FROM tarefas WHERE Destinatario='Todos' AND Status!='Completo'";
                    $RequisicaoGeral=mysqli_query($mysqli,$SQLGeral);

                    while($Tarefas=$RequisicaoGeral->fetch_assoc()){
                        echo "<div class='CartaoTarefa'>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Tarefa']."</label><br>
                            <button class='Resolvido'><img src='Imgs/Confirmar.png'></button>
                        </div>";
                    }
                    echo '</div>';
                    echo '<button onclick="AbrirModal()" class="AddTarefa" style="background-color: rgb(30, 255, 0);box-shadow: -2px 2px 3px rgba(30, 255, 0, 0.5);">+</button>';

                    echo '<div class="CardBox" style="background-color:rgb(255, 233, 163);">';
                    echo '<label class="Titulo">Minhas Tarefas</label>';

                    $SQLMinhas="SELECT * FROM tarefas WHERE Destinatario LIKE '%".$_SESSION['Nome']."%' AND Status!='Completo'";
                    $RequisicaoMinhas=mysqli_query($mysqli,$SQLMinhas);

                    while($Tarefas=$RequisicaoMinhas->fetch_assoc()){
                        echo "<div class='CartaoTarefa'>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Tarefa']."</label><br>
                            <button class='Resolvido'><img src='Imgs/Confirmar.png'></button>
                        </div>";
                    }
                    echo '</div>';
                    echo '<button onclick="AbrirModal()" class="AddTarefa" style="background-color: rgb(255, 166, 0);">+</button>';

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

                    echo "<div id='ModalTarefa'>
                    <button onclick='FecharModal()'>Fechar</button>
                        <div id='FormularioDIV'>
                            <form action='' method='post' id='Formulario'>
                                <label>Destinatário </label>
                                <div id='DestinatarioDIV'>
                                <input type='checkbox' name='checkbox' id='checkbox'><label for='checkbox' id='DestinatarioTXT' name='DestinatarioTXT'>Todos</label><br>";
                                $SQLUser='SELECT * FROM cadastros';
                                $RequisicaoUser=mysqli_query($mysqli,$SQLUser);
                                while($Users=$RequisicaoUser->fetch_assoc()){
                                    if($Users['Patente']=='Sem Patente'){
                                        echo "<input type='checkbox' name='checkbox' id='checkbox'><input type='text' id='DestinatarioTXT' name='DestinatarioTXT' value='".$Users['Nome']." ".$Users['Sobrenome']."'><br>";
                                    }else{
                                        echo "<input type='checkbox' name='checkbox' id='checkbox'><input type='text' id='DestinatarioTXT' name='DestinatarioTXT' value='".$Users['Patente']." ".$Users['Sobrenome']."'><br>";
                                    }
                                    
                                }
                                    
                                echo "</div>
                                <input type='text' placeholder='Título' id='TituloTXT' name='Titulo'><br>
                                <textarea name='Tarefa' id='Tarefa' placeholder='Tarefa'></textarea><br>
                                <label for=''>Data Limite:</label> <input type='date' name='Data' id='DataTXT'><br>
                                <button type='button' onclick='Salvar()' class='EnviarBTN' id='EnviarBTN' style='visibility: hidden;'>Salvar</button>
                            </form>
                        </div>
                    </div>";
            }
        }
    ?>
    
    
</body>
</html>