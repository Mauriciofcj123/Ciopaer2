
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <?php
        session_start();

        include_once("../Conexao.php");
            if(isset($_POST['CriarBTN'])){
                $Nome=$_POST['NomeTXT'];
                $Sobrenome=$_POST['SobrenomeTXT'];
                $Patente=$_POST['PatenteTXT'];
                $Email=$_POST['EmailTXT'].$_POST['ProvedorTXT'];
                $Usuario=$_POST['LoginTXT'];
                $Senha=$_POST['SenhaTXT'];
                $Mensagem='';


                if(empty($Nome)||empty($Sobrenome)||empty($Patente)||empty($Email)||empty($Usuario)||empty($Senha)){
                    $Mensagem='Campos Obrigatórios Faltando';
                }else{
                    $SQL="SELECT * FROM cadastros WHERE Loggin='$Usuario'";
                    $Requisicao=mysqli_query($mysqli,$SQL);
                    $Quantidade=$Requisicao->num_rows;
                    if($Quantidade==0){
                        $Senha=password_hash($_POST['SenhaTXT'],PASSWORD_DEFAULT);
                        $SQL= "INSERT INTO cadastros (Nome, Senha, Loggin, Sobrenome, Patente, Email) VALUES( '$Nome','$Senha','$Usuario','$Sobrenome','$Patente','$Email')";
                        mysqli_query($mysqli,$SQL);
                        header('location: ../Loggin/index.php');
                    }else{
                        $Mensagem="Usuario já cadastrado.";
                    }
                }

            }

    ?>

    <div class="Logo">
    <img src="Imgs/Logo.png" alt="" srcset="">
    </div>
    <form action="" method="post" class="Box">
        <input type="text" name="NomeTXT" id="NomeTXT" placeholder="Nome" class="CampoLado">
        <input type="text" name="SobrenomeTXT" id="SobrenomeTXT" placeholder="Segundo Nome" class="CampoLado">
        <Select class="Campo" name="PatenteTXT" id="PatenteTXT">
            <option>Sem Patente</option>
            <option>Soldado</option>
            <option>Cabo</option>
            <option>3° Sargento</option>
            <option>2° Sargento</option>
            <option>1° Sargento</option>
            <option>SubTenente</option>
            <option>Aspirante</option>
            <option>2° Tenente</option>
            <option>1° Tenente</option>
            <option>Capitão</option>
            <option>Major</option>
            <option>Tenente-Coronel</option>
            <option>Coronel</option>
            <option>General de Brigada</option>
            <option>General de Divisão</option>
            <option>General de Exército</option>
            <option>Marechal</option>
        </Select>
        <input type="text" name="EmailTXT" id="EmailTXT" placeholder="E-mail" class="CampoLado">
        <select class="CampoLado" name="ProvedorTXT" id="ProvedorTXT">
            <option>@hotmail.com</option>
            <option>@outlook.com</option>
            <option>@gmail.com</option>
            <option>@yahoo.com</option>
            <option>@sesp.mt.gov.br</option>
            <option>@proton.me</option>
            <option>@aol.com</option>
        </select>
        <input type="text" name="LoginTXT" id="LoginTXT" placeholder="Usuario" class="Campo">
        <input type="password" name="SenhaTXT" id="SenhaTXT" placeholder="Senha" class="Campo">
        <input type="password" name="RepeteSenhaTXT" id="RepeteSenhaTXT" placeholder="Repitir a Senha" class="Campo">
        <p><?php
            if(isset($Mensagem)){
                echo $Mensagem;
            }
        ?></p>
        <input type="submit" name="CriarBTN" id="CriarBTN" value="Criar Conta" class="CriarBTN"><br><br>
    </form>

</body>
</html>