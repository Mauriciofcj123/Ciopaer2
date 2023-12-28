
<!DOCTYPE html>
<html lang="en">
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
        <p><?php
            require_once('Logar.php');
            $_SESSION['QTD']=3;
            
            if(!empty($Erro)){
                echo "<script>Swal.fire('Erro','$Erro','error')</script>";
            }
        ?></p>

        <input type="submit" value="Enviar Código" class="LogarBTN" name='LogarBTN' id='LogarBTN'>
    </form>

</body>
</html>