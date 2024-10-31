//ELEMENT personnalisé pour envoyer automatiquement dans le parms d'url la valeur du select selectionner
export default class SelectSubmit extends HTMLSelectElement{
    constructor(){
        super();
    }

    connectedCallback(){
        this.addEventListener('change', this.sendRequest.bind(this))
    }

    sendRequest(e){
        let params = new URLSearchParams(window.location.search)
        let select = e.target
        let name_attr = select.getAttribute('name')
        let value = select.options[select.selectedIndex].value

        if(value == ''){
            params.delete(name_attr)
        }else{
            params.set(name_attr, value)
        }
        window.location.replace(`${window.location.pathname}?${params}`)
    }

}