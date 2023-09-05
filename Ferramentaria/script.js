let PesquisarTXT=document.getElementById('PesquisarTXT');
let PesquisarBTN=document.getElementById('PesquisarBTN');
let Modal=document.getElementById('Fundo');
var EditarAtivo=true;

var FiltrosVisivel=false;

function Filtros(){
    FiltrosVisivel=!FiltrosVisivel;
    let FiltrosDIV=document.getElementById('FiltrosDIV');
    let FiltrosBTN=document.getElementById('FiltrosBTN');

    if(FiltrosVisivel==true){
        FiltrosDIV.style.visibility='visible';
        FiltrosDIV.style.position='relative';
        FiltrosBTN.textContent='Menos Filtros';
    }else{
        FiltrosDIV.style.visibility='hidden';
        FiltrosDIV.style.position='absolute';
        FiltrosBTN.textContent='Mais Filtros';
    }
    
}
function AbrirModal(){
    Modal.style.visibility='visible';
    Modal.style.position='fixed';
    Modal.style.opacity='100%';
}
function FecharModal(){
    Modal.style.visibility='hidden';
    Modal.style.position='absolute';
    Modal.style.opacity='0%';
}
function DecisaoEdit(){
    if(EditarAtivo==true){
        Editar();
    }else{
        Salvar();
    }
}
function Editar(){
    let CB=document.getElementsByName('LinhaCB');
    let Codigo=document.getElementsByName('LinhaCOD');
    let Descricao=document.getElementsByName('LinhaDesc');
    let Local=document.getElementsByName('LinhaLocal');
    let QTD=document.getElementsByName('LinhaQTD');
    let Tipo=document.getElementsByName('LinhaTipo');
    let Secao=document.getElementsByName('LinhaSecao');
    let Linha=document.getElementsByName('Linha');
    let RemoverBTN=document.getElementById('Remover');
    let AdicionarBTN=document.getElementById('Adicionar');
    let EditarBTN=document.getElementById('Editar');
    let QTDChecked=0;

    for(let i=0;i<CB.length;i++){
        if(CB[i].checked){
            QTDChecked++;
        }
    }

    if(QTDChecked>0){
        EditarAtivo=false;
        EditarBTN.style.animation='Rodar linear 1s forwards running';

        for(let i=0;i<CB.length;i++){
            if(CB[i].checked){
                Codigo[i].removeAttribute('readonly');
                Descricao[i].removeAttribute('readonly');
                Local[i].removeAttribute('readonly');
                QTD[i].removeAttribute('readonly');
                Tipo[i].style.touchAction='auto';
                Tipo[i].style.pointerEvents='all';
                Secao[i].style.touchAction='auto';
                Secao[i].style.pointerEvents='all';
                Linha[i].style.backgroundColor='rgb(204, 255, 204)';
                RemoverBTN.setAttribute('disabled',true);
                RemoverBTN.style.filter='grayscale()';
                AdicionarBTN.style.filter='grayscale()';
                CB[i].style.visibility='visible';
            }else{
                CB[i].style.visibility='hidden';
                CB[i].setAttribute('disabled',true);
            }
        }
    }
}
function Salvar(){
    let CB=document.getElementsByName('LinhaCB');
    let ID=document.getElementsByName('LinhaID');
    let Codigo=document.getElementsByName('LinhaCOD');
    let Descricao=document.getElementsByName('LinhaDesc');
    let Local=document.getElementsByName('LinhaLocal');
    let QTD=document.getElementsByName('LinhaQTD');
    let Tipo=document.getElementsByName('LinhaTipo');
    let Secao=document.getElementsByName('LinhaSecao');
    let Linha=document.getElementsByName('Linha');
    let RemoverBTN=document.getElementById('Remover');
    let AdicionarBTN=document.getElementById('Adicionar');
    let EditarBTN=document.getElementById('Editar');
    let QTDChecked=0;
    EditarAtivo=true;

    console.log(Secao.length);

    for(let i=0;i<CB.length;i++){
        if(CB[i].checked){
            QTDChecked++;

            $.ajax({
                method:'post',
                url:'Salvar.php',
                data:{
                    ID: ID[i].value,
                    Codigo: Codigo[i].value,
                    Descricao: Descricao[i].value,
                    Local: Local[i].value,
                    QTD: QTD[i].value,
                    Tipo: Tipo[i].value,
                    Secao: Secao[i].value,
                    Salvar:'Salvar'
                },
                dataType:'json'
            });
        }
    }

    if(QTDChecked<=0){
        Swal.fire('Nenhuma Linha Selecionada','As alterações não foram salvas','info');
    }else{
    }

    EditarBTN.style.animation='Voltar linear 1s forwards running';

    for(let i=0;i<CB.length;i++){
            Codigo[i].setAttribute('readonly','true');
            Descricao[i].setAttribute('readonly','true');
            Local[i].setAttribute('readonly','true');
            QTD[i].setAttribute('readonly','true');
            Tipo[i].style.touchAction='none';
            Tipo[i].style.pointerEvents='none';
            Secao[i].style.touchAction='none';
            Secao[i].style.pointerEvents='none';
            Linha[i].style.backgroundColor='rgb(255,255,255)';
            RemoverBTN.setAttribute('disabled',false);
            RemoverBTN.style.filter='none';
            AdicionarBTN.style.filter='none';
            CB[i].style.visibility='visible';
            CB[i].removeAttribute('disabled');
    }
}
function Deletar(){
    let CB=document.getElementsByName('LinhaCB');
    let ID=document.getElementsByName('LinhaID');
    let QTDChecked=0;
    EditarAtivo=true;

    for(let i=0;i<CB.length;i++){
        if(CB[i].checked){
            QTDChecked++;
        }
    }

    if(QTDChecked>0){

        let Aviso=Swal.fire({
            title:'As linhas selecionadas serão deletadas',
            icon:'warning',
            showCancelButton:true
        });

        for(let i=0;i<CB.length;i++){
            if(CB[i].checked){
                Aviso.then((resposta)=>{
                    if(resposta.isConfirmed==true){
                        $.ajax({
                            method:'post',
                            url:'Salvar.php',
                            data:{
                                ID: ID[i].value,
                                Deletar: 'Deletar'
                            },
                            dataType:'json'
                        });

                        window.location.href='index.php';
                    }
                });
            }
        }

    }
}
