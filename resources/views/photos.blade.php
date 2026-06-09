@extends('layout.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/stylePhoto.css') }}">

<div class="photos-container">

    <div class="photos-header">
        <h1>Minhas fotos</h1>

        @if(session('sucesso'))
            <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 15px; width: 100%;">
                {{ session('sucesso') }}
            </div>
        @endif
    </div>

    <div class="photos-grid">

        @forelse($photos as $photo)
            <div class="photo-card" style="border: 1px solid #ddd; padding: 10px; border-radius: 8px; background: #fff; display: flex; flex-direction: column; gap: 10px; position: relative;">

                <form action="{{ route('photos.destroy', $photo->id) }}" method="POST" class="delete-photo-form">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-photo-btn" onclick="return confirm('ATENÇÃO: Isso apagará a foto permanentemente de todos os álbuns e do sistema. Deseja continuar?')">
                        ✕
                    </button>
                </form>
                <a href="{{ asset('storage/' . $photo->image_path) }}" target="_blank" title="Clique para ver a foto">
                    <img src="{{ asset('storage/' . $photo->image_path) }}" alt="Foto" style="width: 100%; height: 200px; object-fit: cover; border-radius: 4px;">
                </a>


                <form action="{{ route('photos.link-album') }}" method="POST" style="margin-top: auto;">
                    @csrf
                    <input type="hidden" name="photo_id" value="{{ $photo->id }}">

                    <div style="display: flex; gap: 5px;">
                        <select name="album_id" required style="flex-grow: 1; padding: 5px; font-size: 12px; border-radius: 4px;">
                            <option value="">Catalogar em...</option>
                            @foreach($albums as $album)
                                <option value="{{ $album->id }}">{{ $album->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" style="background: #007bff; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer; font-size: 12px;">
                            OK
                        </button>
                    </div>
                </form>

            </div>
        @empty
            <p style="grid-column: 1 / -1; text-align: center; color: #777;">Nenhuma foto cadastrada ainda.</p>
        @endforelse

    </div>

</div>

@endsection