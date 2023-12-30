

function Cancelar(){
    Swal.fire({
        title: "Tem Certeza?",
        text: "Todas as alterações serão perdidas.",
        showDenyButton: true,
        confirmButtonText: "Confirmar",
        denyButtonText: `Cancelar`
      }).then((result) => {

        if (result.isConfirmed) {
            window.location.href='../Loggin/index.php';
        } else if (result.isDenied) {
            
        }
      });
}
function VerificarNumero(Texto){
    let TemNumero=false;
    let Numeros=[1,2,3,4,5,6,7,8,9];

    for(T=0;T<Texto.length;T++){
        for(N=0;N<Numeros.length;N++){
            if(Texto[T]==Numeros[N]){
                TemNumero=true;
            }
        }
    }

    return TemNumero;
}
function VerificarCaractere(Texto){
    let TemCarac=false;
    let Caracteres=['!',"@",'#','$','%','&','*'];

    for(T=0;T<Texto.length;T++){
        for(C=0;C<Caracteres.length;C++){
            if(Texto[T]==Caracteres[C]){
                TemCarac=true;
            }
        }
    }

    return TemCarac;
}
function VerificarQuantidade(Texto){
    let Valido=false;
    if(Texto.length>=8){
        Valido=true;
    }

    return Valido;
}
function VerificarIgualdade(Texto,Texto2){
    let Igual=false;
    if(Texto===Texto2){
        Igual=true;
    }

    return Igual;
}

document.addEventListener('keyup',(e)=>{
    var SenhaTXT=document.getElementById('SenhaTXT');
    var SenhaConfirmTXT=document.getElementById('SenhaConfirmTXT');
    let NumeroTXT=document.getElementById('NumeroTXT');
    let CaractereTXT=document.getElementById('CaractereTXT');
    let Tamanho=document.getElementById('Tamanho');
    let Igual=document.getElementById('Igual');
    let SalvarBTN=document.getElementById('LogarBTN');
    let Ativo=false;

    if(VerificarNumero(SenhaTXT.value)){
        NumeroTXT.textContent='Contém Número';
        NumeroTXT.style.color='green';
    }else{
        NumeroTXT.textContent='Conter Número';
        NumeroTXT.style.color='red';
    }
    if(VerificarCaractere(SenhaTXT.value)){
        CaractereTXT.textContent='Contém Caractere(!@#$%&*)';
        CaractereTXT.style.color='green';
    }else{
        CaractereTXT.textContent='Conter Caractere(!@#$%&*)';
        CaractereTXT.style.color='red';
    }
    if(VerificarQuantidade(SenhaTXT.value)){
        Tamanho.textContent='Contém no mínimo 8 digitos.';
        Tamanho.style.color='green';
    }else{
        Tamanho.textContent='Conter no mínimo 8 digitos.';
        Tamanho.style.color='red';
    }
    if(VerificarIgualdade(SenhaTXT.value,SenhaConfirmTXT.value)){
        Igual.textContent='As senhas são iguais.';
        Igual.style.color='green';
    }else{
        Igual.textContent='As senhas devem ser iguais.';
        Igual.style.color='red';
    }

    if(VerificarNumero(SenhaTXT.value)&&VerificarCaractere(SenhaTXT.value)&&VerificarQuantidade(SenhaTXT.value)&&VerificarIgualdade(SenhaTXT.value,SenhaConfirmTXT.value)){
        Ativo=true;
    }else{
        Ativo=false;
    }

    if(Ativo==true){
        SalvarBTN.classList.replace('Desativado','Ativado');
    }else{
        SalvarBTN.classList.replace('Ativado','Desativado');
    }
    
});


