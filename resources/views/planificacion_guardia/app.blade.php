@extends('component.app')
@section('title')
    Patientcare | Planificación Guardias
@endsection

@section('script')


     <script>
        let userNombres =  "<?php echo session('userData')['nombre']; ?>"
        let userApellidos =  "<?php echo session('userData')['apellido']; ?>"
        let userGenero =  "<?php echo session('userData')['genero'] ?>"
        let userPrefijo =  "<?php echo session('userData')['prefijo'] ?>"
        let userIdMedico =  "<?php echo session('userData')['user_id'] ?>"

    </script>
    <script src="{{ mix('js/app_planificacion_guardias.js') }}" type="text/javascript"></script>
@endsection
