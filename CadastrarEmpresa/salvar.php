<?php
    require_once("../Conexao.php");

    if(isset($_POST['ConsultarBTN'])){
        $CNPJ=mysqli_real_escape_string($mysqli,$_POST['CNPJTXT']);
        $Nome=mysqli_real_escape_string($mysqli,$_POST['NomeTXT']);
        $Fantasia=mysqli_real_escape_string($mysqli,$_POST['FantasiaTXT']);
        $Situacao=mysqli_real_escape_string($mysqli,$_POST['SituacaoTXT']);
        $DataAbertura=mysqli_real_escape_string($mysqli,$_POST['DataAberturaTXT']);

        $SQLSelect="SELECT * FROM empresas WHERE CNPJ='$CNPJ'";
        $RequisicaoSelect= mysqli_query($mysqli, $SQLSelect);
        $Quantidade=$RequisicaoSelect->num_rows;

        if($Quantidade==0){
            $SQL="INSERT INTO empresas VALUES ('$CNPJ','$Nome','$Fantasia','$DataAbertura','$Situacao')";
            $Requisicao = mysqli_query($mysqli, $SQL);
            
        }
        header("Location:../ControleLib/index.php");
    }
?>