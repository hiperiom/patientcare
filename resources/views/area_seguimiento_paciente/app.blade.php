@extends('component.app')
@section('title')
    Patientcare
@endsection
@section('script')
    <script>
        let userNombres =  "<?php echo session('userData')['nombre']; ?>"
        let userImage =  "<?php echo session('userData')['imagen']; ?>"
        let userApellidos =  "<?php echo session('userData')['apellido']; ?>"
        let userGenero =  "<?php echo session('userData')['genero'] ?>"
        let userPrefijo =  "<?php echo session('userData')['prefijo'] ?>"
        let userIdMedico =  "<?php echo session('userData')['user_id'] ?>"
    </script>
    <script src="{{ mix('js/app_seguimiento_pacientes.js') }}" type="text/javascript"></script>
@endsection
