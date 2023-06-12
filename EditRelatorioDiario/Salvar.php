<?php
    include_once('../Conexao.php');

    if(isset($_POST['SalvarBTN'])){
        if(isset($_POST['Data'])){
            $Data=$_POST['Data'];
            $MecanicoDia=$_POST['MecanicoDia'];

                $SQLReg="INSERT INTO registrodisp (Mecanico,Data) VALUES('$MecanicoDia','$Data')";
                $Requisicao=mysqli_query($mysqli,$SQLReg);


        if(isset($_POST['PlacaDisp'])){
            
            $Placa=$_POST['PlacaDisp'];
            $Status=$_POST['StatusDisp'];
            $Causa=$_POST['CausaDisp'];
            for($i=0;$i<count($Placa);$i++){

                $SQLDisp="INSERT INTO disponibilidade(Placa,Status,Causa,Data) VALUES('".$Placa[$i]."','".$Status[$i]."','".$Causa[$i]."','".$Data."')";
                $Requisicao=mysqli_query($mysqli,$SQLDisp);
            }
        }

        if(isset($_POST['PlacaDisc'])){
            
            $Placa=$_POST['PlacaDisc'];
            $Descricao=$_POST['Descricao'];

            for($i=0;$i<count($Placa);$i++){

                $SQLDisc="INSERT INTO discrepancias(Placa,DescDiscrepancias,Data) VALUES('".$Placa[$i]."','".$Descricao[$i]."','$Data')";
                $Requisicao=mysqli_query($mysqli,$SQLDisc);
            }
        }
        
        if(isset($_POST['ObjetoTXT'])){
            
            $Objeto=$_POST['ObjetoTXT'];
            $Responsavel=$_POST['ResponsavelOBJ'];

            for($i=0;$i<count($Objeto);$i++){

                $SQLObj="INSERT INTO AcessorioDisp(NomeAcessorio,Responsável,Data) VALUES('".$Objeto[$i]."','".$Responsavel[$i]."','$Data')";
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

                $SQLInt="INSERT INTO intervencao(Placa,DescIntervencao,RealizadoPor,TempoInter,Data,TipoIntervencao) VALUES('".$Placa[$i]."','".$Descricao[$i]."','".$ResponsavelInt[$i]."','".$Tempo[$i]."','$Data','".$Tipo[$i]."')";
                $Requisicao=mysqli_query($mysqli,$SQLInt);
            }
        }

        if(isset($_POST['ObservacaoTXT'])){
            $OBS=$_POST['ObservacaoTXT'];
            for($i=0;$i<count($OBS);$i++){
                $SQLOBS="INSERT INTO observacoes(Data,Observacoes) VALUES('$Data','$OBS[$i]')";
                $Requisicao=mysqli_query($mysqli,$SQLOBS);
            }
        }
    }

    }
?>