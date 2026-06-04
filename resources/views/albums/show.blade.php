@extends('layout.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styleShow.css') }}">


<div class="album-show-container">

    <a href="{{ route('card.index') }}" class="back-link">⬅️ Voltar para o início</a>

    <h1 class="album-title">{{ $album->name }}</h1>

    <div class="photos-grid">
        @forelse($album->photos as $photo)
            <div class="photo-card">
                <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Foto do álbum">
            </div>
        @empty
            <div class="empty-grid-message">
                <p>Nenhuma foto adicionada ainda.</p>
                <a href="{{ route('photos.catalogar') }}" class="catalog-btn">Catalogar Fotos</a>
            </div>
        @endforelse
    </div>

</div>
@endsection
