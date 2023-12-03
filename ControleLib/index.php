<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once('../Cabecalho/Cabecalho.php');

        if(isset($_SESSION['Nome'])){
            echo "<h1 id='Titulo'>Logística</h1>";
            echo "<li class='Menu'>
            <ul><a href='../Horimetro/index.php'><img src='Imgs/Horimetro.png'>Consultar Horímetros</a></ul>
            <ul><a href='../Aerodromos/index.php'><img src='Imgs/CadAeronave.png'>Pesquisar Aeródromos</a></ul>
            <ul class='Desativado'><a href=''><img src='imgs/localizacao.png'>Localizar Aeronaves</a></ul>
            </li>";

            echo "<h1 id='Titulo'>Relatórios</h1>";
            echo "<li class='Menu'>
            <ul><a href='../SessaoRelDiario/index.php'><img src='Imgs/relatorio_diario.png'>Relatório Diario</a></ul>
            <ul><a href='../RelatorioInt/index.php'><img src='Imgs/Intervencoes.png'>Intervenções</a></ul>
            <ul><a href='../RelatorioDisc/index.php'><img src='Imgs/Intervencoes.png'>Discrepâncias Pendentes</a></ul>
            </li>";

            echo "<h1 id='Titulo'>Gestão de Materiais</h1>";
            echo "<li class='Menu'>
            <ul><a href='../Ferramentaria/index.php'><img src='imgs/inventario.png'>Inventário</a></ul>
            </li>";

            echo "<h1 id='Titulo'>Cadastros</h1>";
            echo "<li class='Menu'>
            <ul><a href='../CadAeronave/index.php'><img src='Imgs/CadAeronave.png'>Cadastrar Aeronave</a></ul>
            </li>";
        }else{
            echo "<li class='Menu'>
            <ul><a href='../Horimetro/index.php'><img src='Imgs/Horimetro.png'>Consultar Horimetros</a></ul>
            <ul><a href='../Aerodromos/index.php'><img src='Imgs/CadAeronave.png'>Pesquisar Aeródromos</a></ul>
            </li>";
        }
    ?>

</body>
</html>