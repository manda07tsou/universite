export class Dropdown extends HTMLElement{
    constructor(){
        super()
        this.isOpen = false;
        this.toggle = this.toggle.bind(this)
        this.onBlur = this.onBlur.bind(this)
    }

    connectedCallback(){
        let id = this.getAttribute('id')
        this.trigger = this.querySelector('.dropdown-trigger')
        this.listBox = this.querySelector('.dropdown-content')
        this.trigger.setAttribute('aria-haspopup','listbox')
        this.trigger.setAttribute('id', `${id}-trigger`)

        this.listBox.setAttribute('tabindex', -1)
        this.listBox.setAttribute('role', 'listbox')
        this.listBox.setAttribute('id', `${id}-content`)

        this.trigger.addEventListener('click', (e) => {
            e.preventDefault()
            this.toggle()
        })

        document.addEventListener('keyup', this.onkeyup.bind(this))

        this.listBox.addEventListener('blur', this.onBlur, true)
    }

    toggle(){
        if(this.isOpen){
            this.close()
        }else{
            this.open()
        }
    }

    open(){
        this.trigger.setAttribute('aria-expanded', true)
        this.listBox.classList.add('js-dropdown__open')
        this.listBox.focus();
        this.isOpen = true;
    }

    close(){
        this.trigger.removeAttribute('aria-expanded')
        this.listBox.classList.remove('js-dropdown__open')
        this.isOpen = false
    }


    onBlur(e){
        if(e.relatedTarget == this.trigger){
            return;
        }

        if(!this.listBox.contains(e.relatedTarget)){
            this.close()
            return;
        }
    }

    onkeyup(e){
        if(e.key == "Escape" && this.isOpen){
            this.close();
        }
    }

}