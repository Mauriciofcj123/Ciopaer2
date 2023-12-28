var Pesquisar=document.getElementById('Pesquisar');
var PesquisarForm=document.getElementById('PesquisarForm');
var Tabela=document.getElementById('EmpresaTB');
var TabelaDIV=document.getElementById('TabelaDIV');

Pesquisar.addEventListener('keyup',()=>{
    $.ajax({
        url:'Pesquisar.php',
        method:'post',
        dataType:'json',
        data:{
            PesquisarTXT:Pesquisar.value
        }
    }).done((result)=>{

        let Linhas=document.getElementsByTagName('tr');
        for(L=1;L<Linhas.length;L++){
            Linhas[L].remove();
        }
        
        for(i=0;i<result.length;i++){
            let Linha=document.createElement('tr');
            Tabela.appendChild(Linha);

            let Celula1=document.createElement('td');
            Celula1.textContent=result[i][0];
            Linha.appendChild(Celula1);

            let Celula2=document.createElement('td');
            Celula2.textContent=result[i][1];
            Linha.appendChild(Celula2);

            let Celula3=document.createElement('td');
            Celula3.textContent=result[i][2];
            Linha.appendChild(Celula3);

            let Celula4=document.createElement('td');
            Celula4.innerHTML='<button type="button" onClick="SelecionarEmpresa(\''+result[i][0]+'\')"><img src="Imgs/verificado.png">';
            Linha.appendChild(Celula4);
        }

    });
});

document.addEventListener('mousemove',(e)=>{
    let X=((e.clientX-1000)/400)*-1;
    let Y=((e.clientY-1500)/400)*-1;
    TabelaDIV.style.boxShadow=X+'px '+Y+'px '+'10px rgba(43, 255, 0,0.8)';

});
document.addEventListener('mousemove',(e)=>{
    let X=((e.clientX-1000)/1000)*-1;
    let Y=((e.clientY)/1000)*-1;
    Pesquisar.style.boxShadow=X+'px '+Y+'px '+'10px rgba(43, 255, 0,0.8)';

});
function SelecionarEmpresa(cnpj){
    let FormularioDIV=document.getElementById('FormularioDIV');
    let Formulario=document.createElement('form');
    Formulario.method='post';
    Formulario.action='Salvar.php';
    FormularioDIV.appendChild(Formulario);

    let CNPJTXT=document.createElement('input');
    CNPJTXT.setAttribute('readonly',true);
    CNPJTXT.name='CNPJTXT';
    CNPJTXT.type='text';
    CNPJTXT.value=cnpj;
    Formulario.appendChild(CNPJTXT);

    let Botao=document.createElement('button');
    Botao.type='submit';
    Botao.name='SelecionarBTN';
    Formulario.appendChild(Botao);

    Botao.click();
}

