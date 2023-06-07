
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Diário</title>
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="./script.js"></script>

</head>
<body>
    
    <?php
            include('../Cabecalho/Cabecalho.php');
            include('../Conexao.php');
            $SQL='SELECT * FROM registrodisp ORDER BY Data Desc LIMIT 25';
            $Requisicao=mysqli_query($mysqli,$SQL);
            while($Linha=$Requisicao->fetch_assoc()){
                $Data=date('d/m/Y',strtotime($Linha['Data']));
                echo "<form action='../RelatorioDiario/index.php' method='post'>
                    <table id='" . $Linha['ID'] . "' class='Tabela'>
                        <tr>
                            <td>" . $Linha['Mecanico'] . "</td>
                            <td rowspan='2'><button type='submit' name='AcessarBTN'><img src='Imgs/Proximo.png'></button></td>
                        </tr>
                        <tr>
                            <td>". $Data ."</td>
                        </tr>
                    </table>
                    <input type='text' name='DataRelatorio' id='DataRelatorio' style='visibility: hidden;' value='".$Linha['Data']."'>
                    </form>";
            }
    ?>
</body>
</html>