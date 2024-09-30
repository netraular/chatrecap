@extends('layouts.app')

@section('title', 'Archivos CSV')
@section('content_header_title', 'Archivos CSV Subidos')

@section('content_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <a href="{{ route('csv-uploads.create') }}" class="btn btn-primary mb-3">Subir nuevo archivo CSV</a>
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="opacity: 0.8;">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="opacity: 0.8;">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nombre del archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($csvUploads as $csvUpload)
                            <tr>
                                <td>{{ $csvUpload->filename }}</td>
                                <td>
                                    <a href="{{ route('csv-uploads.edit', $csvUpload) }}" class="btn btn-primary">Editar</a>
                                    <a href="{{ route('csv-uploads.show', $csvUpload) }}" class="btn btn-info">Ver</a>
                                    <form action="{{ route('csv-uploads.destroy', $csvUpload) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este archivo?')">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    $(document).ready(function() {
        // Auto-hide success messages after 5 seconds with fade out effect
        setTimeout(function() {
            $('.alert-success').fadeOut('slow');
        }, 5000);
    });
</script>
@endpush