
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Relatório Diário</title>
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <script src="../Cabecalho/script.js" defer></script>
</head>
<body id='body'>
    <?php
        include('../Cabecalho/Cabecalho.php');
        include('../Conexao.php');
        if(isset($_POST['AcessarBTN'])){
            $Data=date('dd/mm/YY');
            $_SESSION['Data']=$Data;
        }

        if(isset($_SESSION['Data'])){
            echo '<div class="NomeMec">';
            echo '<select id="MecanicoDia">';
            $Mecanicos='SELECT * FROM operacional';
            $MecanicosReq=mysqli_query($mysqli,$Mecanicos);
            while($MecanicosArray=$MecanicosReq->fetch_assoc()){
                if($MecanicosArray['Patente']=="Sem Patente"){
                        echo "<option>".$MecanicosArray['Nome']." ".$MecanicosArray['Sobrenome']."</option>";
                }else{
                        echo "<option>".$MecanicosArray['Patente']." ".$MecanicosArray['Sobrenome']."</option>";
                }
                        
            }
        echo '</select>';
        echo '</div>';
        
        $Data=date('Y-m-d');
        echo '<div class="Data"><input type="date" id="DataTXT" value="'.$Data.'"></div>';

        $SQL='SELECT * FROM aeronavescadastradas';
        $AeronavesCad=mysqli_query($mysqli,$SQL);

        echo '<select style="visibility: hidden" id="Aeronaves">';
        while($AeronavesTotal=$AeronavesCad->fetch_assoc()){
            echo "<option>".$AeronavesTotal['Marca']."</option>";
        }
        echo '</select>';

        $SQL='SELECT * FROM aeronavescadastradas';
        $AeronavesCad=mysqli_query($mysqli,$SQL);
        

        echo '<div class="Part1">';
        echo '<div class="Aeronaves" id="AeronavesDIV">';
        
        $i=0;

        while($Linha1=$AeronavesCad->fetch_assoc()){
            $SQL='SELECT * FROM disponibilidade ORDER BY Data Desc LIMIT 1';
            $Requisicao=mysqli_query($mysqli,$SQL);
            $Resultado=$Requisicao->fetch_assoc();
            $UltimaData=$Resultado['Data'];

            echo '<div id="'.$Linha1['Marca'].'" name="MarcaDIV">';

            $SQL='SELECT * FROM disponibilidade WHERE Placa="'.$Linha1['Marca'].'" AND Data = "'.$UltimaData.'"';
            $Requisicao=mysqli_query($mysqli,$SQL);
            $Disponibilidade=$Requisicao->fetch_assoc();

            echo '<input type="text" class="MarcaTXT" value="'.$Linha1['Marca'].'" disabled class="Placa" name="AeronavePlaca">';

            if($Disponibilidade['Status']=='Disponível'){
                
                echo '<button Onclick="Ativar('.$i.',\'0\',\'Despachada\')"><img name="Botao'.$i.'" id="DespachadaBTN'.$i.'" src="Imgs/Despachada.png" title="Despachadas" ></button>
                <button Onclick="Ativar('.$i.',\'1\',\'Indisponível\')"><img name="Botao'.$i.'" id="IndisponivelBTN'.$i.'" src="Imgs/cancelar.png" title="Indisponíveis" ></button>
                <button Onclick="Ativar('.$i.',\'2\',\'Disponível\')"><img name="Botao'.$i.'" id="Disponivel'.$i.'" class="Selecionada" src="Imgs/verificado.png" title="Disponíveis" ></button><br>';

                echo '<div name="CausaDIV" id="Causa'.$i.'" class="CausaTXT" style="visibility : hidden;"><label>Causa</label><input type="text" class="CausaTXT" name="Causa[]" value="'.$Disponibilidade['Causa'].'" >
                <select name="Previsao" id="Previsao'.$i.'" style="visibility: hidden;">
                <option>Prevista</option>
                <option>Imprevista</option>
                </select></div>';
                
            }else if($Disponibilidade['Status']=='Indisponível'){
                echo '<button Onclick="Ativar('.$i.',\'0\',\'Despachada\')"><img name="Botao'.$i.'" id="DespachadaBTN'.$i.'" src="Imgs/Despachada.png" title="Despachadas" ></button>
                <button Onclick="Ativar('.$i.',\'1\',\'Indisponível\')"><img name="Botao'.$i.'" id="IndisponivelBTN'.$i.'" class="Selecionada" src="Imgs/cancelar.png" title="Indisponíveis" ></button>
                <button Onclick="Ativar('.$i.',\'2\',\'Disponível\')"><img name="Botao'.$i.'" id="Disponivel'.$i.'" src="Imgs/verificado.png" title="Disponíveis" ></button><br>';

                echo '<div name="CausaDIV" id="Causa'.$i.'" class="CausaTXT" style="visibility : visible;"><label>Causa</label><input type="text" class="CausaTXT" name="Causa[]" value="'.$Disponibilidade['Causa'].'" >
                <select name="Previsao" id="Previsao'.$i.'" style="visibility: visible;">
                <option>Prevista</option>
                <option>Imprevista</option>
                </select></div>';
                
            }else if($Disponibilidade['Status']=='Despachada'){
                echo '<button Onclick="Ativar('.$i.',\'0\',\'Despachada\')"><img name="Botao'.$i.'" id="DespachadaBTN'.$i.'" class="Selecionada" src="Imgs/Despachada.png" title="Despachadas" ></button>
                <button Onclick="Ativar('.$i.',\'1\',\'Indisponível\')"><img name="Botao'.$i.'" id="IndisponivelBTN'.$i.'" src="Imgs/cancelar.png" title="Indisponíveis" ></button>
                <button Onclick="Ativar('.$i.',\'2\',\'Disponível\')"><img name="Botao'.$i.'" id="Disponivel'.$i.'" src="Imgs/verificado.png" title="Disponíveis" ></button><br>';

                echo '<div name="CausaDIV" id="Causa'.$i.'" class="CausaTXT" style="visibility : visible;"><label>Causa</label><input type="text" class="CausaTXT" name="Causa[]" value="'.$Disponibilidade['Causa'].'" >
                <select name="Previsao" id="Previsao'.$i.'" style="visibility: visible;">
                <option>Programado</option>
                <option>Não Programado</option>
                </select></div>';
            }

            echo '<input type="text" name="Status[]" id="Status" value="'.$Disponibilidade['Status'].'" style="margin-left: 20px;width: 200px; border-bottom: 1px solid rgb(0, 195, 255); border-right: 1px solid rgb(0, 195, 255); visibility: hidden; width: 80%;"><br>';

            echo'</div>';

            $i++;
        }
        echo '</div>';
    
            $SQL="SELECT * FROM discrepancias WHERE Data='".$UltimaData."'";
            $Requisicao=mysqli_query($mysqli,$SQL);
            $QTD=$Requisicao->num_rows;
    
            echo "<div class='Discrepancias' id='Discrepancias'>";
            echo "<div class='MenuDiscrepancias'>
                    <button onClick='RemoverDiscrepancias()'><img src='Imgs/verifica.png' title='Resolvido'></button>
                    <button onClick='AdicionarDiscrepancia()'><img src='Imgs/AdicionarDiscrepancias.png' title='Adicionar'></button>
                    <label for='DiscrepanciaQTD' class='DiscrepanciaQTDTXT'>Quantidade: ".$QTD."</label>
                </div>";
            
            while($Linha=$Requisicao->fetch_assoc()){
                echo "<table class='DiscrepanciasTB' id='DiscrepanciasTB' name='DiscrepanciasTB'>";
                echo "<tr class='TituloDiscrepancia'>
                        <td colspan='4'>
                        <select name='PlacaDisc'>
                            <option>".$Linha['Placa']."</option>";

                            $SQL='SELECT * FROM aeronavescadastradas WHERE Marca != "'.$Linha['Placa'].'"';
                            $AeronavesCad=mysqli_query($mysqli,$SQL);

                            while($Placa=$AeronavesCad->fetch_assoc()){
                                echo "<option>".$Placa['Marca']."</option>";
                            }
                echo "</select>
                        </td>
                    </tr>
                    <tr class='Elemento'>
                        <td><input type='checkbox' name='CheckboxDiscrepancia' id=''></td>
                        <td><img src='Imgs/alerta.png' title='Discrepancias'></td>
                        <td colspan='2' class='DiscrepanciaTXT'><textarea name='DescricaoDisc'>".$Linha['DescDiscrepancias']."</textarea></td>
                    </tr>
                    <tr>
                        <td colspan='4'><input type='text' name='MedidaTXT' placeholder='Medida Tomada' value='".$Linha['Medida']."'><td/>
                    </tr>";
                    
            echo "</table>";
            }
    

    
        echo "</div>";
        echo "</div>";

        echo "<div class='Part2'>";

        $SQL="SELECT * FROM acessoriodisp WHERE Data='$UltimaData'";
        $Requisicao=mysqli_query($mysqli,$SQL);

        $SQL2="SELECT * FROM pilotos";
        $Pilotos=mysqli_query($mysqli,$SQL2);

        echo '<select style="visibility: hidden; position: absolute;" id="Pilotos" name="PilotosOBJ">';
        while($Piloto=$Pilotos->fetch_assoc()){
            if($Piloto['Patente']=='Sem Patente'){
                echo "<option>".$Piloto['Nome']." ".$Piloto['Sobrenome']."</option>"; 
            }else{
                echo "<option>".$Piloto['Patente']." ".$Piloto['Sobrenome']."</option>"; 
            }
        }
        echo '<select>';


        //echo '<h1 class="TituloCautela">Acessórios Cautelados</h1>';
        echo '<div class="Acessorios">';

        echo '<div class="MenuAcessorio"><button onClick="AdicionarFone()"><img src="Imgs/AdicionarAcessorio.png" class="MenuCautela" title="Cautelar Fone"></button>
        <button onClick="AdicionarGPS()"><img src="Imgs/AdicionarGPS.png" class="MenuCautela" title="Cautelar GPS"></button>
        <button onClick="RemoverAcessorio()"><img src="Imgs/lixo.png" class="MenuCautela" title="Descautelar Acessório"></button></div>';

        echo '<table id="CautelaTB">';

        while($Linha=$Requisicao->fetch_assoc()){

            echo '<tr class="Objeto">
                    <td><input type="checkbox" name="CheckboxAcessorio"></td>
                    <td><img src="Imgs/'.$Linha['NomeAcessorio'].'.png" id="'.$Linha['NomeAcessorio'].'" name="ObjetoTXT"></td>
                    <td>
                        <select name="ResponsavelOBJ">
                            <option >'.$Linha['Responsável'].'</option>';
                            while($Linha2=$Pilotos->fetch_assoc()){
                                echo '<option>'.$Linha2['Nome'].'</option>';
                            }
            echo '</select>
                    </td>
                </tr>';
        }

        echo '</table>';
        echo '</div>';

        //echo '<h1 class="TituloInter">Intervenção</h1>';
        echo "<div class='Intervencao'>";
            echo "<div class='MenuIntervencao'>
            <button onClick='AbrirModalIntervencao()'><img src='Imgs/AdicionarIntervencao.png' title='Adicionar'></button>
            <button onClick='RemoverIntervencao()'><img src='Imgs/lixo.png' title='Remover Intervenção'></button>
            </div>";

            $SQLInt="SELECT * FROM intervencao WHERE Data='$UltimaData'";
            $RequisicaoInt=mysqli_query($mysqli,$SQLInt);
            $IDInt=0;
            echo "<table class='IntervencaoTB' id='IntervencaoTB'>";
                echo "</table>";

        echo "</div>";
        echo "</div>";

        $SQL='SELECT * FROM observacoes WHERE data="'.$UltimaData.'"';
        $Requisicao=mysqli_query($mysqli,$SQL);

        echo "<div class='Observacoes'>";
            echo "<div class='MenuObservacao'>
                <button onClick='AdicionarOBS()'><img src='Imgs/AdicionarOBS.png' title='Adicionar'></button>
                <button onClick='RemoverOBS()'><img src='Imgs/lixo.png' title='Remover Observação'></button>
            </div>";

        echo "<div class='ObservacoesDIV'>";
        echo "<table class='ObservacoesTB' id='ObservacoesTB'>";
        while($Observacoes=$Requisicao->fetch_assoc()){
            echo "<tr name='LinhaOBS'>
                    <td><input type='checkbox' name='CheckOBS'></td>
                    <td><img src='Imgs/papel.png'></td>
                    <td><textarea name='ObservacaoTXT'>".$Observacoes['Observacoes']."</textarea></td>
                </tr>";
        }
        echo "</table>";
        echo "</div>";

        echo "</div>";

        echo '<div class="Botoes">
        <button class="SalvarBTN" onclick="Salvar()">Salvar</button>
        </div>';
    }
    ?>
    <div id='FormularioDIV'></div>
    
    <div class="Modal" id='ModalInt'>
        <div class="Relatorio">
            <div class="formulario">
            
            <label style='font-weight: bold;'>Prefixo da Aeronave: </label>
            <select id='Aeronave'>
            <?php
                $SQL='SELECT * FROM aeronavescadastradas';
                $Requisicao1=mysqli_query($mysqli,$SQL);

                while($Aeronaves=$Requisicao1->fetch_assoc()){
                    echo "<option>" . $Aeronaves['Marca']."</option>";
                }
            ?>
        </select>
        <div class="CardBoxs">
            <div class="TodosDIV">
                <table class="TodosTB" id="MecanicosTB">
                    <thead>
                        <th>Todos</th>
                    </thead>
                    <?php

                        $SQL='SELECT * FROM operacional';
                        $Requisicao1=mysqli_query($mysqli,$SQL);

                        while($Mecanicos=$Requisicao1->fetch_assoc()){
                            if($Mecanicos['Patente']==="Sem Patente"){
                                echo '<tr disabled name="Cartão" id="'. $Mecanicos['Nome']. ' '.$Mecanicos['Sobrenome'].'">
                                    <td>
                                        <button onClick="AdicionarMecanico(\''. $Mecanicos['Nome']. ' '.$Mecanicos['Sobrenome'].'\')"> '. $Mecanicos['Nome']. ' '.$Mecanicos['Sobrenome'].'</button>
                                    </td>
                                </tr>';
                            }else{
                                echo '<tr name="Cartão" id="'. $Mecanicos['Patente']. ' '.$Mecanicos['Sobrenome'].'">
                                <td>
                                    <button onClick="AdicionarMecanico(\''. $Mecanicos['Patente']. ' '.$Mecanicos['Sobrenome'].'\')"> '. $Mecanicos['Patente']. ' '.$Mecanicos['Sobrenome'].'</button>
                                </td>
                            </tr>';
                            }
                            
                        }
                    ?>
                </table>
            </div>
            <div class="responsavelDIV">
                <table class="responsavelTB" id='ResponsavelTB'>
                <thead>
                    <th>Responsáveis</th>
                </thead>
                </table>
            </div>
        </div>
        <label style='font-weight: bold;'>Tipo: </label>
        <select id='Tipo'>
            <option>Mecânica</option>
            <option>Elétrica</option>
            <option>Limpeza e Higienização</option>
            <option>Adequação para Missão</option>
            <option>Avionics</option>
        </select>
        <textarea name="CaixaTexto" id="CaixaTexto" class="DescIntervencao" cols="30" rows="10" placeholder="Descrição da Intervenção" maxlength="120"></textarea><p id='Caracteres'>0/120</p><br>
        <input type="number" class="Tempo" id="Hora" min="0" value=0><label class="Legenda">Hrs.</label>
        <input type="number" class="Tempo" id="Minuto" max="59" min="0" value=0><label class="Legenda">Min.</label>
        <input type="number" class="Tempo" id="Segundo" max="59" min="0" value=0><label class="Legenda">Seg.</label>
        <button onClick='ConfirmarIntervencao()' class="ConfirmarBTN" id='BTNSalvar'><img src="Imgs/Confirmar.png" alt=""></button>
        <button onClick='FecharModalIntervencao()' class="FecharBTN"><img src="Imgs/Fechar.png" alt=""></button>
            </div>
        </div>
    </div>
</body>
</html>