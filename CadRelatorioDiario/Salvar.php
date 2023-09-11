<?php
    include_once('../Conexao.php');
    if(isset($_POST['VerificarAssinatura'])){

    }

    if(isset($_POST['SalvarBTN'])){

        if(isset($_POST['Data'])){
            $Data=$_POST['Data'];
            $MecanicoDia=$_POST['MecanicoDia'];
            $Secao=$_POST['Secao'];

            $Registros='SELECT * FROM `registrodisp` WHERE Data="'.$Data.'" LIMIT 1';
            $Requisicaoreg=mysqli_query($mysqli,$Registros);
            $QTDReg=$Requisicaoreg->num_rows;

        if($QTDReg>0){
            $SQLReg="UPDATE registrodisp SET Mecanico='$MecanicoDia', Secao='$Secao' WHERE Data='$Data'";
            $Requisicao=mysqli_query($mysqli,$SQLReg);


            if(isset($_POST['PlacaDisp'])){
                
                $Placa=$_POST['PlacaDisp'];
                $Status=$_POST['StatusDisp'];
                $Causa=$_POST['CausaDisp'];
                $Previsao=$_POST['PrevisaoDisp'];

                for($i=0;$i<count($Placa);$i++){
                    $SQLDisp="UPDATE disponibilidade SET  Status='".$Status[$i]."', Causa='".$Causa[$i]."', TipoCausa='".$Previsao[$i]."', Secao='".$Secao."' WHERE Data='".$Data."' AND Placa='".$Placa[$i]."' ";
                    $Requisicao=mysqli_query($mysqli,$SQLDisp);
                }
            }

            if(isset($_POST['PlacaDisc'])){
                
                $Placa=$_POST['PlacaDisc'];
                $Descricao=$_POST['Descricao'];
                $Medida=$_POST['MedidaTXT'];

                $SQLDisc="DELETE from discrepancias WHERE Data='$Data'";
                $Requisicao=mysqli_query($mysqli,$SQLDisc);

                for($i=0;$i<count($Placa);$i++){

                    $SQLDisc="INSERT INTO discrepancias(Placa,DescDiscrepancias,Medida,Data,Secao) VALUES('".$Placa[$i]."','".$Descricao[$i]."','".$Medida[$i]."','$Data','$Secao')";
                    $Requisicao=mysqli_query($mysqli,$SQLDisc);
                }
            }
            
            if(isset($_POST['ObjetoTXT'])){
                
                $Objeto=$_POST['ObjetoTXT'];
                $Responsavel=$_POST['ResponsavelOBJ'];

                $SQLObj="DELETE from acessoriodisp WHERE Data='$Data'";
                $Requisicao=mysqli_query($mysqli,$SQLObj);

                for($i=0;$i<count($Objeto);$i++){

                    $SQLObj="INSERT INTO acessoriodisp(NomeAcessorio,Responsável,Data,Secao) VALUES('".$Objeto[$i]."','".$Responsavel[$i]."','$Data','$Secao')";
                    $Requisicao=mysqli_query($mysqli,$SQLObj);
                }
            }

            if(isset($_POST['ResponsavelInt'])){
                
                $ResponsavelInt=$_POST['ResponsavelInt'];
                $Placa=$_POST['PlacaInt'];
                $Descricao=$_POST['DescricaoInt'];
                $Tipo=$_POST['TipoInt'];
                $Tempo=$_POST['TempoInt'];
                
                $SQLInt="DELETE from intervencao WHERE Data='$Data'";
                $Requisicao=mysqli_query($mysqli,$SQLInt);

                for($i=0;$i<count($ResponsavelInt);$i++){

                    $SQLInt="INSERT INTO intervencao(Placa,DescIntervencao,RealizadoPor,TempoInter,Data,TipoIntervencao,Secao) VALUES('".$Placa[$i]."','".$Descricao[$i]."','".$ResponsavelInt[$i]."','".$Tempo[$i]."','$Data','".$Tipo[$i]."','".$Secao."')";
                    $Requisicao=mysqli_query($mysqli,$SQLInt);
                }
            }

            if(isset($_POST['ObservacaoTXT'])){
                $OBS=$_POST['ObservacaoTXT'];

                $SQLOBS="DELETE from observacoes WHERE Data='$Data'";
                $Requisicao=mysqli_query($mysqli,$SQLOBS);

                for($i=0;$i<count($OBS);$i++){
                    $SQLOBS="INSERT INTO observacoes(Data,Observacoes,Secao) VALUES('$Data','$OBS[$i]','$Secao')";
                    $Requisicao=mysqli_query($mysqli,$SQLOBS);
                }
            }
        }else{
            $SQLReg="INSERT INTO registrodisp (Mecanico,Data,Secao) VALUES('$MecanicoDia','$Data','$Secao')";
            $Requisicao=mysqli_query($mysqli,$SQLReg);


            if(isset($_POST['PlacaDisp'])){
                
                $Placa=$_POST['PlacaDisp'];
                $Status=$_POST['StatusDisp'];
                $Causa=$_POST['CausaDisp'];
                $Previsao=$_POST['PrevisaoDisp'];
                for($i=0;$i<count($Placa);$i++){

                    $SQLDisp="INSERT INTO disponibilidade(Placa,Status,Causa,TipoCausa,Data) VALUES('".$Placa[$i]."','".$Status[$i]."','".$Causa[$i]."','".$Previsao[$i]."','".$Data."')";
                    $Requisicao=mysqli_query($mysqli,$SQLDisp);
                }
            }

            if(isset($_POST['PlacaDisc'])){
                
                $Placa=$_POST['PlacaDisc'];
                $Descricao=$_POST['Descricao'];
                $Medida=$_POST['MedidaTXT'];

                for($i=0;$i<count($Placa);$i++){

                    $SQLDisc="INSERT INTO discrepancias(Placa,DescDiscrepancias,Medida,Data,Secao) VALUES('".$Placa[$i]."','".$Descricao[$i]."','".$Medida[$i]."','$Data','$Secao')";
                    $Requisicao=mysqli_query($mysqli,$SQLDisc);
                }
            }
            
            if(isset($_POST['ObjetoTXT'])){
                
                $Objeto=$_POST['ObjetoTXT'];
                $Responsavel=$_POST['ResponsavelOBJ'];

                for($i=0;$i<count($Objeto);$i++){

                    $SQLObj="INSERT INTO AcessorioDisp(NomeAcessorio,Responsável,Data,Secao) VALUES('".$Objeto[$i]."','".$Responsavel[$i]."','$Data','$Secao')";
                    $Requisicao=mysqli_query($mysqli,$SQLObj);
                }
            }

            if(isset($_POST['ResponsavelInt'])){
                
                $ResponsavelInt=$_POST['ResponsavelInt'];
                $Placa=$_POST['PlacaInt'];
                $Descricao=$_POST['DescricaoInt'];
                $Tipo=$_POST['TipoInt'];
                $Tempo=$_POST['TempoInt'];
                

                for($i=0;$i<count($ResponsavelInt);$i++){

                    $SQLInt="INSERT INTO intervencao(Placa,DescIntervencao,RealizadoPor,TempoInter,Data,TipoIntervencao,Secao) VALUES('".$Placa[$i]."','".$Descricao[$i]."','".$ResponsavelInt[$i]."','".$Tempo[$i]."','$Data','".$Tipo[$i]."','$Secao')";
                    $Requisicao=mysqli_query($mysqli,$SQLInt);
                }
            }

            if(isset($_POST['ObservacaoTXT'])){
                $OBS=$_POST['ObservacaoTXT'];
                for($i=0;$i<count($OBS);$i++){
                    $SQLOBS="INSERT INTO observacoes(Data,Observacoes,Secao) VALUES('$Data','$OBS[$i]','$Secao')";
                    $Requisicao=mysqli_query($mysqli,$SQLOBS);
                }
            }
        }
        header('location: ../RelatorioDiarioLib/index.php');
    }
}

?>