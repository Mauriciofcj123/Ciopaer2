<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
    integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
    crossorigin=""></script>
    <script src='https://code.jquery.com/jquery-3.7.1.min.js'></script>
    <link rel="stylesheet" href="../Cabecalho/style.css">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>E-Traking</title>
</head>
<body>
    <?php
     require_once('../Cabecalho/Cabecalho.php');
     require_once('../Conexao.php');

     function VerificarOnline($flespi){
        $curl=curl_init();

                //$Localizacao="https://flespi.io/gw/devices/$flespi/messages?data=%7B%22count%22%3A2%2C%22reverse%22%3Atrue%7D";
                $Localizacao="https://flespi.io/gw/devices/$flespi/messages?data=%7B%22count%22%3A1%2C%22reverse%22%3Afalse%7D";

                $header=[
                    'Authorization: FlespiToken Fw073bXRHSEWEsOpDIXmIqZSVDEysK2X6QSXSFEpn89RpM4SkR2Q5QyQj2cBA4mw',
                    'Content_Type: application/json'
                ];
            
                curl_setopt_array($curl,[
                    CURLOPT_URL=>$Localizacao,
                    CURLOPT_CUSTOMREQUEST=>"GET",
                    CURLOPT_HTTPHEADER=>$header,
                    CURLOPT_RETURNTRANSFER=>true,
                ]);

                curl_close($curl);

                $resultado=curl_exec($curl);
                $Valor=false;

                if(strpos($resultado,'true')==true){
                    $Valor=true;
                }else if(strpos($resultado,'false')==true){
                    $Valor=false;
                }

                return $Valor;
     }

     $SQLAeronavesTotal="SELECT * FROM gps";
     $RequisicaoAeronavesTotal=mysqli_query($mysqli,$SQLAeronavesTotal);
     
    ?>
    <div id="map">
    </div>
    <button type="button" id='MenuBTN'><img src="imgs/Menu.png"></button>
    <div id='MenuMapa'>
        <form style='visibility:hidden'>
            <input type="text" id='AeronaveTXT'>
            <button type='submit' id='PesquisarBTN'>Selecionar</button>
        </form>
        <?php
            if($RequisicaoAeronavesTotal->num_rows > 0){
                echo "<table id='TabelaAeronaves'>";
                while($Linha=$RequisicaoAeronavesTotal->fetch_assoc()){
                    $Placa=$Linha["Veiculo"];
                    $IMG;

                    if(VerificarOnline($Linha["Flespi"])==0){
                        $IMG='<img src="imgs/off.png" id="Status">';
                    }else if(VerificarOnline($Linha["Flespi"])==1){
                        $IMG='<img src="imgs/on.png" id="Status">';
                    }else{
                        $IMG='<img src="imgs/on.png" id="Status">';
                    }
                    echo "<tr>
                            <td><button type='button' onclick=\"Pesquisar('$Placa')\">$Placa</button></td>
                            <td>$IMG</td>
                        </tr>";
                }
                echo "</table>";
            }else{
                echo "<tr>
                <td>Nenhum Localizador Cadastrado</td>
                </tr>";
            }
        ?>
        <div class='Desativado'>
            <label>Velocidade Atual: </label><br><input type="text" id="VelocidadeTXT" readonly>
            <label>Velocidade Máxima Registrada: </label><br><input type="text" id="VelocidadeMaxTXT" readonly>
            <label>Altitude: </label><br><input type="text" id="AltitudeTXT" readonly>
            <div id='Bateria'>
        </div>
        </div>
        
    </div>
</body>
</html>