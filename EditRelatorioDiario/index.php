
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina Inicial</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src="script.js" defer></script>

</head>
<body>
    <div class="cabecalho">
        <div>
            <?php
                session_start();
                require_once('Conexao.php');

                if(isset($_SESSION["Nome"]))
                {
                echo "<p class='LogTexto'> Seja Bem Vindo ".$_SESSION['Nome']."</p><br><br>";
                echo '<input type="button" value="Sair" class="Sair" onClick="Sair()">';
                } else{
                    echo "<a class='Sair'  href='../Loggin/index.php'>Entrar</a>";
                }
                
            ?>
            
        </div>
        <div><img src="Imgs/logo.png"></div>
    </div>
    <?php
        include('../Cabecalho/Cabecalho.php');
        include('../Cabecalho/Conexao.php');

        if(isset($_POST['AcessarBTN'])){
            $_SESSION['Data']=$_POST['DataRelatorio'];
        }

        if(isset($_SESSION['Data'])){
        echo '<div class="Data"><input type="text" value="'.date('d/m/Y',strtotime($_SESSION['Data'])).'" disabled name="DataTXT"></div>';

        $SQL='SELECT * FROM aeronavescadastradas';
        $Requisicao1=mysqli_query($mysqli,$SQL);

        $ID=0;

        while($Linha=$Requisicao1->fetch_assoc()){
            $SQL='SELECT * FROM disponibilidade ORDER BY Data Desc LIMIT 1';
            $Requisicao=mysqli_query($mysqli,$SQL);
            $Resultado=$Requisicao->fetch_assoc();
            $UltimaData=$Resultado['Data'];


            $SQL='SELECT * FROM disponibilidade WHERE Placa="'.$Linha['Marca'].'" AND Data = "'.$UltimaData.'"';
            $Requisicao=mysqli_query($mysqli,$SQL);
            $Disponibilidade=$Requisicao->fetch_assoc();

            echo '<div class="Aeronaves">';
            echo '<input type="text" value="'.$Linha['Marca'].'" disabled class="AeronaveTXT">';
            
            if($Disponibilidade['Status']=='Disponível'){
                echo '<button onClick="Ativar('.$ID.',\'Despachadas\',\'Disponível/Despachada\')"><img src="Imgs/Despachada.png" title="Despachadas" id="Despachadas'.$ID.'" name="Despachadas" class="Deselecionada"></button>
                <button onClick="Ativar('.$ID.',\'Indisponiveis\',\'Indisponível\')"><img src="Imgs/cancelar.png" title="Indisponíveis" id="Indisponiveis'.$ID.'" name="IndisponiveisTXT" class="Deselecionada"></button>
                <button onClick="Ativar('.$ID.',\'Disponiveis\',\'Disponível\')"><img src="Imgs/verificado.png" title="Disponíveis" id="Disponiveis'.$ID.'" name="Disponiveis" class="Selecionada"></button><br>';

                echo '<div name="Causa'.$ID.'" id="Causa'.$ID.'" style="visibility : hidden;"><label >Causa</label><input type="text"  style="margin-left: 20px;width: 200px; border-bottom: 1px solid rgb(0, 195, 255); border-right: 1px solid rgb(0, 195, 255);"></div>';
                
            }else if($Disponibilidade['Status']=='Indisponível'){
                echo '<button onClick="Ativar('.$ID.',\'Despachadas\',\'Disponível/Despachada\')"><img src="Imgs/Despachada.png" title="Despachadas" id="Despachadas'.$ID.'" name="Despachadas" class="Deselecionada"></button>
                <button onClick="Ativar('.$ID.',\'Indisponiveis\',\'Indisponível\')"><img src="Imgs/cancelar.png" title="Indisponíveis" id="Indisponiveis'.$ID.'" name="IndisponiveisTXT" class="Selecionada"></button>
                <button onClick="Ativar('.$ID.',\'Disponiveis\',\'Disponível\')"><img src="Imgs/verificado.png" title="Disponíveis" id="Disponiveis'.$ID.'" name="Disponiveis" class="Deselecionada"></button><br>';

                echo '<div name="Causa'.$ID.'" id="Causa'.$ID.'" style="visibility : visible;"><label >Causa</label><input type="text" value="'.$Disponibilidade['Causa'].'" style="margin-left: 20px;width: 200px; border-bottom: 1px solid rgb(0, 195, 255); border-right: 1px solid rgb(0, 195, 255);"></div>';
                
            }else if($Disponibilidade['Status']=='Disponível/Despachada'){
                echo '<button onClick="Ativar('.$ID.',\'Despachada\',\'Disponível/Despachada\')"><img src="Imgs/Despachada.png" title="Despachadas" id="Despachadas'.$ID.'" name="Despachadas" class="Selecionada"></button>
                <button onClick="Ativar('.$ID.',\'Indisponiveis\',\'Indisponível\')"><img src="Imgs/cancelar.png" title="Indisponíveis" id="Indisponiveis'.$ID.'" name="IndisponiveisTXT" class="Deselecionada"></button>
                <button onClick="Ativar('.$ID.',\'Disponiveis\',\'Disponível\')"><img src="Imgs/verificado.png" title="Disponíveis" id="Disponiveis'.$ID.'" name="Disponiveis" class="Deselecionada"></button><br>';

                echo '<div name="Causa'.$ID.'" id="Causa'.$ID.'" style="visibility : visible;"><label >Causa</label><input type="text" value="'.$Disponibilidade['Causa'].'" style="margin-left: 20px;width: 200px; border-bottom: 1px solid rgb(0, 195, 255); border-right: 1px solid rgb(0, 195, 255);"></div>';
            }
            echo '<input type="text" name="Status'.$ID.'" id="Status'.$ID.'" value="Teste" style="margin-left: 20px;width: 200px; border-bottom: 1px solid rgb(0, 195, 255); border-right: 1px solid rgb(0, 195, 255); visibility: hidden;">';
            echo '</div>';

            $ID++;
        }

        $SQL='SELECT * FROM acessoriodisp';
        $Requisicao=mysqli_query($mysqli,$SQL);

        echo '<div class="Acessorios">';

        echo '<div class="MenuAcessorio"><button onClick="AdicionarFone()"><img src="Imgs/AdicionarAcessorio.png" class="MenuCautelaAdd" title="Adicionar Acessório"></button>
        <button onClick="AdicionarGPS()"><img src="Imgs/AdicionarGPS.png" class="MenuCautelaAdd" title="Adicionar Acessório"></button>
        <button onClick="RemoverAcessorio()"><img src="Imgs/lixo.png" class="MenuCautelaRemove" title="Remover Acessório"></button></div>';

        echo '<table id="CautelaTB">';

        while($Linha=$Requisicao->fetch_assoc()){
            echo '<tr class="Objeto">
                    <td><input type="checkbox" name="CheckboxAcessorio" id=""></td>
                    <td><img src="Imgs/'.$Linha['NomeAcessorio'].'.png"></td>
                    <td><input type="text" value="'.$Linha['Responsável'].'"></td>
                </tr>';
        }
        echo '</table>';

        echo '</div>';
}
    ?>

</body>
</html>