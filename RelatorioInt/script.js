const Secao=document.getElementsByName('Secoes');
const GrupoGraficos=document.getElementById('GrupoGraficos');
let id=0;


function GerarGrafico1(SecaoID,Graficos){

        let QTDTempo=document.getElementsByName('QTDTempo/'+Secao[SecaoID].value);
        console.log(Secao.length);
        id++;

        let TituloPrincipalDIV=document.createElement('div');
        TituloPrincipalDIV.classList.add('TituloPrincipalDIV');
        Graficos.appendChild(TituloPrincipalDIV);

        let TituloPrincipal=document.createElement('h1');
        TituloPrincipal.textContent='Seção '+Secao[SecaoID].value;
        TituloPrincipal.classList.add('TituloPrincipal');
        TituloPrincipalDIV.appendChild(TituloPrincipal);

        let GraficoDiv1=document.createElement('div');
        GraficoDiv1.classList.add('GraficoDiv1');
        Graficos.appendChild(GraficoDiv1);

        let Titulo1=document.createElement('h1');
        Titulo1.classList.add('Titulo1');
        Titulo1.textContent='Tempo gasto por aeronave (hrs)';
        GraficoDiv1.appendChild(Titulo1);

        let Grafico1=document.createElement('div');
        Grafico1.classList.add('Grafico1');
        GraficoDiv1.appendChild(Grafico1);

        let Legendas1=document.createElement('div');
        Legendas1.classList.add('Legendas1');
        GraficoDiv1.appendChild(Legendas1);

    let ValorMaior=0;

    let LarguraBarra=Math.floor((Grafico1.clientWidth/QTDTempo.length)-30);

    for(i=0;i<QTDTempo.length;i++){
        if(QTDTempo[i].value-ValorMaior>0){
            ValorMaior=QTDTempo[i].value;
        }
    }

    if(ValorMaior<=0){
        ValorMaior=100;
    }

    for(i=0;i<QTDTempo.length;i++){
        let R=parseInt(Math.random()*250);
        let G=parseInt(Math.random()*250);
        let B=parseInt(Math.random()*250);
        let Cor='rgb('+R+','+G+','+B+')'
        let AlturaBarra=(90/ValorMaior)*QTDTempo[i].value;
        
        let Barra=document.createElement('div');
        Barra.style.width=LarguraBarra+'px';
        Barra.style.height=AlturaBarra+'%';
        Barra.style.backgroundColor=Cor;
        Barra.style.textAlign='center';
        Barra.classList.add('Barra');
        Grafico1.appendChild(Barra);
        Grafico1.style.transform='rotateX(180deg)';

        Barra.animate([
            {height:'0px'},
            {height: AlturaBarra+'%'}
        ],{
            duration:1000,
        });

        let Legenda=document.createElement('p');
        Legenda.textContent=QTDTempo[i].value;
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
        Nome.textContent=QTDTempo[i].id;
        Legendas1.appendChild(Nome);
    }
}
function GerarGrafico2(SecaoID,Graficos){

        let QTDInt=document.getElementsByName('QTDInt/'+Secao[SecaoID].value);
        console.log(QTDInt.length+'-----');
        id++;

        let GraficoDiv2=document.createElement('div');
        GraficoDiv2.classList.add('GraficoDiv2');
        Graficos.appendChild(GraficoDiv2);

        let Titulo2=document.createElement('h1');
        Titulo2.classList.add('Titulo2');
        Titulo2.textContent='Quantidade de Interveções por aeronave';
        GraficoDiv2.appendChild(Titulo2)

        let Grafico2=document.createElement('div');
        Grafico2.classList.add('Grafico2');
        GraficoDiv2.appendChild(Grafico2);

        let Legendas2=document.createElement('div');
        Legendas2.classList.add('Legendas2');
        GraficoDiv2.appendChild(Legendas2);

    let ValorMaior=0;

    let LarguraBarra=Math.floor((Grafico2.clientWidth/QTDInt.length)-30);

    for(i=0;i<QTDInt.length;i++){
        if(QTDInt[i].value-ValorMaior>0){
            ValorMaior=QTDInt[i].value;
        }
    }

    if(ValorMaior<=0){
        ValorMaior=100;
    }

    for(let i=0;i<QTDInt.length;i++){
        let R=parseInt(Math.random()*250);
        let G=parseInt(Math.random()*250);
        let B=parseInt(Math.random()*250);
        let Cor='rgb('+R+','+G+','+B+')'
        let AlturaBarra=(90/ValorMaior)*QTDInt[i].value;
        
        let Barra=document.createElement('div');
        Barra.style.width=LarguraBarra+'px';
        Barra.style.height=AlturaBarra+'%';
        Barra.style.backgroundColor=Cor;
        Barra.style.textAlign='center';
        Barra.classList.add('Barra');
        Grafico2.appendChild(Barra);
        Grafico2.style.transform='rotateX(180deg)';

        Barra.animate([
            {height:'0px'},
            {height: AlturaBarra+'%'}
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
        Legendas2.appendChild(Nome);
    }
}

function GerarGraficos(){
    for(let i=0;i<Secao.length;i++){

        let TotalDIV=document.createElement('div');
        TotalDIV.classList.add('TotalDIV');
        GrupoGraficos.appendChild(TotalDIV);

        let Total=document.createElement('div');
        Total.classList.add('Total');
        TotalDIV.appendChild(Total);

        let TituloTotal=document.createElement('h1');
        TituloTotal.textContent='Valor Economizado';
        Total.appendChild(TituloTotal);

        let Valor=document.getElementById('QTDTotal/'+Secao[i].value);
        console.log(Valor.value);

        let ValorTotal=document.createElement('h1');
        ValorTotal.textContent=Valor.value;
        Total.appendChild(ValorTotal);

        let Graficos=document.createElement('div');
        Graficos.classList.add('Graficos');
        GrupoGraficos.appendChild(Graficos);

        GerarGrafico1(i,Graficos);
        GerarGrafico2(i,Graficos);
    }
}
function MostrarTotal(){
    let ValorTotal=document.getElementById('QTDTotal');
    let ValorTXT=document.getElementById('ValorTXT');

    console.log(ValorTotal.value);

    ValorTXT.textContent=ValorTotal.value;
}
function BaixarTabela(){
    let Data=document.getElementsByName('Data');
    let Placa=document.getElementsByName('Placa');
    let Descrição=document.getElementsByName('Descricao');
    let Responsavel=document.getElementsByName('Responsavel');
    let Tipo=document.getElementsByName('Tipo');
    let Tempo=document.getElementsByName('Tempo');

    const Book=XLSX.utils.book_new();

    console.log(Book);

    Book.Props={
        Title: 'Relatório de Produtividade',
        CreateDate: new Date()
    };

    Book.SheetNames.push('Relatório 1');

    const Dados=[
        ['Data','Prefixo','Descrição','Responsável','Tipo','Tempo']
    ];

    for(let i=0;i<Data.length;i++){
        const Linha= [Data[i].textContent,Placa[i].textContent,Descrição[i].textContent,Responsavel[i].textContent,Tipo[i].textContent,Tempo[i].textContent];
        Dados.push(Linha);
    }

    let Total=['Total','Teste'];
      
    const sheets=XLSX.utils.json_to_sheet(Dados);

    Book.Sheets['Relatório 1']=sheets;

    worksheet["!cols"]=[{wch: '400'}];

    XLSX.writeFile(Book,'Relatório de Produtividade.xlsx',{
        bookType: 'xlsx',
        type: 'bynary',
    });
}
function BaixarTabela2(){
    let Data=document.getElementsByName('Data');
    let Placa=document.getElementsByName('Placa');
    let Descrição=document.getElementsByName('Descricao');
    let Responsavel=document.getElementsByName('Responsavel');
    let Tipo=document.getElementsByName('Tipo');
    let Tempo=document.getElementsByName('Tempo');

    let Tabela=document.getElementById('Tabela');

    var Book=XLSX.utils.table_to_book(Tabela);

    XLSX.writeFile(Book,'Relatório de Produtividade.xlsx',{
        bookType: 'xlsx',
        type: 'bynary',
    });
}
function MostrarRel(){
    let Modal=document.getElementById('ModalTabela');
    Modal.style.visibility='visible';
    Modal.style.opacity='100%';
}
function FecharRel(){
    let Modal=document.getElementById('ModalTabela');
    Modal.style.visibility='hidden';
    Modal.style.opacity='0%';
}
GerarGraficos();
//MostrarTotal();