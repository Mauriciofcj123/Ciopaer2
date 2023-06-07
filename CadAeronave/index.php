<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aeronave</title>
</head>
<body>
    <form action="" method="post">
        <label>Placa</label><input type="text" name="PesquisarTXT" id=""><br>
        <?php

            include_once('../Conexao.php');

            if(isset($_POST['PesquisarTXT'])){
                $PlacaTXT=str_replace("-","",mysqli_real_escape_string($mysqli,$_POST['PesquisarTXT'])) ;
                $SQL="SELECT * FROM aeronaves WHERE MARCA = '$PlacaTXT'";
                $Requisicao=mysqli_query($mysqli,$SQL);
                $QTD=$Requisicao->num_rows;

                if($QTD>0){
                    $Linha=$Requisicao->fetch_assoc();
    
                    echo "<input value='".$Linha['PROPRIETARIO']."'></input>";
                }
            }
        ?>
        <input type="submit" value="Mandar">
    </form>
    

</body>
</html>