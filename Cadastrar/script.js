var BotãoCriar=document.getElementById('CriarBTN');

document.addEventListener('keyup',function (e){
    VerificarCampos();
    if(e.key='backspace'){
        VerificarCampos();
    }
});
function VerificarNome(){
    let Passou=false;
    let Nome=document.querySelector('#NomeTXT');
    let NomeID=document.getElementById('NomeTXT');

    if(Nome.value==""){
        Passou=false
        NomeID.style.border="none";


    }else{
        Passou=true;
        NomeID.style.border="2px rgb(0, 255, 42) solid";
    }

    return Passou;
}
function VerificarSobrenome(){
    let Passou=false;
    let Sobrenome=document.querySelector('#SobrenomeTXT');
    let SobrenomeID=document.getElementById('SobrenomeTXT');

    if(Sobrenome.value==""){
        Passou=false;
        SobrenomeID.style.border="none";
    }else{
        Passou=true;
        SobrenomeID.style.border="2px rgb(0, 255, 42) solid";

    }
    return Passou;
}

function VerificarEmail(){
    let Passou=false;
    let EmailTXT=document.querySelector('#EmailTXT');
    let EmailID=document.getElementById('EmailTXT');
    let Provedor=document.getElementById('ProvedorTXT');

    if(EmailTXT.value==""){
        Passou=false;
        EmailID.style.border="none";
        Provedor.style.border="none";
    }else{
        Passou=true;
        EmailID.style.border="2px rgb(0, 255, 42) solid";
        Provedor.style.border="2px rgb(0, 255, 42) solid";
    }
    return Passou;
}
function VerificarUsuario(){
    let Passou=false;
    let LoginTXT=document.querySelector('#LoginTXT');
    let LoginID=document.getElementById('LoginTXT');

    if(LoginTXT.value.length<5){
        Passou=false;
        LoginID.style.border="none";
    }else{
        Passou=true;
        LoginID.style.border="2px rgb(0, 255, 42) solid";
    }
    return Passou;
}
function VerificarSenha(){
    let Passou=false;
    let Senha=document.querySelector('#SenhaTXT');
    let RepeteSenha=document.querySelector('#RepeteSenhaTXT');
    let SenhaID=document.getElementById('SenhaTXT');
    let RepeteSenhaID=document.getElementById('RepeteSenhaTXT');

    if(Senha.value.length<5||Senha.value!=RepeteSenha.value){
        Passou=false;
        SenhaID.style.border="none"
        RepeteSenhaID.style.border="none"
    }else{
        Passou=true;
        SenhaID.style.border="2px rgb(0, 255, 42) solid";
        RepeteSenhaID.style.border="2px rgb(0, 255, 42) solid";
    }
    return Passou;
}

function VerificarCampos(){

    if(VerificarNome()&&VerificarSobrenome()&&VerificarEmail()&&VerificarUsuario()&&VerificarSenha()){
        BotãoCriar.style.backgroundColor="rgb(0, 255, 13)";
        BotãoCriar.style.border="rgb(255, 255, 255) 1px solid";
        BotãoCriar.disabled=false;
    }else{
        BotãoCriar.style.backgroundColor='rgb(207, 207, 207)';
        BotãoCriar.style.border="none";
        BotãoCriar.disabled=true;
    }
}