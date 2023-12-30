
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
        
        <input type="text" placeholder="Usuario" name="Usuario" class="Campo">
        <input type="password" placeholder="Senha" name="Senha" class="Campo">
        <p><?php
            require_once('Logar.php');
            
            if(!empty($Erro)){
                echo "<script>Swal.fire('Erro','$Erro','error')</script>";
            }
        ?></p>

        <input type="submit" value="Logar" class="LogarBTN" name='LogarBTN' id='LogarBTN'>
        <input type="button" value="Criar uma Conta" class="CriarBTN" onclick="window.location.href='../Cadastrar/index.php'">
    </form>

</body>
</html>