<?php
    require_once('../Conexao.php');
    session_start();
    
    echo json_encode('Teste');

    if(isset($_POST['SenhaTXT'])){

        $SenhaTXT=$_POST['SenhaTXT'];
        $LogginTXT=$_SESSION['Loggin'];

        $SQLUsuario="SELECT * FROM cadastros WHERE Loggin='$Loggin'";
        $RequisicaoUsuario=mysqli_query($mysqli,$SQLUsuario);
        $QTD=$RequisicaoUsuario->num_rows;
        echo json_encode($QTD);
    }
?>