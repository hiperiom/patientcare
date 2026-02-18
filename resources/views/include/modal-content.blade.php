<!-- Modal -->

<div class="modal-content">
    <div class="modal-header bg-primary">
        <h5 class="modal-title">@yield('titulo')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <p>@yield('cuerpo')</p>
    </div>
    <div class="modal-footer">
        <p>@yield('footer')</p>
    </div>
</div>
