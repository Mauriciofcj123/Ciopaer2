function Sair(){
    window.location.href="Sair.php";
}

var Despachadas=document.getElementById('Despachadas');

document.addEventListener('keydown',function (e){
    if(e.key==='Escape'){
        FecharModalIntervencao();
    }
});

document.addEventListener('keyup', function (e){
    let Caracteres=document.getElementById('Caracteres');
    let CaixaTexto=document.getElementById('CaixaTexto');
    Caracteres.innerHTML=(CaixaTexto.value.length)+"/500";
});

let DiscrepanciasDIV=document.getElementById('Discrepancias');

DiscrepanciasDIV.addEventListener('mouseleave',()=>{
    let MenuDiscrepancias=document.getElementById('MenuDiscrepancias');
    MenuDiscrepancias.style.position='relative';
    MenuDiscrepancias.style.top='0px'
    MenuDiscrepancias.style.backgroundColor='none';
    MenuDiscrepancias.style.width='100%';
    MenuDiscrepancias.style.borderRadius='0px';
    MenuDiscrepancias.style.boxShadow='none';
    MenuDiscrepancias.style.zIndex=1;
    MenuDiscrepancias.style.backdropFilter='none';
});
DiscrepanciasDIV.addEventListener('scroll',()=>{
    let MenuDiscrepancias=document.getElementById('MenuDiscrepancias');

    MenuDiscrepancias.style.position='fixed';
    MenuDiscrepancias.style.top='35%';
    MenuDiscrepancias.style.right='1%'
    MenuDiscrepancias.style.backgroundColor='rgba(255, 255, 255, 0.8)';
    MenuDiscrepancias.style.width='65%';
    MenuDiscrepancias.style.borderRadius='10px';
    MenuDiscrepancias.style.boxShadow='2px 2px 6px rgba(0, 195, 255, 0.6)';
    MenuDiscrepancias.style.zIndex=10;
    MenuDiscrepancias.style.backdropFilter='blur(1px)';

});


function SelecionarLinha(){
    let Linhas=document.getElementsByName('DiscrepanciasTB');
    let Checkbox=document.getElementsByName('CheckboxDiscrepancia');

    for(i=0;i<Checkbox.length;i++){
        if(Checkbox[i].checked){
            Linhas[i].style.backgroundColor='rgba(0, 195, 255, 0.2)';
        }else{
            Linhas[i].style.backgroundColor='white';
        }
    }
}

function Ativar(id,idAtual,Valor){
    let Botoes=document.getElementsByName('Botao'+id);
    let Selecionado=Botoes[idAtual];
    let Status=document.getElementsByName('Status[]')[id];
    let CausaDIV=document.getElementsByName('CausaDIV')[id];
    let CausaTXT=document.getElementsByName('Causa[]')[id];
    let Previsao=document.getElementById('Previsao'+id);

    for(i=0;i<Botoes.length;i++){
        Botoes[i].style.transform='scale(1.0)';
    }
        Selecionado.style.transform='scale(1.2)';
        Status.value=Valor;

    if(Valor=='Disponível'){
        CausaDIV.style.visibility='hidden';
        Previsao.style.visibility='hidden';
        CausaTXT.value='';
    }else{
        CausaDIV.style.visibility='visible';
        Previsao.style.visibility='visible';
    }


}

function AdicionarFone(){
    let CautelaTB=document.getElementById('CautelaTB');
    let NumeroLinhas=CautelaTB.rows.length;
    let Pilotos=document.getElementById('Pilotos');
    let Clone=Pilotos.cloneNode(true);
    Clone.style.visibility='visible';
    Clone.setAttribute('name','ResponsavelOBJ');

    let Linha=CautelaTB.insertRow(NumeroLinhas);
    let Celula1=Linha.insertCell(0);
    let Celula2=Linha.insertCell(1);
    let Celula3=Linha.insertCell(2);

    Linha.classList.add('Objeto');

    Celula1.innerHTML='<input type="checkbox" name="CheckboxAcessorio">';
    Celula2.innerHTML='<img src="Imgs/Fone de ouvido.png" id="Fone de ouvido" name="ObjetoTXT">';
    Celula3.appendChild(Clone);
}

