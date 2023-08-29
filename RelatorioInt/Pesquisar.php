<?php
     require_once('../Conexao.php');

    if(isset($_POST['GerarBTN'])){
        $De=$_POST['De'];
        $Ate=$_POST['Ate'];

        if(!empty($De)&&!empty($Ate)){
            $SQLSecoes='SELECT * FROM secoes';
            $RequisicaoSecoes=mysqli_query($mysqli,$SQLSecoes);

            while($Secao=$RequisicaoSecoes->fetch_assoc()){
                
                echo '<input name="Secoes" value="'.$Secao['Secao'].'">';

            $SQLAeronaves='SELECT * FROM horimetro';
            $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

            $HorasTotal=0;

                while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                    $SQL="SELECT * FROM intervencao WHERE Placa='".$Aeronave['Placa']."' AND Data BETWEEN '$De' AND '$Ate' AND Secao='".$Secao['Secao']."'";
                    $Requisicao=mysqli_query($mysqli,$SQL);

                    $HorasQTD=0;

                    while($IntervencaoHRS=$Requisicao->fetch_assoc()){
                        $Tempo=explode(':',$IntervencaoHRS['TempoInter']);
                        $Horas=$Tempo[0];
                        $Minutos=$Tempo[1]/60;
                        $HorasQTD+=$Horas+$Minutos;
                    }
                    $HorasTotal+=ceil($HorasQTD*420);

                    echo '<input value="'.ceil($HorasQTD).'" name="QTDTempo/'.$Secao['Secao'].'" id="'.$Aeronave['Placa'].'" style="position:absolute;visibility:hidden;"></input>';
                    echo '<input value="'.$Requisicao->num_rows.'" name="QTDInt/'.$Secao['Secao'].'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
                }

                
                echo '<input value="'.number_format($HorasTotal,2,",",".").'" name="QTDTotal/'.$Secao['Secao'].'" id="QTDTotal" style="position:absolute;visibility:hidden;"></input>';

        }
    }else{
            $SQLAeronaves='SELECT * FROM horimetro';
            $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

            $HorasTotal=0;

            while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                $SQL="SELECT * FROM intervencao WHERE Placa='".$Aeronave['Placa']."' WHERE Secao='".$Secao['Secao']."'";
                $Requisicao=mysqli_query($mysqli,$SQL);

                $HorasQTD=0;

                while($IntervencaoHRS=$Requisicao->fetch_assoc()){
                    $Tempo=explode(':',$IntervencaoHRS['TempoInter']);
                    $Horas=$Tempo[0];
                    $Minutos=$Tempo[1]/60;
                    $HorasQTD+=$Horas+$Minutos;
                    
                }
                $HorasTotal+=ceil($HorasQTD*420);

                echo '<input value="'.ceil($HorasQTD).'" name="QTDTempo/'.$Secao['Secao'].'" id="'.$Aeronave['Placa'].'" style="position:absolute;visibility:hidden;"></input>';
                echo '<input value="'.$Requisicao->num_rows.'" name="QTDInt/'.$Secao['Secao'].'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
            }

            echo '<input value="'.number_format($HorasTotal,2,",",".").'" name="QTDTotal/'.$Secao['Secao'].'" id="QTDTotal" style="position:absolute;visibility:hidden;"></input>';
        }
        
    }else{
        $SQLAeronaves='SELECT * FROM horimetro';
            $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

            $HorasTotal=0;

            while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                $SQL="SELECT * FROM intervencao WHERE Placa='".$Aeronave['Placa']."' WHERE Secao='".$Secao['Secao']."'";
                $Requisicao=mysqli_query($mysqli,$SQL);

                $HorasQTD=0;

                while($IntervencaoHRS=$Requisicao->fetch_assoc()){
                    $Tempo=explode(':',$IntervencaoHRS['TempoInter']);
                    $Horas=$Tempo[0];
                    $Minutos=$Tempo[1]/60;
                    $HorasQTD+=$Horas+$Minutos;
                    
                }
                $HorasTotal+=ceil($HorasQTD*420);

                echo '<input value="'.ceil($HorasQTD).'" name="QTDTempo/'.$Secao['Secao'].'" id="'.$Aeronave['Placa'].'" style="position:absolute;visibility:hidden;"></input>';
                echo '<input value="'.$Requisicao->num_rows.'" name="QTDInt/'.$Secao['Secao'].'" id="'.$Aeronave['Placa'].'" style="position:relative;visibility:hidden;"></input>';
            }

            echo '<input value="'.number_format($HorasTotal,2,",",".").'" name="QTDTotal/'.$Secao['Secao'].'" id="QTDTotal" style="position:absolute;visibility:hidden;"></input>';

        }

        
?>