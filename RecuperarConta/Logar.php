<?php
        session_start();



        if(isset($_POST['LogarBTN'])){
             include_once("../Conexao.php");
             $Erro='';


            if(!empty($_POST['Usuario'])){
                $Usuario=mysqli_escape_string($mysqli, $_POST['Usuario']);

                $SQLUsuario="SELECT * FROM cadastros WHERE BINARY Loggin='$Usuario' LIMIT 1";
                $Requisicao=mysqli_query($mysqli,$SQLUsuario);
                $Quantidade=$Requisicao->num_rows;

                if($Quantidade==0){
                        $Erro='Usuario Inexistente';
                }else{
                        $Car1=rand(0,9);
                        $Car2=rand(0,9);
                        $Car3=rand(0,9);
                        $Car4=rand(0,9);
                        $Car5=rand(0,9);
                        $Car6=rand(0,9);
                        $Car7=rand(0,9);
                        $Car8=rand(0,9);

                        $Cod=$Car1."".$Car2."".$Car3."".$Car4."".$Car5."".$Car6."".$Car7."".$Car8;

                        $Registro=$Requisicao->fetch_assoc();
                        $_SESSION['Cod']=$Cod;
                        $_SESSION['CodUser']=$Registro['Loggin'];

                        $Para=$Registro['Email'];
                        $Titulo='Código de Verificação';
                        $Mensagem='Uma tentativa de troca de senha foi efetuada na sua conta Pooblefly\n O Código de Verificação é: '.$Cod;

                        mail($Para,$Titulo,$Mensagem);

                        header('Location: ../RecuperarConta2/index.php');
                }
        }
}

    ?>