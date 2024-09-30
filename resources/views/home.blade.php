@extends('adminlte::page')

{{-- Customize layout sections --}}

@section('title', 'Home')
@section('content_header_title', 'Home')
@section('content_header_subtitle', 'Welcome')

{{-- Content body: main page content --}}

@section('content_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Bienvenido a tu Dashboard</h1>
                <p>Aquí puedes realizar las siguientes acciones:</p>
                <ul>
                    <li>Subir archivos CSV de chats de Discord.</li>
                    <li>Realizar consultas a modelos LLM utilizando los datos del archivo CSV.</li>
                    <li>Ver los resultados de las consultas realizadas.</li>
                </ul>
                <p>Para comenzar, utiliza el menú de la izquierda para acceder a las diferentes secciones.</p>
            </div>
        </div>
    </div>
@stop

{{-- Push extra CSS --}}

@push('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@endpush

{{-- Push extra scripts --}}

@push('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@endpush