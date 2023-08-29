<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src='script.js' defer></script>
    <title>Document</title>
</head>
<body>
    <?php
        require_once('../Cabecalho/Cabecalho.php');
    ?>
    <form action="" method='post' id='Formulario'>
        <input type="date"  name="De">
        <input type="date"  name="Ate">
        <input type="submit" value="Gerar" name='GerarBTN' style='width:100px'>
    </form>
    <?php
        require_once('Pesquisar.php');
    ?>
    <div class="Total">
        <h1>Valor Economizado</h1>
        <h1 id='ValorTXT'></h1>
    </div>
    <div id='Graficos'>
        <h1 class='Titulo1'>Tempo gasto por aeronave (hrs)</h1>
        <h1 class='Titulo2'>Quantidade por aeronave</h1>
        <div id='Grafico1'>
        </div>
        <div id='Grafico2'>
        </div>
        <div id='Textos'>
        </div>
        <div id='Textos2'>
        </div>
    </div>

</body>
</html>