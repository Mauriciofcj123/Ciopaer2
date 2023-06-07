<?php
        include_once("../Conexao.php");
        include_once("/Inicial/Inicial.php");

        $Email=mysqli_escape_string($mysqli, $_POST['Email']);
        $Senha=mysqli_escape_string($mysqli, $_POST['Senha']);

        $Requisição="SELECT * FROM cadastros where Loggin='$Email' AND Senha='$Senha'";
        $res=$mysqli->query($Requisição);
        $Quantidade=$res->num_rows;
        $result=$res->fetch_assoc();

        if($Quantidade==1){
            session_start();

            if($result['Patente']=="Sem Patente"){
                $_SESSION["Nome"]=$result['Nome']." ".$result['Sobrenome'];
                
            }else{
                $_SESSION["Nome"]=$result['Sobrenome'];
            }
            header('Location: /Ciopaer/Inicial/Inicial.php');
            
        }else{
            header('Location: /Ciopaer/Loggin/index.php');
            $_SESSION["Nome"]="";
        }

?>