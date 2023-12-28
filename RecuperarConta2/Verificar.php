<?php
        session_start();



        if(isset($_POST['LogarBTN'])){
             include_once("../Conexao.php");
             $Erro='';


            if(isset($_POST['CodigoTXT']) && isset($_SESSION['Cod'])){
                $Codigo=$_POST['CodigoTXT'];

                if($_SESSION['Cod']===$Codigo){
                        $_SESSION['Cod']=='';
                        header('Location: ../RecuperarConta3/index.php');
                }else{
                        $Erro='Código de verficação incorreto';
                }
        }else if(!isset($_POST['CodigoTXT'])){
                $Erro='Campos obrigatórios vazios.';
        }else if(!isset($_SESSION['Cod'])){
                $Erro='Por favor reinicie a solicitação.';
        }
}

    ?>