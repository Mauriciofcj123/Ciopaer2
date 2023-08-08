<?php
if(isset($_GET['PesquisarBTN'])){
            $PesquisarTXT=mysqli_real_escape_string($mysqli,$_GET['PesquisarTXT']);
            $PesquisarDe=mysqli_real_escape_string($mysqli,$_GET['PesquisarDe']);
            $PesquisarAte=mysqli_real_escape_string($mysqli,$_GET['PesquisarAte']);


            if(empty($PesquisarTXT)&&empty($PesquisarDe)&&empty($PesquisarAte)){
                $SQL='SELECT * FROM registrodisp ORDER BY Data Desc LIMIT 25';
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

                $SQL='SELECT * FROM registrodisp WHERE Mecanico LIKE "%'.$PesquisarTXT.'%" ORDER BY Data Desc';
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
                $SQL="SELECT * FROM registrodisp WHERE Data BETWEEN '$PesquisarDe' AND '$PesquisarAte' ORDER BY Data Desc";
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
            
        }else{
                $SQL='SELECT * FROM registrodisp ORDER BY Data Desc LIMIT 25';
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