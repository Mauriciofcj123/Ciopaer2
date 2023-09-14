let HorasAtuais=document.getElementsByName('HorasAtuais');
let HorasProxRev=document.getElementsByName('HorasProxRev');
let HorasDisp=document.getElementsByName('HorasDisp');
let Linhas=document.getElementsByName('Linha');

document.addEventListener('keyup',()=>{
    for(i=0;i<HorasAtuais.length;i++){
        HorasDisp[i].value=(HorasProxRev[i-1].value-HorasAtuais[i-1].value).toFixed(2);

        if(HorasDisp[i].value>20){
            HorasDisp[i].style.backgroundColor='white';
        }else if(HorasDisp[i].value<20&&HorasDisp[i].value>10){
            HorasDisp[i].style.backgroundColor='yellow';
        }else{
            HorasDisp[i].style.backgroundColor='red';
        }
            
    }

    for(i=0;i<Linhas.length-1;i++){
        let TBODisp=document.getElementsByName('TBODisp'+i);
        let TBO=document.getElementsByName('TBO'+i);

        console.log(TBO[0].value);

        for(T=0;T<TBO.length;T++){
            TBODisp[T].value=(TBO[T].value-HorasAtuais[i].value).toFixed(2);

            if(TBODisp[T].value>20){
                TBODisp[T].style.backgroundColor='white';
            }else if(HorasDisp[i].value<20&&HorasDisp[i].value>10){
                HorasDisp[i].style.backgroundColor='yellow';
            }else{
                HorasDisp[i].style.backgroundColor='red';
            }
        }
            
    }
});

document.addEventListener('click',()=>{
    for(i=0;i<HorasAtuais.length;i++){
        HorasDisp[i].value=(HorasProxRev[i-1].value-HorasAtuais[i-1].value).toFixed(2);
        console.log(i+" - "+HorasProxRev[i].value);
        console.log(i+" - "+HorasAtuais[i].value);
        console.log(i+" - "+HorasDisp[i].value);

        if(HorasDisp[i].value>20){
            HorasDisp[i].style.backgroundColor='white';
        }else if(HorasDisp[i].value<20&&HorasDisp[i].value>10){
            HorasDisp[i].style.backgroundColor='yellow';
        }else{
            HorasDisp[i].style.backgroundColor='red';
        }
            
    }

    for(i=0;i<TBO.length-1;i++){
        TBODisp[i].value=(TBO[i].value-HorasAtuais[i].value).toFixed(2);
        console.log(TBO[i].value+"-"+i+' TBO');
        console.log((HorasAtuais[i].value)+"-"+i+" HorasDisp");
        

        if(TBODisp[i].value>20){
            TBODisp[i].style.backgroundColor='white';
        }else if(HorasDisp[i].value<20&&HorasDisp[i].value>10){
            HorasDisp[i].style.backgroundColor='yellow';
        }else{
            HorasDisp[i].style.backgroundColor='red';
        }
            
    }
});

let Secoes=document.getElementById('Secoes');
