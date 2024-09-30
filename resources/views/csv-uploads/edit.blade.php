@extends('layouts.app')

@section('title', 'Editar Archivo CSV')
@section('content_header_title', 'Editar Archivo CSV')

@section('content_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('csv-uploads.update', $csvUpload) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="filename">Nombre del archivo</label>
                        <input type="text" name="filename" id="filename" class="form-control @error('filename') is-invalid @enderror" value="{{ old('filename', $csvUpload->filename) }}">
                        @error('filename')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="csv_file">Selecciona un archivo CSV</label>
                        <input type="file" name="csv_file" id="csv_file" class="form-control-file @error('csv_file') is-invalid @enderror">
                        @error('csv_file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
@stop