function AdicionarGPS(){
    let CautelaTB=document.getElementById('CautelaTB');
    let Pilotos=document.getElementById('Pilotos');
    let Clone=Pilotos.cloneNode(true);
    Clone.style.visibility='visible';
    Clone.setAttribute('name','ResponsavelOBJ');

    let NumeroLinhas=CautelaTB.rows.length;
    let Linha=CautelaTB.insertRow(NumeroLinhas);
    let Celula1=Linha.insertCell(0);
    let Celula2=Linha.insertCell(1);
    let Celula3=Linha.insertCell(2);

    Linha.classList.add('Objeto');

    Celula1.innerHTML='<input type="checkbox" name="CheckboxAcessorio">';
    Celula2.innerHTML='<img src="Imgs/gps.png" id="GPS" name="ObjetoTXT">';
    Celula3.appendChild(Clone);
}

function RemoverAcessorio(){
    let Checkbox=document.getElementsByName('CheckboxAcessorio');
    let Objetos=document.getElementsByClassName('Objeto');
    let Selecionados=0;

    for(let i=0;i<Checkbox.length;i++){
        if(Checkbox[i].checked){
            Selecionados++;
        }
    }

    for(let i=0;i<Checkbox.length;i++){
        while(Checkbox[i].checked){
            Objetos[i].remove();
        }
    }
}

function RemoverDiscrepancias(){
    let Checkbox =document.getElementsByName('CheckboxDiscrepancia');
    let Discrepancia=document.getElementsByClassName('DiscrepanciasTB');
    let QuantidadeLinhas=document.getElementById('QuantidadeDisc');

    if(Checkbox.length>0){

        for(let i=0;i<Checkbox.length;i++){
            while(Checkbox[i].checked){
                QuantidadeLinhas.textContent='Quantidade: '+(Discrepancia.length-1);
                Discrepancia[i].remove();
            }
        }

    }else{
        QuantidadeLinhas.textContent='Quantidade: 0';
    }

}


