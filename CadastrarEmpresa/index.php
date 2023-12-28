<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="script.js" defer></script>
    <title>Cadastro de Empresas</title>
</head>
<body>
    <?php
        require_once("../Cabecalho/Cabecalho.php");
    ?>
    <form id='Formulario'>
        <input type="text" id='RegistroTXT' placeholder="CNPJ"><br>
    </form>
    <form id='Informacao' action="salvar.php" method="post">
        <label for="CNPJ">CNPJ: </label><input type="text" id='CNPJ' name="CNPJTXT" readonly>
        <label for="Nome">Nome Empresarial: </label><input type="text" id='Nome' name="NomeTXT" readonly>
        <label for="Fantasia">Nome Fantasia: </label><input type="text" id='Fantasia' name="FantasiaTXT" readonly>
        <label for="Situacao">Situação Cadastral: </label><input type="text" id='Situacao' name="SituacaoTXT" readonly>
        <label for="DataAbertura">Data de Abertura: </label><input type="text" id='DataAbertura' name="DataAberturaTXT" readonly>
        <button type='submit' id='consultarBTN' name='ConsultarBTN'>Cadastrar</button>
    </form>

</body>
</html>