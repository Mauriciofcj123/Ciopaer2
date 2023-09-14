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
        <input type="date"  name="De">
        <input type="date"  name="Ate">
        <input type="submit" value="Gerar" name='GerarBTN' class="FormularioBTN" style='width:100px'><br>
        <select name="SecaoTXT" class='SecaoTXT'>
            <?php
                $SQLSecoes='SELECT * FROM secoes';
                $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);

                while($Secao=$RequisicaoSecoes->fetch_assoc()){
                    echo "<option>".$Secao['Secao']."</option>";
                }
            ?>
        </select>
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

        if(isset($RequisicaoTotalInt)){
            echo "<table id='Tabela'>";
            echo "<thead>";
            echo "<th>Data</th>";
            echo "<th>Aeronave</th>";
            echo "<th>Responsável</th>";
            echo "<th>Descrição</th>";
            echo "<th>Tempo</th>";
            echo "</thead>";

            while($IntervencaoTotal=$RequisicaoTotalInt->fetch_assoc()){
                echo "<tr>";
                echo "<td name='Data'>".date('d/m/Y',strtotime($IntervencaoTotal['Data']))."'</td>";
                echo "<td name='Placa'>".$IntervencaoTotal['Placa']."</td>";
                echo "<td name='Responsavel'>".$IntervencaoTotal['RealizadoPor']."</td>";
                echo "<td name='Descricao'>".$IntervencaoTotal['DescIntervencao']."</td>";
                echo "<td name='Tempo'>".date('h:i:s',strtotime($IntervencaoTotal['TempoInter']))."hrs</td>";
                echo "</tr>";
            }
            echo "<tr style='background-color: rgb(133, 231, 133);'>";
            echo "<td colspan='4'>TAXA H/H = R$ 420,00  consideramos nesta tabela o minimo para execução de qualquer serviço que são 02 homens/hora:</td>";
            echo "<td>".number_format($HorasQTDTotal)." horas</td>";
            echo "</tr>";

            echo "<tr style='background-color: rgb(133, 231, 133);'>";
            echo "<td colspan='4'>TOTAL ECONOMIZADO:</td>";
            echo "<td> R$ ".number_format($HorasTotal,2,",",".")."</td>";
            echo "</tr>";
            echo "</table>";
        }
    ?>
        </div>
    </div>

</body>
</html>