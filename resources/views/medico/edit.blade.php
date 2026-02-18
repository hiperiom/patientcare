{{-- @extends('component.template')

@section('title')
    CMDLT | Patientcare@endsection
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
        @include('component.menu_user')
    @endif
@endsection
@section('content')
    @yield('menu_2')
    <div class="content-wrapper">
        <div class="wrapper">
            <div id="content_1" class="mb-4"></div>
        </div>
    </div>
@endsection
@section('footer')
    @include('component.menu_footer')
@endsection
@section('script')
    <script>
        $(function () {
            //CatUserEspecialidad.getIndex();
            UserMedico.edit("#content_1","{{$user_id}}")
        });
    </script>
@endsection
@section('css')
    <style>

    </style>
@endsection
 --}}
 @extends('component.template')

@section('title')
    CMDLT | Patientcare
@endsection
@section('header')
    @include('component.menu_principal')
@endsection
@section('menu_2')
    @if (!is_null(session('userData')))
    <nav class="d-flex justify-content-end  bg-gray p-1"  style="   height: 60px;">
        <button onclick="location.href='/medico/index_medicos'" class="btn bg-transparent d-flex align-items-center" type="button" >
            <div class="d-flex flex-column align-items-end">
                <span class="text-white">
                    @if (isset(session('userData')["genero"]) && session('userData')["genero"]=="f")
                        ¡Bienvenida!
                    @else
                        ¡Bienvenido!

                    @endif
                </span>

                <b class="text-white text-nowrap" >
                    {{!is_null(session('userData')["prefijo"])?session('userData')["prefijo"]:""}} {{session('userData')["nombre"]}} {{session('userData')["apellido"]}}
                </b>


            </div>
            <img id="img_profile" onerror="this.src = '/image/system/medic.svg'"
                class="ml-1 border border-white rounded-circle" style="height: 1.1cm;width:1.1cm"
                src="{{ session('userData')['imagen'] }}" alt="">

        </button>

    </nav>
    @endif
@endsection
@section('content')
    @yield('menu_2')
    <div class="content-wrapper">
        <div class="wrapper">
            <div id="content_1" class="mb-4"></div>
        </div>
    </div>
@endsection
@section('footer')
    @include('component.menu_footer')
@endsection
@section('script')
    <script>
        let user_id =  "<?php echo $user_id; ?>"
    </script>
    <script src="{{ mix('js/app_gestion_medicos.js') }}" type="text/javascript"></script>

@endsection
@section('css')
    <style>

    </style>
@endsection
