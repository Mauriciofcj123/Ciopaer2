<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src="https://cdn.sheetjs.com/xlsx-0.20.0/package/dist/xlsx.full.min.js"></script>
    <script src='script.js' defer></script>
    <title>Relatório de Intervenção</title>
</head>
<body>
    <?php
        require_once('../Cabecalho/Cabecalho.php');
        require_once('Pesquisar.php');
    ?>
    <div class='DIVFormulario'>
    <form action="" method='post' id='Formulario'>
        <select name="SecaoTXT" class='SecaoTXT'>
            <?php
                $SQLSecoes='SELECT * FROM secoes';
                $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);

                while($Secao=$RequisicaoSecoes->fetch_assoc()){
                    echo "<option>".$Secao['Secao']."</option>";
                }
            ?>
        </select>

        <?php

            if(isset($_POST['GerarBTN'])){
                $Secao=$_POST['SecaoTXT'];
                
                echo '<select name="Aeronave" id="AeronaveTXT">';

                    $SQLAeronaves="SELECT * FROM aeronavescadastradas WHERE Secao='$Secao'";
                    $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);
    
                    echo "<option>Todas</option>";
    
                    while($Aeronaves=$RequisicaoAeronaves->fetch_assoc()){
                        echo "<option>".$Aeronaves["Marca"]."</option>";
                    }
                echo '</select>';
            }
        ?>

        <input type="submit" value="Gerar" name='GerarBTN' class="FormularioBTN" style='width:100px'><br>
    </form>
    </div>
    <div class='VerDIV'>
    <button id='VerBTN' onclick='MostrarRel()'><img src="imgs/Ver.png"></button>
    </div>
    <div class="Total">
    </div>
    <div id='GrupoGraficos'>
    </div>
    <div id="ModalTabela">
        <button class='FecharBTN' onclick='FecharRel()'><img src="imgs/Fechar.png"></button>
        <div id='TabelaDIV'>
            <button onclick="BaixarTabela2()" title='Fazer o download da planilha'><img src="imgs/baixar.png"></button>
    <?php

        $SQLSecoes='SELECT * FROM secoes';
        $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);

        if(isset($RequisicaoTotalDisc)){
            echo "<table id='Tabela'>";
            echo "<thead>";
            echo "<th>Prefixo</th>";
            echo "<th>Descrição</th>";
            echo "</thead>";
            while($DiscrepanciasTotal=$RequisicaoTotalDisc->fetch_assoc()){
                echo "<tr>";
                echo "<td name='Placa'>".$DiscrepanciasTotal['Placa']."</td>";
                echo "<td name='Descricao'>".$DiscrepanciasTotal['DescDiscrepancias']."</td>";
                echo "</tr>";
            }
        }
    ?>
        </div>
    </div>

</body>
</html>