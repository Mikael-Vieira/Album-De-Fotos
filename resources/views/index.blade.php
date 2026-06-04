@extends('layout.app')

@section('content')

<div class="home-header">
    <h1>Meus Álbuns</h1>
    <p>Organize suas fotos em coleções personalizadas.</p>
</div>

<div class="albums-container">

   @foreach ($albums as $album)
        <div class="album-card">
            <div class="album-image">
                <img src="https://placehold.co/400x250" alt="Álbum">
            </div>
            <div class="album-info">
                <h3>{{ $album->name }}</h3>
            </div>
        </div>
    @endforeach

</div>

@endsection
