@extends('layout.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/styleForm.css') }}">

<div class="album-container">

    <div class="album-form-card">

        <h1>Atualizar álbum</h1>

        <form action="{{ route('album.update', $album->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome do Álbum</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Ex: Casamento Ana e João"
                    value="{{ old('name', $album->name) }}" required
                >
            </div>

            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    placeholder="Descreva o álbum..."
                >{{ old('description', $album->description) }}</textarea> </div>

            <div class="form-group">
                <label for="cover_photo">Foto de Capa (Opcional)</label>
                @if($album->cover_photo)
                    <div class="current-cover">
                        <small>Capa atual: {{ $album->cover_photo }}</small>
                    </div>
                @endif
                <input
                    type="file"
                    id="cover_photo"
                    name="cover_photo"
                    accept="image/*"
                >
            </div>
 
            <button type="submit" class="btn-save">
                Atualizar
            </button>

        </form>

    </div>

</div>

@endsection