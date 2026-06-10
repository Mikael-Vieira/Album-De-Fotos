@extends('layout.app')

@section('content')

@if (session('sucesso'))
    <div id="mensagem-sucesso"
         style="background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
        {{ session('sucesso') }}
    </div>

    <script>
        setTimeout(() => {
            const mensagem = document.getElementById('mensagem-sucesso');

            if (mensagem) {
                mensagem.style.transition = 'opacity 0.5s';
                mensagem.style.opacity = '0';

                setTimeout(() => {
                    mensagem.remove();
                }, 500);
            }
        }, 3000); // 3 segundos
    </script>
@endif

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

                <!-- Tenho que adicionar a funcionalidade desse botao -->
                <div class="album-actions">
                    <a href="{{ route('album.edit', $album->id) }}">
                        <button class="btn-editar-album"> Editar </button>
                    </a>

                    <form action="{{ route('album.destroy', $album->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este álbum?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-excluir-album">Excluir</button>
                    </form>
                </div>

            </div>
        </div>
    </a>
    @endforeach

</div>
@endsection