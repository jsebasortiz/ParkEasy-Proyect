
    
<div class="form-group">
    <b>{{ Form::label('nombre', 'Nombre ') }}</b>
    <span style="color:red;">*</span>
    {{ Form::text('nombre', null, [
        'class' => 'form-control  ',
        'id' => 'nombre',
        'placeholder' => 'Nombre',
        'aria-describedby' => 'nombre',
        'required' => 'required',
        'autocomplete' => 'off',
    ]) }}   
    <div class="invalid-feedback">Por favor, escriba el Tipo Proceso.</div>
</div>
<div class="form-group">
    <b>{{ Form::label('descripcion', 'Descripción ') }}</b>
    <span style="color:red;">*</span>
    {{ Form::textarea('descripcion', null, [
        'class' => 'form-control  ',
        'id' => 'descripcion',
        'placeholder' => 'Descripción',
        'aria-describedby' => 'descripcion',
        'required' => 'required',
        'autocomplete' => 'off',
    ]) }}   
    <div class="invalid-feedback">Por favor, escriba el Tipo Proceso.</div>
</div>



<div class="row">   
    <div class="col-12 form-actions">
        {{-- <button type="submit" class="btn btn-relief-primary">Guardar</button> --}}
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('categoria.index') }}"> <button type="button" class="btn btn-danger">Cancelar</button></a>
        
    </div>
</div>
