<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CabecalhoDesh/style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="Body">
    <?php
        require_once('../CabecalhoDesh/Cabecalho.php');

        if(isset($_SESSION['Nome'])){
            echo "<li class='Menu'>
            <ul><a href='../Horimetro/index.php'><img src='Imgs/NotaNeon.png'>Consultar Notas</a></ul>
            </li>";
        }else{
            echo "<li class='Menu'>
            <ul><a href='../Horimetro/index.php'><img src='Imgs/Horimetro.png'>Consultar Horimetros</a></ul>
            <ul><a href='../Aerodromos/index.php'><img src='Imgs/CadAeronave.png'>Pesquisar Aeródromos</a></ul>
            </li>";
        }
    ?>
    <div id='Ponto'></div>

</body>
</html>