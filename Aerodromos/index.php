<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar Aeródromos</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <script src='script.js' defer></script>
</head>
<body id='body'>
    <?php
        require_once('../Conexao.php');
        require_once('../Cabecalho/Cabecalho.php');

        $QTD="";

        if(isset($_POST['PesquisarOACI'])){
            $OACI=mysqli_real_escape_string($mysqli,$_POST['OACITXT']);
            $SQL="SELECT * FROM aerodromos WHERE OACI='$OACI' LIMIT 1";
            $Requisicao=mysqli_query($mysqli,$SQL);
            $QTD=$Requisicao->num_rows;
        }

        if(isset($_POST['PesquisarCidade'])){
            $Cidade=mysqli_real_escape_string($mysqli,$_POST['CidadeTXT']);
            $Estado=mysqli_real_escape_string($mysqli,$_POST['EstadoTXT']);

            if(!empty($Cidade)&&!empty($Estado)){
                $SQL="SELECT * FROM aerodromos WHERE Municipio='$Cidade' AND UF='$Estado'";
                $Requisicao=mysqli_query($mysqli,$SQL);
                $QTD=$Requisicao->num_rows;
            }else if(empty($Cidade)&&!empty($Estado)){
                $SQL="SELECT * FROM aerodromos WHERE UF='$Estado' ORDER BY Nome ASC";
                $Requisicao=mysqli_query($mysqli,$SQL);
                $QTD=$Requisicao->num_rows;
            }
        }

    ?>
    <div id='TipoPesquisa'>
        <button id='OACI' onclick='OACIBTN()'>Pesquisa por código OACI</button>
        <button id='OACI' onclick='CidadeBTN()'>Pesquisa por Cidade</button>
    </div>
    <form action="" method="post" id='Formulario1' class='Formulario'>
        <input type="text" placeholder="OACI" maxlength="4" name='OACITXT'>
        <button type='submit' name='PesquisarOACI'>Pesquisar</button>
    </form>

    <form action="" method="post" id='Formulario2' class='Formulario' style='visibility:hidden;position:absolute;'>
    <input type="text" placeholder='Cidade' name='CidadeTXT'>
    <select name="EstadoTXT" id="EstadosTXT">
            <option>AC</option>
            <option>AL</option>
            <option>AP</option>
            <option>AM</option>
            <option>BA</option>
            <option>CE</option>
            <option>DF</option>
            <option>ES</option>
            <option>GO</option>
            <option>MA</option>
            <option>MT</option>
            <option>MS</option>
            <option>MG</option>
            <option>PA</option>
            <option>PB</option>
            <option>PR</option>
            <option>PE</option>
            <option>PI</option>
            <option>RJ</option>
            <option>RN</option>
            <option>RS</option>
            <option>RR</option>
            <option>SC</option>
            <option>SP</option>
            <option>SE</option>
            <option>TO</option>
        </select>
        <button type='submit' name='PesquisarCidade'>Pesquisar</button>
    </form>

    <?php

        if($QTD==1 && isset($QTD) && !empty($QTD)){

            echo '<div class="Metrica">
            <label>Distancia:</label><input type="text" id="Distancia" readonly>
            <label>Velocidade:</label><input type="text" id="Velocidade" readonly>
            <label>Tempo:</label><input type="text" id="Tempo" readonly>
            </div>';

            $Registro=$Requisicao->fetch_assoc();

            echo "<div id='Informacoes'>
            <div id='Texto'>
            <label>Código OACI:</label><input type='text' value='".$Registro['OACI']."' disabled></input>
            <label>Nome:</label><input type='text' value='".$Registro['Nome']."' disabled></input>
            <label>Cidade:</label><input type='text' value='".$Registro['Municipio']."' disabled></input>
            <label>UF:</label><input type='text' value='".$Registro['UF']."' disabled></input>
            <label style='width:25%'>Latitude:</label><input type='text' value='".$Registro['Latitude']."' style='width:25%' disabled></input>
            <label style='width:25%'>Longitude:</label><input type='text' value='".$Registro['Longitude']."' style='width:25%' disabled></input>
            <input type='text' value='".$Registro['LATGEOPOINT']."' id='Latitude' style='visibility:hidden;position:absolute;' disabled></input>
            <input type='text' value='".$Registro['LONGEOPOINT']."' id='Longitude' style='visibility:hidden;position:absolute;' disabled></input>
            <input type='text' value='".$Registro['Comprimento']."' id='Comprimento' style='visibility:hidden;position:absolute;' disabled></input>
            <input type='text' value='".$Registro['Largura']."' id='Largura' style='visibility:hidden;position:absolute;' disabled></input>
            <input type='text' value='".$Registro['Cabeceiras']."' id='Cabeceiras' style='visibility:hidden;position:absolute;' disabled></input>
            <label>Altitude:</label><input type='text' value='".$Registro['Altitude']."' disabled></input>
            <label>Tipo da Pista:</label><input type='text' id='PavimentoTXT' value='".$Registro['Pavimento']."' disabled></input>
            </div>
            <div id='Mapa'>
            </div>
            <div id='Aeroporto'>
                <button id='Aproximar' onclick='Aproximar()'>+</button>
                <button id='Afastar' onclick='Afastar()'>-</button>
                <label>Largura: ".$Registro['Largura']."m</label>
                <label>Comprimento: ".$Registro['Comprimento']."m</label>
                <label>Cabeçeiras: ".$Registro['Cabeceiras']."</label>
                <div id='Pista'>
                <img id='Aviao' src='Imgs/Aviao.png'>
                </div>
            </div>
            </div>";
        }else if($QTD>1 && isset($QTD) && !empty($QTD)){
                echo '<table id="AeroportosTB">
                <thead>
                <tr>
                    <th>Cód. OACI</th>
                    <th>Nome</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Tipo da Pista</th>
                </tr>
                </thead>';

                $ID=0;
            while($Registro=$Requisicao->fetch_assoc()){
                echo '<tr>';
                echo "<td><input type='text' value='".$Registro['OACI']."' name='OACI'  readonly></input></td>";
                echo "<td><input type='text' value='".$Registro['Nome']."'  readonly></input></td>";
                echo "<td><input type='text' value='".$Registro['Municipio']."'  readonly></input></td>";
                echo "<td><input type='text' value='".$Registro['UF']."'  readonly></input></td>";
                echo "<td><input type='text' value='".$Registro['Pavimento']."' readonly></input></td>";
                echo "<td><button type='button' onclick='Ver($ID)'><img src='Imgs/Ver.png'></button></td>"; 
                echo '</tr>';

                $ID++;
            }
            echo '</table>';
        }
    ?>
</body>
</html>