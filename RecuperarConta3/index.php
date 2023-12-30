
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
    <?php
        require_once('Modificar.php');

        if(isset($_SESSION['Valido'])){
            if($_SESSION['Valido']==true){
                echo "<div class='Logo'>
                <img src='Imgs/logo-Empresa.png'>
                </div>";

                echo '<form action="" method="post" class="Box">';
                echo '<input type="password" name="Senha" placeholder="Nova Senha" class="Campo" id="SenhaTXT">
                        <input type="password" name="SenhaConfirm" placeholder="Confirmar Senha" class="Campo" id="SenhaConfirmTXT"><br><br>
                        <label id="NumeroTXT" style="color:red;">Conter Número.</label><br>
                        <label id="CaractereTXT" style="color:red;">Conter Caractere(!@#$%&*).</label><br>
                        <label id="Tamanho" style="color:red;">Conter no mínimo 8 digitos.</label><br>
                        <label id="Igual" style="color:red;">As senhas devem ser iguais.</label><br><br>';

                if(!empty($Erro)){
                    echo "<script>Swal.fire('Erro','$Erro','error')</script>";
                }

                echo '<input type="submit" value="Salvar" class="LogarBTN Desativado" name="SalvarBTN" id="LogarBTN"><br><br>
                       <input type="button" value="Cancelar" class="CancelarBTN" onclick="Cancelar()">';

                echo "</form>";
            }else{
                header('Location: ../RecuperarConta2/index.php');
            }
        }else{
            header('Location: ../RecuperarConta2/index.php');
        }
    ?>

</body>
</html>