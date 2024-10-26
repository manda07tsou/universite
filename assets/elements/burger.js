export class Burger extends HTMLElement{
    constructor(){
        super()
        this.open = false;
        this.parentEl = document.querySelector(this.getAttribute('parent'))
    }

    connectedCallback(){
        this.setAttribute('isOpen', this.open)
        this.innerHTML = `
                <span></span>
                <span></span>
                <span></span>
        `
        this.addEventListener('click', (e) => {
            this.parentEl.classList.toggle('is-open')
            this.open = !this.open
            this.setAttribute('isOpen', this.open)
        })
    }
}
