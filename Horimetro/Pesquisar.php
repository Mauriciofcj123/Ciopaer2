<?php
    require_once('../Conexao.php');

    if(isset($_POST['PrefixoTXT'])){
        $Prefixo=$_POST['PrefixoTXT'];
        $SQL="SELECT * FROM horimetros WHERE Placa='$Prefixo'";
        $Requisicao=mysqli_query($mysqli,$SQL);
        $Registros;

        while($Linha->$Requisicao->fetch_assoc()){
            $Registros[]=$Linha['Placa'];
            $Registros[]=$Linha['HorasProxRev'];
            $Registros[]=$Linha['TipoProxRev'];
            $Registros[]=$Linha['TBORH'];
            $Registros[]=$Linha['TBOLH'];
        }

        echo json_encode($Registros);
    }
?>