@extends('layouts.app')

@section('content')
    <!-- Basic Tables start -->
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Categorias</h4>
                    <a href="{{ route('categoria.create') }}"> <button type="submit"
                            class="btn btn-primary">Nuevo</button></a>
                </div>
                <div class="card-body">
                    {{-- <p class="card-text">
                    {{-- Using the most basic table Leanne Grahamup, here’s how <code>.table</code>-based tables look in Bootstrap. You
                    can use any example of below table for your table and it can be use with any type of bootstrap tables. --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered " id="datatable">
                            <thead>
                                <tr>
                                    <th>NOMBRE</th>
                                    <th>DESCRIPCION</th>
                                    <th>EDITAR</th>
                                    <th>ELIMINAR</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categorias as $cat)
                                    <tr>
                                        <td><b>{{ $cat->nombre }}</b></td>
                                        <td>{{ $cat->descripcion }}</td>
                                        <td>
                                            <a href="{{ route('categoria.edit', $cat->id) }}"> <button type="button"
                                                    class="btn btn-success">editar</button></a>


                                        </td>
                                        <td>                                         

                                                {!! Form::open(['route' => ['categoria.destroy', $cat->id], 'method' => 'DELETE']) !!}
                                                <button  class="btn btn-danger">Eliminar</button> 
                                                {!! Form::close() !!}
                                        </td>


                                        
                                    </tr>
                                    {{-- @include('categorias.modal') --}}
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Basic Tables end -->
@endsection

@section('css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plantilla/app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plantilla/app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plantilla/app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('plantilla/app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
    {{-- <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css }}"> --}}
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
                }
            });
        });
    </script>

    {{-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script> --}}

    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('plantilla/app-assets/js/scripts/tables/table-datatables-basic.js') }}"></script>
@endsection
