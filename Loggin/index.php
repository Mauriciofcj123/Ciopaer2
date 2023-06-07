
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        session_start();

        include_once("../Conexao.php");

        if(isset($_POST['LogarBTN'])){

            if(!empty($_POST['Usuario']) && !empty($_POST['Senha'])){
                $Usuario=mysqli_escape_string($mysqli, $_POST['Usuario']);
                $Senha=mysqli_escape_string($mysqli, $_POST['Senha']);

                $SQL="SELECT * FROM cadastros where Loggin='$Usuario' LIMIT 1";
                $Requisicao=mysqli_query($mysqli,$SQL);
                $Linha=$Requisicao->fetch_assoc();

                if(password_verify($Senha,$Linha['Senha'])){
                    if($Linha['Patente']=="Sem Patente"){

                        $_SESSION["Nome"]=$Linha['Nome']." ".$Linha['Sobrenome'];
                        $_SESSION['ADM']=$Linha['Admin'];

                        }else{

                        $_SESSION["Nome"]=$Linha['Sobrenome'];
                        $_SESSION['ADM']=$Linha['Admin'];

                        }
                        header('location: ../index.php');
                
                    }else{
                        $Erro="Usuario ou senha incorreto.";
                    }
                }else{
                    $Erro="Campos Obrigatórios Faltando.";
                }
        }

        $Erro="";

        

    ?>

    <div class="Logo">
    <img src="Imgs/logo-Empresa.png" alt="">
    </div>
    <form action="" method="post" class="Box">
        
        <input type="text" placeholder="Usuario" name="Usuario" class="Campo">
        <input type="password" placeholder="Senha" name="Senha" class="Campo">
        <p><?php
            if(!empty($Erro)){
                echo "$Erro";
            }
        ?></p>

        <input type="submit" value="Logar" class="LogarBTN" name='LogarBTN'>
        <input type="button" value="Criar uma Conta" class="CriarBTN" onclick="window.location.href='../Cadastrar/index.php'">
    </form>

</body>
</html>