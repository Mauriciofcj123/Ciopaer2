<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../CabecalhoDesh/style.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        require_once('../CabecalhoDesh/Cabecalho.php');

        if(isset($_SESSION['Nome'])){
            echo "<li class='Menu'>
            <ul><a href='../Horimetro/index.php'><img src='Imgs/Horimetro.png'>Consultar Horimetros</a></ul>
            <ul><a href='../CadAeronave/index.php'><img src='Imgs/CadAeronave.png'>Cadastrar Aeronave</a></ul>
            <ul><a href='../Aerodromos/index.php'><img src='Imgs/CadAeronave.png'>Pesquisar Aeródromos</a></ul>
            <ul><a href='../Ferramentaria/index.php'><img src='imgs/inventario.png'>Inventário</a></ul>
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