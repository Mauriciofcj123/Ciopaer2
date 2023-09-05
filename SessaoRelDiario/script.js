const Corpo=document.getElementById('Corpo');

let Fixa=document.getElementById('Fixa');
Fixa.addEventListener('click',()=>{
    let Formulario=document.createElement('form');
    Formulario.setAttribute('action','../RelatorioDiarioLib/index.php');
    Formulario.method='post';
    Formulario.style.visibility='hidden';
    Corpo.appendChild(Formulario);

    let Campo=document.createElement('input');
    Campo.value='Tecnica Asa Fixa';
    Campo.setAttribute('name','SecaoTXT');
    Campo.setAttribute('readonly',true);
    Formulario.appendChild(Campo);

    let Submit=document.createElement('button');
    Submit.name='SecaoBTN';
    Submit.type='submit';
    Formulario.appendChild(Submit);
    Submit.click();
});


let Rotativa=document.getElementById('Rotativa');

Rotativa.addEventListener('click',()=>{
    let Formulario=document.createElement('form');
    Formulario.setAttribute('action','../RelatorioDiarioLib/index.php');
    Formulario.method='post';
    Formulario.style.visibility='hidden';
    Corpo.appendChild(Formulario);

    let Campo=document.createElement('input');
    Campo.value='Tecnica Asa Rotativa';
    Campo.setAttribute('name','SecaoTXT');
    Campo.setAttribute('readonly',true);
    Formulario.appendChild(Campo);

    let Submit=document.createElement('button');
    Submit.name='SecaoBTN';
    Submit.type='submit';
    Formulario.appendChild(Submit);
    Submit.click();
});
