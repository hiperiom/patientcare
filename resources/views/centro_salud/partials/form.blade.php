<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label requerido text-left">Nombre</label>
    <div class="col-sm-10">
        <input type="text" data-toggle="tooltip" title="Ingrese el Nombre" class="form-control" name="name" id="name" placeholder="Nombre" value="{{old('name', $data->name ?? '')}}" minlength="1" maxlength="100" required/>
    </div>
</div>
