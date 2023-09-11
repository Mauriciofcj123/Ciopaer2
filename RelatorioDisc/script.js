const Secao=document.getElementsByName('Secoes');
const GrupoGraficos=document.getElementById('GrupoGraficos');
let id=0;


function GerarGrafico1(SecaoID,Graficos){

        let QTD=document.getElementsByName('QTD/'+Secao[SecaoID].value);
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
        Titulo1.textContent='Quantidade de discrepancias por Aeronave';
        GraficoDiv1.appendChild(Titulo1);

        let Grafico1=document.createElement('div');
        Grafico1.classList.add('Grafico1');
        GraficoDiv1.appendChild(Grafico1);

        let Legendas1=document.createElement('div');
        Legendas1.classList.add('Legendas1');
        GraficoDiv1.appendChild(Legendas1);

    let ValorMaior=0;

    let LarguraBarra=Math.floor((Grafico1.clientWidth/QTD.length)-30);

    for(i=0;i<QTD.length;i++){
        if(QTD[i].value-ValorMaior>0){
            ValorMaior=QTD[i].value;
        }
    }

    if(ValorMaior<=0){
        ValorMaior=100;
    }

    for(i=0;i<QTD.length;i++){
        let R=parseInt(Math.random()*250);
        let G=parseInt(Math.random()*250);
        let B=parseInt(Math.random()*250);
        let Cor='rgb('+R+','+G+','+B+')'
        let AlturaBarra=(90/ValorMaior)*QTD[i].value;
        
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
        Legenda.textContent=QTD[i].value;
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
        Nome.textContent=QTD[i].id;
        Legendas1.appendChild(Nome);
    }
}

function GerarGraficos(){
    let QTD=document.getElementsByName('QTD/'+Secao[0].value);
    if(QTD.length>1){
        for(let i=0;i<Secao.length;i++){

            let Graficos=document.createElement('div');
            Graficos.classList.add('Graficos');
            GrupoGraficos.appendChild(Graficos);
    
            GerarGrafico1(i,Graficos);
        }
    }else if(QTD.length==1){
        let Graficos=document.createElement('div');
        Graficos.classList.add('Graficos');
        GrupoGraficos.appendChild(Graficos);
        
        let Quantidade=document.createElement('h1');
        Quantidade.textContent='Quantidade de Anormalidade Pendentes: '+QTD[0].value;
        Quantidade.classList.add('Titulo1');
        Graficos.appendChild(Quantidade);
    }else{
        let Graficos=document.createElement('div');
        Graficos.classList.add('Graficos');
        GrupoGraficos.appendChild(Graficos);
        
        let Quantidade=document.createElement('h1');
        Quantidade.textContent='Quantidade de Anormalidades Pendentes: 0';
        Quantidade.classList.add('Titulo1');
        Graficos.appendChild(Quantidade);
    }
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
      
    const sheets=XLSX.utils.aoa_to_sheet(Dados);

    Book.Sheets['Relatório 1']=sheets;

    XLSX.writeFile(Book,'Relatório de Produtividade.xlsx',{
        bookType: 'xlsx',
        type: 'bynary',
    });
}
function BaixarTabela2(){
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

document.addEventListener('keyup',(e)=>{
    if(e.key=='Escape'){
        FecharRel();
    }
})


GerarGraficos();
//MostrarTotal();