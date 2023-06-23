function Sair(){
    window.location.href="Sair.php";
}
function CriarImpressao(){
    const Imprimir=document.getElementById('ImprimirDIV');
    const TituloDIV=document.createElement('div');
    TituloDIV.classList.add('TituloDIV');
    Imprimir.appendChild(TituloDIV);

    let Data=document.getElementById('DataTXT').value;
    let DataPDF=document.createElement('label');
    DataPDF.textContent='Data do Serviço: '+Data;
    TituloDIV.appendChild(DataPDF);

    let Espaco=document.createElement('br');
    TituloDIV.appendChild(Espaco);

    let MecanicoNome=document.getElementById('MecanicoNome').value;
    let MecanicoPDF=document.createElement('label');
    MecanicoPDF.textContent='Mecânico de Serviço: '+MecanicoNome;
    TituloDIV.appendChild(MecanicoPDF);

    const CorpoDIV=document.createElement('div');
    CorpoDIV.classList.add('CorpoDIV');
    Imprimir.appendChild(CorpoDIV);

    let Espaco2=document.createElement('br');
    CorpoDIV.appendChild(Espaco2);
    CorpoDIV.appendChild(Espaco2);

    let Titulo1=document.createElement('label');
    Titulo1.textContent='1 - Disponibilidade das Aeronaves';
    Titulo1.style.fontWeight='bold';
    CorpoDIV.appendChild(Titulo1);

    CorpoDIV.appendChild(Espaco2);
    CorpoDIV.appendChild(Espaco2);

    let Titulo2=document.createElement('label');
    Titulo2.textContent='1.1 - Aeronaves Disponíveis:';
    Titulo2.style.position='relative';
    Titulo2.style.left='10px';
    Titulo2.style.fontWeight='bold';
    CorpoDIV.appendChild(Titulo2);

    let PlacasDisp=document.getElementsByName('Disponível');

    for(let i=0;i<PlacasDisp.length;i++){
        let Espaco3=document.createElement('br');
        CorpoDIV.appendChild(Espaco3);

        let Disponivel=document.createElement('label');
        Disponivel.textContent='-'+PlacasDisp[i].textContent;
        Disponivel.style.position='relative';
        Disponivel.style.left='20px';
        CorpoDIV.appendChild(Disponivel);

    }

    let Espaco4=document.createElement('br');

    CorpoDIV.appendChild(Espaco4);
    CorpoDIV.appendChild(Espaco4);

    let Titulo3=document.createElement('label');
    Titulo3.textContent='1.1 - Aeronaves Indisponíveis:';
    Titulo3.style.fontWeight='bold';
    Titulo3.style.position='relative';
    Titulo3.style.left='10px';
    CorpoDIV.appendChild(Titulo3);

    let PlacasInd=document.getElementsByName('Indisponível');

    for(let i=0;i<PlacasInd.length;i++){
        let Espaco3=document.createElement('br');
        CorpoDIV.appendChild(Espaco3);

        let Indisponível=document.createElement('label');
        Indisponível.textContent='-'+PlacasInd[i].textContent+" ("+PlacasInd[i].id.replace('Causa: ','')+")";
        Indisponível.style.position='relative';
        Indisponível.style.left='20px';
        CorpoDIV.appendChild(Indisponível);
    }

    let Espaco5=document.createElement('br');
    CorpoDIV.appendChild(Espaco5);

    let Espaco6=document.createElement('br');
    CorpoDIV.appendChild(Espaco6);

    let Titulo4=document.createElement('label');
    Titulo4.textContent='2 - Serviços do Dia';
    Titulo4.style.fontWeight='bold';
    Titulo4.style.position='relative';
    CorpoDIV.appendChild(Titulo4);

    let Espaco7=document.createElement('br');
    CorpoDIV.appendChild(Espaco7);

    let Titulo5=document.createElement('label');
    Titulo5.textContent='2.1 - Aeronaves Despachadas:';
    Titulo5.style.fontWeight='bold';
    Titulo5.style.position='relative';
    Titulo5.style.left='10px';
    CorpoDIV.appendChild(Titulo5);

    let PlacasDesp=document.getElementsByName('Despachada');

    for(let i=0;i<PlacasDesp.length;i++){
        let Espaco3=document.createElement('br');
        CorpoDIV.appendChild(Espaco3);

        let Despachadas=document.createElement('label');
        Despachadas.textContent='-'+PlacasDesp[i].textContent+" ("+PlacasDesp[i].id+")";
        Despachadas.style.position='relative';
        Despachadas.style.left='20px';
        CorpoDIV.appendChild(Despachadas);
    }

    let Espaco8=document.createElement('br');
    CorpoDIV.appendChild(Espaco8);

    let Espaco9=document.createElement('br');
    CorpoDIV.appendChild(Espaco9);

    let Titulo6=document.createElement('label');
    Titulo6.textContent='2.2 - Intervenções Realizadas na base:';
    Titulo6.style.fontWeight='bold';
    Titulo6.style.position='relative';
    Titulo6.style.left='10px';
    CorpoDIV.appendChild(Titulo6);

    let Espaco10=document.createElement('br');
    CorpoDIV.appendChild(Espaco10);

    let IntervencaoTB=document.createElement('table');
    IntervencaoTB.classList.add('IntervencaoTB');
    CorpoDIV.appendChild(IntervencaoTB);

    let NumeroLinha=IntervencaoTB.rows.length;
    let Linha1=IntervencaoTB.insertRow(NumeroLinha);

    let Celula1=Linha1.insertCell(0);
    let Celula2=Linha1.insertCell(1);
    let Celula3=Linha1.insertCell(2);
    let Celula4=Linha1.insertCell(3);
    let Celula5=Linha1.insertCell(4);

    Celula1.innerHTML='<label>Prefixo</label>';
    Celula2.innerHTML='<label>Descricao</label>';
    Celula3.innerHTML='<label>Responsável</label>';
    Celula4.innerHTML='<label>Tempo</label>';
    Celula5.innerHTML='<label>Tipo</label>';

    let PlacasInt=document.getElementsByName('PlacaInt');
    let ResponsavelInt=document.getElementsByName('ResponsavelInt');
    let DescricaoInt=document.getElementsByName('DescricaoInt');
    let TempoInt=document.getElementsByName('TempoInt');
    let TipoInt=document.getElementsByName('TipoInt');

    for(let i=0;i<PlacasInt.length;i++){

        let NumeroLinha=IntervencaoTB.rows.length;
        let Linha2=IntervencaoTB.insertRow(NumeroLinha);

        let Celula1=Linha2.insertCell(0);
        let Celula2=Linha2.insertCell(1);
        let Celula3=Linha2.insertCell(2);
        let Celula4=Linha2.insertCell(3);
        let Celula5=Linha2.insertCell(4);

        Celula1.innerHTML='<label>'+PlacasInt[i].textContent+'</label>';
        Celula2.innerHTML='<label>'+ResponsavelInt[i].textContent+'</label>';
        Celula3.innerHTML='<label>'+DescricaoInt[i].textContent+'</label>';
        Celula4.innerHTML='<label>'+TempoInt[i].textContent+'</label>';
        Celula5.innerHTML='<label>'+TipoInt[i].textContent.replace('Tipo: ','')+'</label>';

    }

    let PlacasDisc=document.getElementsByName('PlacaDisc');
    let DescricaoDisc=document.getElementsByName('DescricaoDisc');

    let Espaco11=document.createElement('br');
    CorpoDIV.appendChild(Espaco11);

    let Espaco12=document.createElement('br');
    CorpoDIV.appendChild(Espaco12);

    let Titulo7=document.createElement('label');
    Titulo7.textContent='3 - Discrepâncias Pendentes';
    Titulo7.style.fontWeight='bold';
    Titulo7.style.position='relative';
    CorpoDIV.appendChild(Titulo7);

    let TotalDisc=document.createElement('label');
    TotalDisc.textContent='Quantidade: '+PlacasDisc.length;
    TotalDisc.style.fontWeight='bold';
    TotalDisc.style.position='relative';
    TotalDisc.style.left='50%';
    TotalDisc.style.transform='translateX(-50%)';
    CorpoDIV.appendChild(TotalDisc);

    let Espaco13=document.createElement('br');
    CorpoDIV.appendChild(Espaco13);

    for(let i=0;i<PlacasDisc.length;i++){
        let Espaco3=document.createElement('br');
        CorpoDIV.appendChild(Espaco3);

        let Discrepancias=document.createElement('label');
        Discrepancias.textContent=(i+1)+') '+PlacasDisc[i].textContent+": "+DescricaoDisc[i].textContent+")";
        Discrepancias.style.position='relative';
        Discrepancias.style.left='20px';
        CorpoDIV.appendChild(Discrepancias);
    }

    let Espaco15=document.createElement('br');
    CorpoDIV.appendChild(Espaco15);

    let Espaco16=document.createElement('br');
    CorpoDIV.appendChild(Espaco16);

    let Espaco17=document.createElement('br');
    CorpoDIV.appendChild(Espaco17);
    let Espaco18=document.createElement('br');
    CorpoDIV.appendChild(Espaco18);

    let Titulo8=document.createElement('label');
    Titulo8.textContent='4 - Objetos Cautelados';
    Titulo8.style.fontWeight='bold';
    Titulo8.style.position='relative';
    CorpoDIV.appendChild(Titulo8);

    let Espaco19=document.createElement('br');
    CorpoDIV.appendChild(Espaco19);

    let NomeAcessorio=document.getElementsByName('NomeAces');
    let Responsavel=document.getElementsByName('ResponsavelAces');

    for(let i=0;i<NomeAcessorio.length;i++){
        let Espaco3=document.createElement('br');
        CorpoDIV.appendChild(Espaco3);

        let Acessorios=document.createElement('label');
        Acessorios.textContent=' -'+NomeAcessorio[i].textContent+" ("+Responsavel[i].textContent+")";
        Acessorios.style.position='relative';
        Acessorios.style.left='20px';
        CorpoDIV.appendChild(Acessorios);
    }

    let Espaco20=document.createElement('br');
    CorpoDIV.appendChild(Espaco20);

    let Espaco21=document.createElement('br');
    CorpoDIV.appendChild(Espaco21);

    let Titulo9=document.createElement('label');
    Titulo9.textContent='5 - Observações';
    Titulo9.style.fontWeight='bold';
    Titulo9.style.position='relative';
    CorpoDIV.appendChild(Titulo9);

    let Espaco22=document.createElement('br');
    CorpoDIV.appendChild(Espaco22);

    let Espaco23=document.createElement('br');
    CorpoDIV.appendChild(Espaco23);

    let Observacoes=document.getElementsByName('Observacao');

    for(let i=0;i<Observacoes.length;i++){

        let Observacao=document.createElement('label');
        Observacao.textContent=' -'+Observacoes[i].textContent;
        Observacao.style.position='relative';
        Observacao.style.left='20px';
        CorpoDIV.appendChild(Observacao);
    }

    let ImprimirDIV=document.getElementById('Imprimir');
    ImprimirDIV.style.visibility='visible';

}
function ImprimirPDF(){
    const Imprimir=document.getElementById('ImprimirDIV');

    CriarImpressao();

    const Option={
        margin:[0,0,10,0],
        filename:"Relatorio Diario",
        html2canvas:{scale:2},
        jsPDF:{unit:"mm", format:"a4", orientation:"portrait"},
    };

    html2pdf().set(Option).from(Imprimir).save();
}