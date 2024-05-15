<div class="modal animated bounceInRight text-left" id="modal-delete-{{ $cat->id }}" tabindex="-1"
    role="dialog" aria-labelledby="myModalLabel49" aria-hidden="true">
    <div class="modal-dialog" role="document" >
        <div class="modal-content">
            <div class="modal-header bg-danger ">
                <h4 class="modal-title" id="myModalLabel49">Eliminar Rol de Usuario</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Confirme si desea Eliminar el Rol de Usuario</p>
            </div>
            <div class="modal-footer">
                {!! Form::open(['route' => ['categoria.destroy', $cat->id], 'method' => 'DELETE']) !!}
                <button  class="btn btn-outline-primary">Eliminar</button>
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Cerrar</button>
                
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>