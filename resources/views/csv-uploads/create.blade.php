@extends('layouts.app')

@section('title', 'Subir Archivo CSV')
@section('content_header_title', 'Subir Archivo CSV')

@section('content_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('csv-uploads.store') }}" method="POST" enctype="multipart/form-data" id="csvUploadForm">
                    @csrf
                    <div class="form-group">
                        <label for="csv_file">Selecciona un archivo CSV</label>
                        <input type="file" name="csv_file" id="csv_file" class="form-control-file @error('csv_file') is-invalid @enderror">
                        @error('csv_file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group" id="filenameGroup" style="display: none;">
                        <label for="filename">Nombre del archivo</label>
                        <input type="text" name="filename" id="filename" class="form-control @error('filename') is-invalid @enderror">
                        @error('filename')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Subir Archivo</button>
                </form>
            </div>
        </div>
    </div>
@stop

@push('js')
<script>
    document.getElementById('csv_file').addEventListener('change', function() {
        const filenameInput = document.getElementById('filename');
        const filenameGroup = document.getElementById('filenameGroup');

        if (this.files.length > 0) {
            filenameInput.value = this.files[0].name;
            filenameGroup.style.display = 'block';
        } else {
            filenameInput.value = '';
            filenameGroup.style.display = 'none';
        }
    });
</script>
@endpush