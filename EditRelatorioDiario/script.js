function Sair(){
    window.location.href="Sair.php";
}

var Despachadas=document.getElementById('Despachadas');


function Ativar(id,Nome,Texto){
    let IDTXT=Nome+id;
    let BotãoSelecionado=document.getElementById(IDTXT);
    let DisponivelBTN=document.getElementById("Disponiveis"+id);
    let IndisponivelBTN=document.getElementById("Indisponiveis"+id);
    let DespachadaBTN=document.getElementById("Despachadas"+id);
    let StatusTXT=document.getElementById("Status"+id);
    let CausaTXT=document.getElementById("Causa"+id);
    let CausaLB=document.getElementById("CausaLB"+id);

    if(DisponivelBTN.className=='Selecionada'){
        DisponivelBTN.classList.remove('Selecionada');
        DisponivelBTN.classList.add('Deselecionada');
    }
    if(DespachadaBTN.className=='Selecionada'){
        DespachadaBTN.classList.remove('Selecionada');
        DespachadaBTN.classList.add('Deselecionada');
    }
    if(IndisponivelBTN.className=='Selecionada'){
        IndisponivelBTN.classList.remove('Selecionada');
        IndisponivelBTN.classList.add('Deselecionada');
    }

    if(BotãoSelecionado.className='Deselecionada'){
        BotãoSelecionado.classList.remove('Deselecionada');
        BotãoSelecionado.classList.add('Selecionada');
    }

    if(Texto!='Disponível'){
        CausaTXT.style.visibility="visible";
        console.log(CausaTXT.value);
    }else{
        CausaTXT.style.visibility="hidden";
    }
    
    StatusTXT.value=Texto;

}

function AdicionarFone(){
    let CautelaTB=document.getElementById('CautelaTB');
    let NumeroLinhas=CautelaTB.rows.length;

    let Linha=CautelaTB.insertRow(NumeroLinhas);
    let Celula1=Linha.insertCell(0);
    let Celula2=Linha.insertCell(1);
    let Celula3=Linha.insertCell(2);

    Linha.classList.add('Objeto');

    Celula1.innerHTML='<input type="checkbox" name="CheckboxAcessorio" id="">';
    Celula2.innerHTML='<img src="Imgs/Fone de ouvido.png">';
    Celula3.innerHTML='<input type="text">';   
}

function RemoverAcessorio(){
    let Checkbox=document.getElementsByName('CheckboxAcessorio');
    let Objetos=document.getElementsByClassName('Objeto');

    for(let i=0;i<Checkbox.length;i++){
        if(Checkbox[i].checked==true){
            Objetos[i].remove();
        }
    }
}