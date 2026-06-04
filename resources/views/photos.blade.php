@extends('layout.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/stylePhoto.css') }}">

<div class="photos-container">

    <div class="photos-header">
        <h1>Minhas fotos</h1>

        <form enctype="multipart/form-data" class="upload-area">
            <label class="file-label" for="photos">
                📁 Escolher arquivos
            </label>
            <input id="photos" type="file" name="photos[]" multiple accept="image/*" style="display:none">
            <span class="file-name" id="file-name-display">Nenhum arquivo</span>
            <button type="submit" class="btn-upload">⬆ Fazer upload</button>
        </form>
    </div>

    <div class="photos-grid">

        <div class="photo-card">
            <img src="https://placehold.co/300x250" alt="Foto">
        </div>

        <div class="photo-card">
            <img src="https://placehold.co/300x250" alt="Foto">
        </div>

        <div class="photo-card">
            <img src="https://placehold.co/300x250" alt="Foto">
        </div>

        <div class="photo-card">
            <img src="https://placehold.co/300x250" alt="Foto">
        </div>

    </div>

</div>

@endsection
