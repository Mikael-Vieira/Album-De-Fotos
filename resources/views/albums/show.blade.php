    @extends('layout.app')

    @section('content')
    <link rel="stylesheet" href="{{ asset('css/styleShow.css') }}">


    <div class="album-show-container">

        <a href="{{ route('card.index') }}" class="back-link">⬅️ Voltar para o início</a>

        <h1 class="album-title">{{ $album->name }}</h1>

        <div class="photos-grid">
            @forelse($album->photos as $photo)
            <div class="photo-card" style="position: relative;">

                <a href="{{ asset('storage/' . $photo->image_path) }}" target="_blank" title="Clique para ver a foto crua">
                    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Foto do álbum" style="cursor: pointer;">
                </a>

                <form action="{{ route('albums.photos.detach', [$album->id, $photo->id]) }}" method="POST" class="detach-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="detach-btn" onclick="return confirm('Deseja mesmo remover esta foto do álbum?')">
                        ✕
                    </button>
                </form>
            </div>
            @empty
            <div class="empty-grid-message">
                <p>Nenhuma foto adicionada ainda.</p>
                <a href="{{ route('photos.index') }}" class="catalog-btn">Catalogar Fotos</a>
            </div>
            @endforelse
        </div>

    </div>
    @endsection