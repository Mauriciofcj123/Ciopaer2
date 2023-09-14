
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src="script.js" defer></script>
    <script src="../Cabecalho/script.js" defer></script>

</head>
<body id='body'>
    <?php
        include('../Cabecalho/Cabecalho.php');
        include('../Conexao.php');
        if(isset($_SESSION['Nome'])){

            function ContarDatas($Data){
                if(!empty($Data)){
                    $Data2=date('Y-m-d');

                    $DataFinal=explode('-',$Data);

                    $DiaFinal=$DataFinal[2];
                    $MesFinal=$DataFinal[1];
                    $AnoFinal=$DataFinal[0];

                    $TotalDiasFinal=$DiaFinal+($MesFinal*30);

                    $DataAtual=explode('-',$Data2);

                    $DiaAtual=$DataAtual[2];
                    $MesAtual=$DataAtual[1];
                    $AnoAtual=$DataAtual[0];

                    $TotalDiasAtual=$DiaAtual+($MesAtual*30);

                    return $TotalDiasFinal-$TotalDiasAtual;
                }



            }
            function CorFundo($Data){
                
                    $Cor="rgb(255, 255, 255)";

                if(!empty($Data)){
                    $Dias=ContarDatas($Data);

                    if($Dias>=7){
                        $Cor="rgb(255, 255, 255)";
                    }else if($Dias<7 && $Dias>3){
                        $Cor='rgb(255, 254, 187)';
                    }else{
                        $Cor='rgb(255, 204, 204)';
                    }
                }


                return $Cor;
            }

            if($_SESSION['Nome']!=""){
                echo '<form method="post" action="" id="PesquisaForm" >';
                echo '<select name="SecaoTXT">';
                    $SQLSecao='SELECT * FROM secoes';
                    $RequisicaoSecao=mysqli_query($mysqli,$SQLSecao);

                    while($Secao=$RequisicaoSecao->fetch_assoc()){
                        echo "<option>".$Secao['Secao']."</option>";
                    }
                echo '</select>';
                echo '<button type="submit" name="PesquisarBTN">Pesquisar</button>';
                echo '</form>';

                if(isset($_POST['PesquisarBTN'])){
                    $Secao=$_POST['SecaoTXT'];
                }else{
                    $SQLSecao='SELECT * FROM secoes LIMIT 1';
                    $RequisicaoSecao=mysqli_query($mysqli,$SQLSecao);
                    $SecaoLinha=$RequisicaoSecao->fetch_assoc();

                    $Secao=$SecaoLinha['Secao'];
                }

                echo '<button onclick="AbrirModal()" class="AddTarefa">+</button><br>';
                echo '<div class="Quadro">';
                    echo '<div class="CardBox" id="Minhas" style="background-color:rgb(255, 233, 163);">';
                    echo '<label class="Titulo">Minhas Tarefas</label>';
                    
                    $id=0;
                    
                    $SQLIncompletas="SELECT * FROM tarefas WHERE Destinatario = 'Todos' AND Status!='Completo' AND DataLimite!='' AND Secao='$Secao' ORDER BY DataLimite ASC";
                    $RequisicaoIncompletas=mysqli_query($mysqli,$SQLIncompletas);

                    while($Tarefas=$RequisicaoIncompletas->fetch_assoc()){

                        $id++;
                        echo "<div class='CartaoTarefa' style='background-color:".CorFundo($Tarefas['DataLimite'])."'>
                            <div class='Selo'>
                                <img src='Imgs/Todos.png'>
                            </div>
                            <label style='visibility: hidden;position: absolute;'></label>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Tarefa']."</label><br>";
                            if(!empty($Tarefas['DataLimite'])){
                                echo "<label>Data Limite: </label><label>".date('d/m/Y',strtotime($Tarefas['DataLimite']))."</label><br>";
                            }
                            echo "<button onclick='Resolver(".$Tarefas['id'].",".$id.")' class='Resolvido'><img src='Imgs/Confirmar.png'></button>
                        </div>";
                    }

                    $SQLIncompletas="SELECT * FROM tarefas WHERE Destinatario = 'Todos' AND Status!='Completo' AND Secao='$Secao' AND DataLimite IS null";
                    $RequisicaoIncompletas=mysqli_query($mysqli,$SQLIncompletas);

                    while($Tarefas=$RequisicaoIncompletas->fetch_assoc()){

                        $id++;

                        echo "<div class='CartaoTarefa' style='background-color:".CorFundo($Tarefas['DataLimite'])."'>
                            <div class='Selo'>
                                <img src='Imgs/Todos.png'>
                            </div>
                            <label style='visibility: hidden;position: absolute;'></label>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Tarefa']."</label><br>";
                            echo "<button onclick='Resolver(".$Tarefas['id'].",".$id.")' class='Resolvido'><img src='Imgs/Confirmar.png'></button>
                        </div>";
                    }
                    
                    $SQLIncompletas="SELECT * FROM tarefas WHERE Destinatario LIKE '%".$_SESSION['Nome']."%' AND Status!='Completo' AND DataLimite!='' AND Secao='$Secao' ORDER BY DataLimite ASC";
                    $RequisicaoIncompletas=mysqli_query($mysqli,$SQLIncompletas);

                    while($Tarefas=$RequisicaoIncompletas->fetch_assoc()){
                        $id++;
                        echo "<div class='CartaoTarefa' style='background-color:".CorFundo($Tarefas['DataLimite'])."'>
                            <label style='visibility: hidden;position: absolute;'></label>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Tarefa']."</label><br>";
                            if(!empty($Tarefas['DataLimite'])){
                                echo "<label>Data Limite: </label><label>".date('d/m/Y',strtotime($Tarefas['DataLimite']))."</label><br>";
                            }
                            echo "<button onclick='Resolver(".$Tarefas['id'].",".$id.")' class='Resolvido'><img src='Imgs/Confirmar.png'></button>
                        </div>";
                    }

                    $SQLIncompletas="SELECT * FROM tarefas WHERE Destinatario LIKE '%".$_SESSION['Nome']."%' AND Status!='Completo' AND DataLimite IS NULL AND Secao='$Secao' ORDER BY DataLimite ASC";
                    $RequisicaoIncompletas=mysqli_query($mysqli,$SQLIncompletas);

                    while($Tarefas=$RequisicaoIncompletas->fetch_assoc()){
                        $id++;
                        echo "<div class='CartaoTarefa' style='background-color:".CorFundo($Tarefas['DataLimite'])."'>
                            <label style='visibility: hidden;position: absolute;'></label>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Tarefa']."</label><br>";
                            if(!empty($Tarefas['DataLimite'])){
                                echo "<label>Data Limite: </label><label>".date('d/m/Y',strtotime($Tarefas['DataLimite']))."</label><br>";
                            }
                            echo "<button onclick='Resolver(".$Tarefas['id'].",".$id.")' class='Resolvido'><img src='Imgs/Confirmar.png'></button>
                        </div>";
                    }
                    echo '</div>';

                    echo '<div class="CardBox" id="Completas" style="background-color:rgb(176, 255, 202);">';
                    echo '<label class="Titulo">Tarefas Completas</label>';


                    $SQLCompletas="SELECT * FROM tarefas WHERE Status='Completo' AND Secao='$Secao' LIMIT 10";
                    $RequisicaoCompletas=mysqli_query($mysqli,$SQLCompletas);

                    while($Tarefas=$RequisicaoCompletas->fetch_assoc()){
                        
                        $Data=date('d/m/y',strtotime($Tarefas['DataRealizacao']));

                        echo "<div class='CartaoTarefa'>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Tarefa']."</label><br><br>
                            <label>Realizador: </label><label name='TarefaTXT'>".$Tarefas['Realizador']."</label><br>
                            <label>Data do Cumprimento: </label><label name='TarefaTXT'>".$Data."</label><br>
                        </div>";
                    }
                    echo '</div>';

                    echo '<div class="CardBoxOBS" style="background-color:rgb(255, 172, 172);box-shadow: -2px 2px 3px rgba(255, 184, 52, 0.5);">';
                    echo '<label class="Titulo">Discrepancias Pendentes</label>';

                    $SQLData="SELECT * FROM registrodisp WHERE Secao='$Secao' ORDER BY Data DESC LIMIT 1";
                    $RequisicaoData=mysqli_query($mysqli,$SQLData);
                    $QTDReg=$RequisicaoData->num_rows;

                    if($QTDReg>0){
                        $UltimaData=$RequisicaoData->fetch_assoc()['Data'];

                        $SQLDisc="SELECT * FROM discrepancias WHERE Data='$UltimaData'";
                        $RequisicaoDisc=mysqli_query($mysqli,$SQLDisc);
                        $QTD=$RequisicaoDisc->num_rows;

                        if($QTD>0){
                            while($Disc=$RequisicaoDisc->fetch_assoc()){
                                echo "<div class='CartaoOBS'>
                                    <label name='OBSTXT'>Prefixo: ".$Disc['Placa']."</label><br>
                                    <label name='OBSTXT'>".$Disc['DescDiscrepancias']."</label>
                                </div>";
                            }
                        }
                    }
                    
                echo '</div>';
                echo '</div>';

                echo "<div id='ModalTarefa'>
                <div id='FormularioDIV'>
                <button onclick='FecharModal()' id='FecharBTN'>X</button>

                    <form action='' method='post' id='Formulario'>
                        <label>Destinatário </label>
                        <div id='DestinatarioDIV'>
                        <input type='checkbox' name='checkbox' id='checkbox'><input type='text' id='DestinatarioTXT' name='DestinatarioTXT' value='Todos'><br>";
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
                        <select id='SecaoTXT'>";

                        $SQLSecao="SELECT * FROM secoes";
                        $RequisicaoSecao=mysqli_query($mysqli,$SQLSecao);
                        while($Secao=$RequisicaoSecao->fetch_assoc()){
                            echo "<option>".$Secao['Secao']."</option>";
                        }

                        echo "</select><br>
                        <textarea name='Tarefa' id='Tarefa' placeholder='Tarefa'></textarea><br>
                        <label>Data Limite:</label> <input type='date' name='Data' id='DataTXT'><br>
                        <button type='button' onclick='Salvar()' class='EnviarBTN' id='EnviarBTN' style='visibility: hidden;'>Salvar</button>
                    </form>
                </div>
            </div>";


            }
        }else{
            echo '<h1 style="width=100%;text-align: center;margin:50px;">Acesso rápido</h1>
                    <li class="Menu">
                        <ul><a href="../SessaoRelDiario/index.php">Relatórios Diário</a></ul>
                        <ul><a href="../Horimetro/index.php">Horímetros</a></ul>
                        <ul><a href="../Erro/index.php">Boletim Informativo</a></ul>
                    </li>';
        }
    ?>

</body>
</html>