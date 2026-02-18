import {Ajax} from "/App/helper/ajax.js"
import {LoginPage} from "/App/component/page/Login.js"
import {HomePage} from "/App/component/page/HomePage.js"

const d     = document;
const $main = document.querySelector("main");

d.addEventListener("DOMContentLoaded",function(e){

    $main.appendChild(HomePage())

})
