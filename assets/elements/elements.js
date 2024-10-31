import { Burger } from "./burger"
import SelectSubmit from "./selectSubmit"

customElements.define('burger-menu', Burger)
customElements.define('select-submit', SelectSubmit, {extends: 'select'})