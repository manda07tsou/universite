import { Burger } from "./burger"
import SelectSubmit from "./selectSubmit"
import { Dropdown } from "./dropdown"

customElements.define('burger-menu', Burger)
customElements.define('select-submit', SelectSubmit, {extends: 'select'})
customElements.define('drop-down', Dropdown)