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
    ?>
    <form>
        <select name="Aeronaves" id="AeronaveTXT">
            <?php
                require_once('../Conexao.php');
                $SQLAeronaves="SELECT * FROM gps";
                $RequisicaoAeronaves=mysqli_query($mysqli,$SQLAeronaves);

                while($Aeronave=$RequisicaoAeronaves->fetch_assoc()){
                    echo "<option>".$Aeronave['Veiculo']."</option>";
                }
            ?>
        </select>
        <button type='submit' id='PesquisarBTN'>Selecionar</button>
    </form>
    <div id="map">
    </div>
    <button type="button" id='MenuBTN'><img src="imgs/Menu.png"></button>
    <div id='MenuMapa'>
        <label>Velocidade Atual: </label><br><input type="text" id="VelocidadeTXT" readonly>
        <label>Velocidade Máxima Registrada: </label><br><input type="text" id="VelocidadeMaxTXT" readonly>
        <label>Altitude: </label><br><input type="text" id="AltitudeTXT" readonly>
        <div id='Bateria'>
        </div>
    </div>
</body>
</html>