@extends('layout.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styleForm.css') }}">

    <div class="album-container">

        <div class="album-form-card">

            <h1>Adicionar Nova Foto</h1>

            @if (session('sucesso'))
                <div class="alert-success">
                    {{ session('sucesso') }}
                </div>
            @endif

            <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="photo">Selecione a Imagem</label>
                    <input type="file" id="photo" name="photos[]" accept="image/*" multiple required>
                </div>

                <div class="form-group">
                    <label for="album_id">Escolha o Álbum de Destino</label>
                    <select name="album_id">
                        <option value="">-- Deixar na galeria geral (Sem álbum) --</option>
                        @foreach ($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-save">
                    Adicionar Foto
                </button>

            </form>

        </div>

    </div>
@endsection
