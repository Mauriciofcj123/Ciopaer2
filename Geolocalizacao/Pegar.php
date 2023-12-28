
<?php
        /*function SalvarPosicao(){
            require_once('../Conexao.php');
            $curl=curl_init();

            $Localizacao="https://flespi.io/gw/devices/5339922/messages?data=%7B%22fields%22%3A%22position.longitude%2Cposition.latitude%2Cposition.altitude%2Cposition.speed%22%2C%22count%22%3A10%2C%22reverse%22%3Atrue%7D";

        $header=[
            'Authorization: FlespiToken Fw073bXRHSEWEsOpDIXmIqZSVDEysK2X6QSXSFEpn89RpM4SkR2Q5QyQj2cBA4mw',
            'Content_Type: application/json'
        ];
        
        curl_setopt_array($curl,[
            CURLOPT_URL=>$Localizacao,
            CURLOPT_CUSTOMREQUEST=>"GET",
            CURLOPT_HTTPHEADER=>$header,
            CURLOPT_RETURNTRANSFER=>true,
            //CURLOPT_SSL_VERIFYHOST=>false,
            //CURLOPT_POSTFIELDS=>json_encode($PostFields)
        ]);

        $resultado=curl_exec($curl);
        $Resultado=explode('"',$resultado);
        $Array=0;
        
        $Altitude=substr($Resultado[4],1,-1);
        $Latitude=substr($Resultado[6],1,-1);
        $Longitude=substr($Resultado[8],1,-1);
        $Velocidade=substr($Resultado[10],1,-3);
        $Data=date('Y/m/d');
        $Veiculo='Caminhão1';

        curl_close($curl);

        $SQLSalvar="INSERT INTO posicao (Latitude,Longitude,Velocidade,Altura,Veiculo,Data) VALUES ('$Latitude','$Longitude','$Velocidade','$Altitude','$Veiculo','$Data')";
        $RequisicaoSalvar=mysqli_query($mysqli,$SQLSalvar);
        }*/

        function PegarGPS($Veiculo){
            require_once('../Conexao.php');

            $SQLDevice="SELECT * FROM gps WHERE Veiculo='$Veiculo' LIMIT 1";
            $RequisicaoDevice=mysqli_query($mysqli,$SQLDevice);
            $Device=$RequisicaoDevice->fetch_assoc();

            if($RequisicaoDevice->num_rows>=1){
                $curl=curl_init();
                $flespi=$Device['Flespi'];

                //$Localizacao="https://flespi.io/gw/devices/".$Device['Flespi']."/messages?data=%7B%22count%22%3A100%2C%22reverse%22%3Atrue%7D";
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
                    //CURLOPT_SSL_VERIFYHOST=>false,
                    //CURLOPT_POSTFIELDS=>json_encode($PostFields)
                ]);

                curl_close($curl);

                header ("Content-Type: application/json");

                $resultado=str_replace('{"result":','',curl_exec($curl));
                $resultado=substr($resultado,0,-1);
                echo json_encode($resultado);
                

            }else{
                echo json_encode('Nao Achou');
            }
        }

        $Aeronave=mysqli_real_escape_string($mysqli,$_POST['Aeronaves']);

        PegarGPS($Aeronave);

?>