<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="script.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="../CabecalhoDesh/style.css">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar Nota</title>
</head>
<body>
    <?php
        require_once('../CabecalhoDesh/Cabecalho.php');

        if($_SESSION['CNPJ']==''||$_SESSION['CNPJ']==null){
            header('Location ../CadNota1/index.php');
        }
    ?>

    <div id='TipoDIV'>
        <label>Tipo da Nota</label>
        <div class="BotoesDIV">
            <button onclick="SelecionarTipo('Serviços')"><img src="Imgs/Serv.png">Serviços</button>
            <button onclick="SelecionarTipo('Produtos/Duráveis')"><img src="Imgs/ProdDur.png">Produtos Duráveis</button>
            <button onclick="SelecionarTipo('Produtos/NDuráveis')"><img src="Imgs/ProdNDur.png">Produtos Não Duráveis</button>
            <button onclick="SelecionarTipo('Produtos/Serviços')"><img src="Imgs/ProdServ.png">Produtos e Serviços</button>
        </div>
    </div>
    <div id='FormularioDIV'></div>
    <div class='Navbar'>
        <a href="../CadNota1/index.php"><img src="Imgs/Voltar.png"></a>
        <?php
            if($_SESSION['Tipo']!=''||$_SESSION['Tipo']!=null){
                echo '<a href="../CadNota2/index.php"><img src="Imgs/Seguinte.png"></a>';
            }
        ?>
    </div>
</body>
</html>