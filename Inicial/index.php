
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
                $SQLGeral="SELECT * FROM tarefas WHERE Destinatario='Todos' AND Status!='Completo'";
                $RequisicaoGeral=mysqli_query($mysqli,$SQLGeral);
    
                echo '<div class="Quadro">';
                    echo '<div class="GeralBOX">';
                    echo '<label class="TituloGeral">Tarefas Gerais</label>';
                    while($Tarefas=$RequisicaoGeral->fetch_assoc()){
                        echo "<div class='Cartao'>
                            <h1 name='TituloTXT'>".$Tarefas['Titulo']."</h1>
                            <h2 name='RemetenteTXT'>".$Tarefas['Remetente']."</h2>
                            <label name='TarefaTXT'>".$Tarefas['Tarefa']."</label><br>
                            <button class='Resolvido'><img src='Imgs/Confirmar.png'></button>
                        </div>";
                    }
                    echo '</div>';
                echo '</div>';
            }
        }
    ?>

    
    
</body>
</html>