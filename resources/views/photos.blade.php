@extends('layout.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/stylePhoto.css') }}">

<div class="photos-container">

    <div class="photos-header">
        <h1>Minhas fotos</h1>

        @if(session('sucesso'))
            <div class="alert-success">
                {{ session('sucesso') }}
            </div>
        @endif
    </div>

    <div class="photos-grid">

        @forelse($photos as $photo)
            <div class="photo-card">

                <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" class="delete-photo-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-photo-btn" onclick="return confirm('ATENÇÃO: Isso apagará a foto permanentemente de todos os álbuns e do sistema. Deseja continuar?')">
                        ✕
                    </button>
                </form>
                <a href="{{ asset('storage/' . $photo->image_path) }}" target="_blank" title="Clique para ver a foto">
                    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Foto" class="photo-card-img">
                </a>

                <form action="{{ route('photos.link-album') }}" method="POST" class="link-album-form">
                    @csrf
                    <input type="hidden" name="photo_id" value="{{ $photo->id }}">

                    <div class="link-album-row">
                        <select name="album_id" required class="link-album-select">
                            <option value="">Catalogar em...</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn-link-album">
                            OK
                        </button>
                    </div>
                </form>

            </div>
        @empty
            <p class="empty-photos-message">Nenhuma foto cadastrada ainda.</p>
        @endforelse

    </div>

</div>

@endsection
