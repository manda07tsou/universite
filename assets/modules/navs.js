window.addEventListener('load', () => {
    //scroll vers l'element active sur le scroll est activé sur nav-sticky
    let navs = document.querySelector('.nav-sticky')
    if(navs && navs.getBoundingClientRect().width < navs.lastElementChild.offsetLeft){
        let el = navs.querySelector('.active')
        let left = el.offsetLeft
        navs.scrollTo({
            top: 0,
            left: left,
            behavior: 'smooth'
        })
    }
})