<?php
    require_once('../Conexao.php');

    if(isset($_POST['Prefixo'])){
        $Prefixo=mysqli_real_escape_string($mysqli,$_POST['PrefixoTXT']);
        $HAtual=mysqli_real_escape_string($mysqli,$_POST['HAtual']);
        $HProxRev=mysqli_real_escape_string($mysqli,$_POST['HProxRev']);
        $TProxRev=mysqli_real_escape_string($mysqli,$_POST['TProxRev']);
        $TBORH=mysqli_real_escape_string($mysqli,$_POST['TBORH']);
        $TBOLH=mysqli_real_escape_string($mysqli,$_POST['TBOLH']);

        $SQL="UPDATE horimetro SET HorasAtuais='$HAtual',HorasProxRev='$HProxRev',TipoProxRev='$TProxRev',TBORH='$TBORH',TBOLH='$TBOLH' WHERE Placa='$Prefixo'";
        $Requisicao=mysqli_query($mysqli,$SQL);

        if(!mysqli_query($mysqli,$SQL)){
            echo json_encode('Erro');
        }

        echo json_encode('Sucesso');
    }else{
        echo json_encode('Erro');
    }
?>