function AdicionarDiscrepancia(){
    let Discrepancia=document.getElementById('Discrepancias');
    let Tabela=document.createElement('table');
    let Aeronaves=document.getElementById('Aeronaves');
    let Clone=Aeronaves.cloneNode(true);
    Tabela.setAttribute('name','DiscrepanciasTB');
    Tabela.setAttribute('id','DiscrepanciasTB');
    Tabela.setAttribute('class','DiscrepanciasTB');
    Discrepancia.appendChild(Tabela);

    let Linha=Tabela.insertRow(0);
    Linha.classList.add('TituloDiscrepancia');

    let Celula1=Linha.insertCell(0);
    Celula1.colSpan=4;
    Clone.style.visibility='visible';
    Clone.setAttribute('name','PlacaDisc');
    Celula1.appendChild(Clone);

    let Linha2=Tabela.insertRow(1);
    Linha2.classList.add('Elemento');
    let Celula2=Linha2.insertCell(0);
    let Celula3=Linha2.insertCell(1);
    let Celula4=Linha2.insertCell(2);
    Celula2.innerHTML="<input type='checkbox' name='CheckboxDiscrepancia' id=''>";
    Celula3.innerHTML="<img src='Imgs/alerta.png'>";
    Celula4.innerHTML="<textarea name='DescricaoDisc' maxlength='600'/>";
    Celula4.colSpan=2;
    Celula4.classList.add('DiscrepanciaTXT');

    let Linha3=Tabela.insertRow(2);
    Linha3.classList.add('Elemento');

    let Celula5=Linha3.insertCell(0);
    Celula5.innerHTML="<input type='text' name='MedidaTXT' placeholder='Medida Tomada' value=''>";
    Celula5.colSpan=4;
    
    let QuantidadeLinhas=document.getElementById('QuantidadeDisc');
    let Linhas=document.getElementsByName('DiscrepanciasTB');
    QuantidadeLinhas.textContent='Quantidade:'+ Linhas.length;
}
function AdicionarOBS(){
    let Tabela=document.getElementById('ObservacoesTB');
    let NumeroLinhas=Tabela.rows.length;

    let Linha1=Tabela.insertRow(NumeroLinhas);
    Linha1.setAttribute('name','LinhaOBS');
    let Celula1=Linha1.insertCell(0);
    let Celula2=Linha1.insertCell(1);
    let Celula3=Linha1.insertCell(2);

    Celula1.innerHTML="<input type='checkbox' name='CheckOBS'>";
    Celula2.innerHTML="<img src='Imgs/papel.png'>";
    Celula3.innerHTML="<textarea name='ObservacaoTXT' maxlength='500'></textarea>";

}
function RemoverOBS(){
    let Checkbox =document.getElementsByName('CheckOBS');
    let Observacao=document.getElementsByName('LinhaOBS');

    for(let i=0;i<Checkbox.length;i++){
        while(Checkbox[i].checked){
            Observacao[i].remove();
        }
    }
}
function ResetarModal(){
    let Responsavel=document.getElementsByName('CartãoMec');
    let Mecanicos=document.getElementById('MecanicosTB');
    let Aeronave=document.getElementById('Aeronave');
    let Tipo=document.getElementById('Tipo');
    let Hora=document.getElementById('Hora');
    let Minuto=document.getElementById('Minuto');
    let Segundo=document.getElementById('Segundo');

    Aeronave.value=Aeronave.options[0].value;
    Tipo.value=Tipo.options[0].value;
    for(i=0;i<Responsavel.length;i++){
        let NumeroLinhas = Mecanicos.rows.length;
        let Linha=Mecanicos.insertRow(NumeroLinhas);
        let Celula=Linha.insertCell(0);

        Linha.id=Responsavel[i].id;
        Linha.setAttribute('name','Cartão');

        Celula.innerHTML="<button onClick=\"AdicionarMecanico('"+Responsavel[i].id+"')\">"+Responsavel[i].id+"</button>";
        
    }
    for(i=0;i<Responsavel.length;){
        Responsavel[i].remove();
    }

    let Caracteres=document.getElementById('Caracteres');
    let CaixaTexto=document.getElementById('CaixaTexto');
    CaixaTexto.value="";
    Caracteres.innerHTML="0/500";

    Hora.value=0;
    Minuto.value=0;
    Segundo.value=0;

    
}

function AbrirModalIntervencao(){
    ResetarModal();
   var Modal=document.getElementById('ModalInt');
   let BTNSalvar=document.getElementById('BTNSalvar');
   BTNSalvar.setAttribute('onClick','ConfirmarIntervencao()');

   Modal.style.visibility='visible';
}

var idGlobal=0;

function EditarInt(id){
    ResetarModal();
    let linha=document.getElementsByName("CamposInt");

    
   let Modal=document.getElementById('ModalInt');
   let Aeronave=document.getElementById('Aeronave');
   let Tipo=document.getElementById('Tipo');
   let CaixaTexto=document.getElementById('CaixaTexto');
   let AeronaveTXT=document.getElementsByName('PlacaInt')[id].value;
   let MecanicoTXT=document.getElementsByName('MecanicoInt')[id].value;
   let Mecanicos=MecanicoTXT.split('/');
   let Descricao=document.getElementsByName('DescricaoInt')[id].value;
   let TipoTXT=document.getElementsByName('TipoInt')[id].value;
   let Tempo=document.getElementsByName('TempoInt')[id].value;
   let Tempos=Tempo.split(":");
   let HoraTXT=Tempos[0];
   let MinutosTXT=Tempos[1];
   let SegundosTXT=Tempos[2];
   let Hora=document.getElementById('Hora');
   let Minuto=document.getElementById('Minuto');
   let Segundo=document.getElementById('Segundo');
   let BTNSalvar=document.getElementById('BTNSalvar');
   BTNSalvar.setAttribute('onClick','ConfirmarEdicao('+id+')');

   for(Mec=0;Mec<Mecanicos.length;Mec++){
        AdicionarMecanico(Mecanicos[Mec]);
   }

   Hora.value=HoraTXT.replace('0','');
   Minuto.value=MinutosTXT;
   Segundo.value=SegundosTXT;
   Aeronave.value=AeronaveTXT;
   Tipo.value=TipoTXT;
   CaixaTexto.value=Descricao;
   Modal.style.visibility='visible';
}

