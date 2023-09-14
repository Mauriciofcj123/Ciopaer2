<?php
    require_once('Conexao.php');

    if(!empty($_SESSION['Loggin'])){
        $Loggin=$_SESSION['Loggin'];
        $SQL="SELECT * FROM cadastros WHERE Loggin='$Loggin' LIMIT 1";
        $Requisicao=mysqli_query($mysqli,$SQL);
        $Registro=$Requisicao->fetch_assoc();

        echo json_encode($Registro);
        echo 'Teste';
    }
?>