
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Diário</title>
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="./script.js" defer></script>
    <script src="../Cabecalho/script.js" defer></script>

</head>
<body>
    
    <?php
            include('../Cabecalho/Cabecalho.php');
            include('../Conexao.php');

            $QTD=0;

        if(isset($_POST['SecaoTXT'])){
            $_SESSION['Secao']=$_POST['SecaoTXT'];

            $SQL='SELECT * FROM aeronavescadastradas WHERE Secao="'.$_POST['SecaoTXT'].'"';
            $Requisicao=mysqli_query($mysqli,$SQL);
            $QTD=$Requisicao->num_rows;
        }

        echo "<div class='Pesquisa'>
        <form action='' method='get'>
            <input type='text' placeholder='Pesquisar' name='PesquisarTXT' class='PesquisaTXT'>
            <button type='submit' name='PesquisarBTN' id='PesquisarBTN' class='PesquisaBTN'><img src='Imgs/Pesquisar.png'></button><br>
            <input type='date' name='PesquisarDe' class='PesquisaData'>
            <label>Até</label>
            <input type='date' name='PesquisarAte' class='PesquisaData'>
        </form>";

        if(isset($_SESSION['Nome'])&&$QTD>0){
            echo "<div class='Botoes' id='BotoesDIV'>
            <button onclick='CriarRelatorio()' title='Criar um novo relatório' ><img src='Imgs/CriarRel.png'></button>
            </div>";
        }
        
        echo "</div>";


        if(!empty($_SESSION['Secao'])){
            echo '<div class="TabelaDIV">';
            if(isset($_GET['PesquisarBTN'])){
                $PesquisarTXT=mysqli_real_escape_string($mysqli,$_GET['PesquisarTXT']);
                $PesquisarDe=mysqli_real_escape_string($mysqli,$_GET['PesquisarDe']);
                $PesquisarAte=mysqli_real_escape_string($mysqli,$_GET['PesquisarAte']);
    
    
                if(empty($PesquisarTXT)&&empty($PesquisarDe)&&empty($PesquisarAte)){
                    echo $_SESSION['Secao'];
                    $SQL='SELECT * FROM registrodisp WHERE Secao="'.$_SESSION['Secao'].'" ORDER BY Data Desc LIMIT 25';
                    $Requisicao=mysqli_query($mysqli,$SQL);
                    while($Linha=$Requisicao->fetch_assoc()){
                    $Data=date('d/m/Y',strtotime($Linha['Data']));
                    echo "<form action='../RelatorioDiario/index.php' method='post'>
                        <table id='" . $Linha['ID'] . "' class='Tabela'>
                            <tr>
                                <td>" . $Linha['Mecanico'] . "</td>
                                <td rowspan='2'><button type='submit' name='AcessarBTN'><img src='Imgs/Proximo.png'></button></td>
                            </tr>
                            <tr>
                                <td>". $Data ."</td>
                            </tr>
                        </table>
                        <input type='text' name='DataRelatorio' id='DataRelatorio' style='visibility: hidden;' value='".$Linha['Data']."'>
                        </form>";
                    }
                }else if(!empty($PesquisarTXT)&&empty($PesquisarDe)&&empty($PesquisarAte)){
    
                    $SQL='SELECT * FROM registrodisp WHERE Mecanico LIKE "%'.$PesquisarTXT.'%" AND Secao="'.$_SESSION['Secao'].'" ORDER BY Data Desc';
                    $Requisicao=mysqli_query($mysqli,$SQL);
                    $Quantidade=$Requisicao->num_rows;
                    if($Quantidade>0){
                        while($Linha=$Requisicao->fetch_assoc()){
                            $Data=date('d/m/Y',strtotime($Linha['Data']));
                            echo "<form action='../RelatorioDiario/index.php' method='post'>
                                <table id='" . $Linha['ID'] . "' class='Tabela'>
                                    <tr>
                                        <td>" . $Linha['Mecanico'] . "</td>
                                        <td rowspan='2'><button type='submit' name='AcessarBTN'><img src='Imgs/Proximo.png'></button></td>
                                    </tr>
                                    <tr>
                                        <td>". $Data ."</td>
                                    </tr>
                                </table>
                                <input type='text' name='DataRelatorio' id='DataRelatorio' style='visibility: hidden;' value='".$Linha['Data']."'>
                                </form>";
                            }
                    }
    
                    
                }else if(empty($PesquisarTXT)&&!empty($PesquisarDe)&&!empty($PesquisarAte)){
                    $SQL="SELECT * FROM registrodisp WHERE Data BETWEEN '$PesquisarDe' AND '$PesquisarAte' AND Secao='".$_SESSION['Secao']."' ORDER BY Data Desc ";
                    $Requisicao=mysqli_query($mysqli,$SQL);
                    $Quantidade=$Requisicao->num_rows;
                    if($Quantidade>0){
                        while($Linha=$Requisicao->fetch_assoc()){
                            $Data=date('d/m/Y',strtotime($Linha['Data']));
                            echo "<form action='../RelatorioDiario/index.php' method='post'>
                                <table id='" . $Linha['ID'] . "' class='Tabela'>
                                    <tr>
                                        <td>" . $Linha['Mecanico'] . "</td>
                                        <td rowspan='2'><button type='submit' name='AcessarBTN'><img src='Imgs/Proximo.png'></button></td>
                                    </tr>
                                    <tr>
                                        <td>". $Data ."</td>
                                    </tr>
                                </table>
                                <input type='text' name='DataRelatorio' id='DataRelatorio' style='visibility: hidden;' value='".$Linha['Data']."'>
                                </form>";
                            }
                    }
                }else if(!empty($PesquisarTXT)&&!empty($PesquisarDe)&&!empty($PesquisarAte)){
                    $SQL="SELECT * FROM registrodisp WHERE Mecanico LIKE '%$PesquisarTXT%' AND Data BETWEEN '$PesquisarDe' AND '$PesquisarAte' ORDER BY Data Desc";
                    $Requisicao=mysqli_query($mysqli,$SQL);
                    $Quantidade=$Requisicao->num_rows;
                    if($Quantidade>0){
                        while($Linha=$Requisicao->fetch_assoc()){
                            $Data=date('d/m/Y',strtotime($Linha['Data']));
                            echo "<form action='../RelatorioDiario/index.php' method='post'>
                                <table id='" . $Linha['ID'] . "' class='Tabela'>
                                    <tr>
                                        <td>" . $Linha['Mecanico'] . "</td>
                                        <td rowspan='2'><button type='submit' name='AcessarBTN'><img src='Imgs/Proximo.png'></button></td>
                                    </tr>
                                    <tr>
                                        <td>". $Data ."</td>
                                    </tr>
                                </table>
                                <input type='text' name='DataRelatorio' id='DataRelatorio' style='visibility: hidden;' value='".$Linha['Data']."'>
                                </form>";
                            }
                    }
                }
                
            }else{
                    $SQL='SELECT * FROM registrodisp WHERE Secao="'.$_SESSION['Secao'].'"  ORDER BY Data Desc LIMIT 25';
                    $Requisicao=mysqli_query($mysqli,$SQL);
                    while($Linha=$Requisicao->fetch_assoc()){
                    $Data=date('d/m/Y',strtotime($Linha['Data']));
                    echo "<form action='../RelatorioDiario/index.php' method='post'>
                        <table id='" . $Linha['ID'] . "' class='Tabela'>
                            <tr>
                                <td>" . $Linha['Mecanico'] . "</td>
                                <td rowspan='2'><button type='submit' name='AcessarBTN'><img src='Imgs/Proximo.png'></button></td>
                            </tr>
                            <tr>
                                <td>". $Data ."</td>
                            </tr>
                        </table>
                        <input type='text' name='DataRelatorio' id='DataRelatorio' style='visibility: hidden;' value='".$Linha['Data']."'>
                        </form>";
                    }
            }
            echo '</div>';
    
            $Quantidade=$Requisicao->num_rows;
            if($Quantidade<=0){
                echo '<h1 class="Erro">Nenhum resultado encontrado.</h1>';
            }
        }
        
    ?>
</body>
</html>