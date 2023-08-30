let PesquisarTXT=document.getElementById('PesquisarTXT');
let PesquisarBTN=document.getElementById('PesquisarBTN');
let Modal=document.getElementById('Fundo');

var FiltrosVisivel=false;

function Filtros(){
    FiltrosVisivel=!FiltrosVisivel;
    let FiltrosDIV=document.getElementById('FiltrosDIV');
    let FiltrosBTN=document.getElementById('FiltrosBTN');

    if(FiltrosVisivel==true){
        FiltrosDIV.style.visibility='visible';
        FiltrosDIV.style.position='relative';
        FiltrosBTN.textContent='Menos Filtros';
    }else{
        FiltrosDIV.style.visibility='hidden';
        FiltrosDIV.style.position='absolute';
        FiltrosBTN.textContent='Mais Filtros';
    }
    
}
function AbrirModal(){
    Modal.style.visibility='visible';
    Modal.style.position='fixed';
    Modal.style.opacity='100%';
}
function FecharModal(){
    Modal.style.visibility='hidden';
    Modal.style.position='absolute';
    Modal.style.opacity='0%';
}
