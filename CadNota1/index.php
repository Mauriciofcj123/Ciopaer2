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
    ?>
    <form id='PesquisarForm'>
        <input type="text" placeholder="Pesquisar" id='Pesquisar'>
    </form>

    <div id='TabelaDIV'>
        <table id='EmpresaTB'>
                <thead>
                    <th>CNPJ</th>
                    <th>Nome Empresárial</th>
                    <th>Nome Fantasia</th>
                    <th></th>
                </thead>
        </table>
    </div>
    <div id='FormularioDIV'></div>
</body>
</html>