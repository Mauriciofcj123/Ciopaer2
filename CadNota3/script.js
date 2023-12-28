
var PesquisarForm=document.getElementById('PesquisarForm');
var Tabela=document.getElementById('EmpresaTB');
var TipoDIV=document.getElementById('TipoDIV');

document.addEventListener('mousemove',(e)=>{
    let X=((e.clientX-1000)/400)*-1;
    let Y=((e.clientY-1500)/400)*-1;
    TipoDIV.style.boxShadow=X+'px '+Y+'px '+'10px rgba(43, 255, 0,0.8)';

});
function SelecionarTipo(Tipo){
    let FormularioDIV=document.getElementById('FormularioDIV');
    let Formulario=document.createElement('form');
    Formulario.method='post';
    Formulario.action='Salvar.php';
    FormularioDIV.appendChild(Formulario);

    let TipoTXT=document.createElement('input');
    TipoTXT.setAttribute('readonly',true);
    TipoTXT.name='TipoTXT';
    TipoTXT.type='text';
    TipoTXT.value=Tipo;
    Formulario.appendChild(TipoTXT);

    let Botao=document.createElement('button');
    Botao.type='submit';
    Botao.name='SelecionarBTN';
    Formulario.appendChild(Botao);

    Botao.click();
}

