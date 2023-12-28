function Reenviar(Nome){
    let DIV=document.getElementById('ReenviarDIV');

    let Formulario=document.createElement('form');
    Formulario.action='../RecuperarConta/Logar.php';
    Formulario.method='post';
    DIV.appendChild(Formulario);

    Formulario.style.visibility='hidden';

    let Usuario=document.createElement('input');
    Usuario.name='Usuario';
    Usuario.value=Nome;
    Formulario.appendChild(Usuario);

    let Submit=document.createElement('button');
    Submit.type='submit';
    Submit.name='LogarBTN';
    Formulario.appendChild(Submit);

    Submit.click();
}
function IniciarContagem(Tempo){
    let ReenviarBTN=document.getElementById('ReenviarTXT');
    ReenviarBTN.classList.add('Desativado');
    let Segundo=14;

    setInterval(()=>{
        if(Segundo>0){
            ReenviarBTN.textContent=Segundo--;
        }else{
            ReenviarBTN.textContent='Re-enviar código';
        }

    },1000);

    setInterval(()=>{
        ReenviarBTN.classList.toggle('Ativado','Desativado');
    },Tempo*1000);
}
var Executado=false;

if(Executado==false){
    IniciarContagem(15);
    Executado=true;
}