function FecharModalIntervencao(){
   let Modal=document.getElementById('ModalInt');

   Modal.style.visibility='hidden';
}

function ContarMecanicos(){
    let IntervencaoTB=document.getElementById('ResponsavelTB');
    let NumeroLinhas=IntervencaoTB.rows.length;
    let Responsaveis="";
    let Mecanicos="";
    let Celulas=IntervencaoTB.getElementsByTagName('td');
    for(let i=0;i<NumeroLinhas-1;i++){
        if(Mecanicos==undefined||Mecanicos.length==0){
            Mecanicos=Celulas[i].textContent;
        }else{
            Mecanicos+='/ '+Celulas[i].textContent;
        }
        Responsaveis=Mecanicos;
   }

   return Responsaveis;
}
function isNumeric(Valor){
    let Caracteres=Valor.length;
    let Aprovado=false;

    for(let i=0;i<Caracteres;i++){
        if(Valor.substring(i,i+1)=='0'||Valor.substring(i,i+1)=='1'||Valor.substring(i,i+1)=='2'||Valor.substring(i,i+1)=='3'||Valor.substring(i,i+1)=='4'||Valor.substring(i,i+1)=='5'||Valor.substring(i,i+1)=='6'||Valor.substring(i,i+1)=='7'||Valor.substring(i,i+1)=='8'||Valor.substring(i,i+1)=='9'){
            Aprovado=true;
        }else{
            Aprovado=false;
        }
    }
    return Aprovado;
}
function VerificarTempo(){
    let Hora=document.getElementById('Hora').value;
    let Minutos=document.getElementById('Minuto').value;
    let Segundos=document.getElementById('Segundo').value;
    let Aprovado=false;
    if(Hora+Minutos+Segundos>0){
        Aprovado=true;
    }else{
        Aprovado=false;
    }
    return Aprovado;
}
function Formatar(Valor){
    let ValorTXT=Valor;
    let Resultado;

    if(ValorTXT<0){
        ValorTXT=0;
    }

    if(ValorTXT.length==0){
        Resultado='00';
    }else if(Valor.length==1){
        Resultado='0'+ValorTXT;
    }else{
        Resultado=ValorTXT;
    }

    return Resultado;
}
function ConfirmarIntervencao(){
   let Aprovado=true;
   let Aeronave=document.getElementById('Aeronave').value;
   let Responsáveis=ContarMecanicos();
   let Tempo;
   let Tipo=document.getElementById('Tipo').value;
   let Descricao=document.getElementById('CaixaTexto').value;

   if(Responsáveis==''||Responsáveis==undefined){
        Aprovado=false;
        alert('Por favor selecione os responsáveis pelo serviço.');
   }

   if(Descricao.length<10){
        Aprovado=false;
        alert('Por favor descreva o que foi realizado na intervenção.');
   }
   
    if(VerificarTempo()){
        let Hora=document.getElementById('Hora').value;
        let Minutos=document.getElementById('Minuto').value;
        let Segundos=document.getElementById('Segundo').value;
           Tempo=Formatar(Hora)+':'+Formatar(Minutos)+':'+Formatar(Segundos);
    }else{
        Aprovado=false;
        alert('Por favor informe a duração do serviço.');
    }

    if(Aprovado){
        let IntervencaoDIV=document.getElementById('IntervencaoDIV');
        let IntervencaoTB=document.createElement('table');
        IntervencaoTB.setAttribute('name','IntervencaoTB');
        IntervencaoDIV.appendChild(IntervencaoTB);
        let NumeroLinhas=document.getElementsByName('IntervencaoTB');
        let IDLocal=0;
        IDLocal=NumeroLinhas.length-1;


        
        let Linha1=IntervencaoTB.insertRow(0);
        Linha1.classList.add('Responsavel');
        Linha1.setAttribute('name','ResponsavelInt');
        let Celula1=Linha1.insertCell(0);
        Celula1.colSpan=7;
        Celula1.innerHTML='<input type="text" name="MecanicoInt" value="'+Responsáveis+'" disabled>';

        let Linha2=IntervencaoTB.insertRow(1);
        Linha2.classList.add('CamposInt');
        Linha2.setAttribute('name','CamposInt');
        let Celula2=Linha2.insertCell(0);
        let Celula3=Linha2.insertCell(1);
        let Celula4=Linha2.insertCell(2);
        let Celula5=Linha2.insertCell(3);
        let Celula6=Linha2.insertCell(4);
        let Celula7=Linha2.insertCell(5);
        Celula2.innerHTML="<input type='checkbox' name='CheckInt'>";
        Celula3.innerHTML='<input type="text" name="PlacaInt" value="'+Aeronave+'" disabled>';
        Celula4.innerHTML='<input type="text" name="DescricaoInt" value="'+Descricao+'" disabled>';
        Celula4.colSpan=2;
        Celula5.innerHTML='<input type="text" name="TipoInt" value="'+Tipo+'" disabled>';
        Celula6.innerHTML='<input type="text" name="TempoInt" value="'+Tempo+'" disabled>';
        Celula7.innerHTML="<button onClick='EditarInt("+IDLocal+")'><img src='Imgs/editar.png'></button></img>";

        console.log(IntervencaoTB.rows.length);
        FecharModalIntervencao();

    }
}

