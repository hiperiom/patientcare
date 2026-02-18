@extends('component.app')
@section('title')
    Patientcare | Área Quirúrgica
@endsection
@section('script')
    <script>
        let userNombres =  "<?php echo session('userData')['nombre']; ?>"
        let userApellidos =  "<?php echo session('userData')['apellido']; ?>"
        let userGenero =  "<?php echo session('userData')['genero'] ?>"
        let userPrefijo =  "<?php echo session('userData')['prefijo'] ?>"
        let userIdMedico =  "<?php echo session('userData')['user_id'] ?>"
    </script>
    <script src="{{ mix('js/app_area_quirurgica_enfermeria.js') }}" type="text/javascript"></script>
@endsection