@extends('layout.app')

@section('content')
    <div class="home-header">
        <h1>Meus Álbuns</h1>
        <p>Organize suas fotos em coleções personalizadas.</p>
    </div>

    <div class="albums-container">

        @foreach ($albums as $album)
            <a href="{{ route('albums.show', $album->id) }}" class="album-card-link" style="text-decoration: none; color: inherit;">
                <div class="album-card">
                    <div class="album-image">
                        @if ($album->cover_photo)
                            <img src="{{ asset('storage/' . $album->cover_photo) }}">
                        @else
                            <img src="https://placehold.co/400x250?text=Sem+Capa">
                        @endif
                    </div>
                    <div class="album-info">
                        <h3>{{ $album->name }}</h3>
                        <p>{{ $album->description }}</p>
                    </div>
                </div>
            </a>
        @endforeach

    </div>
@endsection
