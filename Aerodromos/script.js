
let Latitude=document.getElementById('Latitude');
let Longitude=document.getElementById('Longitude');


function Formatar(Valor){
    let ValorTXT=Valor;
    let Resultado;

    if(ValorTXT<0){
        ValorTXT=0;
    }

    if(ValorTXT<10){
        Resultado='0'+ValorTXT;
    }else if(ValorTXT>=10){
        Resultado=ValorTXT;
    }

    return Resultado;
}

function Sucess(Pos){
    let Distancia=document.getElementById('Distancia');
    let Velocidade=document.getElementById('Velocidade');
    let Tempo=document.getElementById('Tempo');

    DifLat=Latitude.value-Pos.coords.latitude;
    DifLong=Longitude.value-Pos.coords.longitude;
    console.log(DifLat);
    console.log(DifLong);


    Distancia.value=Math.ceil(Math.sqrt(DifLat**2+DifLong**2)*111.195);
    Distancia.value=Distancia.value.replace('.',',');
    Velocidade.value=393;
    let TempoTXT=Distancia.value/Velocidade.value*60;
    let Horas=Math.floor(TempoTXT/60);
    let Minutos=Math.floor(TempoTXT-(Horas*60));
    let Segundo=Math.floor((TempoTXT-(Horas*60)-Minutos)*60);

    Tempo.value=Formatar(Horas)+':'+Formatar(Minutos)+':'+Formatar(Segundo);
    Distancia.value=Distancia.value+'km';
    Velocidade.value=Velocidade.value+'km/h';
    
    var Marker2;
    Marker2=L.marker([Pos.coords.latitude,Pos.coords.longitude]);
    Marker2.addTo(map);
    console.log(Pos.coords.latitude+'-'+Pos.coords.longitude);
    console.log(Latitude.value+'--'+Longitude.value);
}

function Erro(){
    console.log('Não criado');
}

if(Latitude!=undefined&&Latitude!=null){

var map=L.map('Mapa').setView([Latitude.value,Longitude.value],15);
var Marker=L.marker([Latitude.value,Longitude.value]).addTo(map);

navigator.geolocation.getCurrentPosition(Sucess,Erro);

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '© OpenStreetMap'
}).addTo(map);


let Comprimento=document.getElementById('Comprimento').value;
let Largura=document.getElementById('Largura').value;
let Pavimento=document.getElementById('PavimentoTXT').value;
let Pista=document.getElementById('Pista');
let Aviao=document.getElementById('Aviao');
var Zoom=0;

document.addEventListener('keydown',(e)=>{
    if(e.key=='+'){

    }else if(e.key=='-'){
        Zoom--;
    }
    
    if(Zoom>0){
        Pista.style.width=Comprimento*Zoom+'px';
        Pista.style.height=Largura*Zoom+'px';
        Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
        Aviao.style.height=13*Zoom+"px";
    }else if(Zoom<0){
        Pista.style.width=Comprimento/(Zoom*-1)+'px';
        Pista.style.height=Largura/(Zoom*-1)+'px'; 
        Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
        Aviao.style.height=13/(Zoom*-1)+"px";
    }else{
        Pista.style.width=Comprimento+'px';
        Pista.style.height=Largura+'px';
        Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
        Aviao.style.height="13px";
    }

});

function Aproximar(){
    Zoom++;

    if(Zoom>0){
        Pista.style.width=Comprimento*Zoom+'px';
        Pista.style.height=Largura*Zoom+'px';
        Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
        Aviao.style.height=13*Zoom+"px";
    }else if(Zoom<0){
        Pista.style.width=Comprimento/(Zoom*-1)+'px';
        Pista.style.height=Largura/(Zoom*-1)+'px'; 
        Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
        Aviao.style.height=13/(Zoom*-1)+"px";
    }else{
        Pista.style.width=Comprimento+'px';
        Pista.style.height=Largura+'px';
        Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
        Aviao.style.height="13px";
    }

}
function Afastar(){
    Zoom--;

    if(Zoom>0){
        Pista.style.width=Comprimento*Zoom+'px';
        Pista.style.height=Largura*Zoom+'px';
        Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
        Aviao.style.height=13*Zoom+"px";
    }else if(Zoom<0){
        Pista.style.width=Comprimento/(Zoom*-1)+'px';
        Pista.style.height=Largura/(Zoom*-1)+'px'; 
        Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
        Aviao.style.height=13/(Zoom*-1)+"px";
    }else{
        Pista.style.width=Comprimento+'px';
        Pista.style.height=Largura+'px';
        Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
        Aviao.style.height="13px";
    }
}

    Pista.style.width=Comprimento+'px';
    Pista.style.height=Largura+'px';
    Aviao.style.height="13px";
    Pista.style.border=Zoom+"px solid rgb(109, 109, 109)";
    Pista.style.backgroundImage="url('Imgs/"+Pavimento+".png')";
}

function Ver(id){
    let Body=document.getElementById('body');
    let OACI=document.getElementsByName('OACI');

    let Formulario=document.createElement('form');
    Formulario.setAttribute('name','Formulario');
    Formulario.method='post';
    Formulario.action='';
    Body.appendChild(Formulario);

    let Input=document.createElement('input');
    Input.setAttribute('name','OACITXT');
    Input.value=OACI[id].value;
    Formulario.appendChild(Input);

    let Botao=document.createElement('button');
    Botao.type='submit';
    Botao.name='PesquisarOACI';
    Formulario.appendChild(Botao);
    Botao.click();
    
}
function OACIBTN(){
    let Formulario1=document.getElementById('Formulario1');
    let Formulario2=document.getElementById('Formulario2');

    Formulario1.style.position='relative';
    Formulario1.style.visibility='visible';
    
    Formulario2.style.position='absolute';
    Formulario2.style.visibility='hidden';
}

function CidadeBTN(){
    let Formulario1=document.getElementById('Formulario1');
    let Formulario2=document.getElementById('Formulario2');

    Formulario2.style.position='relative';
    Formulario2.style.visibility='visible';

    Formulario1.style.position='absolute';
    Formulario1.style.visibility='hidden';
}

