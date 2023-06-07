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