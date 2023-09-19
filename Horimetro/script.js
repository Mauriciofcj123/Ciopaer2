let Prefixos = document.getElementsByName('PrefixoTXT');
let Modal=document.getElementById('Modal');

var IDAeronave=0;
console.log(Prefixos[0].value);

if(IDAeronave>Prefixos.length){
    IDAeronave=0;
}else if(IDAeronave<0){
    IDAeronave=Prefixos.length;
}

function AbrirModal(){
    let Modal=document.getElementById('Fundo');
    Modal.style.visibility='visible';

    let Prefixo=document.getElementById('Prefixo');
    let HorasAtual=document.getElementById('HAtual');
    let HorasProx=document.getElementById('HorasProxRev');
    Prefixo.value=Prefixos[IDAeronave].value;
}

function BuscarAeronave(id){
    $.ajax({
        url:'Pesquisar.php',
        method:'post',
        data:{
            PrefixoTXT:Prefixos[id].value
        },
        dataType:'json'
    });
}

