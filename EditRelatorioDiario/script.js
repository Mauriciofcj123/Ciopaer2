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
    Caracteres.innerHTML=(CaixaTexto.value.length)+"/120";
});



function Ativar(id,Nome,Valor){
    let Botoes=document.getElementsByName('Botao'+id);
    let Selecionado=document.getElementById(Nome+id);
    let Status=document.getElementsByName('Status[]');
    let Causa=document.getElementById('Causa'+id);
    let CausaTXT=Causa.children;

    for(i=0;i<Botoes.length;i++){
        Botoes[i].style.transform='scale(1.0)';
    }
    Selecionado.style.transform='scale(1.2)';
    Status[id-1].value=Valor;

    if(Valor=='Disponível'){
        Causa.style.visibility='hidden';
        CausaTXT[1].value='';
    }else{
        Causa.style.visibility='visible';
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

    for(let i=0;i<Checkbox.length;i++){
        while(Checkbox[i].checked){
            Discrepancia[i].remove();
        }
    }
}


function AdicionarDiscrepancia(){
    let Discrepancia=document.getElementById('Discrepancias');
    let Tabela=document.createElement('table');
    let Aeronaves=document.getElementById('Aeronaves');
    let Clone=Aeronaves.cloneNode(true);
    Clone.style.visibility='visible';

    Tabela.setAttribute('name','DiscrepanciasTB');
    Tabela.setAttribute('id','DiscrepanciasTB');
    Tabela.setAttribute('class','DiscrepanciasTB');
    Discrepancia.appendChild(Tabela);

    let Linha=Tabela.insertRow(0);
    Linha.classList.add('TituloDiscrepancia');

    let Celula1=Linha.insertCell(0);
    Celula1.appendChild(Clone);
    Celula1.colSpan=4;

    let Linha2=Tabela.insertRow(1);
    Linha2.classList.add('Elemento');
    let Celula2=Linha2.insertCell(0);
    let Celula3=Linha2.insertCell(1);
    let Celula4=Linha2.insertCell(2);
    Celula2.innerHTML="<input type='checkbox' name='CheckboxDiscrepancia' id=''>";
    Celula3.innerHTML="<img src='Imgs/alerta.png'>";
    Celula4.innerHTML="<textarea name='DescricaoDisc'/>";
    Celula4.colSpan=2;
    Celula4.classList.add('DiscrepanciaTXT');
}
function AdicionarOBS(){
    let Tabela=document.getElementById('ObservacoesTB');
    let NumeroLinhas=Tabela.rows.length;

    let Linha1=Tabela.insertRow(NumeroLinhas);
    let Celula1=Linha1.insertCell(0);
    let Celula2=Linha1.insertCell(1);
    let Celula3=Linha1.insertCell(2);

    Celula1.innerHTML="<input type='checkbox' name='CheckOBS'>";
    Celula2.innerHTML="<img src='Imgs/papel.png'>";
    Celula3.innerHTML="<textarea name='ObservacaoTXT'></textarea>";

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
    Caracteres.innerHTML="0/120";

    Hora.value=0;
    Minuto.value=0;
    Segundo.value=0;

    
}

function AbrirModalIntervencao(){
    ResetarModal();
   var Modal=document.getElementById('ModalInt');

   Modal.style.visibility='visible';
}

var idGlobal="";

function EditarInt(id){
    ResetarModal();
    idGlobal=id;
   let Modal=document.getElementById('ModalInt');
   let Aeronave=document.getElementById('Aeronave');
   let Tipo=document.getElementById('Tipo');
   let CaixaTexto=document.getElementById('CaixaTexto');
   let AeronaveTXT=document.getElementsByName('PlacaInt')[id-1].value;
   let MecanicoTXT=document.getElementsByName('ResponsavelInt')[id-1].value;
   let Mecanicos=MecanicoTXT.split('/');
   let Descricao=document.getElementsByName('DescricaoInt')[id-1].value;
   let TipoTXT=document.getElementsByName('TipoInt')[id-1].value;
   let Tempo=document.getElementsByName('TempoInt')[id-1].value;
   let HoraTXT=Tempo.substring(0,2);
   let MinutosTXT=Tempo.substring(3,5);
   let SegundosTXT=Tempo.substring(6,8);
   let Hora=document.getElementById('Hora');
   let Minuto=document.getElementById('Minuto');
   let Segundo=document.getElementById('Segundo');

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
        let HoraTXT;
        if(Hora<10){
            HoraTXT='0'+Hora;
           }else{
            HoraTXT=Hora;
           }
        let Minutos=document.getElementById('Minuto').value;
        let MinutoTXT;
           if(Minutos<10){
            MinutoTXT='0'+Minutos;
           }else{
            MinutoTXT=Minutos;
           }
        let Segundos=document.getElementById('Segundo').value;
        let SegundosTXT;
           if(Segundos<10){
            SegundosTXT='0'+Segundos;
           }else{
            SegundosTXT=Segundos;
           }

           Tempo=HoraTXT+':'+MinutoTXT+':'+SegundosTXT;
    }else{
        Aprovado=false;
        alert('Por favor informe a duração do serviço.');
    }

    if(Aprovado){
        let IntervencaoTB=document.getElementById('IntervencaoTB');
        let NumeroLinhas=IntervencaoTB.getElementsByTagName('tr');


        let Linha2=IntervencaoTB.insertRow(NumeroLinhas);
        Linha2.classList.add('CamposInt');
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
        Celula7.innerHTML="<button onClick='EditarInt("+(NumeroLinhas/2+1)+")'><img src='Imgs/editar.png'></button></img>";

        let Linha1=IntervencaoTB.insertRow(NumeroLinhas);
        Linha1.classList.add('Responsavel');
        let Celula1=Linha1.insertCell(0);
        Celula1.colSpan=7;
        Celula1.innerHTML='<input type="text" name="ResponsavelInt" value="'+Responsáveis+'" disabled>';

        console.log(IntervencaoTB.rows.length);
        FecharModalIntervencao();

    }
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
        let HoraTXT;
            if(Hora<10){
            HoraTXT='0'+Hora;
           }else{
            HoraTXT=Hora;
           }
        let Minutos=document.getElementById('Minuto').value;
        let MinutoTXT;
           if(Minutos<10){
            MinutoTXT='0'+Minutos;
           }else{
            MinutoTXT=Minutos;
           }
        let Segundos=document.getElementById('Segundo').value;
        let SegundosTXT;
           if(Segundos<10){
            SegundosTXT='0'+Segundos;
           }else{
            SegundosTXT=Segundos;
           }

           Tempo=HoraTXT+':'+MinutoTXT+':'+SegundosTXT;
    }else{
        Aprovado=false;
        alert('Por favor informe a duração do serviço.');
    }

    if(Aprovado){
        let IntervencaoTB=document.getElementById('IntervencaoTB');
        let NumeroLinhas=IntervencaoTB.rows.length;
        let Linha2=IntervencaoTB.insertRow(idGlobal);
        Linha2.classList.add('CamposInt');
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
        Celula7.innerHTML="<button onClick='EditarInt("+(NumeroLinhas/2+1)+")'><img src='Imgs/editar.png'></button></img>";

        let Linha1=IntervencaoTB.insertRow(NumeroLinhas);
        Linha1.classList.add('Responsavel');
        let Celula1=Linha1.insertCell(0);
        Celula1.colSpan=6;
        Celula1.innerHTML='<input type="text" name="ResponsavelInt" value="'+Responsáveis+'" disabled>';

        FecharModalIntervencao();

    }
}
function RemoverIntervencao(){

    let IntervencaoTB=document.getElementById('IntervencaoTB');
    let Linha=IntervencaoTB.getElementsByTagName('tr');
    let Checkbox=document.getElementsByName('CheckInt');

    for(let i=0;i<Checkbox.length;i++){
        while(Checkbox[i].checked){
            Linha[i].remove();
        }
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
    let DIV=document.getElementById('FormularioDIV');

    let Discrepancias=document.createElement("div");
    Discrepancias.setAttribute('name','Discrepancias');
    Formulario.appendChild(Discrepancias);


    for(let i=0;i<Tabelas.length;i++){
        if(Descricao[i].value.length>0){
            var PlacaTXT=Placas[i].options[Placas[i].selectedIndex].value;
            var DescricaoTXT=Descricao[i].value;

            let DIVDiscrepancia=document.createElement("div");
            DIVDiscrepancia.setAttribute('name','Discrepancia');
            Discrepancias.appendChild(DIVDiscrepancia);

            let Input=document.createElement('input');
            Input.setAttribute('name', 'PlacaDisc[]')
            Input.setAttribute('value', PlacaTXT);
            DIVDiscrepancia.appendChild(Input);

            let Input2=document.createElement('input');
            Input2.setAttribute('name', 'Descricao[]')
            Input2.setAttribute('value', DescricaoTXT);
            DIVDiscrepancia.appendChild(Input2);
        }

        

    }

}

function ListarIntervencao(Formulario){
    let Responsavel = document.getElementsByName('ResponsavelTXT');
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
            Input2.setAttribute('value', Descricao[i].textContent);
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
    InputMec.setAttribute('value',MecanicoDia.options[MecanicoDia.selectedIndex].value);
    Formulario.appendChild(InputMec);

    let Submit=document.createElement('input');
    Submit.setAttribute('type','submit');
    Submit.setAttribute('name','SalvarBTN');
    Formulario.appendChild(Submit);
    
    if(VerificarDisponibilidade()){
        Submit.click();
    }else{
        alert('Todas as causas são obrigatórias.');
    }
    

}







