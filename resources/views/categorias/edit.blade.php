@extends('layouts.app')

@section('content')
<section class="bs-validation">
    <div class="row">
        <!-- Bootstrap Validation -->
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Editar categoria</h4>
                </div>
                <div class="card-body">
                    {{-- <form class="needs-validation" novalidate>
                        
                    </form> --}}                    
                    {!! Form::model($categoria, ['route' => ['categoria.update', $categoria->id], 'method' => 'PUT']) !!}
                    @csrf
                    @include('categorias.partials.form')
                   
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <!-- /Bootstrap Validation -->

 
    </div>
</section>
@endsection