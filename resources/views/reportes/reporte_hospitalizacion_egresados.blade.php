<!doctype html>
<html lang="en">

    <head>
        <title>Egresados Hospitalización</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="/css/stylePatientcare.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="{{asset('image/system/icomoon3/style.css')}}">
        <style>
            i.fas.fa-male.text-success.h2:hover {
                color: white !important;
                cursor: pointer;
            }


            /* .users_buttons{
                display:none;
            } */
            body{
                    /* background-color: #213647; */
                    padding: 1rem;
                    margin: 0 auto;
                    max-width: 1725px;
                }
            .icon-home{
                font-size: 6rem;
                }
            .icon-logo-institution{
                    height: 6em;
                }


            @media (min-width: 0px) {
                i.h2{
                    font-size:1rem;
                }
                .item-count {
                    font-size: 4rem;
                    line-height: 0.6;
                }
                .count-type-user{
                    font-size: 1rem;
                }
                .icon-report-men{
                    font-size: 3rem;
                }
                .icon-home {
                    font-size: 3rem;
                }
                .icon-logo-institution {
                    height: 2.6em;
                }
                .header-titles.h1 {
                    font-size: 0.7rem;
                }
                .header-titles-2.h2{
                    font-size: 1rem;
                }
            }
            @media (max-width: 576px) {
                .row.users_buttons{
                    margin-right: 1rem;
                    margin-left: 1rem;
                }
                .row.users_buttons > .col-1-custom{
                    -ms-flex: 0 0 3% !important;
                    flex: 0 0 3% !important;
                    position: relative !important;
                    text-align: center !important;
                    width: 10px !important;
                    padding-right: 0.2rem !important;
                    padding-left: 0.2rem !important;
                }
            }
            @media (min-width: 576px) {
                .icon-report-men{
                    font-size: 20rem;
                }
                i.h2{
                    font-size:2rem;
                }
                .users_buttons{
                    display:flex;
                }
                .icon-home {
                    font-size: 3rem;
                }
                .icon-logo-institution {
                    height: 2.6em;
                }
                .header-titles.h1 {
                    font-size: 1.3rem;
                }
                .header-titles-2.h2{
                    font-size: 1rem;
                }
            }
            @media (min-width: 992px) {
                .item-count{
                    font-size: 6rem;
                    line-height: 0.6;
                }
                .count-type-user{
                    font-size: 1.5rem;
                }
                .icon-home {
                    font-size: 6rem;
                }
                .icon-logo-institution {
                    height: 6em;
                }
                .header-titles.h1 {
                    font-size: 2.5rem;
                }
                .header-titles-2.h2{
                    font-size: 2rem;
                }
            }
            .rotate-in-ver{-webkit-animation:rotate-in-ver .5s cubic-bezier(.25,.46,.45,.94) both;animation:rotate-in-ver .5s cubic-bezier(.25,.46,.45,.94) both}
            @-webkit-keyframes rotate-in-ver{0%{-webkit-transform:rotateY(-360deg);transform:rotateY(-360deg);opacity:0}100%{-webkit-transform:rotateY(0deg);transform:rotateY(0deg);opacity:1}}@keyframes rotate-in-ver{0%{-webkit-transform:rotateY(-360deg);transform:rotateY(-360deg);opacity:0}100%{-webkit-transform:rotateY(0deg);transform:rotateY(0deg);opacity:1}}
            .scale-in-ver-top{-webkit-animation:scale-in-ver-top .5s cubic-bezier(.25,.46,.45,.94) both;animation:scale-in-ver-top .5s cubic-bezier(.25,.46,.45,.94) both}
            @-webkit-keyframes scale-in-ver-top{0%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}@keyframes scale-in-ver-top{0%{-webkit-transform:scaleY(0);transform:scaleY(0);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}100%{-webkit-transform:scaleY(1);transform:scaleY(1);-webkit-transform-origin:100% 0;transform-origin:100% 0;opacity:1}}
        </style>
    </head>
    <body>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>CEDULA</th>
                    <th>CORREO</th>
                    <th>AREA</th>
                    <th>HABITACIÓN</th>
                    <th>NOMBRES</th>
                    <th>APELLIDOS</th>
                    <th>TELEFONO</th>
                    <th>FECHA EGRESO</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($model as $key=>$item)
                    <tr>
                        <td scope="row">{{ $key+1 }}</td>
                        <td>{{ $item->CEDULA }}</td>
                        <td>{{ $item->CORREO }}</td>
                        <td>{{ $item->AREA }}</td>
                        <td>{{ $item->HABITACION }}</td>
                        <td>{{ $item->NOMBRES }}</td>
                        <td>{{ $item->APELLIDOS }}</td>
                        <td>{{ (int) $item->TELEFONO }}</td>
                        <td>{{ $item->FECHA_EGRESO }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
        </script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <script src="/js/html2canvas.min.js"></script>

    </body>

</html>
