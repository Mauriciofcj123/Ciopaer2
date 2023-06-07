<?php
    include_once('../Conexao.php');

    if(isset($_POST['SalvarBTN'])){

        if(isset($_POST['PlacaDisp'])){
            $Placa=$_POST['PlacaDisp'];
            $Placa=$_POST['StatusDisp'];
            $Placa=$_POST['CausaDisp'];
            $Data=$_POST['Data'];
            foreach($OBS as $observacao){
                $SQL="INSERT INTO observacoes(Data,Observacoes) VALUES('$Data','$observacao')";
                $Requisicao=mysqli_query($mysqli,$SQL);
            }
        }

        if(isset($_POST['ObservacaoTXT'])){
            $OBS=$_POST['ObservacaoTXT'];
            $Data=$_POST['Data'];
            foreach($OBS as $observacao){
                $SQL="INSERT INTO observacoes(Data,Observacoes) VALUES('$Data','$observacao')";
                $Requisicao=mysqli_query($mysqli,$SQL);
            }
        }
    }
?>