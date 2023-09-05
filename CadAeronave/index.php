<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Aeronave</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src="script.js" defer></script>
</head>
<body>
    <?php
    include_once('../Conexao.php');
    include_once('../Cabecalho/Cabecalho.php');

    require_once('../Conexao.php');

    if(isset($_POST['BotaoCad'])){
        $Mensagem="";
        $Prefixo=mysqli_real_escape_string($mysqli,$_POST['PrefixoTXT']);
        $SQL="SELECT * FROM aeronavescadastradas WHERE Marca = '$Prefixo' LIMIT 1";
        $Requisicao=mysqli_query($mysqli,$SQL);
        $Quantidade=$Requisicao->num_rows;
        if($Quantidade>0){
            $Mensagem='Aeronave já foi Cadastrada.';
        }else{
            $Nome=mysqli_real_escape_string($mysqli,$_POST['NomeTXT']);
            $Fabricante=mysqli_real_escape_string($mysqli,$_POST['FabricanteTXT']);
            $Modelo=mysqli_real_escape_string($mysqli,$_POST['ModeloTXT']);
            $NSerie=mysqli_real_escape_string($mysqli,$_POST['NSTXT']);
            $Horimetro=$_POST['HorimetroTXT'];
            $Secao=$_POST['SecaoTXT'];

            $SQLInsert="INSERT INTO aeronavescadastradas(Marca,Nome,Fabricante,Modelo,NSerie,Secao) VALUES ('$Prefixo','$Nome','$Fabricante','$Modelo','$NSerie','$Secao')";
            $RequisicaoInsert=mysqli_query($mysqli,$SQLInsert);

            $Data=date('Y-m-d');

            $SQLDispInsert='SELECT * FROM disponibilidade WHERE Secao="'.$Secao.'" LIMIT 1';
            $RequisicaoDispInsert=mysqli_query($mysqli,$SQLDispInsert);
            $QTDDisp=$RequisicaoDispInsert->num_rows;
            echo $QTDDisp;

            if($QTDDisp>0){
                $SQLUltimaData='SELECT * FROM disponibilidade WHERE Secao="'.$Secao.'" ORDER BY Data DESC LIMIT 1';
                $RequisicaoUltimaData=mysqli_query($mysqli,$SQLUltimaData);
                $UltimoRegistro=$RequisicaoUltimaData->fetch_assoc();
                $UltimaData=$UltimoRegistro['Data'];

                echo $UltimaData;

                $SQLDisp="INSERT INTO disponibilidade (Placa,Status,Data,Horimetro,Secao) VALUES ('$Prefixo','Disponível','$UltimaData','$Horimetro','$Secao')";
            }else{
                $SQLDisp="INSERT INTO disponibilidade (Placa,Status,Data,Horimetro,Secao) VALUES ('$Prefixo','Disponível','$Data','$Horimetro','$Secao')";
            }

            $RequisicaoDispo=mysqli_query($mysqli,$SQLDisp);

            $HorasProxRev=$Horimetro+100;
            $Disp=100;
            $CVA=$_POST['CVATXT'];

            $SQLHorimetro="INSERT INTO horimetro(Placa,Data,HorasAtuais,HorasProxRev,HorasDisp,TipoProxRev,CVA,TBORH,TBOLH,TBOHorasDispLH,TBOHorasDispRH,Secao) VALUES ('$Prefixo','$Data','$Horimetro','$HorasProxRev','$Disp','50 Horas','$CVA',0,0,0,0,'$Secao')";
            $RequisicaoHorimetro=mysqli_query($mysqli,$SQLHorimetro);

            $Mensagem='Aeronave Cadastrada com sucesso.';
        }
    }


    if(isset($_POST['PesquisarTXT'])){
        $PlacaTXT=str_replace("-","",mysqli_real_escape_string($mysqli,$_POST['PesquisarTXT'])) ;
        $SQL="SELECT * FROM aeronaves WHERE MARCA = '$PlacaTXT' LIMIT 1";
        $Requisicao=mysqli_query($mysqli,$SQL);
        $QTD=$Requisicao->num_rows;
    }
    ?>
        <?php
            if(!empty($_SESSION['Nome'])||isset($_SESSION['Nome'])){

            echo '<form action="" method="post" id="Formulario">
                        <div class="PesquisarDIV">
                            <input type="text" name="PesquisarTXT" id="" placeholder="Placa"><br>
                            <input type="submit" value="Pesquisar" style="width:10%;color:white;background-color:rgb(43, 255, 0);border-radius:10px;border:none;">
                        </div><br>
                    </form>';

            if(isset($QTD)){
                if($QTD>0){
                    echo '<div class="InformacoesDIV">';
                    $Linha=$Requisicao->fetch_assoc();
                    echo '<form method="post" action="">';
                    $Marca=substr($Linha['MARCA'],0,2).'-'.substr($Linha['MARCA'],2);
                
                    echo "<label>Prefixo:</label><input value='".$Marca."' readonly name='PrefixoTXT'></input><br><br>";
    
                    echo "<label>Horimetro Atual</label><input type='text' value='' name='HorimetroTXT' id='HorimetroTXT'></input><br>";
                    echo "<label>Nome</label><input type='text' value='' name='NomeTXT' id='NomeTXT'></input><br>";
                    echo "<label>Seção</label><select name='SecaoTXT'>";
                            $SQLSecao='SELECT * FROM secoes';
                            $RequisicaoSecao=mysqli_query($mysqli,$SQLSecao);

                            while($Secao=$RequisicaoSecao->fetch_assoc()){
                                echo '<option>'.$Secao['Secao'].'</option>';
                            }
                    echo "</select><br>";
                    echo "<label>Proprietário Atual:</label><input value='".$Linha['PROPRIETARIO']."' readonly></input><br>";
                    echo "<label>Estado:</label><input value='".$Linha['SG_UF']."' readonly></input><br>";
                    echo "<label>Modelo:</label><input value='".$Linha['DS_MODELO']."' readonly name='ModeloTXT'></input><br>";
                    echo "<label>Numero de Série:</label><input value='".$Linha['NR_SERIE']."' readonly name='NSTXT'></input><br>";
                    echo "<label>Fabricante:</label><input value='".$Linha['NM_FABRICANTE']."' readonly name='FabricanteTXT'></input><br>";
                    echo "<label>Tripulação Min.:</label><input value='".$Linha['NR_TRIPULACAO_MIN']."' readonly></input><br>";
                    echo "<label>Tripulação MAX.:</label><input value='".$Linha['NR_PASSAGEIROS_MAX']."' readonly></input><br>";
                    echo "<label>Fabricação.:</label><input value='".$Linha['NR_ANO_FABRICACAO']."' readonly></input><br>";
                    echo "<label>Data Mat.:</label><input value='".$Linha['DT_MATRICULA']."' readonly></input><br>";
                    echo "<label>Val. C.V.A.:</label><input type='text' value='".$Linha['DT_VALIDADE_CVA']."' readonly name='CVATXT'></input><br>";
                    echo "<button type='submit' name='BotaoCad' id='Botao'>Adicionar</button>";
                    echo "<div>";
    
                    echo '</form>';
                }else{
                    echo '<div class="InformacoesDIV">';
                    $Linha=$Requisicao->fetch_assoc();
                    echo '<form method="post" action="">';
    
                    echo "<label>Proprietário Atual:</label><input value='' readonly></input><br>";
                    echo "<label>Estado:</label><input value='' readonly></input><br>";
                    echo "<label>Modelo:</label><input value='' readonly></input><br>";
                    echo "<label>Numero de Série:</label><input value='' readonly></input><br>";
                    echo "<label>Fabricante:</label><input value='' readonly></input><br>";
                    echo "<label>Tripulação Min.:</label><input value='' readonly></input><br>";
                    echo "<label>Tripulação MAX.:</label><input value='' readonly></input><br>";
                    echo "<label>Fabricação.:</label><input value='' readonly></input><br>";
                    echo "<label>Data Mat.:</label><input value='' readonly></input><br>";
                    echo "<label>Val. C.V.A.:</label><input type='text' value='' readonly></input><br><br>";
                    echo "<p>Aeronave não encontrada.</p>";
                    echo "<div>";
    
                    echo '</form>';
                }
            }else{
                echo '<div class="InformacoesDIV">';
                echo '<form method="post" action="">';
    
                echo "<label>Proprietário Atual:</label><input value='' readonly></input><br>";
                echo "<label>Estado:</label><input value='' readonly></input><br>";
                echo "<label>Modelo:</label><input value='' readonly></input><br>";
                echo "<label>Numero de Série:</label><input value='' readonly></input><br>";
                echo "<label>Fabricante:</label><input value='' readonly></input><br>";
                echo "<label>Tripulação Min.:</label><input value='' readonly></input><br>";
                echo "<label>Tripulação MAX.:</label><input value='' readonly></input><br>";
                echo "<label>Fabricação.:</label><input value='' readonly></input><br>";
                echo "<label>Data Mat.:</label><input value='' readonly></input><br>";
                echo "<label>Val. C.V.A.:</label><input type='text' value='' readonly></input><br><br>";
                if(isset($Mensagem)){
                    echo "<p>$Mensagem</p>";
                }
                echo "<div>";
    
                echo '</form>';
            }
        }
        
        ?>
    </form>
    

</body>
</html>