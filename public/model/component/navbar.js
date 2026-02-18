export const 	navbar  = ({
			id       = "navbar",
			bgColor  = "bg-primary",
			fixed = "",
			height   = "1.5cm",
			top      = "0vh",
			bottom      = "0cm",
			padding = "0",
			widthClass="lg",
			align = "",
            borderRadius= "2em",
            margin= "0.5%",
            content = ""
		}) =>
		{

			let position = 	fixed === "fixed-top"
								? `top:${top}`
								:`bottom:${bottom}`;

					switch (align) {
						case 'left':
							align = "start";
							break;
						case 'right':
							align = "flex-end";
							break;
						case 'center':
							align = "center";
							break;
						case 'justify':
							align = "space-between";
							break;
						case 'around':
							align = "around";
							break;
						case 'evenly':
							align = "evenly";
							break;
						default:
							align = "end";
							break;
					}

					//console.log("-->",align)


				let customStyle =`
                    margin:${margin};
                    border-radius:${borderRadius};
					padding:${padding};
					height:${height};
					justify-content:${align} !important;
					${position}
				`;

				return `
                    <nav
                        id    = ${id}
                        class = "	navbar navbar-light
                                    ${widthClass}
                                    ${fixed}
                                    ${bgColor}
                                    ${align}
                                "
                        style = "
                                    ${customStyle}
                                "
                    >
                    ${content}
                    </nav>
                `
		}//fin funcion


