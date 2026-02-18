<script>
    function ver(url){
        $.get(url, function(resp){
            $('#modal-content').html(resp);
            $('#modal').modal('toggle');
        });
    }

    $(".alert").delay(10000).slideUp(200, function() {
        $(this).alert('close');
    });
</script>

{{-- Eliminar --}}
    @if (session('eliminar') == 'ok') 
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Mensaje!',
                text: 'Registro Eliminado',
                showConfirmButton: false
            })
            setTimeout(function () { location.reload(1); }, 2000);
        </script>
    @endif

    <script>
        $("#pricing-table").on('submit', '.formulario-eliminar', function (e) {
            e.preventDefault();

            Swal.fire({
                    title: 'Estás Seguro de Eliminar?',
                    text: "Este Registro!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: "Cancelar",
                    confirmButtonText: 'Si, Eliminar!'
                }).then((result) => {
                if (result.value) {
                    this.submit();
                }
            })
        });
    </script>
{{-- Eliminar --}}

{{-- tooltip --}}
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script>
    $( document ).ready(function() {
        $('[data-toggle="tooltip"]').tooltip({'placement': 'top'});
    });
</script>
{{-- tooltip --}}

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div id="modal-content" class="modal-content"></div>
    </div>
</div>
<!-- Modal -->