function ConfirmarEdicao(id){
   let Aprovado=true;
   let Aeronave=document.getElementById('Aeronave').value;
   let Responsáveis=ContarMecanicos();
   let Tempo;
   let Tipo=document.getElementById('Tipo').value;
   let Descricao=document.getElementById('CaixaTexto').value;
   idGlobal=id;

   if(Responsáveis==''||Responsáveis==undefined){
        Aprovado=false;
        alert('Por favor selecione os responsáveis pelo serviço.');
   }

   if(Descricao.length<10){
        Aprovado=false;
        alert('Por favor descreva o que foi realizado na intervenção.');
   }
   
   if(VerificarTempo()){
    let Hora=document.getElementById('Hora').value;
    let Minutos=document.getElementById('Minuto').value;
    let Segundos=document.getElementById('Segundo').value;
       Tempo=Formatar(Hora)+':'+Formatar(Minutos)+':'+Formatar(Segundos);
    }else{
        Aprovado=false;
        alert('Por favor informe a duração do serviço.');
    }

    if(Aprovado){
        RemoverIntervencaoID(id);
        let IntervencaoDIV=document.getElementById('IntervencaoDIV');
        let IntervencaoTB=document.createElement('table');
        IntervencaoTB.setAttribute('name','IntervencaoTB');
        IntervencaoDIV.appendChild(IntervencaoTB);

        let Linha1=IntervencaoTB.insertRow(0);
        Linha1.classList.add('Responsavel');
        Linha1.setAttribute('name','ResponsavelInt');
        let Celula1=Linha1.insertCell(0);
        Celula1.colSpan=6;
        Celula1.innerHTML='<input type="text" name="MecanicoInt" value="'+Responsáveis+'" disabled>';

        let Linha2=IntervencaoTB.insertRow(1);
        Linha2.classList.add('CamposInt');
        Linha2.setAttribute('name','CamposInt');
        let Celula2=Linha2.insertCell(0);
        let Celula3=Linha2.insertCell(1);
        let Celula4=Linha2.insertCell(2);
        let Celula5=Linha2.insertCell(3);
        let Celula6=Linha2.insertCell(4);
        let Celula7=Linha2.insertCell(5);
        Celula2.innerHTML="<input type='checkbox' name='CheckInt'>";
        Celula3.innerHTML='<input type="text" name="PlacaInt" value="'+Aeronave+'" disabled>';
        Celula4.innerHTML='<input type="text" name="DescricaoInt" value="'+Descricao+'" disabled>';
        Celula4.colSpan=2;
        Celula5.innerHTML='<input type="text" name="TipoInt" value="'+Tipo+'" disabled>';
        Celula6.innerHTML='<input type="text" name="TempoInt" value="'+Tempo+'" disabled>';
        Celula7.innerHTML="<button onClick='EditarInt("+idGlobal+")'><img src='Imgs/editar.png'></button></img>";
        FecharModalIntervencao();


    }
}
function RemoverIntervencao(){

    let Linha=document.getElementsByName('IntervencaoTB');
    let Checkbox=document.getElementsByName('CheckInt');

    for(let i=0;i<Checkbox.length;i++){
        while(Checkbox[i].checked){
            Linha[i].remove();
        }
    }
}
function RemoverIntervencaoID(id){

    let Linha=document.getElementsByName('IntervencaoTB');
    console.log(Linha.length);
    console.log(id);

    if(Linha.length>0){
        Linha[idGlobal].remove();
    }


}

