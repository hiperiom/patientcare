@extends('component.app')
@section('title')
    Patientcare | Área Quirúrgica
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.0/dist/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
    <script>
        let userNombres =  "<?php echo session('userData')['nombre']; ?>"
        let userApellidos =  "<?php echo session('userData')['apellido']; ?>"
        let userGenero =  "<?php echo session('userData')['genero'] ?>"
        let userPrefijo =  "<?php echo session('userData')['prefijo'] ?>"
        let userIdMedico =  "<?php echo session('userData')['user_id'] ?>"
    </script>
    <script src="{{ mix('js/app_tablero_area_quirurgica.js') }}" type="text/javascript"></script>
@endsection
