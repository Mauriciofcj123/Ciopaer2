document.addEventListener('click',()=>{
    let Titulo=document.getElementById('TituloTXT');
    let Tarefa=document.getElementById('Tarefa');
    let SalvarBTN=document.getElementById('EnviarBTN');
    let DestinatariosCB=document.getElementsByName('checkbox');
    let Quantidade=0;

    for(i=0;i<DestinatariosCB.length;i++){
        if(DestinatariosCB[i].checked){
            Quantidade++;
        }
    }

    if(Titulo.value.length<=0||Tarefa.value.length<=0||Quantidade<=0){
        SalvarBTN.style.visibility='hidden';
    }else{
        SalvarBTN.style.visibility='visible';
    }
});

document.addEventListener('keyup',()=>{
    let Titulo=document.getElementById('TituloTXT');
    let Tarefa=document.getElementById('Tarefa');
    let SalvarBTN=document.getElementById('EnviarBTN');
    let DestinatariosCB=document.getElementsByName('checkbox');
    let Quantidade=0;

    for(i=0;i<DestinatariosCB.length;i++){
        if(DestinatariosCB[i].checked){
            Quantidade++;
        }
    }

    if(Titulo.value.length<=0||Tarefa.value.length<=0||Quantidade<=0){
        SalvarBTN.style.visibility='hidden';
    }else{
        SalvarBTN.style.visibility='visible';
    }

});

document.addEventListener('keydown',()=>{
    let Titulo=document.getElementById('TituloTXT');
    let Tarefa=document.getElementById('Tarefa');

    if(Titulo.value.length>=50){
        Titulo.value=Titulo.value.substring(0,50);
    }

    if(Tarefa.value.length>=250){
        Tarefa.value=Tarefa.value.substring(0,250);
    }
});

function FecharModal(){
    let Modal=document.getElementById('ModalTarefa');
    let FormularioDIV=document.getElementById('FormularioDIV');
    Modal.style.visibility='hidden';
    FormularioDIV.style.width='50%';
    FormularioDIV.style.height='50%';
    FormularioDIV.style.opacity='0%';
}

function AbrirModal(){
    let Modal=document.getElementById('ModalTarefa');
    let FormularioDIV=document.getElementById('FormularioDIV');
    Modal.style.visibility='visible';
    FormularioDIV.style.transitionDuration='1s';
    FormularioDIV.style.width='80%';
    FormularioDIV.style.height='90%';
    FormularioDIV.style.opacity='100%';
}

function Salvar(){
    let DestinatariosCB=document.getElementsByName('checkbox');
    let DestinatariosTXT=document.getElementsByName('DestinatarioTXT');
    let Titulo=document.getElementById('TituloTXT');
    let Tarefa=document.getElementById('Tarefa');
    let Data=document.getElementById('DataTXT');

    let DIV=document.getElementById('FormularioDIV');
    let Formulario=document.createElement('form');
    Formulario.setAttribute('method','post');
    Formulario.setAttribute('action','');
    Formulario.style.position='fixed';
    DIV.appendChild(Formulario);

    let input1=document.createElement('input');
    input1.setAttribute('name','Destinatario');

    if(DestinatariosCB[0].checked){
        input1.value='Todos';
    }else{
        for(i=1;i<DestinatariosCB.length;i++){
            if(DestinatariosCB[i].checked){
                input1.value=input1.value+'/'+DestinatariosTXT[i].value+'/';
            }
        }
    }
    Formulario.appendChild(input1);

    let input2=document.createElement('input');
    input2.setAttribute('name','Titulo');
    input2.value=Titulo.value;
    Formulario.appendChild(input2);

    let input3=document.createElement('input');
    input3.setAttribute('name','Tarefa');
    input3.value=Tarefa.value;
    Formulario.appendChild(input3);

    if(DataTXT.value!=''){
        let input4=document.createElement('input');
        input4.setAttribute('name','Data');
        input4.value=Data.value;
        Formulario.appendChild(input4);
    }

    let Botao=document.createElement('button');
    Botao.setAttribute('type','submit');
    Botao.setAttribute('name','EnviarBTN');
    Formulario.appendChild(Botao);
    Botao.click();
}