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
        }, 3000);
    </script>
@endif

<div class="home-header">
    <h1>Meus Álbuns</h1>
    <p>Organize suas fotos em coleções personalizadas.</p>
</div>

<div class="albums-container">

    @foreach ($albums as $album)

        <div class="album-card">

            <div class="album-image">
                <a href="{{ route('albums.show', $album->id) }}">
                    @if ($album->cover_photo)
                        <img src="{{ asset('storage/' . $album->cover_photo) }}" alt="{{ $album->name }}">
                    @else
                        <img src="https://placehold.co/400x250?text=Sem+Capa" alt="Sem capa">
                    @endif
                </a>
            </div>

            <div class="album-info">

                <h3>
                    <a href="{{ route('albums.show', $album->id) }}"
                       style="text-decoration: none; color: inherit;">
                        {{ $album->name }}
                    </a>
                </h3>

                <p>{{ $album->description }}</p>

                <div class="album-actions">

                    <a href="{{ route('album.edit', $album->id) }}">
                        <button type="button" class="btn-editar-album">
                            Editar
                        </button>
                    </a>

                    <form action="{{ route('album.destroy', $album->id) }}"
                          method="POST"
                          onsubmit="return confirm('Tem certeza que deseja excluir este álbum?');">
                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn-excluir-album">
                            Excluir
                        </button>
                    </form>

                </div>

            </div>

        </div>

    @endforeach

</div>

@endsection
