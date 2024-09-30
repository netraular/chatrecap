@extends('layouts.app')

@section('title', 'Ver Archivo CSV')
@section('content_header_title', 'Ver Archivo CSV')

@section('content_body')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>{{ $csvUpload->filename }}</h2>
                <div class="chat-container">
                    @php
                        $previousDate = null;
                    @endphp
                    @foreach($csvData as $row)
                        @php
                            $currentDate = \Carbon\Carbon::parse($row['Date'])->format('Y-m-d');
                            $currentTime = \Carbon\Carbon::parse($row['Date'])->format('H:i:s');
                        @endphp
                        @if($currentDate !== $previousDate)
                            <div class="chat-date-separator">
                                <span>{{ $currentDate }}</span>
                            </div>
                        @endif
                        <div class="chat-message">
                            <div class="chat-author-time">
                                <span class="chat-author">{{ $row['Author'] }}</span>
                                <span class="chat-time">{{ $currentTime }}</span>
                            </div>
                            <div class="chat-content">{{ $row['Content'] }}</div>
                            @if($row['Attachments'])
                                <div class="chat-attachment">
                                    <a href="{{ $row['Attachments'] }}" target="_blank">Ver adjunto</a>
                                </div>
                            @endif
                        </div>
                        @php
                            $previousDate = $currentDate;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@push('css')
<style>
    .chat-container {
        max-height: 80vh; /* Ajusta la altura máxima del contenedor de chat */
        overflow-y: auto; /* Habilita el scroll vertical */
        overflow-x: hidden; /* Evita el scroll horizontal */
        padding-right: 15px; /* Añade un poco de espacio a la derecha para evitar que el scroll tape el contenido */
    }

    .chat-date-separator {
        text-align: center;
        margin: 20px 0;
        position: relative;
    }

    .chat-date-separator span {
        background-color: #fff;
        padding: 0 10px;
        position: relative;
        z-index: 1;
    }

    .chat-date-separator::before {
        content: '';
        display: block;
        width: 100%;
        height: 1px;
        background-color: #ccc;
        position: absolute;
        top: 50%;
        left: 0;
        z-index: 0;
    }

    .chat-message {
        margin-bottom: 15px;
        word-wrap: break-word; /* Rompe las palabras largas en varias líneas */
        margin-left: 20px; /* Añade más espacio a la izquierda de los mensajes */
    }

    .chat-author-time {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }

    .chat-author {
        font-weight: bold;
        margin-right: 10px; /* Añade un poco de espacio entre el autor y la hora */
    }

    .chat-time {
        color: #888;
        font-size: 0.9em;
    }

    .chat-content {
        margin-left: 20px; /* Añade un poco de espacio a la derecha del autor */
    }

    .chat-attachment {
        margin-left: 20px; /* Añade más espacio a la izquierda de los adjuntos */
    }

    .chat-attachment a {
        color: #007bff;
        text-decoration: none;
    }

    .chat-attachment a:hover {
        text-decoration: underline;
    }
</style>
@endpush