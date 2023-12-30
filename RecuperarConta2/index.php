
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="script.js" defer></script>
</head>
<body>
    <div class="Logo">
    <img src="Imgs/logo-Empresa.png" alt="">
    </div>
    <form action="" method="post" class="Box">
        <p>Um Código de verificação será enviado para o e-mail vinculado a conta, em caso de não localizar o código, buscar na caixa de SPAM.<br><br></p>
        
        <input type="text" placeholder="Código" name="CodigoTXT" class="Campo">
        <p><?php
            require_once('Verificar.php');
            echo $_SESSION['Cod'];
            if(!empty($Erro)){
                echo "<script>Swal.fire('Erro','$Erro','error')</script>";
            }
        ?></p>

        <input type="submit" value="Confirmar" class="LogarBTN" name='LogarBTN' id='LogarBTN'><br>
        <?php
            if(isset($_SESSION['CodUser'])){
                echo '<a id="ReenviarTXT" class="Desativado" onclick="Reenviar(\''.$_SESSION['CodUser'].'\')">15</a>';
            }
        ?>

    </form>

    <div id='ReenviarDIV'></div>

</body>
</html>