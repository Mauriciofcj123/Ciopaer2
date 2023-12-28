<?php
    session_start();
    require_once("../Conexao.php");

    if(isset($_POST['SelecionarBTN'])){
        $CNPJ=mysqli_real_escape_string($mysqli,$_POST['CNPJTXT']);
        $_SESSION['CNPJ']=$CNPJ;

        header('Location: ../CadNota2/index.php');
    }
?>