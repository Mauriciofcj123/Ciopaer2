<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatórios</title>
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <link rel="stylesheet" href="style.css">
    <script src='../Cabecalho/script.js' defer></script>
</head>
<body>
    <?php
        include_once('../Cabecalho/Cabecalho.php');
    ?>
    
    <ul id="MenuRel">
        <li><a href="../SessaoRelDiario/index.php"><img id="Imagem1" src="Imgs/relatorio_diario.png" alt=""><a href="../RelatorioDiarioLib/index.php">Relatório Diário</a></li>
        <li><a href="../RelatorioInt/index.php"><img src="Imgs/Intervencoes.png"><a href="../RelatorioInt/index.php">Relatório de Intervenções Realizadas</a></li>
        <li><a href="../RelatorioDisc/index.php"><img src="Imgs/Intervencoes.png"><a href="../RelatorioInt/index.php">Relatório de Anormalidades Pendentes</a></li>
    </ul>
    
</body>
</html>