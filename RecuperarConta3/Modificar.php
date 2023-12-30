<?php
        session_start();


        if(isset($_POST['SalvarBTN'])){
             include_once("../Conexao.php");
             $Erro='';

            if(isset($_POST['Senha']) && $_POST['SenhaConfirm']){
                $Senha=mysqli_real_escape_string($mysqli,$_POST['Senha']);
                $SenhaConfirm=mysqli_real_escape_string($mysqli,$_POST['SenhaConfirm']);
                $Valido=true;

                if(filter_var($Senha,FILTER_SANITIZE_NUMBER_INT)==false){
                        $Valido=false;
                }

                if(filter_var($Senha,FILTER_SANITIZE_SPECIAL_CHARS)==false){
                        $Valido=false;
                }

                if($Senha!==$SenhaConfirm){
                        $Valido=false;
                }

                if(strlen($Senha)<8){
                        $Valido=false;
                }

                if($Valido){
                        if(isset($_SESSION['CodUser'])){
                                $SenhaHASH=password_hash($Senha,PASSWORD_DEFAULT);
                                $Usuario=$_SESSION['CodUser'];
                                $SQL="UPDATE cadastros SET Senha='$SenhaHASH', Bloqueada=0  WHERE Loggin='$Usuario'";
                                $Requisicao=mysqli_query($mysqli,$SQL);

                                header('Location: ../Loggin/index.php');
                        }
                }else{
                        $Erro='Senha Incorreta.';
                }
        }else{
                $Erro='Campos obrigatórios vazios.';
        }
}

    ?>