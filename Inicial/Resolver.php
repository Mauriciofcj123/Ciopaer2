<?php
    session_start();
    require_once('../Conexao.php');

    if(isset($_POST['ID'])){

        $ID=$_POST['ID'];
        $Realizador=$_POST['Realizador'];
        $DataRealizacao=$_POST['DataRealizacao'];

        $SQLTarefa="UPDATE tarefas SET Status='Completo', Realizador= '$Realizador', DataRealizacao= '$DataRealizacao' WHERE id= '$ID'";
        $RequisicaoTarefa=mysqli_query($mysqli,$SQLTarefa);

        echo json_encode('OK');
    }
?>