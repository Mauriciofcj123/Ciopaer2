<?php
    session_start();
    require_once("../Conexao.php");

    if(isset($_POST['SelecionarBTN'])){
        $TipoTXT=mysqli_real_escape_string($mysqli,$_POST['TipoTXT']);
        $_SESSION['Tipo']=$TipoTXT;

        header('Location: ../CadNota3/index.php');
    }
?>