var BTNMobile=document.getElementById('BTNMobile');

function toglemenu(){
    let nav = document.getElementById('nav');

    nav.classList.toggle('active');
}

BTNMobile.addEventListener('click', toglemenu);
