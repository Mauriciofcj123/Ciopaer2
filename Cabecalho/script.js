var BTNMobile=document.getElementById('_BTNMobile');

function toglemenu(){
    let nav = document.getElementById('_nav');

    nav.classList.toggle('active');
    console.log('Clicou');
}

BTNMobile.addEventListener('click', toglemenu);
