document.addEventListener('click',()=>{
    let Titulo=document.getElementById('TituloTXT');
    let Tarefa=document.getElementById('Tarefa');
    let SalvarBTN=document.getElementById('EnviarBTN');
    let DestinatariosCB=document.getElementsByName('checkbox');
    let TodosCB=document.getElementsByName('checkbox')[0];

    let Quantidade=0;

    for(i=0;i<DestinatariosCB.length;i++){
        if(DestinatariosCB[i].checked){
            Quantidade++;
        }
    }
    if(Quantidade<DestinatariosCB.length){
        TodosCB.checked=false;
    }


    if(Titulo.value.length<=0||Tarefa.value.length<=0||Quantidade<=0){
        SalvarBTN.style.visibility='hidden';
    }else{
        SalvarBTN.style.visibility='visible';
    }
});

let TodosCB=document.getElementsByName('checkbox')[0];

TodosCB.addEventListener('click',()=>{
    let DestinatariosCB=document.getElementsByName('checkbox');
    let TodosCB=document.getElementsByName('checkbox')[0];
    for(i=0;i<DestinatariosCB.length;i++){
        DestinatariosCB[i].checked=TodosCB.checked;
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
    Formulario.setAttribute('action','salvar.php');
    Formulario.style.position='fixed';
    Formulario.style.visibility='hidden';
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

function Resolver(id){
    let DIV=document.getElementById('body');
    let Formulario=document.createElement('form');
    Formulario.setAttribute('method','post');
    Formulario.setAttribute('action','salvar.php');
    Formulario.style.position='fixed';
    DIV.appendChild(Formulario);

    let input1=document.createElement('input');
    input1.setAttribute('name','ID');
    input1.value=id;
    Formulario.appendChild(input1);

    let NomeUsuario=document.getElementById('NomeUsuario');
    let input2=document.createElement('input');
    input2.setAttribute('name','Realizador');
    input2.value=NomeUsuario.value;
    Formulario.appendChild(input2);

    let Data=new Date();
    let Dia=String(Data.getDate()).padStart(2,'0');
    let Mes=String(Data.getMonth()+1).padStart(2,'0');
    let Ano=String(Data.getFullYear());
    let DataRealizacao=Ano+'-'+Mes+'-'+Dia;

    let input3=document.createElement('input');
    input3.setAttribute('name','DataRealizacao');
    input3.value=DataRealizacao;
    Formulario.appendChild(input3);

    let Botao=document.createElement('button');
    Botao.setAttribute('type','submit');
    Botao.setAttribute('name','ResolverBTN');
    Formulario.appendChild(Botao);

    $.ajax({
        url:'Resolver.php',
        method:'POST',
        data:{
            ID:input1.value=id,
            Realizador: NomeUsuario.value,
            DataRealizacao:DataRealizacao,
        },
        dataTyoe: 'json'
    }).done((Resultado)=>{
        if(Resultado=='OK'){
            Swal.fire('Sucesso','Missão Cumprida','success');
        }
    });

    //Botao.click();
}