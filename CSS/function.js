function showhide() {
    let menu = document.getElementsByClassName("menu")[0];
    let hero_content = document.getElementsByClassName("hero__content")[0];

    menu.classList.toggle("menu-show");
    hero_content.classList.toggle("hide-hero__content")
}


function black_band() {
    let h_container = document.getElementsByClassName("header__container")[0];
    if (window.scrollY > window.innerHeight - 100) {
        console.log('La pagina è stata scrollata')
        h_container.classList.add('b-g')
    } else {
        h_container.classList.remove('b-g')
    }

}

//Fatto da Varisco e De Vecchi