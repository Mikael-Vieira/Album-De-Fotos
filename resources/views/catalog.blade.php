@extends('layout.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/styleForm.css') }}">

    <div class="album-container" style="max-width: 600px; margin: 50px auto; padding: 20px;">

        <div class="album-form-card">

            <h1>Adicionar Nova Foto</h1>

            @if (session('sucesso'))
                <div style="background: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 20px;">
                    {{ session('sucesso') }}
                </div>
            @endif

            <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="photo">Selecione a Imagem</label>
                    <input type="file" id="photo" name="photos[]" accept="image/*" multiple required>
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    <label for="album_id">Escolha o Álbum de Destino</label>
                    <select name="album_id">
                        <option value="">-- Deixar na galeria geral (Sem álbum) --</option>
                        @foreach ($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn-save"
                    style="width: 100%; padding: 12px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer;">
                    Adicionar Foto
                </button>

            </form>

        </div>

    </div>
@endsection
