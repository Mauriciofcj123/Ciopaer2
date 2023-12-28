var PesquisarBTN=document.getElementById('PesquisarBTN');
var Aeronave=document.getElementById('AeronaveTXT');
var Velocidade=document.getElementById('VelocidadeTXT');
var VelocidadeMax=document.getElementById('VelocidadeMaxTXT');
var Altitude=document.getElementById('AltitudeTXT');
var PrimeiraVez=true;
var Caminho;
var MacadorAtual;
var Bateria=document.getElementById('Bateria');
let MenuBTN=document.getElementById('MenuBTN');
let Menu=document.getElementById('MenuMapa');
let MenuAtivo=false;

function IniciarMapa(){
    var posicao=[-15.657082062569849, -56.117756734111275];
    var map = L.map('map').setView(posicao,19);

    var MapaNormal = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    });

    MapaNormal.addTo(map);
}

function Pesquisar(Placa){
    Aeronave.value=Placa;
    PesquisarBTN.click();
    MandarRequisicao();
}

MenuBTN.addEventListener('click',()=>{
    MenuAtivo=!MenuAtivo;

    if(MenuAtivo==true){
        Menu.style.transform='translateX(0%)';
        Menu.style.opacity='100%';
        Menu.style.boxShadow='6px 0px 2px rgba(0, 0, 0, 0.5)';
    
    }else{
        Menu.style.transform='translateX(-90%)';
        Menu.style.opacity='50%';
        Menu.style.boxShadow='0px 0px';
    }
});

PesquisarBTN.addEventListener('click',(e)=>{
    e.preventDefault();

    $.ajax({
        url:'Pegar.php',
        method:'POST',
        data:{
            Aeronaves: Aeronave.value
        },
        dataType:'json'
    }).done((resposta)=>{
        if(resposta!=null&&resposta!=undefined){
            let Resposta=JSON.parse(resposta);
            let Pontos=[];
            let VelocidadeAtual;
            let AltitudeAtual;
            let VelocidadeMaxTXT=0;
            let Atual;
            let CargaAtual=0;
            let IconeAtual=L.icon({
                iconUrl: 'Icones/Atual.png',
                iconAnchor:   [26, 68],
            });
            let IconeDestino=L.icon({
                iconUrl: 'Icones/Destino.png',
                iconAnchor:   [26, 68],
            });
            let Vertices=L.icon({
                iconUrl: 'Icones/Pontos.png',
                iconAnchor:   [5, 5],
            });
            
            for(let i=0;i<Resposta.length;i++){
                if(Resposta[i]['position.latitude']!=undefined&&Resposta[i]['position.longitude']!=undefined){
                    Pontos.push([Resposta[i]['position.latitude'], Resposta[i]['position.longitude']]);
                    Atual=[Resposta[i]['position.latitude'], Resposta[i]['position.longitude']];
                    AltitudeAtual=Resposta[i]['position.altitude'];
                    CargaAtual=Resposta[i]['battery.level'];
                    let MarcadorPonto=L.marker([Resposta[i]['position.latitude'], Resposta[i]['position.longitude']],{icon: Vertices});
                    MarcadorPonto.addTo(map);
                    //console.log("Carga: "+i+" "+Resposta[i]['battery.level']);
                }
                if(Resposta[i]['position.speed']!=undefined&&Resposta[i]['position.speed']!=null){
                    VelocidadeAtual=Resposta[i]['position.speed'];

                    if(Resposta[i]['position.speed']>VelocidadeMaxTXT){
                        VelocidadeMaxTXT=Resposta[i]['position.speed'];
                    }

                    Inicial=[Resposta[i]['position.latitude'], Resposta[i]['position.longitude']];
                }
            }

            if(Caminho==undefined){
                Caminho=L.polyline(Pontos);
                Caminho.addTo(map)
                MacadorAtual=L.marker(Atual,{icon: IconeAtual});
                MacadorAtual.addTo(map);
            }else{
                map.removeLayer(Caminho);
                map.removeLayer(MacadorAtual);
                Caminho=L.polyline(Pontos);
                Caminho.addTo(map)
                MacadorAtual=L.marker(Atual,{icon: IconeAtual});
                MacadorAtual.addTo(map);
            }

            Velocidade.value=VelocidadeAtual+' Km/h';
            VelocidadeMax.value=VelocidadeMaxTXT+' Km/h';
            Altitude.value=AltitudeAtual;

            if(CargaAtual>=80&&CargaAtual<=100){
                Bateria.style.backgroundImage='url(imgs/Bateria1.png)';
            }else if(CargaAtual>=60&&CargaAtual<80){
                Bateria.style.backgroundImage='url(imgs/Bateria2.png)';
            }else if(CargaAtual>=40&&CargaAtual<60){
                Bateria.style.backgroundImage='url(imgs/Bateria3.png)';
            }else if(CargaAtual>=20&&CargaAtual<40){
                Bateria.style.backgroundImage='url(imgs/Bateria4.png)';
            }else if(CargaAtual>=0&&CargaAtual<20){
                Bateria.style.backgroundImage='url(imgs/Bateria5.png)';
            }

            /*var MacadorDestino=L.marker(Inicial,{icon: IconeDestino});
            if(PrimeiraVez==true){
                MacadorDestino.addTo(map);
                PrimeiraVez=false;
            }
            if(VelocidadeAtual>0){
                MacadorDestino.addTo(map);
            }*/

        }
    });
});

IniciarMapa();


function MandarRequisicao(){
    let ValorVelocidade=Velocidade.value.replace(' Km/h','');

    if(ValorVelocidade>0){
        PesquisarBTN.click();
        console.log(ValorVelocidade);
    }

    setTimeout(() => {
        MandarRequisicao();
    }, 1000);
}
