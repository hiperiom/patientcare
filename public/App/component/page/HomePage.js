import {CopyHtml} from "/App/helper/CopyHtml.js"
import {Navbar} from "/App/component/Navbar.js"
export function HomePage(){

    const   $body = document.querySelector("body");
            $body.classList.add("bg-home")
    const   $header = document.querySelector("header");

            $header.appendChild(Navbar())
    const   $main = document.querySelector("main");
            $main.appendChild(CopyHtml("page-home"))


}
