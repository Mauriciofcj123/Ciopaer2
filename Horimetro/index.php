<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Horimetros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    require_once('../Conexao.php');

    $SQLHorimetro='SELECT * FROM horimetro';
    $RequisicaoHorimetro=mysqli_query($mysqli,$SQLHorimetro);

    echo "<table id='Tabela'>
            <thead>
                <th>Prefixo</th>
                <th>Ultima Atualização</th>
                <th>Horímetro Atual</th>
                <th>Proxima Revisão</th>
                <th>Horas Disponíveis</th>
                <th>Status da Aerovane</th>
                <th>Nome da Proxima Revisão</th>
                <th>C.V.A.</th>
                <th>TBO RH</th>
                <th>TBO LH</th>
                <th>Horas Disponíveis de Motor LH</th>
                <th>Horas Disponíveis de Motor RH</th>
            </thead>";
        while($Linha=$RequisicaoHorimetro->fetch_assoc()){
            echo "<tr name='Linha'>
                        <td>".$Linha['Placa']."</td>
                        <td>".$Linha['Data']."</td>
                        <td>".$Linha['HorasAtuais']."</td>
                        <td>".$Linha['HorasProxRev']."</td>
                        <td>".$Linha['HorasDisp']."</td>
                        <td>".$Linha['TipoProxRev']."</td>
                        <td>".$Linha['CVA']."</td>
                        <td>".$Linha['TBORH']."</td>
                        <td>".$Linha['TBOLH']."</td>
                        <td>".$Linha['Placa']."</td>
                    </tr>";
        }
        echo "</table>";
    ?>
</body>
</html>