function AdicionarMecanico(Texto){
    let Responsavel=document.getElementById('ResponsavelTB');
    let Cartões=document.getElementsByName('Cartão');

    let NumeroLinhas = Responsavel.rows.length;
    let Linha=Responsavel.insertRow(NumeroLinhas);
    let Celula=Linha.insertCell(0);
    Linha.id=Texto;
    Linha.setAttribute('name','CartãoMec');

    Celula.innerHTML="<button onclick=\"RemoverMecanico('"+Texto+"')\">"+Texto+"</button>";


    for(let i=0;i<Cartões.length;i++){
        if(Cartões[i].id==Texto){
            Cartões[i].remove();
        }
    }
}

function RemoverMecanico(Texto){
    let Mecanicos=document.getElementById('MecanicosTB');
    let CartõesMec=document.getElementsByName('CartãoMec');

    let NumeroLinhas = Mecanicos.rows.length;
    let Linha=Mecanicos.insertRow(NumeroLinhas);

    let Celula=Linha.insertCell(0);
    Linha.id=Texto;
    Linha.setAttribute('name','Cartão');

    Celula.innerHTML="<button onClick=\"AdicionarMecanico('"+Texto+"')\">"+Texto+"</button>";


    for(let i=0;i<CartõesMec.length;i++){
        if(CartõesMec[i].id==Texto){
            CartõesMec[i].remove();
        }
    }
}
function ListarDisponibilidade(Formulario){
    let Filhos = document.getElementById('AeronavesDIV').children;
    let Status=document.getElementsByName('Status[]');
    let Causa=document.getElementsByName('Causa[]');
    let Previsao=document.getElementsByName('Previsao');

    let Disponibilidade=document.createElement("div");
    Disponibilidade.setAttribute('name','Disponibilidades');
    Formulario.appendChild(Disponibilidade);


    for(let i=0;i<Filhos.length;i++){

            var DIVAeronave=document.createElement("div");
            DIVAeronave.setAttribute('name','Disponibilidade');
            Disponibilidade.appendChild(DIVAeronave);

            let Input=document.createElement('input');
            Input.setAttribute('name', 'PlacaDisp[]')
            Input.setAttribute('value', Filhos[i].id);
            DIVAeronave.appendChild(Input);


            let Input2=document.createElement('input');
            Input2.setAttribute('name', 'StatusDisp[]');
            Input2.setAttribute('value', Status[i].value);
            DIVAeronave.appendChild(Input2);

            if(Causa[i].value==""||Causa[i].value==undefined){
                Causa[i].value="";
            }

            let Input3=document.createElement('input');
            Input3.setAttribute('name', 'CausaDisp[]')
            Input3.setAttribute('value', Causa[i].value);
            DIVAeronave.appendChild(Input3);

            let Input4=document.createElement('input');
            Input4.setAttribute('name', 'PrevisaoDisp[]')
            DIVAeronave.appendChild(Input4);

            if(Status[i].value=='Disponível'){
                Input4.value="";
            }else{
                Input4.value=Previsao[i].options[Previsao[i].selectedIndex].value;
            }

    }
}
function VerificarDisponibilidade(){
    let Status=document.getElementsByName('Status[]');
    let Causa=document.getElementsByName('Causa[]');
    let Valido=true;

    for(i=0;i<Status.length;i++){

        if(Causa[i].value.length<=0 && Status[i].value=='Indisponivel'){
            Valido=false;
        }else if(Causa[i].value.length<=0 && Status[i].value=='Despachada'){
            Valido=false;
        }
    }
    return Valido;
}

