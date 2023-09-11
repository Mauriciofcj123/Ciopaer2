<?php
     require('../Conexao.php');

     function GerarPlanilhaData($SecaoTXT,$DeTXT,$AteTXT){
     }

     function GerarPlanilha($SecaoTXT){
        require('../Conexao.php');

        $SQLTotalInt="SELECT * FROM intervencao WHERE Secao='".$SecaoTXT."' ORDER BY Data Desc";
        $RequisicaoTotalInt=mysqli_query($mysqli,$SQLTotalInt);

        return $RequisicaoTotalInt;

     }


    if(isset($_POST['GerarBTN'])){
        $Secao=$_POST['SecaoTXT'];
        $Placa=$_POST['Aeronave'];

        if($Placa=='Todas'){

            echo '<input name="Secoes" value="'.$Secao.'" style="position:relative;visibility:hidden;">';

            $SQLAeronaves="SELECT * FROM horimetro WHERE Secao='".$Secao."'";
            $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

            $UltimaDataSQL="SELECT * FROM discrepancias WHERE Secao='$Secao' ORDER BY Data Desc LIMIT 1";
            $UltimaDataReq=mysqli_query($mysqli,$UltimaDataSQL);
            $UltimaData=$UltimaDataReq->fetch_assoc();

            $SQLTotalDisc="SELECT * FROM discrepancias WHERE Secao='$Secao' AND Data='".$UltimaData['Data']."' ORDER BY Placa DESC";
            $RequisicaoTotalDisc=mysqli_query($mysqli,$SQLTotalDisc);

                while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                    $SQL="SELECT * FROM discrepancias WHERE Placa='".$Aeronave['Placa']."' AND Data = '".$UltimaData['Data']."' AND Secao='".$Secao."'";
                    $Requisicao=mysqli_query($mysqli,$SQL);
                    $QTD=$Requisicao->num_rows;

                    if($QTD>0){
                        echo '<input value="'.$QTD.'" name="QTD/'.$Secao.'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
                    }
                }

    }else{
        $Secao=$_POST['SecaoTXT'];
        $Placa=$_POST['Aeronave'];

        echo '<input name="Secoes" value="'.$Secao.'" style="position:relative;visibility:hidden;">';

            $SQLAeronaves="SELECT * FROM horimetro WHERE Secao='".$Secao."' AND Placa='$Placa'";
            $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

            $UltimaDataSQL="SELECT * FROM discrepancias WHERE Secao='$Secao' ORDER BY Data Desc LIMIT 1";
            $UltimaDataReq=mysqli_query($mysqli,$UltimaDataSQL);
            $UltimaData=$UltimaDataReq->fetch_assoc();

            $SQLTotalDisc="SELECT * FROM discrepancias WHERE Secao='$Secao' AND Data='".$UltimaData['Data']."' AND Placa='$Placa' ORDER BY Placa DESC";
            $RequisicaoTotalDisc=mysqli_query($mysqli,$SQLTotalDisc);

                while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                    $SQL="SELECT * FROM discrepancias WHERE Placa='".$Aeronave['Placa']."' AND Data='".$UltimaData['Data']."'";
                    $Requisicao=mysqli_query($mysqli,$SQL);
                    $QTD=$Requisicao->num_rows;

                    if($QTD>0){
                        echo '<input value="'.$QTD.'" name="QTD/'.$Secao.'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
                    }
                }
            }
}else{
    $SQLSecoes='SELECT * FROM secoes LIMIT 1';
    $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);
    $Linha=$RequisicaoSecoes->fetch_assoc();
    $Secao=$Linha['Secao'];


    echo '<input name="Secoes" value="'.$Secao.'" style="position:relative;visibility:hidden;">';

        $SQLAeronaves="SELECT * FROM horimetro WHERE Secao='".$Secao."'";
        $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

        $UltimaDataSQL="SELECT * FROM discrepancias WHERE Secao='$Secao' ORDER BY Data Desc LIMIT 1";
        $UltimaDataReq=mysqli_query($mysqli,$UltimaDataSQL);
        $UltimaData=$UltimaDataReq->fetch_assoc();

        $SQLTotalDisc="SELECT * FROM discrepancias WHERE Secao='$Secao' AND Data='".$UltimaData['Data']."' ORDER BY Placa DESC";
        $RequisicaoTotalDisc=mysqli_query($mysqli,$SQLTotalDisc);

            while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                $SQL="SELECT * FROM discrepancias WHERE Placa='".$Aeronave['Placa']."' AND Data='".$UltimaData['Data']."'";
                $Requisicao=mysqli_query($mysqli,$SQL);
                $QTD=$Requisicao->num_rows;

                if($QTD>0){
                    echo '<input value="'.$QTD.'" name="QTD/'.$Secao.'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
                }
            }
}

        
?>