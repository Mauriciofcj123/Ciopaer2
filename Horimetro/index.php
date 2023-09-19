<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Horimetros</title>
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <link rel="stylesheet" href="style.css">
    <script src='script.js' defer></script>
</head>
<body>
    <?php
    require_once('../Conexao.php');
    require('../Cabecalho/Cabecalho.php');

    $SQLSecoes='SELECT * FROM secoes';
    $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);

    echo '<form method="post" action="" class="Formulario" class="Formulario">';
    echo '<select id="Secoes" name="SecaoTXT">';
            while($Secao=$RequisicaoSecoes->fetch_assoc()){
                echo "<option>".$Secao['Secao']."</option>";
            }
    echo '</select>';
    echo '<button type="submit" name="PesquisarBTN">Pesquisar</button>';
    echo '</form>';

    if(isset($_POST['PesquisarBTN'])){
        $Secao=$_POST['SecaoTXT'];
        $SQLHorimetro="SELECT * FROM horimetro WHERE Secao = '$Secao'";
        $RequisicaoHorimetro=mysqli_query($mysqli,$SQLHorimetro);
    }else{
        $SQLSecoes='SELECT * FROM secoes LIMIT 1';
        $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);
        $Secao=$RequisicaoSecoes->fetch_assoc();

        $SQLHorimetro="SELECT * FROM horimetro WHERE Secao = '".$Secao['Secao']."'";
        $RequisicaoHorimetro=mysqli_query($mysqli,$SQLHorimetro);
    }
    echo "<li class='MenuHorimetro'>
            <ul><a onClick='AbrirModal()'><img src='Imgs/Atualizar.png'></a></ul>
            <ul><a href='../CadAeronave/index.php'><img src='Imgs/Cadastrar.png'></a></ul>
        </li>";
    echo "<div class='TabelaDIV'>";
        echo '<h1 class="Titulo">Tabela de Horimetros</h1>';
        echo "<table id='Tabela'>
                <thead>
                    <th>Prefixo</th>
                    <th>Ultima Atualização</th>
                    <th>Horímetro Atual</th>
                    <th>Horas da Proxima Revisão</th>
                    <th>Horas Disp.</th>
                    <th>Status</th>
                    <th>Causa</th>
                    <th>Proxima Revisão</th>
                    <th>C.V.A.</th>
                    <th>TBO</th>
                    <th>Horas Disponíveis do Motor</th>
                </thead>";

                $LinhasID=0;
            while($Linha=$RequisicaoHorimetro->fetch_assoc()){
                $LinhasID++;

                $SQLDisp="SELECT * FROM `disponibilidade` WHERE Placa='".$Linha['Placa']."' ORDER BY Data desc LIMIT 1";
                $RegistroDisp=mysqli_query($mysqli,$SQLDisp);
                $ResultadoDisp=$RegistroDisp->fetch_assoc();

                $HorasDisp=$Linha['HorasProxRev']-$Linha['HorasAtuais'];

                $Fundo="";

                if($LinhasID % 2==0){
                    $Fundo="background-color: rgba(182, 238, 255,0.2);";
                }else{
                    $Fundo="background-color: white;";
                }

                if($Linha['TBOLH']>0){

                    $HorasDispMotorRH=$Linha['TBORH']-$Linha['HorasAtuais'];
                    $HorasDispMotorLH=$Linha['TBOLH']-$Linha['HorasAtuais'];

                    echo "<tr name='Linha' style='$Fundo'>
                            <td rowspan=2>".$Linha['Placa']."</td>
                            <td rowspan=2>".date('d/m/Y',strtotime($ResultadoDisp['Data']))."</td>
                            <td rowspan=2><input type='number' name='HorasAtuais' value='".$Linha['HorasAtuais']."' readonly></td>
                            <td rowspan=2><input type='number' name='HorasProxRev' value='".$Linha['HorasProxRev']."' readonly></td>
                            <td rowspan=2><input type='number' name='HorasDisp' value='$HorasDisp' readonly></td>";
                            if($ResultadoDisp['Status']=='Disponível'){
                                echo "<td class='Disponivel' rowspan=2>".$ResultadoDisp['Status']."</td>";
                            }else if($ResultadoDisp['Status']=='Despachada'){
                                echo "<td class='Despachada' rowspan=2>".$ResultadoDisp['Status']."</td>";
                            }else{
                                echo "<td class='Indisponivel' rowspan=2>".$ResultadoDisp['Status']."</td>";
                            }
                            echo "<td rowspan=2>".$ResultadoDisp['Causa']."</td>
                            <td rowspan=2><input type='text' name='ProxRev' value='".$Linha['TipoProxRev']."' readonly></td>
                            <td rowspan=2><input type='date' name='CVA' value='".$Linha['CVA']."' readonly></td>
                            <td><input type='number' name='TBORH' value='".$Linha['TBORH']."' name='TBO' readonly></td>
                            <td><input type='number' name='TBODisp' value='$HorasDispMotorRH' readonly></td>
                        </tr>
                        <tr name='Linha' style='$Fundo'>
                        <td><input type='number' value='".$Linha['TBOLH']."' name='TBOLH'></td>
                        <td name='TBODisp'><input type='number' name='HorasDisp' value='$HorasDispMotorLH' readonly></td>
                        </tr>";
                }else{
                    $HorasDispMotor=$Linha['TBORH']-$Linha['HorasAtuais'];

                    echo "<tr name='Linha' style='$Fundo'>
                            <td>".$Linha['Placa']."</td>
                            <td>".date('d/m/Y',strtotime($ResultadoDisp['Data']))."</td>
                            <td><input type='number' name='HorasAtuais' value='".$Linha['HorasAtuais']."' readonly></td>
                            <td><input type='number' name='HorasProxRev' value='".$Linha['HorasProxRev']."' readonly></td>
                            <td><input type='number' name='HorasDisp' value='$HorasDisp' readonly></td>";
                            if($ResultadoDisp['Status']=='Disponível'){
                                echo "<td class='Disponivel'>".$ResultadoDisp['Status']."</td>";
                            }else if($ResultadoDisp['Status']=='Despachada'){
                                echo "<td class='Despachada'>".$ResultadoDisp['Status']."</td>";
                            }else{
                                echo "<td class='Indisponivel'>".$ResultadoDisp['Status']."</td>";
                            }
                            echo "<td>".$ResultadoDisp['Causa']."</td>
                            <td><input type='text' name='ProxRev' value='".$Linha['TipoProxRev']."' readonly></td>
                            <td><input type='date' name='CVA' value='".$Linha['CVA']."' readonly></td>
                            <td><input type='number' value='".$Linha['TBORH']."' name='TBORH' readonly></td>
                            <td name='TBODisp$LinhasID'><input type='number' name='HorasDisp' value='$HorasDispMotor' readonly></td>
                            </tr>";
                }
                
            }
            echo "</table>";
    echo "</div>";
    ?>

        <div id='Fundo'>
            <div id='Modal'>
            <form id='Formulario'>
                <label>Prefixo:</label><input type="text" id='Prefixo'><br>
                <label>Horas Atuais:</label><input type="number" id='HAtual'>
                <label>Horas da Proxima Revisão:</label><input type="number" id='HorasProxRev'>
                <label>Tipo da Proxima Revisão:</label><input type="text" id='TipoProxRev'>
                <label>TBO LH:</label><input type="number" id='TBOLH'>
                <label>TBO RH:</label><input type="number" id='TBORH'>
                <button type="submit">Salvar<br>e<br>Ir para o Proximo</button>
            </form>
            </div>
        </div>
</body>
</html>