function ListarDiscrepancias(Formulario){
    var Tabelas =document.getElementsByName('DiscrepanciasTB');
    var Placas = document.getElementsByName('PlacaDisc');
    var Descricao = document.getElementsByName('DescricaoDisc');
    var Medidas = document.getElementsByName('MedidaTXT');
    let DIV=document.getElementById('FormularioDIV');

    let Discrepancias=document.createElement("div");
    Discrepancias.setAttribute('name','Discrepancias');
    Formulario.appendChild(Discrepancias);


    for(let i=0;i<Tabelas.length;i++){
        if(Descricao[i].value.length>0){
            var PlacaTXT=Placas[i].options[Placas[i].selectedIndex].value;
            var DescricaoTXT=Descricao[i].value;
            var MedidaTXT=Medidas[i].value;

            let DIVDiscrepancia=document.createElement("div");
            DIVDiscrepancia.setAttribute('name','Discrepancia');
            Discrepancias.appendChild(DIVDiscrepancia);

            let Input=document.createElement('input');
            Input.setAttribute('name', 'PlacaDisc[]')
            Input.value=PlacaTXT;
            DIVDiscrepancia.appendChild(Input);

            let Input2=document.createElement('input');
            Input2.setAttribute('name', 'Descricao[]')
            Input2.value=DescricaoTXT;
            DIVDiscrepancia.appendChild(Input2);

            let Input3=document.createElement('input');
            Input3.setAttribute('name', 'MedidaTXT[]')
            Input3.value=MedidaTXT.toUpperCase();
            DIVDiscrepancia.appendChild(Input3);
        }

    }
}

function ListarIntervencao(Formulario){
    let Responsavel = document.getElementsByName('MecanicoInt');
    let Placas = document.getElementsByName('PlacaInt');
    let Descricao = document.getElementsByName('DescricaoInt');
    let Tipo = document.getElementsByName('TipoInt');
    let Tempo = document.getElementsByName('TempoInt');

    let Intervencoes=document.createElement("div");
    Intervencoes.setAttribute('name','Intervencoes');
    Formulario.appendChild(Intervencoes);


    for(let i=0;i<Responsavel.length;i++){


        var DIVIntervencao=document.createElement("div");
        DIVIntervencao.setAttribute('name','Intervencao');
        Intervencoes.appendChild(DIVIntervencao);

            var Input=document.createElement('input');
            Input.setAttribute('name', 'ResponsavelInt[]')
            Input.setAttribute('value', Responsavel[i].value);
            DIVIntervencao.appendChild(Input);


            let Input1=document.createElement('input');
            Input1.setAttribute('name', 'PlacaInt[]');
            Input1.setAttribute('value', Placas[i].value);
            DIVIntervencao.appendChild(Input1);

            let Input2=document.createElement('input');
            Input2.setAttribute('name', 'DescricaoInt[]');
            Input2.setAttribute('value', Descricao[i].value);
            DIVIntervencao.appendChild(Input2);

            let Input3=document.createElement('input');
            Input3.setAttribute('name', 'TipoInt[]');
            Input3.setAttribute('value', Tipo[i].value);
            DIVIntervencao.appendChild(Input3);

            let Input4=document.createElement('input');
            Input4.setAttribute('name', 'TempoInt[]');
            Input4.setAttribute('value', Tempo[i].value);
            DIVIntervencao.appendChild(Input4);

    }

}

