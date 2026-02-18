import {navbar} from './component/navbar.js'
import {navbarBrand} from './component/navbar-brand.js'
import {navbarHomeBtn} from './component/navbar-home-btn.js'


document.querySelector('header').insertAdjacentHTML= navbar({
    top:"2cm",
    //fixed:"fixed-top",
    padding: "0px 1em 0px 1em",
    align:"justify",
    content: navbarHomeBtn({})
});
