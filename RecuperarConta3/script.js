var TemNumero=false;
var TemCarac=false;

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
    let Numeros=[1,2,3,4,5,6,7,8,9];

    for(T=0;T<Texto.length;T++){
        for(N=0;N<Numeros.length;N++){
            if(Texto[T]==Numeros[N]){
                console.log('Tem Numero');
                TemNumero=true;
            }
        }
    }
}

var SenhaTXT=document.getElementById('SenhaTXT');

document.addEventListener('keydown',(e)=>{
    let Caracteres=['!',"@",'#','$','%','&','*'];
    let Texto='Teste';

    for(C=0;C<Caracteres.length;C++){
        if(e.key==Caracteres[C]){
            console.log(Texto[1]);
        }
    }
    for(N=0;N<Numeros.length;N++){
        if(e.key==Numeros[N]){
            Te
            console.log(Numeros[N]);
        }
    }
    
});