function ListarCautelados(Formulario){
    let Objeto = document.getElementsByName('ObjetoTXT');
    let Responsavel = document.getElementsByName('ResponsavelOBJ');

    let Objetos=document.createElement("div");
    Objetos.setAttribute('name','Objetos');
    Formulario.appendChild(Objetos);

    for(let y=0;y<Objeto.length;y++){

            if(Objeto[y].id!=""){
                let DIVObjetos=document.createElement("div");
                DIVObjetos.setAttribute('name','Objeto');
                Objetos.appendChild(DIVObjetos);
    
                let Input=document.createElement('input');
                Input.setAttribute('name', 'ObjetoTXT[]')
                Input.setAttribute('value', Objeto[y].id);
                Input.setAttribute('type','text');
                DIVObjetos.appendChild(Input);
    
    
                let Input2=document.createElement('input');
                Input2.setAttribute('name', 'ResponsavelOBJ[]');
                Input2.setAttribute('value', Responsavel[y].options[Responsavel[y].selectedIndex].value);
                Input2.setAttribute('type','text');
                DIVObjetos.appendChild(Input2); 
            }
    }

}
function ListarOBS(Formulario){
    var Observacao = document.getElementsByName('ObservacaoTXT');
    var Tamanho=Observacao.length;

    let Observacoes=document.createElement("div");
    Observacoes.setAttribute('name','Observacoes');
    Formulario.appendChild(Observacoes);

    for(O=0;O<Tamanho;O++){

        if(Observacao[O].value.length>0){
            let DIVObservacoes=document.createElement("div");
            DIVObservacoes.setAttribute('name','Observacao');
            Observacoes.appendChild(DIVObservacoes);

            let Input=document.createElement('input');
            Input.setAttribute('name', 'ObservacaoTXT[]')
            Input.setAttribute('value', Observacao[O].value);
            DIVObservacoes.appendChild(Input);
        }
    }
    

}
function FecharAviso(){
    let AvisoDIV=document.getElementById('Aviso');
    AvisoDIV.style.opacity='0%';
    AvisoDIV.style.visibility='hidden';
}
function AbrirAviso(){
    let AvisoDIV=document.getElementById('Aviso');
    AvisoDIV.style.visibility='visible';
    AvisoDIV.style.opacity='100%';
}
function Salvar(){

    let DIV=document.getElementById('FormularioDIV');
    let Formulario=document.createElement("form");
    Formulario.setAttribute('method','post');
    Formulario.setAttribute('action','Salvar.php');
    Formulario.setAttribute('name','FormularioGeral');
    Formulario.style.visibility='visible';
    DIV.appendChild(Formulario);

    ListarDisponibilidade(Formulario);
    ListarDiscrepancias(Formulario);
    ListarIntervencao(Formulario);
    ListarCautelados(Formulario);
    ListarOBS(Formulario);

    let Data=document.getElementById('DataTXT');
    let InputData=document.createElement('input');
    InputData.setAttribute('name','Data');
    InputData.setAttribute('value',Data.value);
    Formulario.appendChild(InputData);

    let MecanicoDia=document.getElementById('MecanicoDia');
    let InputMec=document.createElement('input');
    InputMec.setAttribute('name','MecanicoDia');
    InputMec.setAttribute('value',MecanicoDia.value);
    Formulario.appendChild(InputMec);

    let Secao=document.getElementById('Secao');
    let SecaoInput=document.createElement('input');
    SecaoInput.setAttribute('name','Secao');
    SecaoInput.setAttribute('value',Secao.value);
    Formulario.appendChild(SecaoInput);

    let Submit=document.createElement('input');
    Submit.setAttribute('type','submit');
    Submit.setAttribute('name','SalvarBTN');
    Formulario.appendChild(Submit);
    
    if(VerificarDisponibilidade()){
        //Submit.click();
    }else{
        alert('Todas as causas são obrigatórias.');
    }
}







