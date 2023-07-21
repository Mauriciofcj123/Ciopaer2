<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    include_once('../Conexao.php');

    $SQL="SELECT * FROM aeronaves";
    $Requisicao=mysqli_query($mysqli,$SQL);
    while($Linha=$Requisicao->fetch_assoc()){
        $Dia='Vazio';
        $Mes='Vazio';
        $Ano='Vazio';
        if(strlen($Linha['DT_VALIDADE_CVA'])==8){
            $Dia=substr($Linha['DT_VALIDADE_CVA'],0,2);
            $Mes=substr($Linha['DT_VALIDADE_CVA'],2,2);
            $Ano=substr($Linha['DT_VALIDADE_CVA'],4,4);

            $Data=$Dia."/".$Mes."/".$Ano;

            $SQL="UPDATE aeronaves SET DT_VALIDADE_CVA = '$Data' WHERE DT_VALIDADE_CVA=".$Linha['DT_VALIDADE_CVA']."";
            //$Requisicao3=mysqli_query($mysqli,$SQL);

        }else if(strlen($Linha['DT_VALIDADE_CVA'])==7){
            $Dia=substr($Linha['DT_VALIDADE_CVA'],0,1);
            $Mes=substr($Linha['DT_VALIDADE_CVA'],1,2);
            $Ano=substr($Linha['DT_VALIDADE_CVA'],3,4);

            $Data=$Dia."/".$Mes."/".$Ano;
            
            $SQL="UPDATE aeronaves SET DT_VALIDADE_CVA = '$Data' WHERE DT_VALIDADE_CVA=".$Linha['DT_VALIDADE_CVA']."";
            //$Requisicao2=mysqli_query($mysqli,$SQL);
        }

    }
?>
</body>
</html>