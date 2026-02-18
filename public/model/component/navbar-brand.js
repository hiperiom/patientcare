export const 	navbarBrand  = ({
    id      = "navbarBrand",
    href    = "#",
    imgSrc  = "http://via.placeholder.com/150",
    width   = "6.25em",//100px
    height  = "2.5em",//40px
    texto   = "",
    padding = "0",
    margin = "0",
    rounded ="",
    customClass = ""
}) =>
{
    let customStyle =`
        width:${width};
        height:${height};
        margin:${margin};
        padding:${padding};

    `;

    return (`
        <div>
        <a
            id="${id}"
            class="navbar-brand m-0 p-0"
            href="${href}"
        >
            <img

                src="${imgSrc}"
                alt="${width}x${height}"
                style="${customStyle}"
                class="d-flex mx-auto img-fluid ${rounded} ${customClass}"
            >${texto}</a>
        </div>
    `);

}//fin funcion
