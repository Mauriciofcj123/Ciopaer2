document.addEventListener('keydown',function (e){
    let PesquisatBTN=document.getElementById('PesquisarBTN');
    if(e.key=='Enter'){
        PesquisatBTN.click();
    }
});
function Sair(){
    window.location.href="Sair.php";
}
function VerRelatorio(Data){
    let IDRelatorioTXT=document.querySelector('#IDRelatorio');
    //let Botao=document.querySelector('#AcessarBTN');
    console.log('Teste');

    IDRelatorioTXT.value=Data;
    //Botao.click();
}
function VerRelatorio2(Data){
    let IDRelatorioTXT=document.querySelector('#IDRelatorio');
    console.log('Teste');

    IDRelatorioTXT.value=Data;
}
function CriarRelatorio(){
    let DIV=document.getElementById('BotoesDIV');
    let Formulario=document.createElement('form');
    Formulario.setAttribute('method','post');
    Formulario.setAttribute('action','../CadRelatorioDiario/index.php')
    DIV.appendChild(Formulario);

    let Botao=document.createElement('button');
    Botao.setAttribute('type','submit');
    Botao.setAttribute('name','AcessarBTN');
    Formulario.appendChild(Botao);
    Botao.click();
    //window.location.href='../CadRelatorioDiario/index.php'
}