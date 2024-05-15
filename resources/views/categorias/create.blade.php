@extends('layouts.app')

@section('content')
    <section class="bs-validation">
        <div class="row">
            <!-- Bootstrap Validation -->
            <div class="col-md-12 col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Crear categoria</h4>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'categoria.store']) !!}
                        @csrf
                        @include('categorias.partials.form')
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
