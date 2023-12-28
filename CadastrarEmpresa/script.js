var ConsultarBTN=document.getElementById('consultarBTN');
var RegistroTXT=document.getElementById('RegistroTXT');
var CNPJTXT=document.getElementById('CNPJ');
var Nome=document.getElementById('Nome');
var Fantasia=document.getElementById('Fantasia');
var Situcao=document.getElementById('Situacao');
var DataAbertura=document.getElementById('DataAbertura');
var Informacao=document.getElementById('Informacao');


RegistroTXT.addEventListener('keyup',()=>{
    $('#RegistroTXT').mask('00.000.000/0000-00');
    if(RegistroTXT.value.length>=18){
        ConsultarCNPJ();
    }
});


function removercaracteres(texto){
    let Texto=texto.replace('.','');
    Texto=Texto.replace('.','');
    Texto=Texto.replace('.','');
    Texto=Texto.replace('/','');
    Texto=Texto.replace('-','');

    return Texto;
}

function ConsultarCNPJ(){
    let Valido=true;
    var CNPJ=removercaracteres(RegistroTXT.value);

    if(RegistroTXT.value.length<18){
        Valido=false;
    }else{
        $.ajax({
            url:"https://www.receitaws.com.br/v1/cnpj/"+CNPJ,
            method:'post',
            dataType:'jsonp',
        }).done((result)=>{
            if(result.cnpj!=RegistroTXT.value){
                Valido=false;
                Nome.value="";
                Situcao.value="";
                DataAbertura.value="";
                Fantasia.value="";
            }else{
                Valido=true;
                Nome.value=result.nome;
                Situcao.value=result.situacao;
                DataAbertura.value=result.abertura;
                CNPJTXT.value=result.cnpj;
                Informacao.style.visibility='visible';
                Informacao.style.position='relative';

                if(result.situacao!='ATIVA'){
                    Situcao.style.backgroundColor='rgb(255, 198, 198)';
                }else{
                    Situcao.style.backgroundColor='rgb(255,255,255)';
                }

                if(result.fantasia!=""){
                    Fantasia.value=result.fantasia;
                }else{
                    Fantasia.value='-';
                }
            }
        });
    }
    return Valido;
}