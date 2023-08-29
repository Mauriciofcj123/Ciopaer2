let Secao=document.getElementsByName('Secoes');

function GerarGrafico1(){
    for(i=0;i<Secao.length;i++){
        let QTDInt=document.getElementsByName('QTDTempo/'+Secao[i].value);
        let Textos=document.getElementById('Textos/'+Secao[i].value);

        let DivPrincipal=document.createElement('div');
        DIVPrincipal.setAttribute('name','SecaoDIV');
        document.appendChild(DIVPrincipal);


        let GraficoDIV=document.createElement('div');
        GraficoDIV.setAttribute('name','Grafico1');
        document.appendChild(GraficoDIV);

    let ValorMaior=0;

    let TamanhoBarra=Math.floor((GraficoDIV.clientWidth/QTDInt.length)-30);

    for(i=0;i<QTDInt.length;i++){
        if(QTDInt[i].value-ValorMaior>0){
            ValorMaior=QTDInt[i].value;
        }
    }

    for(i=0;i<QTDInt.length;i++){
        let R=parseInt(Math.random()*250);
        let G=parseInt(Math.random()*250);
        let B=parseInt(Math.random()*250);
        let Cor='rgb('+R+','+G+','+B+')'
        let AlturaBarra=(90/ValorMaior)*QTDInt[i].value;
        
        let Barra=document.createElement('div');
        Barra.style.width=TamanhoBarra+'px';
        Barra.style.height=AlturaBarra+'%';
        Barra.style.backgroundColor=Cor;
        Barra.style.textAlign='center';
        Barra.classList.add('Barra');
        GraficoDIV.appendChild(Barra);
        GraficoDIV.style.transform='rotateX(180deg)';

        Barra.animate([
            {height:'0px'},
            {height: AlturaBarra}
        ],{
            duration:1000,
        });

        let Legenda=document.createElement('p');
        Legenda.textContent=QTDInt[i].value;
        Legenda.style.position='relateive';
        Legenda.style.fontWeight='bold';
        Legenda.style.color='white';
        Legenda.style.top='100%';
        Legenda.style.fontSize='25px';
        Legenda.style.webkitTextStrokeColor='black';
        Legenda.style.webkitTextStrokeWidth='1px';
        Legenda.style.transform='rotateX(180deg)';
        Barra.appendChild(Legenda);

        let Nome=document.createElement('p');
        Nome.textContent=QTDInt[i].id;
        Textos.appendChild(Nome);
    }
}
}
function GerarGrafico2(){
    let QTDInt=document.getElementsByName('QTDInt');
    let GraficoDIV=document.getElementById('Grafico2');
    let Textos=document.getElementById('Textos2');
    let ValorMaior=0;

    let TamanhoBarra=Math.floor((GraficoDIV.clientWidth/QTDInt.length)-30);

    for(i=0;i<QTDInt.length;i++){
        if(QTDInt[i].value-ValorMaior>0){
            ValorMaior=QTDInt[i].value;
        }
    }

    for(i=0;i<QTDInt.length;i++){
        let R=parseInt(Math.random()*250);
        let G=parseInt(Math.random()*250);
        let B=parseInt(Math.random()*250);
        let Cor='rgb('+R+','+G+','+B+')'
        let AlturaBarra=(90/ValorMaior)*QTDInt[i].value;
        
        let Barra=document.createElement('div');
        Barra.style.width=TamanhoBarra+'px';
        Barra.style.height=AlturaBarra+'%';
        Barra.style.backgroundColor=Cor;
        Barra.style.textAlign='center';
        Barra.classList.add('Barra');
        GraficoDIV.appendChild(Barra);
        GraficoDIV.style.transform='rotateX(180deg)';

        Barra.animate([
            {height:'0px'},
            {height: AlturaBarra}
        ],{
            duration:1000,
        });

        let Legenda=document.createElement('p');
        Legenda.textContent=QTDInt[i].value;
        Legenda.style.position='relateive';
        Legenda.style.fontWeight='bold';
        Legenda.style.color='white';
        Legenda.style.top='100%';
        Legenda.style.fontSize='25px';
        Legenda.style.webkitTextStrokeColor='black';
        Legenda.style.webkitTextStrokeWidth='1px';
        Legenda.style.transform='rotateX(180deg)';
        Barra.appendChild(Legenda);

        let Nome=document.createElement('p');
        Nome.textContent=QTDInt[i].id;
        Textos.appendChild(Nome);
    }
}
function MostrarTotal(){
    let ValorTotal=document.getElementById('QTDTotal');
    let ValorTXT=document.getElementById('ValorTXT');

    console.log(ValorTotal.value);

    ValorTXT.textContent=ValorTotal.value;
}
GerarGrafico1();
GerarGrafico2();
MostrarTotal();