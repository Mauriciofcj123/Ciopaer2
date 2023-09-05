
document.addEventListener('keyup',()=>{
    let Nome=document.getElementById('NomeTXT');
    let Horimetro=document.getElementById('HorimetroTXT');
    let Botao=document.getElementById('Botao');

    if(Nome.value.length > 3 && Horimetro.value > 0 && isNaN(Horimetro.value)==false){
        Botao.style.visibility='visible';
    }else{
        Botao.style.visibility='hidden';
    }
});

