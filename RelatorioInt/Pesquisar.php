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
        $De=$_POST['De'];
        $Ate=$_POST['Ate'];
        $Secao=$_POST['SecaoTXT'];


        if(!empty($De)&&!empty($Ate)){

            echo '<input name="Secoes" value="'.$Secao.'" style="position:relative;visibility:hidden;">';

            $SQLAeronaves="SELECT * FROM horimetro WHERE Secao='".$Secao."'";
            $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

            $SQLTotalInt="SELECT * FROM intervencao WHERE Secao='$Secao' AND Data BETWEEN '$De' AND '$Ate'  ORDER BY Data ASC";
            $RequisicaoTotalInt=mysqli_query($mysqli,$SQLTotalInt);

            $HorasTotal=0;

                while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                    $SQL="SELECT * FROM intervencao WHERE Placa='".$Aeronave['Placa']."' AND Data BETWEEN '$De' AND '$Ate' AND Secao='".$Secao."'";
                    $Requisicao=mysqli_query($mysqli,$SQL);

                    $HorasQTD=0;

                    while($IntervencaoHRS=$Requisicao->fetch_assoc()){
                        $Tempo=explode(':',$IntervencaoHRS['TempoInter']);
                        $Horas=$Tempo[0];
                        $Minutos=$Tempo[1]/60;
                        $HorasQTD+=$Horas+$Minutos;
                    }
                    $HorasTotal+=ceil($HorasQTD*420);

                    echo '<input value="'.ceil($HorasQTD).'" name="QTDTempo/'.$Secao.'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
                    echo '<input value="'.$Requisicao->num_rows.'" name="QTDInt/'.$Secao.'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
                }

                
                echo '<input value="'.number_format($HorasTotal,2,",",".").'" name="QTDTotal/'.$Secao.'" id="QTDTotal/'.$Secao.'" style="position:relative;visibility:hidden;"></input><br>';

    }else{


                echo '<input name="Secoes" value="'.$Secao.'" style="position:relative;visibility:hidden;">';

                $SQLAeronaves="SELECT * FROM horimetro WHERE Secao='".$Secao."'";
                $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

                $SQLTotalInt="SELECT * FROM intervencao WHERE Secao='".$Secao."' ORDER BY Data Asc";
                $RequisicaoTotalInt=mysqli_query($mysqli,$SQLTotalInt);

                $HorasTotal=0;

                while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                    $SQL="SELECT * FROM intervencao WHERE Placa='".$Aeronave['Placa']."' AND Secao='".$Secao."'";
                    $Requisicao=mysqli_query($mysqli,$SQL);

                    $HorasQTD=0;

                    while($IntervencaoHRS=$Requisicao->fetch_assoc()){
                        $Tempo=explode(':',$IntervencaoHRS['TempoInter']);
                        $Horas=$Tempo[0];
                        $Minutos=$Tempo[1]/60;
                        $HorasQTD+=$Horas+$Minutos;
                        
                    }
                    $HorasTotal+=ceil($HorasQTD*420);

                    echo '<input value="'.ceil($HorasQTD).'" name="QTDTempo/'.$Secao.'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
                    echo '<input value="'.$Requisicao->num_rows.'" name="QTDInt/'.$Secao.'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
                }

                echo '<input value="'.number_format($HorasTotal,2,",",".").'" name="QTDTotal/'.$Secao.'" id="QTDTotal/'.$Secao.'" style="position:relative;visibility:hidden;"></input>';
    }
}else{
            $Secao='Tecnica Asa Fixa';
            echo '<input name="Secoes" value="'.$Secao.'" style="position:relative;visibility:hidden;">';

            $SQLAeronaves="SELECT * FROM horimetro WHERE Secao='".$Secao."'";
            $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

            $SQLTotalInt="SELECT * FROM intervencao WHERE Secao='".$Secao."' ORDER BY Data ASC";
            $RequisicaoTotalInt=mysqli_query($mysqli,$SQLTotalInt);

            $HorasTotal=0;

            while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                $SQL="SELECT * FROM intervencao WHERE Placa='".$Aeronave['Placa']."' AND Secao='".$Secao."'";
                $Requisicao=mysqli_query($mysqli,$SQL);

                $HorasQTD=0;

                while($IntervencaoHRS=$Requisicao->fetch_assoc()){
                    $Tempo=explode(':',$IntervencaoHRS['TempoInter']);
                    $Horas=$Tempo[0];
                    $Minutos=$Tempo[1]/60;
                    $HorasQTD+=$Horas+$Minutos;
                    
                }
                $HorasTotal+=ceil($HorasQTD*420);

                echo '<input value="'.ceil($HorasQTD).'" name="QTDTempo/'.$Secao.'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
                echo '<input value="'.$Requisicao->num_rows.'" name="QTDInt/'.$Secao.'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
            }

            echo '<input value="'.number_format($HorasTotal,2,",",".").'" name="QTDTotal/'.$Secao.'" id="QTDTotal/'.$Secao.'" style="position:relative;visibility:hidden;"></input>';
    }

        
?>