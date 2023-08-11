<?php
    session_start();
    require_once('../Conexao.php');
    if(isset($_SESSION['Nome'])){
        if($_SESSION['Nome']!=""){

            if(isset($_POST['EnviarBTN'])){

                $Destinatario=$_POST['Destinatario'];

                $Titulo=$_POST['Titulo'];
                $Tarefa=$_POST['Tarefa'];
                $Remetente=$_SESSION['Nome'];
                $Status='Pendente';

                if(isset($_POST['Data'])){
                    $Data=$_POST['Data'];
                    $SQLTarefa="INSERT INTO tarefas(Remetente,Destinatario,Tarefa,Titulo,Status,DataLimite) VALUES ('$Remetente','$Destinatario','$Tarefa','$Titulo','$Status','$Data')";
                }else{
                    $SQLTarefa="INSERT INTO tarefas(Remetente,Destinatario,Tarefa,Titulo,Status) VALUES ('$Remetente','$Destinatario','$Tarefa','$Titulo','$Status')";
                }
                $RequisicaoTarefa=mysqli_query($mysqli,$SQLTarefa);
            }
        
        }
}
?>